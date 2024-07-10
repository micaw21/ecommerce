<?php

namespace App\Controllers;

class Home extends BaseController {
    public function index() {
        // return view('Principal');
        echo view('Plantillas/HeadPrincipal');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Principal');
        echo view('Plantillas/FooterInformacion');
        echo view('Plantillas/Footer');
    }   

    public function quienesSomos() {
        echo view('Plantillas/HeadQuienesSomos');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/QuienesSomos');
        echo View('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

    public function comercializacion() {
        echo view('Plantillas/HeadComercializacion');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Comercializacion');
        echo View('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

    public function TerminosYCondiciones() {
        echo view('Plantillas/HeadTermsConds');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/TermCond');
        echo View('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }
}