<?php 

namespace App\Controllers;
use App\Models\facturaModel;
use App\Models\CatalogoModel;
use App\Models\SubcategoriasModel;
use App\Models\CategoriasModel;
use App\Models\detalleFacturaModel;
use App\Models\UsuariosModel;
use CodeIgniter\Controller;

class adminFacturaController extends Controller {
    public function mostrarFacturas($pagina = 1) {
        helper(['form', 'url']);
        
        $facturaModel = new facturaModel();
        $detalleModel = new detalleFacturaModel();
        $clienteModel = new UsuariosModel();
        $productosModel = new CatalogoModel();
        $categoriasModel = new CategoriasModel();
        $subcategoriasModel = new SubcategoriasModel();

        $facturas = $facturaModel->paginate(4, 'facturas');

        $facturasCompletas = [];
        foreach($facturas as $cabecera) {
            $detalleFactura = [];
            $detalle = $detalleModel->obtenerDetalleFacturaPorId($cabecera['id_factura']);
            $cliente = $clienteModel->obtenerUsuarioPorId($cabecera['cliente_id']);

            foreach ($detalle as $item) {
                $producto = $productosModel->obtenerProductoPorId($item['id_producto']);
                $categoria = $categoriasModel->obtenerCategoriasPorId($producto['categoria_id']);
                $subcategoria = $subcategoriasModel->obtenerSubcategoriasPorId($producto['id_subcategoria']);

                $detalleFactura[] = [
                    'id_detalle_factura' => $item['id_detalle_factura'],
                    'id_producto' => $producto['id_productos'],
                    'nombre_producto' => $producto['nombre'],
                    'categoria' => $categoria['descripcion'],
                    'subcategoria' => $subcategoria['descripcion'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['subtotal'] / $item['cantidad'],
                    'subtotal' => $item['subtotal']
                ];
            }

            $facturasCompletas[] = [
                'factura' => $cabecera,
                'detalle' => $detalleFactura,
                'cliente' => $cliente
            ];
        }

        $data = [
            'facturasCompletas' => $facturasCompletas,
            'paginacion' => $facturaModel->pager
        ];

        
        echo view('Plantillas/HeadAdminFactura');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Administrar/adminFactura', $data);
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }
}
