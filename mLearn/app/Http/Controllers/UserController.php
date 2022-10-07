<?php

namespace App\Http\Controllers;

use App\EnumTypes\AccessLevelType;
use App\Http\Controllers\Traits\ApiResponseTrait;
use App\Http\Requests\UserRequest;
use App\Services\UserServiceInterface;
use Error;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponseTrait;

    public function __construct(private UserServiceInterface $userService)
    {
    }

    public function index()
    {
        $users = $this->userService->users();

        return view('user.index', ["users" => $users]);
    }

    public function create()
    {
        return view('user.create');
    }

    public function store(UserRequest $userRequest)
    {
        return $this->run(function () use ($userRequest) {
            return ['user' => $this->userService->store($userRequest)];
        });
    }

    public function storePage(UserRequest $userRequest)
    {
        try {
            $this->userService->store($userRequest);

            return redirect('/user')->with('success', 'Usuario cadastrado com sucesso.');
        } catch (Exception $e) {
            return redirect('/user')->with('errors', $e->getMessage());
        }
    }

    /**
     * Is a api controller and return JsonResponse
     */
    public function upgrade(Request $request)
    {
        return $this->run(function () use ($request) {
            $user = $this->userService->findUserByExternalId($request->userExternalId);

            if ($user->access_level == AccessLevelType::PREMIUM)
                throw new Exception('Usuario premium nao pode receber ascensão');

            if ($this->userService->changeAccessLevel($user, AccessLevelType::PREMIUM))
                return ["user" => $user];

            throw new Exception('Erro ao ascender usuario!');
        });
    }

    /**
     * Is a api controller and return JsonResponse
     */
    public function downgrade(Request $request)
    {
        return $this->run(function () use ($request) {
            $user = $this->userService->findUserByExternalId($request->userExternalId);

            if ($user->access_level == AccessLevelType::PRO)
                throw new Exception('Usuario pro nao pode ser rebaixado');

            if ($this->userService->changeAccessLevel($user, AccessLevelType::PRO))
                return ["user" => $user];

            throw new Exception('Erro ao rebaixar usuario!');
        });
    }

    public function upgradePage(Request $request)
    {

        $user = $this->userService->findUserByExternalId($request->userExternalId);

        if ($user->access_level == AccessLevelType::PREMIUM)
            throw new Exception('Usuario premium nao pode receber ascensão');

        if ($this->userService->changeAccessLevel($user, AccessLevelType::PREMIUM))
            return redirect('user')->with('success', 'Usuário promovido com sucesso');

        throw new Exception('Erro ao ascender usuario!');
    }

    public function downgradePage(Request $request)
    {
        $user = $this->userService->findUserByExternalId($request->userExternalId);

        if ($user->access_level == AccessLevelType::PRO)
            throw new Exception('Usuario pro nao pode ser rebaixado');

        if ($this->userService->changeAccessLevel($user, AccessLevelType::PRO))
            return redirect('user')->with('success', 'Usuário rebaixado com sucesso');

        throw new Exception('Erro ao rebaixar usuario!');
    }
}
