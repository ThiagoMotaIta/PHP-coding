<?php

/*
Autor: Thiago Mota
E-mail: thiagomotaita1@gmail.com
*/

// TESTE YMONETIZE - QUESTÃO 3
/*
Crie uma implementação prática do padrão de design Command em PHP. Considere um cenário onde você precisa implementar um sistema de fila de comandos que podem ser desfeitos e refeitos.
*/


/*
  O Design Pattern "Command" é um padrão utilizado na seperação da solicitação do receptor. Isso permite encapsular uma solicitação como um objeto, que pode então ser passado para diferentes receptores.
  */
class PlayerCommandee {
    private $player;
    private $soccerTeam;
    // Construtor
    function __construct($soccerTeam_in, $player_in) {
        $this->setPlayer($player_in);
        $this->setSoccerTeam($soccerTeam_in);
    }

    // Getters e Setters necessários à manipulação
    function getPlayer() {
        return $this->player;
    }
    function setPlayer($player_in) {
        $this->player = $player_in;
    }
    function getSoccerTeam() {
        return $this->soccerTeam;
    }
    function setSoccerTeam($soccerTeam_in) {
        $this->soccerTeam = $soccerTeam_in;
    }
    // Setter de incremento inicial do estado (trocando espaço vazio por uma string)
    function setStarsOn() {
        $this->setPlayer(Str_replace(' ',' WIN ',$this->getPlayer()));
        $this->setSoccerTeam(Str_replace(' ',' WIN ',$this->getSoccerTeam()));
    }
    // Setter de substituição de strings (Trocando WIN por LOSE)
    function setStarsOff() {
        $this->setPlayer(Str_replace(' WIN ',' LOSE ',$this->getPlayer()));
        $this->setSoccerTeam(Str_replace(' WIN ',' LOSE ',$this->getSoccerTeam()));
    }
    function getPlayerAndSoccerTeam() {
        return $this->getSoccerTeam().' by '.$this->getPlayer();
    }
}

// Iniciando nosso receptor
abstract class PlayerCommand {
    protected $playerCommandee;
    function __construct($playerCommandee_in) {
        $this->playerCommandee = $playerCommandee_in;
    }
    abstract function execute();
}

// E agora, nossas solicitações (Vencer e perder uma Copa do Mundo)
class PlayerStarsOnCommand extends PlayerCommand {
    function execute() {
        $this->playerCommandee->setStarsOn();
    }
}

class PlayerStarsOffCommand extends PlayerCommand {
    function execute() {
        $this->playerCommandee->setStarsOff();
    }
}
 

// Por fim, as chamadas para demonstração do Pattern COMMAND
$player = new PlayerCommandee('Neymar Jr', 'Barcelona');
echo('player after creation:<br/>'.$player->getPlayerAndSoccerTeam()."<hr/>");

$starsOn = new PlayerStarsOnCommand($player);
callCommand($starsOn);
echo('player after world cup win:<br/>'.$player->getPlayerAndSoccerTeam()."<hr/>");

$starsOff = new PlayerStarsOffCommand($player);
callCommand($starsOff);
echo('player after world cup lose:<br/>'.$player->getPlayerAndSoccerTeam());

function callCommand(PlayerCommand $playerCommand_in) {
$playerCommand_in->execute();
}

function writeln($line_in) {
echo $line_in."<br/>";
}

?>