<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\usuariosModel;

class adminUsuariosController extends Controller {
    public function mostrarUsuarios() {
        helper(['form','url']);
    
        $modelo = new usuariosModel();
        $usuarios = $modelo->where('baja', 'NO')->paginate(5, 'usuariosActivos');
        $usuariosDadosDeBaja = $modelo->where('baja', 'SI')->paginate(5, 'usuariosBaja');

        $datos = [
            'usuarios' => $usuarios,
            'usuariosDadosDeBaja' => $usuariosDadosDeBaja,
            'paginacion' => $modelo->pager
        ];
    
        echo view('Plantillas/HeadAdministrarUsuarios');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('/Pages/Administrar/administrarUsuarios', $datos); 
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');

    }

    public function anularBaja($id) {
        $modelo = new usuariosModel();
        $modelo->anularBajaUsuario($id);
        session()->setFlashdata('success', 'Baja anulada con éxito!');
        return redirect()->to('administrarUsuario');

    }

    public function bajaUsuario($id) {
        $modelo = new usuariosModel();
        $modelo->eliminarUsuario($id);
        session()->setFlashdata('success', 'Usuario dado de baja con éxito!');
        return redirect()->to('administrarUsuario');
    }
}