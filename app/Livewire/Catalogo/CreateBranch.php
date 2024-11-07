<?php

namespace App\Livewire\Catalogo;

use App\Models\Branch;
use Livewire\Component;
use Livewire\WithPagination;

class CreateBranch extends Component
{
    use WithPagination;

    public $name, $phone, $rfc, $address;
    public $title;
    public $mEdit = false;
    public $idEditable;
    public $mCreate = false;
    public $branchEdit = [
        'id' => '',
        'name' => '',
        'phone' => '',
        'rfc' => '',
        'address' => ''
    ];
    public $search = '';

    public function render()
    {
        $branches = Branch::where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('address', 'like', '%' . $this->search . '%')
                          ->paginate(5);
        return view('livewire.catalogo.create-branch', [
            'branches' => $branches
        ]);
    }

    public function save()
    {
        $branch = new Branch();
        $branch->name = $this->name;
        $branch->phone = $this->phone;
        $branch->rfc = $this->rfc;
        $branch->address = $this->address;
        $branch->save();
        $this->reset(['name', 'phone', 'rfc', 'address']);
        $this->mCreate = false; // Cerrar formulario de creación después de guardar
    }

    public function updated($propertyName){

        if($propertyName === 'search'){
            $this->resetPage();
        }

    }

    public function eliminar($id)
    {
        $branch = Branch::find($id);
        $branch->delete();
    }

    public function editar($branchEdit)
    {
        $this->mEdit = true;
        $branchEdit = Branch::find($branchEdit);
        $this->idEditable = $branchEdit->id;
        $this->branchEdit['id'] = $branchEdit->id;
        $this->branchEdit['name'] = $branchEdit->name;
        $this->branchEdit['phone'] = $branchEdit->phone;
        $this->branchEdit['rfc'] = $branchEdit->rfc;
        $this->branchEdit['address'] = $branchEdit->address;
    }

    public function update()
    {
        $branch = Branch::find($this->idEditable);
        $branch->update([
            'name' => $this->branchEdit['name'],
            'phone' => $this->branchEdit['phone'],
            'rfc' => $this->branchEdit['rfc'],
            'address' => $this->branchEdit['address'],
        ]);
        $this->reset([
            'branchEdit',
            'idEditable',
            'mEdit'
        ]);
    }
}
