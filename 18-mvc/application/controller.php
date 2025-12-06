<?php 
class Controller {
    public $load;
    public $model;
    private $base_url;

    public function __construct($action = 'index', $id = null) {
        $this->load = new Load;
        $this->model = new Model;
        $this->base_url = '/18-mvc/';

        // Redirigir según la acción
        switch($action) {
            case 'add':
            case 'crear':
                $this->add();
                break;
            case 'store':
            case 'guardar':
                $this->store();
                break;
            case 'show':
            case 'ver':
                $this->show($id);
                break;
            case 'edit':
            case 'editar':
                $this->edit($id);
                break;
            case 'update':
            case 'actualizar':
                $this->update($id);
                break;
            case 'delete':
            case 'eliminar':
                $this->delete($id);
                break;
            case 'destroy':
                $this->destroy($id);
                break;
            case 'index':
            case '':
            default:
                $this->index();
                break;
        }
    }

    // Función helper para redireccionar
    private function redirect($path = '') {
        header('Location: ' . $this->base_url . $path);
        exit;
    }

    // Mostrar lista de pokemones
    public function index() {
        $pokemons = $this->model->listPokemons();
        $data = [
            'pokemons' => $pokemons,
            'url' => $this->base_url
        ];
        $this->load->view('welcome.php', $data);
    }

    // Mostrar formulario de agregar
    public function add() {
        $data = ['url' => $this->base_url];
        $this->load->view('add.php', $data);
    }

    // Guardar nuevo pokemon
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $type = $_POST['type'];
            
            $this->model->createPokemon($name, $type);
            $_SESSION['message'] = $name . ' ha sido agregado exitosamente';
            $_SESSION['message_type'] = 'success';
            $this->redirect();
        }
    }

    // Mostrar detalles de un pokemon
    public function show($id) {
        if (!$id) {
            $this->redirect();
        }
        
        $pokemon = $this->model->getPokemonById($id);
        
        if (!$pokemon) {
            $this->redirect();
        }
        
        $data = [
            'pokemon' => $pokemon,
            'url' => $this->base_url
        ];
        $this->load->view('show.php', $data);
    }

    // Mostrar formulario de editar
    public function edit($id) {
        if (!$id) {
            $this->redirect();
        }
        
        $pokemon = $this->model->getPokemonById($id);
        
        if (!$pokemon) {
            $this->redirect();
        }
        
        $data = [
            'pokemon' => $pokemon,
            'url' => $this->base_url
        ];
        $this->load->view('edit.php', $data);
    }

    // Actualizar pokemon
    public function update($id) {
        if (!$id) {
            $this->redirect();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $name = $_POST['name'];
            $type = $_POST['type'];
            
            $this->model->updatePokemon($id, $name, $type);
            $_SESSION['message'] = $name . ' ha sido actualizado exitosamente';
            $_SESSION['message_type'] = 'success';
            $this->redirect();
        }
    }

    // Mostrar confirmación de eliminar
    public function delete($id) {
        if (!$id) {
            $this->redirect();
        }
        
        $pokemon = $this->model->getPokemonById($id);
        
        if (!$pokemon) {
            $this->redirect();
        }
        
        $data = [
            'pokemon' => $pokemon,
            'url' => $this->base_url
        ];
        $this->load->view('delete.php', $data);
    }

    // Eliminar pokemon (acción real)
    public function destroy($id) {
        if (!$id) {
            $this->redirect();
        }
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $pokemon = $this->model->getPokemonById($id);
            $name = $pokemon ? $pokemon['name'] : 'Pokemon';
            
            $this->model->deletePokemon($id);
            $_SESSION['message'] = $name . ' ha sido eliminado exitosamente';
            $_SESSION['message_type'] = 'success';
            $this->redirect();
        } else {
            $this->redirect('delete/' . $id);
        }
    }
}