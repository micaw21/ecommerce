<?php

namespace App\Controllers;
use App\Models\ContactoModel;
use CodeIgniter\Controller;

class contactoController extends Controller {
    public function contacto() {
        helper(['form','url','session']);

        echo view('Plantillas/HeadContacto');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Contacto');
        echo View('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

    public function enviarConsulta() {
        $input = $this->validate([
            'nombre' => 'required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z]+$/]',
            'apellido' => 'required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z]+$/]',
            'email' => 'required|valid_email',
            'mensaje' => 'required|max_length[255]'
        ]);
    
        $formModel = new ContactoModel();
    
        if (!$input) {
            echo view('Plantillas/HeadContacto');
            echo view('Plantillas/Header1');
            echo view('Plantillas/Header2');
            echo view('Pages/Contacto', ['validation' => $this->validator]);
            echo View('Plantillas/FooterNavegacion');
            echo view('Plantillas/Footer');
        } else {
            $formData = [
                'usuario_id' => $this->request->getVar('usuario_id'),
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'email' => $this->request->getVar('email'),
                'mensaje' => $this->request->getVar('mensaje'),
            ];
    
            $formModel->save($formData);
            $session = session();

            $session->setFlashdata('success', 'Mensaje enviado con éxito!');
    
            return redirect()->to(site_url('/contacto'));
        }
    }
}
