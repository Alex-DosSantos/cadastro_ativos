<?php
class Caneta{
    public $cor;
    public $ponta;
    public $tem_tinta;
    public $tampada;

    public function escrever() {
        if ($this->tampada == "S") {
            echo"caneta esta tampada nao pode escrever";
} else if ($this->tem_tinta == "N") {
    echo "a caneta nao pode escrever por estar sem tinta";
} else {
    echo "estou escrevendo....<br>";
}
    }
public function tampar() {
    $this->tampada == "S";
    echo "caneta tampada <br>";
}
public function destampa() {
    $this->tampada = "N";
    echo "caneta destampada";
}
}

$caneta1 = new Caneta();
$caneta1->cor = 'verde';
$caneta1->tem_tinta = "S";
$caneta1->ponta = 0.9;
$caneta1->escrever();
$caneta1->tampar();
$caneta1->escrever();
$caneta1->destampa();
$caneta1->tem_tinta = "N";
$caneta1->escrever();


?>