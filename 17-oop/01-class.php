<?php

$title  = '01-class ';
$descripcion = '';


include 'template/header.php';
echo "<section>";

class Vehicle {
    # Attributes
    public $brand;
    public $reference;
    public $color;
    public $model;

    # Methods
    public function setAttributes($brand,$reference,$color,$model) {
        $this->brand = $brand;
        $this->reference = $reference;
        $this->color = $color;
        $this->model = $model;
    }
    public function getAttributes() {
        return "<ul>
                    <li>Brand: $this->brand </li>
                    <li>Reference: $this->reference </li>
                    <li>Color: $this->color </li>
                    <li>Model: $this->model </li>
                </ul>";
    }
}

$vh1 = new Vehicle;
$vh1->setAttributes('Volkswagen', 'Golf', 'red', 2020);
echo $vh1->getAttributes();

$vh2= new Vehicle;
$vh2->setAttributes('Nissan', 'Murano', 'Gray', 2022);
$vh2->reference = 'Kicks';
echo $vh2->getAttributes();

$vh3= new Vehicle;
$vh3->brand = 'Toyota';
$vh3->reference = 'Foreruner';
$vh3->color = 'Orange';
$vh3->model = '2010';
echo $vh2->getAttributes();

include 'template/footer.php';
