<div>
    @if ($mCreate)
        <h3 class="p-7 font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Nueva Sucursal</h3>
        <div class="mb-6">
            <form wire:submit='save'>
                <x-label class="ml-6" for="name" value="Nombre de la Sucursal"/>
                <x-input class="ml-6" type="text" wire:model='name'/>
                <x-label class="ml-6" for="phone" value="Número de Teléfono"/>
                <x-input class="ml-6" type="text" wire:model='phone'/><br>
                <x-label class="ml-6" for="address" value="Dirección"/>
                <textarea class="ml-6" name="address" wire:model='address' cols="30" rows="4" placeholder="Dirección"></textarea>
                <x-label class="ml-6" for="rfc" value="RFC"/>
                <x-input class="ml-6" type="text" wire:model='rfc'/><br>
                <x-button class="ml-6 mt-2">Guardar</x-button>
                <x-danger-button wire:click="set('mCreate', false)">Cerrar</x-danger-button>
            </form>
        </div>
    @endif

    <div class="relative overflow-x-auto">
        <div class="flex justify-between items-center p-7">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Sucursales</h2>
            <div class="flex items-center space-x-4">
                <button wire:click="set('mCreate', true)" class="px-3 py-2 text-sm bg-gray-200 hover:bg-gray-300 rounded">Crear</button>
                <div class="relative">
                    <input type="search"
                           wire:model.live="search"
                           class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                           placeholder="Buscar sucursales..."/>
                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nombre</th>
                    <th scope="col" class="px-6 py-3">Dirección</th>
                    <th scope="col" class="px-6 py-3">Teléfono</th>
                    <th scope="col" class="px-6 py-3">RFC</th>
                    <th scope="col" class="px-6 py-3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($branches as $branch)
                <tr wire:key="{{ $branch->id }}" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $branch->id }}</th>
                    <td class="px-6 py-4">{{ $branch->name }}</td>
                    <td class="px-6 py-4">{{ $branch->address }}</td>
                    <td class="px-6 py-4">{{ $branch->phone }}</td>
                    <td class="px-6 py-4">{{ $branch->rfc }}</td>
                    <td class="px-6 py-4">
                        <x-danger-button wire:click='eliminar({{$branch->id}})'>DELETE</x-danger-button>
                        <x-button class="text-orange-600 active:bg-orange-400 bg-white hover:bg-orange-300 border-orange-600 border-2" wire:click='edit({{$branch->id}})'>Editar</x-button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $branches->links() }}
        </div>
    </div>

    @if ($mEdit)
    <div class="bg-gray-800 bg-opacity-25 fixed inset-0">
        <div class="py-12">
            <div class="bg-white shadow rounded-lg p-6">
                <form class="max-w-lg mx-auto" wire:submit='update'>
                    <div class="mb-4"><span>Editar Sucursal:</span></div>
                    <x-label class="w-full" for="name" value="Nombre de la Sucursal"/>
                    <x-input class="w-full" name="name" wire:model='branchEdit.name'/>
                    <x-label class="w-full" for="phone" value="Teléfono"/>
                    <x-input class="w-full" name="phone" wire:model='branchEdit.phone'/><br>
                    <x-label class="w-full" for="address" value="Dirección"/>
                    <textarea class="w-full" name="address" wire:model='branchEdit.address' cols="30" rows="4"></textarea>
                    <x-label class="w-full" for="rfc" value="RFC"/>
                    <x-input class="w-full" name="rfc" wire:model='branchEdit.rfc'/><br>
                    <x-danger-button class="mt-2" wire:click="set('mEdit', false)">Cancelar</x-danger-button>
                    <x-button class="mt-2">Actualizar</x-button>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
