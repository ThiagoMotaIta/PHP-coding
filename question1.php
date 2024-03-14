<?php 

/*
Autor: Thiago Mota
E-mail: thiagomotaita1@gmail.com
*/

// TESTE YMONETIZE - QUESTÃO 1
/*
Implemente uma função em PHP que calcule a soma dos números primos em um intervalo
dado. Otimize sua solução para lidar eficientemente com intervalos grandes.
*/

// Vamos pegar um número aleatório entre 100 e 1000.
$randomNumber = rand(100,1000);

// Valor da soma de números primos começa com ZERO.
$sumNumbers = 0;

// Agora, faremos o loop de 1 até o número escolhido aleatoriamente entre 100 e 1000.
for($i = 1; $i <= $randomNumber; $i++)
{
    // variavel que armazena o número de divisores de um número, para sabermos se é PRIMO.
    $divisors = 0;
     
    // recupera o número atual no loop e, a partir dele, o decrementa até chegar a 1. 
    // se o número do primeiro loop for divisível por algum número anterior a ele, ou seja, resto 0, significa que ele NÃO É NÚMERO PRIMO.
    for($j = $i; $j >= 1; $j--){
        if (($i % $j) == 0){
            $divisors++;
        }
    }
     
    // se o número do loop principal tiver exatamente 2 divisores (1 e ele próprio), significa que o número é PRIMO, ou seja, este número vai entrar na soma de números primos.
    if ($divisors == 2){
        $sumNumbers = $sumNumbers + $i;
    }
}

// Por fim, informamos o valor da soma dos números primos em um dado intervalo
echo ("O intervalo escolhido foi entre 1 e ".$randomNumber.", e a soma de números primos neste intervalo é igual a ".$sumNumbers);

?>