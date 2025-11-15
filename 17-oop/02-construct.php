<?php

$title  = '02-constructor ';
$descripcion = '';


include 'template/header.php';
echo "<section>";

class PlayList {
    # Attributes
    public $artist;
    public $album;
    public $year;
    public $song;
    # Construct Methods
    public function __construct($artist,$album,$year,$song = 'Charrito Negro') {
        $this->artist = $artist;
        $this->album = $album;
        $this->year = $year;
        $this->song = $song;
    }
}

$pl = new PlayList('Juanes','La camisa negra',1998,'La tierra');
echo $pl->song;

include 'template/footer.php';