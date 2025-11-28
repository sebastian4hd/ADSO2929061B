<?php

$title  = '09-class-abstract';
$descripcion = " A class that cannot be instantiated, only extended from.";


include 'template/header.php';
echo "<section>";

abstract class ConexionBase {
    private $servidor = 'localhost';
    private $usuario = 'root';
    private $clave = '';
    private $bd = 'pokeadso';
    protected $conn;

    protected function iniciarConexion() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->servidor};dbname={$this->bd}",
                $this->usuario,
                $this->clave
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;
        } catch (PDOException $e) {
            die("Error: " . $e->getMessage());
        }
    }

    abstract public function obtenerDatos();
}

class ListaEntrenadores extends ConexionBase {
    
    public function obtenerDatos() {
        $conexion = $this->iniciarConexion();
        $sql = "SELECT id, name, level FROM trainers ORDER BY level DESC";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

$entrenadores = new ListaEntrenadores();
$lista = $entrenadores->obtenerDatos();

echo "<h2>Lista de Entrenadores</h2>";
echo "<table border='1' cellpadding='10' style='border-collapse: collapse; width: 100%;'>
        <tr style='background-color: #4CAF50; color: white;'>
            <th>ID</th>
            <th>Nombre</th>
            <th>Nivel</th>
            <th>Categoría</th>
        </tr>";

foreach ($lista as $e) {
    $categoria = $e['level'] >= 5 ? 'Experto' : 'Novato';
    $color = $e['level'] >= 5 ? '#e8f5e9' : '#fff3e0';
    echo "<tr style='background-color: {$color};'>
            <td>{$e['id']}</td>
            <td><strong>{$e['name']}</strong></td>
            <td style='text-align: center;'>Nivel {$e['level']}</td>
            <td>{$categoria}</td>
          </tr>";
}

echo "</table>";

echo "</section>";




include 'template/footer.php';