<?php

namespace App\Livewire\Catalogo;

use App\Models\Supplier;
use Livewire\Component;
use Livewire\WithPagination;

class CreateSupplier extends Component
{
    use WithPagination;

    public $name, $phone, $rfc, $address, $email, $manager_name;
    public $title;
    public $mEdit = false;
    public $idEditable;
    public $mCreate = false;
    public $supplierEdit = [
        'id' => '',
        'name' => '',
        'phone' => '',
        'rfc' => '',
        'address' => '',
        'email' => '',
        'manager_name' => ''
    ];
    public $search = '';

    public function render()
    {
        $suppliers = Supplier::where('name', 'like', '%' . $this->search . '%')
                             ->orWhere('address', 'like', '%' . $this->search . '%')
                             ->orWhere('email', 'like', '%' . $this->search . '%')
                             ->paginate(5);
        return view('livewire.catalogo.create-supplier', [
            'suppliers' => $suppliers
        ]);
    }

    public function updated($propertyName){

        if($propertyName === 'search'){
            $this->resetPage();
        }

    }

    public function save()
    {
        $supplier = new Supplier();
        $supplier->name = $this->name;
        $supplier->phone = $this->phone;
        $supplier->rfc = $this->rfc;
        $supplier->address = $this->address;
        $supplier->email = $this->email;
        $supplier->manager_name = $this->manager_name;
        $supplier->save();
        $this->reset(['name', 'phone', 'rfc', 'address', 'email', 'manager_name']);
        $this->mCreate = false; // Cerrar formulario de creación después de guardar
    }

    public function eliminar($id)
    {
        $supplier = Supplier::find($id);
        $supplier->delete();
    }

    public function editar($supplierEdit)
    {
        $this->mEdit = true;
        $supplierEdit = Supplier::find($supplierEdit);
        $this->idEditable = $supplierEdit->id;
        $this->supplierEdit['id'] = $supplierEdit->id;
        $this->supplierEdit['name'] = $supplierEdit->name;
        $this->supplierEdit['phone'] = $supplierEdit->phone;
        $this->supplierEdit['rfc'] = $supplierEdit->rfc;
        $this->supplierEdit['address'] = $supplierEdit->address;
        $this->supplierEdit['email'] = $supplierEdit->email;
        $this->supplierEdit['manager_name'] = $supplierEdit->manager_name;
    }

    public function update()
    {
        $supplier = Supplier::find($this->idEditable);
        $supplier->update([
            'name' => $this->supplierEdit['name'],
            'phone' => $this->supplierEdit['phone'],
            'rfc' => $this->supplierEdit['rfc'],
            'address' => $this->supplierEdit['address'],
            'email' => $this->supplierEdit['email'],
            'manager_name' => $this->supplierEdit['manager_name'],
        ]);
        $this->reset([
            'supplierEdit',
            'idEditable',
            'mEdit'
        ]);
    }
}
