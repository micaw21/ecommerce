<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\usuariosModel;

class UsuarioController extends Controller {
    public function __construct() {
        helper(['form','url']);
    }

    public function create() {
        echo view('Plantillas/HeadRegistrarse');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Registrarse');
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

    public function formValidation() {
        //Definicion de reglas de validacion
        $input = $this->validate([
            'nombre' => 'required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z]+$/]',
            'apellido' => 'required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z]+$/]',
            'usuario' => 'required|min_length[3]|max_length[20]|is_unique[usuarios.usuario]',
            'email' => 'required|min_length[4]|max_length[50]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[5]|max_length[20]'
        ]);

        //Conexion con la bd
        $formModel = new usuariosModel();
        
        //si la validacion falla, se muestra el formulario con los mensajes de error
        if(!$input) {
            echo view('Plantillas/HeadRegistrarse');
            echo view('Plantillas/Header1');
            echo view('Plantillas/Header2');
            echo view('Pages/Registrarse', ['validation' => $this->validator]);
            echo view('Plantillas/FooterNavegacion');
            echo view('Plantillas/Footer');
            
        } else {
            
            //si la validacion es exitosa, se almacenan los datos  y se guarda en la bd
            $formData = [
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'email' => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            ];

            $formModel->save($formData);

            session()->setFlashdata('success', 'Usuario registrado con éxito!');
            
            return redirect()->to(site_url('/login'));
        }
    }
}
