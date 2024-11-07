<?php

namespace App\Livewire\Productos;

use App\Models\Supplier;
use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class CreateProduct extends Component
{
    use WithPagination;

    public $name;
    public $stock;
    public $store_price;
    public $public_price;
    public $expiration;
    public $assortment;
    public $status;
    public $supplier_id;
    public $category_id;
    public $idEditable;
    public $suppliers;
    public $categories;
    public $busqueda;

    public $vista = false;
    public $pEdit = false;
    public $productEdit = [
        'id' => '',
        'name' => '',
        'stock' => '',
        'store_price' => '',
        'public_price' => '',
        'expiration' => '',
        'assortment' => '',
        'status' => '',
        'supplier_id' => '',
        'category_id' => ''
    ];

    public function mount()
    {
        $this->categories= Category::all();
        $this->suppliers= Supplier::all();
    }

    public function render()
    {
        $products = Product::where('name', 'LIKE', "%{$this->busqueda}%")
            ->orWhere('stock', 'LIKE', "%{$this->busqueda}%")
            ->orWhere('store_price', 'LIKE', "%{$this->busqueda}%")
            ->orWhere('public_price', 'LIKE', "%{$this->busqueda}%")
            ->orWhere('expiration', 'LIKE', "%{$this->busqueda}%")
            ->orWhere('assortment', 'LIKE', "%{$this->busqueda}%")
            ->orWhere('status', 'LIKE', "%{$this->busqueda}%")
            ->paginate(5);

        return view('livewire.productos.create-product', ['products' => $products]);
    }

    public function verVista()
    {
        $this->vista = !$this->vista;
    }

    public function enviar()
    {
        $product = new Product();
        $product->name = $this->name;
        $product->stock = $this->stock;
        $product->store_price = $this->store_price;
        $product->public_price = $this->public_price;
        $product->expiration = $this->expiration;
        $product->assortment = $this->assortment;
        $product->status = $this->status;
        $product->supplier_id = $this->supplier_id;
        $product->category_id = $this->category_id;
        $product->save();

        $this->reset(['name', 'stock', 'store_price', 'public_price', 'expiration', 'assortment',
        'status', 'supplier_id', 'category_id']);
        $this->verVista();
    }

    public function editar($productID)
    {
        $this->pEdit = true;
        $productEditable = Product::find($productID);
        $this->idEditable = $productEditable->id;
        $this->productEdit['name'] = $productEditable->name;
        $this->productEdit['stock'] = $productEditable->stock;
        $this->productEdit['store_price'] = $productEditable->store_price;
        $this->productEdit['public_price'] = $productEditable->public_price;
        $this->productEdit['expiration'] = $productEditable->expiration;
        $this->productEdit['assortment'] = $productEditable->assortment;
        $this->productEdit['status'] = $productEditable->status;
        $this->productEdit['supplier_id'] = $productEditable->supplier_id;
        $this->productEdit['category_id'] = $productEditable->category_id;
    }

    public function update()
    {
        $product = Product::find($this->idEditable);
        $product->update([
            'name' => $this->productEdit['name'],
            'stock' => $this->productEdit['stock'],
            'store_price' => $this->productEdit['store_price'],
            'public_price' => $this->productEdit['public_price'],
            'expiration' => $this->productEdit['expiration'],
            'assortment' => $this->productEdit['assortment'],
            'status' => $this->productEdit['status'],
            'supplier_id' => $this->productEdit['supplier_id'],
            'category_id' => $this->productEdit['category_id'],
        ]);

        $this->reset(['productEdit', 'idEditable', 'pEdit']);
    }

    public function delete(Product $product)
    {
        $product->delete();
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'busqueda') {
            $this->resetPage();
        }
    }

}
