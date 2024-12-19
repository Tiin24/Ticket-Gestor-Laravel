<x-slot name="header">
    <h1 class="text-gray-900">CRUD con Laravel 8 y Livewire</h1>
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
            <div class="flex justify-between">

                <button wire:click="crear()"
                    class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 my-3">Nuevo</button>
                @if ($modal)
                    @include('livewire.crear')
                @endif


                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Filtrar por Completado:</label>
                    <select id="completed" wire:model="completed" class="shadow border rounded w-full py-2 px-3">
                        <option value="">Todos</option>
                        <option value="1">Completados</option>
                        <option value="0">Incompletos</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Filtrar por Dificultad:</label>
                    <select id="difficulty" wire:model="difficulty" class="shadow border rounded w-full py-2 px-3">
                        <option value="">Todas</option>
                        <option value="Easy">Fácil</option>
                        <option value="Medium">Medio</option>
                        <option value="Hard">Difícil</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Ordenar por Fecha:</label>
                    <select wire:model="orderByDate"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        <option value="asc">ASC</option>
                        <option value="desc" selected>DESC</option>
                    </select>
                </div>
                <button wire:click="limpiarFiltros()"
                    class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 my-3">Limpiar Filtros</button>
            </div>


            <table class="table-fixed w-full">
                <thead>
                    <tr class="bg-indigo-600 text-white">
                        <th class="px-4 py-2">ID</th>
                        <th class="px-4 py-2">NAME</th>
                        <th class="px-4 py-2">DESCRIPTION</th>
                        <th class="px-4 py-2">DIFICULTAD</th>
                        <th class="px-4 py-2">STATUS</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td class="border px-4 py-2">{{ $ticket->id }}</td>
                            <td class="border px-4 py-2">{{ $ticket->name }}</td>
                            <td class="border px-4 py-2">{{ $ticket->description }}</td>
                            <td class="border px-4 py-2">
                                <div className="flex items-center gap-1 text-center">
                                    <img src="{{ $ticket->gif_url }}" alt="GIF" width="50" height="50" />
                                </div>
                            </td>
                            <td class="border px-4 py-2">
                                <span
                                    class="inline-block px-3 py-1 text-sm font-semibold rounded-full 
                                            {{ $ticket->completed == 1 ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                                    {{ $ticket->completed == 1 ? 'Completado' : 'Incompleto' }}
                                </span>
                            </td>

                            <td class="border px-4 py-2 text-center">
                                <button wire:click="editar({{ $ticket->id }})"
                                    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4">Editar</button>
                                <button wire:click="borrar({{ $ticket->id }})"
                                    class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4">Borrar</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
