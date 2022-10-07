<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Services\UserServiceInterface;
use Illuminate\Http\Request;

class UserController extends Controller
{
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
        $this->userService->store($userRequest);

        return redirect('/user')->with('success', 'Cadastrado com sucesso!');;
    }
}
