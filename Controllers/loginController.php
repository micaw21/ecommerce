<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuariosModel;

class loginController extends Controller {
    public function index() {
        helper(['form','url']);
        
    echo view('Plantillas/HeadLogin');
    echo view('Plantillas/Header1');
    echo view('Plantillas/Header2');
    echo view('Pages/Login');
    echo View('Plantillas/FooterNavegacion');
    echo view('Plantillas/Footer');
    }

    public function auth() {
        $session = session();
        $model = new UsuariosModel();

        $login = $this->request->getVar('login');
        $password = $this->request->getVar('pass');
        
        $data = $model->where('email', $login)->orWhere('usuario', $login)->first(); 

        if($data){
            $pass = $data['pass'];
            $ba= $data['baja'];

            if ($ba == 'SI'){
                $session->setFlashdata('fail', 'usuario dado de baja');
                return redirect()->to('/login');
            }

            $verify_pass = password_verify($password, $pass);

            if($verify_pass){
                $user = [
                'id_usuario' => $data['id_usuario'],
                'nombre' => $data['nombre'],
                'apellido'=> $data['apellido'],
                'email' =>  $data['email'],
                'usuario' => $data['usuario'],
                'perfil_id'=> $data['perfil_id'],
                'logged_in'  => TRUE
                ];

                $session->set($user);

                $session->set('perfil_id', $user['perfil_id']);
                
                $session->setFlashdata('success', 'Bienvenido!! :)');
                
                return redirect()->to('/');

            } else { 
                $session->setFlashdata('fail', 'Contraseña incorrecta! :(');
                return redirect()->to('/login')->withInput();
            }   
        } else {
            $session->setFlashdata('fail', 'El correo electrónico/nombre de usuario no existe! :(');
            return redirect()->to('/login')->withInput();
        } 
    }

    public function logout() {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }
} 
