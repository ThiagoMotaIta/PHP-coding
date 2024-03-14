<?php

/*
Autor: Thiago Mota
E-mail: thiagomotaita1@gmail.com
*/

// TESTE YMONETIZE - QUESTÃO 5 (parte 2)
/*
Escreva um programa em php que use rabittmq para enviar uma mensagem com um identificador único e confirmar que a mensagem foi devidamente entregue
*/

require_once __DIR__ . '/vendor/autoload.php';

// Advanced Message Queuing Protocol - Utilizado pelo Rabbitmq
use PhpAmqpLib\Connection\AMQPStreamConnection;

// Conexao local
$connection = new AMQPStreamConnection('localhost', 8050, 'thiagomota', 'fSyTVR!OnKSPs');
$channel = $connection->channel();

// Indicamos a fila que será usada
$channel->queue_declare('thiagomotafila', false, false, false, false);
echo "Aguardando novas mensagens.", "\n";

// Função que vai receber e tratar a mensagem
$callback = function($msg) {
  echo "Nova mensagem recebida: ", $msg->body, "\n";
};

// Adiciona o callback à fila 
$channel->basic_consume('thiagomotafila', '', false, true, false, false, $callback);

// Mantem a função escutando a fila por tempo indeterminado, até que seja encerrada
// Prática de listening - Desta forma, garanto a leitura das próximas mensagens, caso haja
while(count($channel->callbacks)) {
    $channel->wait();
}

$channel->close();
$connection->close();