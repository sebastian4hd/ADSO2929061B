<?php

$title  = '02-constructor ';
$descripcion = 'Special method that initializes a new object upon creation.';


include 'template/header.php';
echo "<section>";

class PlayList {
    # Attributes
    public $name;
    public $artist = array();
    public $genre = array();
    public $image = array();
    public $year =  array();
    # Construct Methods

    public function __construct($name) {
        $this->name = $name;
    }
    public function setPlayList($artist,$genre,$image,$year) {
        $this->artist[] = $artist;
        $this->genre[] = $genre;
        $this->image[] = $image;
        $this->year[] = $year;
    }

    public function getPlayList() {
        echo "<h3>PlayList: $this->name</h3>
                <div style='display: flex; gap: 0.4rem; flex-direction: column'>";
                foreach($this->artist as $i => $artist) {
                echo "<div style='display: flex; gap: 0.4rem; border: 2px solid #0009; background-color: #0003;'>";
                    <img src='{$this->image[$i]}' width='100px'>
                    <div>
                        <h4>Artist: {$artist}</h4>
                        <h5>Genre: {$this->genre[$i]}</h5>
                        <h5></h5>
                    
                    
                    </div>
            </div>";
                
                
            }

    }
}

$pl = new PlayList('Juanes','La camisa negra',1998,'La tierra');
echo $pl->song;

include 'template/footer.php';