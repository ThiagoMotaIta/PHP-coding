<?php

/*
Autor: Thiago Mota
E-mail: thiagomotaita1@gmail.com
*/

// TESTE YMONETIZE - QUESTÃO 5 (parte 1)
/*
Escreva um programa em php que use rabittmq para enviar uma mensagem com um identificador único e confirmar que a mensagem foi devidamente entregue
*/

require_once __DIR__ . '/vendor/autoload.php';

// Advanced Message Queuing Protocol - Utilizado pelo Rabbitmq
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

$connection = new AMQPStreamConnection('localhost', 8050, 'thiagomota', 'fSyTVR!OnKSPs');
$channel = $connection->channel();

// Indicamos a fila que será usada
$channel->queue_declare('thiagomotafila', false, false, false, false);

// Instancia uma nova mensagem e a envia para a fila
$msg = new AMQPMessage('Ola Ymonetiza!');
$channel->basic_publish($msg, '', 'thiagomotafila');

$channel->close();
$connection->close();