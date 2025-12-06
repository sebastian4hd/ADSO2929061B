<?php 
class Model extends DataBase {
    protected $db;

    public function __construct(){
        $this->db = DataBase::connect();
    }

    // Listar todos los pokemones
    public function listPokemons(){
        $stmt = $this->db->query("SELECT * FROM pokemons ORDER BY id ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Obtener un pokemon por ID
    public function getPokemonById($id){
        $stmt = $this->db->prepare("SELECT * FROM pokemons WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Crear un nuevo pokemon
    public function createPokemon($name, $type){
        $stmt = $this->db->prepare("INSERT INTO pokemons (name, type) VALUES (:name, :type)");
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Actualizar un pokemon
    public function updatePokemon($id, $name, $type){
        $stmt = $this->db->prepare("UPDATE pokemons SET name = :name, type = :type WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':type', $type, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Eliminar un pokemon
    public function deletePokemon($id){
        $stmt = $this->db->prepare("DELETE FROM pokemons WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}