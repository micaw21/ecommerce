<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\ContactoModel;

class adminContactoController extends Controller {

    public function mostrarConsultas() {
        helper(['form','url']);
    
        $modelo = new ContactoModel();
        $consultasActivas = $modelo->where('activo', 'SI')->paginate(3, 'consultasActivas');
        $consultasLeidas = $modelo->where('activo', 'NO')->paginate(3, 'consultasInactivas');
    
        $datos = [
            'consultasActivas' => $consultasActivas,
            'consultasLeidas' => $consultasLeidas,
            'paginacion' => $modelo->pager
        ];
    
        echo view('Plantillas/HeadAdministrarConsultas');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('/Pages/Administrar/administrarConsultas', $datos); 
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

    public function marcarLeidoConsultas($id) {
        $modelo = new ContactoModel();
        $modelo->eliminarConsulta($id);
        
        session()->setFlashdata('success', 'Consulta marcada como leída!');
            
        return redirect()->to('administrarConsultas');
    }

    public function marcarNoLeidoConsultas($id) {
        $modelo = new ContactoModel();
        $modelo->altaConsulta($id);
        $consultas = $modelo->obtenerTodasLasConsultas();

        session()->setFlashdata('success', 'Consulta marcada como no leída!');
            
        return redirect()->to('administrarConsultas');
    }
}