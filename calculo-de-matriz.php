<?php

class CalculoDeMatriz
{
    /**
     * @var array $matriz refere-se a matriz gerada para o calculo
     */
    private array | int $matriz;

    /**
     * @param array|int $matriz caso nao informade uma matriz será gerada uma no tamanho informado
     */
    public function __construct(array | int $matriz)
    {
        if ($this->verificarMatriz($matriz)) {
            $this->matriz = $matriz;
        } else {
            $this->matriz = $this->gerarMatriz($matriz);
        }
    }

    /**
     * @param int $tamanho referente ao tamanho do array gerado
     */
    private function gerarMatriz($tamanho): array
    {
        $matriz = [];

        for ($y = 0; $y < $tamanho; $y++) {
            $largura = [];
            for ($x = 0; $x < $tamanho; $x++) {
                $largura[] = rand(1, 9);
            }
            $matriz[] = $largura;
        }

        return $matriz;
    }

    /**
     * @param array|int $matriz referente a matriz q será verificada
     * @return bool Array é valido?
     * @obs poderia tambem ter verificado se cada item da matriz contem um int.
     */
    private function verificarMatriz(array | int $matriz): bool
    {
        if (is_array($matriz)) {
            $tamanhoEixoY = count($matriz);
            //Verificar as linhas do eixo Y
            for ($i = 0; $i < $tamanhoEixoY; $i++) {
                //Caso a linha do eixo x nao for array ou nao corresponder ao tamanho do eixo Y nao será valido
                if (!is_array($matriz[$i]) || $tamanhoEixoY != count($matriz[$i])) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    /**
     * 
     * @return int retorna a diferença da soma das diagonais da matriz
     */
    public function calculoDeMatriz(): int
    {
        $tamanho = count($this->matriz);

        $direita = $esquerda = 0;
        for ($i = 0; $i < $tamanho; $i++) {
            $direita += $this->matriz[$i][$i];
            $esquerda += $this->matriz[$i][($tamanho - 1) - $i];
        }
        return $direita - $esquerda;
    }

    /**
     * 
     * Imprime a matriz atual
     * @return void
     */
    public function imprimirMatriz(): void
    {
        foreach ($this->matriz as $y) {
            foreach ($y as $x) {
                echo " $x ";
            }
            echo "\r\n";
        }
    }
}

$calculo = new CalculoDeMatriz(3);
$calculo->imprimirMatriz();
echo ($calculo->calculoDeMatriz());

echo "\r\n";

$matrizGabarito[0] = [1, 2, 3];
$matrizGabarito[1] = [4, 5, 6];
$matrizGabarito[2] = [9, 8, 9];

$calculo2 = new CalculoDeMatriz($matrizGabarito);
$calculo2->imprimirMatriz();
echo ($calculo2->calculoDeMatriz());
