<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private $products = [];
    private $_filters;
    private $showBanner = false;

    public function __construct()
    {
        /**
         * Filters (name=>value) format to show in the view
         * Write the content of the stars
         */
        $this->_filters = (object)array(
            'category' => array(1 => 'Fantasia', 2 => 'Acción', 3 => 'Romance'),
        );
        $this->showBanner = true;
        $this->products = [];
    }
    /**
     * Method to list all the products
     */
    public function all()
    {
        //TODO: Carga todos los productos en $this->products
        $this->showBanner = true;
        $this->products=Product::all();
        return $this->showProducts();
    }

    /**
     * Method to list the products filtered by category
     */
    public function category(Request $request, $cat)
    {

        //TODO: Carga todos los productos de la categoria enviada en $this->products
        $this->showBanner = true;
        $this->products=Product::category($cat)->get();
        return $this->showProducts();
    }

    /**
     * Method to list the products filtered by stars
     */
    public function search(Request $request)
    {

        //TODO: Carga todos los productos que coincidan con el texto de search y la categoria seleccionada $this->products
        $query= Product::query();
        $this->showBanner=false;
        if($request->filled('category'))
        {
            $query->category($request->input('category'));
        }
        $this->products=$query->get();
        return $this->showProducts();
    }

    public function showProducts()
    {
        //Load the same view for all the methods
        return view('productos/products')
            ->with('showBanner', $this->showBanner)
            ->with('filters', $this->_filters)
            ->with('products', $this->products);
    }
}
