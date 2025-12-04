<?php

$title  = '09-class-abstract';
$descripcion = " A class that cannot be instantiated, only extended from.";


include 'template/header.php';
echo "<section>";
abstract class ConexionBase {
    private $host = 'localhost';
    private $usuario = 'root';
    private $password = '';
    private $bd = 'pokeadso';
    protected $conn;

    protected function iniciarConexion() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->bd}",
                $this->usuario,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Error de Conexión: " . $e->getMessage());
        }
    }
    abstract public function obtenerDatos();
}
class ListaPokemon extends ConexionBase {
    
    public function obtenerDatos() {
        $conexion = $this->iniciarConexion();
        $sql = "SELECT id, name, type FROM pokemons";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}


$pokemons = new ListaPokemon(); 
$lista = $pokemons->obtenerDatos();

echo "<h2>Lista de Pokémon</h2>";
echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%;'>";
echo "
        <tr style='background-color: #4CAF50; color: white;'>
            <th>ID</th>
            <th>Nombre</th>
            <th>Tipo</th>
        </tr>";

foreach ($lista as $p) {
    echo "<tr>
            <td>{$p['id']}</td>
            <td><strong>{$p['name']}</strong></td>
            <td>{$p['type']}</td>
          </tr>";
}

echo "</table>";

echo "</section>";
include 'template/footer.php';
