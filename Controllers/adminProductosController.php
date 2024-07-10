<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\CatalogoModel;
use App\Models\CategoriasModel;
use App\Models\SubcategoriasModel;

class adminProductosController extends Controller {
    public function __construct() {
        helper(['form', 'url']);
    }

    public function productosMostrar($pagina = 1) {
            helper(['form', 'url']);

            $modelo = new CatalogoModel();
            $categoriaModelo = new CategoriasModel();
            $subcategoriasModelo = new SubcategoriasModel();
        
            $categoriaFiltro = $this->request->getVar('categoria');

            $subcategoriaFiltro = $this->request->getVar('subcategoria');
        
            $categorias = $categoriaModelo->where('baja', 'NO')->obtenerCategorias();
            $subcategorias = $subcategoriasModelo->where('baja','NO')->obtenerSubcategorias();
        
            if ($categoriaFiltro && !$subcategoriaFiltro) {
                $productosActivos = $modelo->where('baja', 'NO')->where('categoria_id', $categoriaFiltro)->paginate(7, 'productsAlta');
                $productosBaja = $modelo->where('baja', 'SI')->where('categoria_id', $categoriaFiltro)->paginate(7, 'productsBaja');
            } elseif ($subcategoriaFiltro && !$categoriaFiltro) {
                $productosActivos = $modelo->where('baja', 'NO')->where('id_subcategoria', $subcategoriaFiltro)->paginate(7, 'productsAlta');
                $productosBaja = $modelo->where('baja', 'SI')->where('id_subcategoria', $subcategoriaFiltro)->paginate(7, 'productsBaja');
            } else {
                $productosActivos = $modelo->where('baja', 'NO')->paginate(7, 'productsAlta');
                $productosBaja = $modelo->where('baja', 'SI')->paginate(7, 'productsBaja');
            }
        
            $datos = [
                'productosActivos' => $productosActivos,
                'productosBaja' => $productosBaja,
                'categorias' => $categorias,
                'subcategorias' => $subcategorias,
                'paginacion' => $modelo->pager
            ];
        
            echo view('Plantillas/HeadAdminProduc');
            echo view('Plantillas/Header1');
            echo view('Plantillas/Header2');
            echo view('/Pages/Administrar/administrarProductos', $datos); 
            echo view('Plantillas/FooterNavegacion');
            echo view('Plantillas/Footer');
        }
        
        public function modificarProducto($id) {
            $model = new CatalogoModel();
            $categoriaModelo = new CategoriasModel();
            $subcategoriasModelo = new SubcategoriasModel();
            $categorias = $categoriaModelo->where('baja', 'NO')->obtenerCategorias();
            $subcategorias = $subcategoriasModelo->where('baja','NO')->obtenerSubcategorias();

            $data = [
                'producto' => $model->obtenerProductoPorId($id),
                'categorias' => $categorias,
                'subcategorias' => $subcategorias
            ];
    
            echo view('Plantillas/HeadModificarProduc');
            echo view('Plantillas/Header1');
            echo view('Plantillas/Header2');
            echo view('/Pages/Administrar/modificarProducto', $data); 
            echo view('Plantillas/FooterNavegacion');
            echo view('Plantillas/Footer');
        }
    
        public function editarProducto() {
            $model = new CatalogoModel();
    
            $id = $this->request->getVar('id_productos');
    
            $input = $this->validate([
                'nombre' => 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-Z0-9ÁÉÍÓÚáéíóúÑñ.,()\- ]+$/]',
                'url_imagen' => 'max_length[100]',
                'precio' => 'required|regex_match[/^\d{1,10}(\.\d{2})?$/]',
                'stock' => 'required|regex_match[/^\d{1,11}$/]'
            ]);
    
            if(!$input) {
    
                $data['producto'] = $model->obtenerProductoPorId($id);
    
                echo view('Plantillas/HeadModificarProduc');
                echo view('Plantillas/Header1');
                echo view('Plantillas/Header2');
                echo view('/Pages/Administrar/modificarProducto', $data, ['validation' => $this->validator]); 
                echo view('Plantillas/FooterNavegacion');
                echo view('Plantillas/Footer');
                
            } else {
                $datosProduc = [
                    'nombre' => $this->request->getVar('nombre'),
                    'precio' => $this->request->getVar('precio'),
                    'stock' => $this->request->getVar('stock'),
                    'url_imagen' => $this->request->getVar('url_imagen'),
                    'categoria_id' => $this->request->getVar('categoria_id'),
                    'id_subcategoria' => $this->request->getVar('id_subcategoria'),
                ];
    
                $model->actualizarProducto($id, $datosProduc);
    
                session()->setFlashdata('success', 'Producto modificado con éxito!');
                
                return redirect()->to(site_url('administrarProductos'));
            }
        }
    
        public function modificarImagen() {
            $model = new CatalogoModel();
    
            $id = $this->request->getVar('id_productos');
    
            $url_imagen = $this->request->getFile('imagen');
            $nombre = $url_imagen->getName(); 
            $datos = array('url_imagen' => $nombre);
            $model->actualizarProducto($id, $datos);
            session()->setFlashdata('success', 'Imagen del producto modificada con éxito!');
    
    
            return redirect()->to(site_url('administrarProductos'));
        }
    
        public function altaProducto() {
            $categoriaModelo = new CategoriasModel();
            $subcategoriasModelo = new SubcategoriasModel();
            $categorias = $categoriaModelo->where('baja', 'NO')->obtenerCategorias();
            $subcategorias = $subcategoriasModelo->where('baja','NO')->obtenerSubcategorias();

            $datos = [
                'categorias' => $categorias,
                'subcategorias' => $subcategorias,
            ];

            echo view('Plantillas/HeadAltaProducto');
            echo view('Plantillas/Header1');
            echo view('Plantillas/Header2');
            echo view('/Pages/Administrar/altaProducto', $datos); 
            echo view('Plantillas/FooterNavegacion');
            echo view('Plantillas/Footer');
        }
    
        public function productValidation() {
            $input = $this->validate([
                'nombre' => 'required|min_length[3]|max_length[50]|regex_match[/^[a-zA-Z0-9ÁÉÍÓÚáéíóúÑñ.,()\- ]+$/]',
                'precio' => 'required|regex_match[/^\d{1,10}(\.\d{2})?$/]',
                'stock' => 'required|regex_match[/^\d{1,11}$/]',
            ]);
    
            $modelo = new CatalogoModel();
            $categoriaModelo = new CategoriasModel();
            $subcategoriasModelo = new SubcategoriasModel();
            $categorias = $categoriaModelo->where('baja', 'NO')->obtenerCategorias();
            $subcategorias = $subcategoriasModelo->where('baja','NO')->obtenerSubcategorias();
            
            $datos = [
                'categorias' => $categorias,
                'subcategorias' => $subcategorias,
            ];
    
            if(!$input) {
                echo view('Plantillas/HeadAltaProducto');
                echo view('Plantillas/Header1');
                echo view('Plantillas/Header2');
                echo view('/Pages/Administrar/altaProducto', $datos, ['validation' => $this->validator]); 
                echo view('Plantillas/FooterNavegacion');
                echo view('Plantillas/Footer');
                
            } else {
                $datos = [
                    'nombre' => $this->request->getVar('nombre'),
                    'precio' => $this->request->getVar('precio'),
                    'stock' => $this->request->getVar('stock'),
                    'url_imagen' => $this->request->getVar('url_imagen'),
                    'categoria_id' => $this->request->getVar('categoria_id'),
                    'id_subcategoria' => $this->request->getVar('id_subcategoria'),
                ];
    
                $modelo->altaProducto($datos);
    
                session()->setFlashdata('success', 'Producto añadido con éxito!');
                
                return redirect()->to(site_url('administrarProductos'));
            }
        }
    
        public function bajaProducto($id) {
            $modelo = new CatalogoModel();
            $modelo->eliminarProducto($id);
            session()->setFlashdata('success', 'Producto dado de baja con éxito!');
            return redirect()->to(site_url('administrarProductos'));
        }
        
        public function anularBajaProducto($id) {
            $modelo = new CatalogoModel();
            $modelo->anularBaja($id);
            session()->setFlashdata('success', 'Baja anulada con éxito!');
            return redirect()->to('/administrarProductos');
        }

        public function altaCategoria() {
            echo view('Plantillas/HeadAltaCategoria');
            echo view('Plantillas/Header1');
            echo view('Plantillas/Header2');
            echo view('/Pages/Administrar/altaCategoria'); 
            echo view('Plantillas/FooterNavegacion');
            echo view('Plantillas/Footer');
        }

        public function categoriaValidation(){
            $input = $this->validate([
                'descripcion' => 'required|min_length[3]|max_length[50]|is_unique[categorias.descripcion]|regex_match[/^[a-zA-ZÁÉÍÓÚáéíóúÑñ.,()\- ]+$/]',
            ]);
    
            $modelo = new CategoriasModel();
    
            if(!$input) {
                echo view('Plantillas/HeadAltaCategoria');
            echo view('Plantillas/Header1');
            echo view('Plantillas/Header2');
            echo view('/Pages/Administrar/altaCategoria', ['validation' => $this->validator]); 
            echo view('Plantillas/FooterNavegacion');
            echo view('Plantillas/Footer');
                
            } else {
                $datos = [
                    'descripcion' => $this->request->getVar('descripcion'),
                ];
    
                $modelo->altaCategoria($datos);
    
                session()->setFlashdata('success', 'Categoría añadida con éxito!');
                
                return redirect()->to(site_url('administrarProductos'));
            }
        }

        public function bajaCategoria() {
            $modelo = new CategoriasModel();
            $productosModelo = new CatalogoModel();
            $id = $this->request->getVar('id_categoria');

            $productosActivos = $productosModelo->where('baja', 'NO')->where('categoria_id', $id)->obtenerTodosLosProductos();
            if(!empty($productosActivos)){
                session()->setFlashdata('fail', 'No se puede eliminar la categoría! Posee productos asociados!');
                return redirect()->to('/administrarProductos');

            }

            $modelo->eliminarCategoria($id);
            session()->setFlashdata('success', 'Categoría eliminada con éxito!');
            return redirect()->to('/administrarProductos');
        }
        public function altaSubCategoria() {
            echo view('Plantillas/HeadAltaSubCategoria');
            echo view('Plantillas/Header1');
            echo view('Plantillas/Header2');
            echo view('/Pages/Administrar/altaSubCategoria'); 
            echo view('Plantillas/FooterNavegacion');
            echo view('Plantillas/Footer');
        }

        public function SubCategoriaValidation(){
            $input = $this->validate([
                'descripcion' => 'required|min_length[3]|max_length[50]|is_unique[subcategorias.descripcion]|regex_match[/^[a-zA-ZÁÉÍÓÚáéíóúÑñ.,()\- ]+$/]',
            ]);
    
            $modelo = new SubcategoriasModel();
    
            if(!$input) {
                echo view('Plantillas/HeadAltaSubCategoria');
                echo view('Plantillas/Header1');
                echo view('Plantillas/Header2');
                echo view('/Pages/Administrar/altaSubCategoria', ['validation' => $this->validator]); 
                echo view('Plantillas/FooterNavegacion');
                echo view('Plantillas/Footer');
            } else {
                $datos = [
                    'descripcion' => $this->request->getVar('descripcion'),
                ];
    
                $modelo->altaSubCategoria($datos);
    
                session()->setFlashdata('success', 'Subcategoría añadida con éxito!');
                
                return redirect()->to(site_url('administrarProductos'));
            }
        }

        public function bajaSubCategoria() {
            $modelo = new SubcategoriasModel();
            $productosModelo = new CatalogoModel();
            $id = $this->request->getVar('id_subcategoria');
            
            $productosActivos = $productosModelo->where('baja', 'NO')->where('id_subcategoria', $id)->findAll();
            if (!empty($productosActivos)) {
                session()->setFlashdata('fail', 'No se puede eliminar la subcategoría porque tiene productos activos asociados.');
                return redirect()->to('/administrarProductos');
            }
            
            $modelo->eliminarSubCategoria($id);
            session()->setFlashdata('success', 'Sub-categoría eliminada con éxito!');
            return redirect()->to('/administrarProductos');
        }
        
}
