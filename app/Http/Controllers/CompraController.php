<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Http\Requests\CompraRequest;
use App\Http\Requests\UserRequest;
use Exception;

class CompraController extends Controller
{

    public function main()
    {
        /*Recuerda el estado de la compra y redirige a la pantalla en la 
        que el usuario estaba antes: resumen, envio o confirmar. Si no esta definido empieza por "resumen"*/
        return redirect(session()->get('status', '/compra/resumen'));
    }
    /**
     * Method to show the resume of the products in the chart
     */
    public function resumen()
    {
        //TODO: hay que enviar a la vista los productos guardados en el carrito (session) para que se vean en el resumen
        $products=[session()->get('products')];

        return view('compra/resumen')->with('products', $products);
    }

    /**
     * Method that load the form of shipping with the user information
     */
    public function envio()
    {
        //TODO: Carga la información del usuario (nombre y mail) en el formulario. 
        //*Tu usuario está guardado en sesión con la key "user"
        return view('compra/envio');
    }
    /**
     * Method to show and process the shipping form (envio)
     */
    public function verificarEnvio(UserRequest $request)
    {
        $request->flash();
        $formOK = false;
        $userShipping = (object)[];

        try {
            //TODO: Almacena los datos que vienen del formulario en la variable $userShipping
            $userShipping->name=$request->input('Name');
            $userShipping->direccion=$request->input('Direccion');
            $userShipping->email=$request->input('E-mail Adress');
            $userShipping->password=$request->input('Password');
            $userShipping->name=$request->input('Name');
            
            //TODO: Guarda la foto en la carpeta /publica
            $formOK = true;
            
        } catch (Exception $e) {

        }
        /*Una vez verificado se guarda la información de envio en la session para poderla utilizar en otras pantallas*/
        $request->session()->put('shipping', $userShipping);
        //si el formulario se ha rellenado correctamente se redirecciona a la pagina de confirmación
        if ($formOK) return redirect('/compra/confirmar');
        else  return redirect('/compra/envio');
    }
    /**
     * Method to show the list of products and shipping info
     */
    public function confirmar()
    {
        //Cargamos la información del envio y los productos que tenemos en session par amostrarlo en la vista
        $carrito = session()->get('carrito', []);
        $shipping =  session()->get('shipping');
        session()->put('status', 'compra/confirmar');
        return view('compra/confirmar')->with('products', $carrito)->with('shipping', $shipping);
    }

    /**
     * Metodo que comprueba que existan unidades de una pelicula
     */
    public function checkStock(CompraRequest $request)
    {
        //TODO: Comprueba que haya stock del producto enviado para comprar/alquilar

    }

    /**
     * Metodo para introducir un producto al carrito (session)
     */
    public function addToCart(CompraRequest $request)
    {
       //TODO: Añade el producto enviado al carrito (session)
        $product=$request->input('product');
        $carrito= $request->session()->get('carrito',[]);
        array_push($carrito,$product);
        $request->session()->put('carrito',$carrito);
        $request->session()->forget('status');
        
    }

    /**
     * Metodo para borrar el carrito (session)
     */
    public function clearCart(CompraRequest $request)
    {
        //TODO: Borra el carrito
        $carrito= $request->session()->get('carrito',[]);
        $carrito=[];
        $request->session()->put('carrito',$carrito);
        $request->session()->forget('carrito');
        
    }
}
