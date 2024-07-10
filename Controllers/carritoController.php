<?php
namespace App\Controllers;
use App\Models\CatalogoModel;
use App\Models\CategoriasModel;
use App\Models\facturaModel;
use App\Models\detalleFacturaModel;
use App\Models\SubcategoriasModel;
use App\Models\UsuariosModel;
use CodeIgniter\Controller;
use CodeIgniterCart\Cart; 

class carritoController extends Controller {
    public function carrito() {

        helper(['form', 'url', 'cart']);

        $cliente_id = session()->get('id_usuario'); 

        $facturaModel = new FacturaModel();
        $detalleModel = new DetalleFacturaModel();
        $clienteModel = new UsuariosModel();
        $productosModel = new CatalogoModel();
        $categoriasModel = new CategoriasModel();
        $subcategoriasModel = new SubcategoriasModel();

        $facturas = $facturaModel->obtenerFacturasPorCliente($cliente_id); 

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
                    'categoria_id' => $producto['categoria_id'],
                    'id_subcategoria' => $producto['id_subcategoria'],
                    'subcategoria' => $subcategoria['descripcion'],
                    'cantidad' => $item['cantidad'],
                    'precio' => $item['subtotal'] / $item['cantidad'],
                    'subtotal' => $item['subtotal'],
                    'url_imagen' => $producto['url_imagen']
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
        ];

        $cart = \Config\Services::cart();
        $cartContents = $cart->contents();
    
        foreach ($cartContents as $item) {
            $producto = $productosModel->obtenerProductoPorId($item['id']);
            if ($producto['baja'] === 'SI') {
                $cart->remove($item['rowid']);
                session()->setFlashdata('fail', 'Se ha eliminado un producto dado de baja del carrito.');
                return redirect()->to('/carrito');
            }

            if($producto['stock'] <= 0) {
                $cart->remove($item['rowid']);
                session()->setFlashdata('fail', 'No se puede agregar al carrito. El producto no posee stock');
                return redirect()->to('/carrito');
            }
        }

        echo view('Plantillas/HeadCarrito');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/Carrito', $data);
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }
    
    public function agregarCarrito() {
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
        $modeloProductos = new CatalogoModel();
    
        $cartContents = $cart->contents();

        $productoID = $request->getPost('id');

        foreach ($cartContents as $item) {
            if ($item['id'] == $productoID) {
                session()->setFlashdata('fail', 'El producto ya está en el carrito.');
                return redirect()->back()->withInput();
                }
        }

        $producto = $modeloProductos->obtenerProductoPorId($productoID);
        if($producto['stock'] <= 0) {
            session()->setFlashdata('fail', 'No se puede agregar al carrito. El producto no posee stock');
            return redirect()->back()->withInput();
        }
    
        $cart->insert(array(
            'id' => $request->getPost('id'),
            'qty' => $request->getPost('cantidad'),
            'price' => $request->getPost('precio'),
            'name' => $request->getPost('nombre'),
            'options' => array('stock' => $request->getPost('stock')), 
        ));
    
        session()->setFlashdata('success', 'Producto agregado al carrito!');
    
        return redirect()->back()->withInput();
    }
    
    public function actualizarCarrito() {
        $cart = \Config\Services::cart();
        $request = \Config\Services::request();
        $rowid = $request->getPost('rowid');
        $qty = $request->getPost('qty');
    
        $cart->update(array(
            'rowid' => $rowid,
            'qty' => $qty
        ));
    
        return $this->response->setJSON(['status' => 'success']);
    }
    

    public function quitarCarrito($rowid) {
        $cart = \Config\Services::cart();
        if ($rowid === 'all') {
            $cart->destroy();
        } else {
            $cart->remove($rowid);
        }

        return redirect()->to(base_url('carrito'));
    }
    
    public function comprarCarrito(){
        $cart = \Config\Services::cart();
        $productos = $cart->contents();
        $montoTotal = 0;
        foreach($productos as $producto) {
            $montoTotal += $producto['price'] * $producto['qty'];
        }
    
        $facturaModel = new facturaModel();
        $fecha = date('Y-m-d H:i:s'); 
    
        $datos = [
            'cliente_id' => session()->get('id_usuario'),
            'fecha' => $fecha,
            'importe_total' => $montoTotal,
        ];
    
        $idFactura = $facturaModel->crearFactura($datos);
    
        if ($idFactura) {
            $detalleFacturaModelo = new detalleFacturaModel();
            $productoModelo = new CatalogoModel();
    
            foreach($productos as $producto) {
                if ($producto['options']['stock'] - $producto['qty'] <= 0) {
                    $productoModelo->actualizarProducto($producto['id'], ['baja' => 'SI']);
                }
                
                $dataFactura = [
                    'id_factura' => $idFactura,
                    'id_producto' => $producto['id'],
                    'cantidad' => $producto['qty'],
                    'subtotal' => $producto['price'] * $producto['qty'],
                ];
    
                $detalleFacturaModelo->crearDetalleFactura($dataFactura);
                $productoModelo->actualizarProducto($producto['id'], ['stock' => $producto['options']['stock'] - $producto['qty'] ]);
            }
    
            $cart->destroy();
    
            session()->setFlashdata('compraRealizada', 'Compra realizada exitosamente.');
            return redirect()->to(base_url('factura/' . $idFactura));
        } else {
            session()->setFlashdata('error', 'Hubo un problema al procesar su compra.');
            return redirect()->back()->withInput();
        }
    }

    
    public function mostrarCompra($id) {
        
        $facturaModel = new facturaModel();
        $detalleModel = new detalleFacturaModel();
        $clienteModel = new UsuariosModel();
        $productosModel = new CatalogoModel();
        $categoriasModel = new CategoriasModel();
        $subcategoriasModel = new SubcategoriasModel();

        $factura = $facturaModel->obtenerFacturaPorId($id);

        $detalle = $detalleModel->obtenerDetalleFacturaPorId($factura['id_factura']);
        $detalle = is_array($detalle) ? $detalle : [];

        $cliente = $clienteModel->obtenerUsuarioPorId($factura['cliente_id']);

        $detalleCompleto = [];
        foreach ($detalle as $item) {
            $producto = $productosModel->obtenerProductoPorId($item['id_producto']);
            $categoria = $categoriasModel->obtenerCategoriasPorId($producto['categoria_id']);
            $subcategoria = $subcategoriasModel->obtenerSubcategoriasPorId($producto['id_subcategoria']);

            $detalleCompleto[] = [
                'id_producto' => $producto['id_productos'],
                'nombre_producto' => $producto['nombre'],
                'categoria' => $categoria['descripcion'],
                'subcategoria' => $subcategoria['descripcion'],
                'cantidad' => $item['cantidad'],
                'precio' => $item['subtotal'] / $item['cantidad'],
                'subtotal' => $item['subtotal']
            ];
        }

        $data = [
            'factura' => $factura,
            'detalle' => $detalleCompleto,
            'cliente' => $cliente
        ];

        echo view('Plantillas/HeadFactura');
        echo view('Plantillas/Header1');
        echo view('Plantillas/Header2');
        echo view('Pages/verFactura', $data);
        echo view('Plantillas/FooterNavegacion');
        echo view('Plantillas/Footer');
    }

}