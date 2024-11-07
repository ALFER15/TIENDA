<div class="container mx-auto px-4">
    <div class="flex justify-between items-center">
        <span class="block font-medium text-lg text-gray-700 dark:text-gray-300">CREATE A NEW PRODUCT</span>
        <x-button wire:click="verVista">Create Product</x-button>
    </div>
    <br>
    <div class="mb-4">
        <x-input class="w-full border-gray-600 placeholder:text-gray-300" placeholder="Busqueda" wire:model.live='busqueda'/>
    </div>
    <br>
    @if($vista)
    <div class="fixed inset-0 flex items-center justify-center z-50 bg-gray-800 bg-opacity-75">
        <div class="bg-white shadow rounded-lg p-6 w-full max-w-4xl">
            <form wire:submit.prevent='enviar'>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <x-label for="name" value="Name of product"/>
                        <x-input type="text" wire:model='name' class="w-full"/>
                    </div>
                    <div>
                        <x-label for="stock" value="Stock"/>
                        <x-input type="text" wire:model='stock' class="w-full"/>
                    </div>
                    <div>
                        <x-label for="store_price" value="Store price"/>
                        <x-input type="text" wire:model='store_price' class="w-full"/>
                    </div>
                    <div>
                        <x-label for="public_price" value="Public price"/>
                        <x-input type="text" wire:model='public_price' class="w-full"/>
                    </div>
                    <div>
                        <x-label for="expiration" value="Expiration"/>
                        <x-input type="date" wire:model='expiration' class="w-full"/>
                    </div>
                    <div>
                        <x-label for="assortment" value="Assortment"/>
                        <x-input type="date" wire:model='assortment' class="w-full"/>
                    </div>
                    <div>
                        <x-label for="status" value="Status"/>
                        <x-input type="text" wire:model='status' class="w-full"/>
                    </div>
                    <div>
                        <x-label for="supplier_id" value="Supplier"/>
                        <select wire:model='supplier_id' class="w-full border-gray-300 rounded-md">
                            <option value="">Select Supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-label for="category_id" value="Category"/>
                        <select wire:model='category_id' class="w-full border-gray-300 rounded-md">
                            <option value="">Select Category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex justify-end space-x-4">
                    <x-button type="submit">Save</x-button>
                    <x-danger-button  wire:click="set('vista', false)" >Cancel</x-danger-button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <div class="mt-8 overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stock</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Store Price</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Public Price</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expiration</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assortment</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Supplier</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->id }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->stock }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->store_price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->public_price }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->expiration }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->assortment }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->supplier->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->category->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $product->created_at }}</td>
                        <td class="px-6 py-4">
                            <x-button class="bg-green-600 dark:bg-green-600" wire:click='editar({{ $product->id }})'>Editar</x-button>
                            <x-danger-button class="" wire:click='delete({{ $product->id }})'>Eliminar</x-danger-button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-4">
            {{ $products->links() }}
        </div>
    </div>
</div>
