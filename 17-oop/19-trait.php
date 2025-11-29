<?php

$title  = '19-trait';
$descripcion = " A mechanism for code reuse in single inheritance languages.";


include 'template/header.php';
echo "<section>";

trait Hello {
    public function showHello($name) {
        echo "<li> <b>Welcome:</b>".$name."</li>";
    }
}

trait Adso {
     public function showAdso($code) {
        echo "<li> <b>Program:</b>".$code."</li>";
    }
}

class Deportment {
    use Hello, Adso;
    public function showDeportment($dep) {
        echo "<li> <b>Deportment:</b>".$dep."</li>";    
    }
}

$h1 = new Deportment();
$h1->showHello('Sebastian');
$h1->showAdso(2929061);
$h1->showDeportment('Caldas');

include_once 'template/footer.php';