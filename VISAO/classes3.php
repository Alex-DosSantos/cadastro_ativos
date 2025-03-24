<?php
class Carro {
    private $cor;
    private $marca; 
    private $modelo; 
    private $porta_aberta;
    private $andando;

    public function __construct() {
        $this->porta_aberta = "N"; 
        $this->andando = "N"; 
        $this->cor = "Vermelho";
        $this->marca = "Ferrari";
        $this->modelo = "F80";
    }

    public function andar() {
        if ($this->porta_aberta == "N") {
            if ($this->andando == "N") {
                $this->andando = "S";
                echo "O carro da marca " . $this->marca . " está andando.<br>";
            } else {
                echo "O carro já está em movimento.<br>";
            }
        } else {
            echo "A porta está aberta. Não é possível andar.<br>";
        }
    }

    public function parar() {
        if ($this->andando == "S") {
            $this->andando = "N";
            echo "O carro parou.<br>";
        } else {
            echo "O carro já está parado.<br>";
        }
    }

    public function abrir_porta() {
        if ($this->andando == "N") {
            if ($this->porta_aberta == "N") {
                $this->porta_aberta = "S";
                echo "A porta foi aberta.<br>";
            } else {
                echo "A porta já está aberta.<br>";
            }
        } else {
            echo "O carro está em movimento. Não é possível abrir a porta.<br>";
        }
    }

    public function fechar_porta() {
        if ($this->porta_aberta == "S") {
            $this->porta_aberta = "N";
            echo "A porta foi fechada.<br>";
        } else {
            echo "A porta já está fechada.<br>";
        }
    }

    public function info_carro() {
        echo "Carro: " . $this->marca . ", Modelo: " . $this->modelo . ", Cor: " . $this->cor . "<br>";
    }
}

$carro1 = new Carro();
$carro1->info_carro(); 
$carro1->andar();
$carro1->abrir_porta(); 
$carro1->andar(); 
$carro1->fechar_porta();
$carro1->andar(); 
$carro1->abrir_porta(); 
$carro1->parar();
$carro1->abrir_porta(); 
$carro1->parar();
?>
<h1>metodo get/set<br></h1>
<?php
class Carro2 {
    private $cor;
    private $marca; 
    private $modelo; 
    private $porta_aberta;
    private $andando;

    public function __construct($cor, $modelo, $marca) {
        $this->porta_aberta = "N"; 
        $this->andando = "N";
        $this->setCor($cor);
        $this->setModelo($modelo);
        $this->setMarca($marca);
    }

   
    public function getCor() {
        return $this->cor;
    }

    public function getMarca() {
        return $this->marca;
    }

    public function getModelo() {
        return $this->modelo;
    }

    public function getPorta_Aberta() {
        return $this->porta_aberta;
    }

    public function getAndando() {
        return $this->andando;
    }

    
    public function setCor($cor) {
        $this->cor = $cor;
    }

    public function setModelo($modelo) {
        $this->modelo = $modelo;
    }

    public function setMarca($marca) {
        $this->marca = $marca;
    }

    public function andar() {
        if ($this->porta_aberta == "N") {
            if ($this->andando == "N") {
                $this->andando = "S";
                echo "O carro da marca " . $this->marca . " está andando.<br>";
            } else {
                echo "O carro já está em movimento.<br>";
            }
        } else {
            echo "A porta está aberta. Não é possível andar.<br>";
        }
    }

    public function parar() {
        if ($this->andando == "S") {
            $this->andando = "N";
            echo "O carro parou.<br>";
        } else {
            echo "O carro já está parado.<br>";
        }
    }

    public function abrir_porta() {
        if ($this->andando == "N") {
            if ($this->porta_aberta == "N") {
                $this->porta_aberta = "S";
                echo "A porta foi aberta.<br>";
            } else {
                echo "A porta já está aberta.<br>";
            }
        } else {
            echo "O carro está em movimento. Não é possível abrir a porta.<br>";
        }
    }

    public function fechar_porta() {
        if ($this->porta_aberta == "S") {
            $this->porta_aberta = "N";
            echo "A porta foi fechada.<br>";
        } else {
            echo "A porta já está fechada.<br>";
        }
    }

    public function info_carro() {
        echo "Carro: " . $this->marca . ", Modelo: " . $this->modelo . ", Cor: " . $this->cor . "<br>";
    }
}

$carro1 = new Carro2("Amarelo", "Huracan", "Lamborghini");
$carro1->info_carro(); 
$carro1->andar();
$carro1->abrir_porta(); 
$carro1->andar(); 
$carro1->fechar_porta();
$carro1->andar(); 
$carro1->abrir_porta(); 
$carro1->parar();
$carro1->abrir_porta(); 
$carro1->parar();
?>