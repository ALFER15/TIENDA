<?php

namespace App\Livewire\Catalogo;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithPagination;
use App\Events\NewCategoryCreated; // Importa el evento que creaste

class CreateCategory extends Component
{
    use WithPagination;

    public $cat;
    public $name;
    public $description;
    public $title;
    public $mEdit = false;
    public $idEditable;
    public $mCreate = false;
    public $categoryEdit = [
        'id' => '',
        'name' => '',
        'description' =>''
    ];
    public $search = '';

    public function render()
    {
        $categories = Category::where('name', 'like', '%' . $this->search . '%')
                              ->orWhere('description', 'like', '%' . $this->search . '%')
                              ->paginate(5);
        return view('livewire.catalogo.create-category', [
            'categories' => $categories
        ]);
    }

    public function enviar()
    {
        $category = new Category();
        $category->name = $this->name;
        $category->description = $this->description;
        $category->save();

        // Emitir el evento después de guardar la nueva categoría
        event(new NewCategoryCreated($category));

        $this->reset(['name', 'description']);
    }

    public function updated($propertyName)
    {
        if ($propertyName === 'search') {
            $this->resetPage();
        }
    }

    public function eliminar($id)
    {
        $category = Category::find($id);
        $category->delete();
    }

    public function editar($categoryEdit)
    {
        $this->mEdit = true;
        $categoryEdit = Category::find($categoryEdit);
        $this->idEditable = $categoryEdit->id;
        $this->categoryEdit['id'] = $categoryEdit->id;
        $this->categoryEdit['name'] = $categoryEdit->name;
        $this->categoryEdit['description'] = $categoryEdit->description;
    }

    public function update()
    {
        $category = Category::find($this->idEditable);
        $category->update([
            'name' => $this->categoryEdit['name'],
            'description' => $this->categoryEdit['description'],
        ]);
        $this->reset([
            'categoryEdit',
            'idEditable',
            'mEdit'
        ]);
    }
}
