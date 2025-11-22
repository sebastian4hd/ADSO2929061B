<?php

$title  = '04-collaboration';
$descripcion = "Objects working together by calling each other's methods.";

include 'template/header.php';

echo "<section>";

class Evolve {
    public function evolvePokemon($origin, $evolution) {
        echo "<ul>
                <li style='display: flex; justify-content: sapce-between; align-items: center;'> 
                    span>{$origin}➡️{$evolution}</span>
                </li>
        </ul>";
    }
}

class Pokemon {
    private $origin;
    private $evolution;
    private $collaboration;

    public function __construct($origin, $evolution) {
        $this->origin = $origin;
        $this->evolution = $evolution;
        //Collaboration
        $this->collaboration = new Evolve();
    }
    public function nextLevel() {
        $this->collaboration->evolvePokemon($this->origin, $this->evolution);
    }
}

$ev1 = new Pokemon('Pichu', 'Pikachu');
$eve1->nextLevel();
$ev = new Pokemon('Pikachu', 'Pichu');
$eve1->nextLevel();

$ev2 = new Pokemon('Bulbasaur', 'Inysaur');
$eve2->nextLevel();
$ev2 = new Pokemon('Inysaur', 'Pikachu');
$eve2->nextLevel();

$ev3 = new Pokemon('Squirtle', 'Wartortle');
$eve3->nextLevel();
$ev3 = new Pokemon('Waetortle', 'Blastoise');
$eve3->nextLevel();
include 'template/footer.php';