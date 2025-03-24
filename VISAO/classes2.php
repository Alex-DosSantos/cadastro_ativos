<?php
class Sala {
    public $capacidade;
    public $ocupada; 
    public $aberta; 
    public $total_ocupantes;

   

    public function entrar() {
        if ($this->aberta == "N") {
            echo "A sala está fechada. Não é possível entrar.<br>";
        } else if ($this->ocupada == "S") {
            echo "A sala está ocupada. Não é possível entrar.<br>";
        } else if ($this->total_ocupantes >= $this->capacidade) {
            echo "A sala está cheia. Não é possível entrar.<br>";
        } else {
            $this->total_ocupantes++;
            echo "Entrou na sala. Total de ocupantes: " . $this->total_ocupantes . "<br>";
        }
    }

    public function sair() {
        if ($this->aberta == "N") {
            echo "A sala está fechada. Não é possível sair.<br>";
        } else if ($this->total_ocupantes <= 0) {
            echo "Não há ninguém na sala para sair.<br>";
        } else {
            $this->total_ocupantes--;
            echo "Saiu da sala. Total de ocupantes: " . $this->total_ocupantes . "<br>";
        }
    }

    public function aberta() {
        if ($this->aberta == "S") {
            echo "A sala já está aberta.<br>";
        } else {
            $this->aberta = "S";
            echo "A sala foi aberta.<br>";
        }
    }

    public function fechada() {
        if ($this->aberta == "N") {
            echo "A sala já está fechada.<br>";
        } else {
            $this->aberta = "N";
            echo "A sala foi fechada.<br>";
        }
    }

    public function reservada() { 
        if ($this->ocupada == "S") {
            echo "A sala já está ocupada. Não é possível reservar.<br>";
        } else {
            $this->ocupada = "S";
            echo "A sala foi reservada.<br>";
        }
    }

    public function cancelar_reserva() { 
        if ($this->ocupada == "N") {
            echo "A sala já está reservada. Não é possível  reservar.<br>";
        } else {
            $this->ocupada = "N";
            echo "A reserva da sala foi cancelada.<br>";
        }
    }
}


$sala1 = new Sala(); 
$sala1->capacidade = 10;
$sala1->ocupada = "N"; 
$sala1->aberta = "S"; 
$sala1->total_ocupantes = 10 ;

$sala1->aberta();
$sala1->entrar();
$sala1->reservada(); 
$sala1->entrar(); 
$sala1->sair(); 
$sala1->fechada(); 
$sala1->sair(); 
$sala1->cancelar_reserva(); 
?>