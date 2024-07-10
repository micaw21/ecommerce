<?php

namespace App\Controllers;

use App\Models\CategoriasModel;
use App\Models\SubcategoriasModel;
use CodeIgniter\Controller;
use App\Models\CatalogoModel;

class CatalogoController extends Controller {
    public function mostrarCatalogo($pagina = 1) {
        $modelo = new CatalogoModel();
        $categoriaModelo = new CategoriasModel();
        
        $categorias = $categoriaModelo->where('baja','NO')->obtenerCategorias();

        $categoriaFiltro = $this->request->getVar('categoria');


        if($categoriaFiltro) {
            $productos = $modelo->where('baja', 'NO')->where('categoria_id', $categoriaFiltro)->where('stock >', 0)->paginate(7, 'products');
        } else {
            $productos = $modelo->where('baja', 'NO')->where('stock >', 0)->paginate(7, 'products');
        }

        $data = [
            'productos' => $productos,
            'paginacion' => $modelo->pager,
            'categorias' => $categorias,
        ];
        
        
        echo view('Plantillas/HeadCatalogo');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Catalogo', $data);
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

    public function mostrarCatalogoHS($pagina = 1) {
        $modelo = new CatalogoModel();
        $categoriaModelo = new CategoriasModel();

        $categorias = $categoriaModelo->where('baja','NO')->obtenerCategorias();


        $categoriaFiltro = $this->request->getVar('categoria');

        if($categoriaFiltro) {
            $productos = $modelo->where('baja', 'NO')->where('id_subcategoria', 1)->where('categoria_id', $categoriaFiltro)->where('stock >', 0)->paginate(4, 'products');
        } else {
            $productos = $modelo->where('baja', 'NO')->where('id_subcategoria', 1)->where('stock >', 0)->paginate(4, 'products');
        }

        $data = [
            'productos' => $productos,
            'paginacion' => $modelo->pager,
            'categorias' => $categorias
        ];
        
        
        echo view('Plantillas/HeadCatalogo');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Catalogo', $data);
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

    public function mostrarCatalogoTS($pagina = 1) {
        $modelo = new CatalogoModel();

        $categoriaModelo = new CategoriasModel();

        $categorias = $categoriaModelo->where('baja','NO')->obtenerCategorias();

        $categoriaFiltro = $this->request->getVar('categoria');

        if($categoriaFiltro) {
            $productos = $modelo->where('baja', 'NO')->where('id_subcategoria', 2)->where('categoria_id', $categoriaFiltro)->where('stock >', 0)->paginate(4, 'products');
        } else {
            $productos = $modelo->where('baja', 'NO')->where('id_subcategoria', 2)->where('stock >', 0)->paginate(4, 'products');
        }
        
        $data = [
            'productos' => $productos,
            'paginacion' => $modelo->pager,
            'categorias' => $categorias
        ];
        
        echo view('Plantillas/HeadCatalogo');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Catalogo', $data);
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

    public function mostrarCatalogo5SOS($pagina = 1) {
        $modelo = new CatalogoModel();

        $categoriaModelo = new CategoriasModel();

        $categorias = $categoriaModelo->where('baja','NO')->obtenerCategorias();

        $categoriaFiltro = $this->request->getVar('categoria');

        if($categoriaFiltro) {
            $productos = $modelo->where('baja', 'NO')->where('id_subcategoria', 3)->where('categoria_id', $categoriaFiltro)->where('stock >', 0)->paginate(4, 'products');
        } else {
            $productos = $modelo->where('baja', 'NO')->where('id_subcategoria', 3)->where('stock >', 0)->paginate(4, 'products');
        }
        
        $data = [
            'productos' => $productos,
            'paginacion' => $modelo->pager,
            'categorias' => $categorias
        ];
        
        
        echo view('Plantillas/HeadCatalogo');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Catalogo', $data);
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

    public function compra($id) {
        $modelo = new CatalogoModel();
        $data['producto'] = $modelo->obtenerProductoPorId($id);

        echo view('Plantillas/HeadCompra');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('/Pages/compraProducto', $data); 
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');

    }
}


