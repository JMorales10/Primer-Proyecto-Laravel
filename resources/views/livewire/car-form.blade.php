<div>
    <h1>Mis Coches-{{ $nombre }}</h1>

    <div>
        Buscar: <x-text-input wire:model='buscador' class="border-4"></x-text-input>
    </div>
    @livewire('create-car')

    <div class="relative overflow-x-auto">
        @if ($cars->count() > 0)
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th wire:click="ordenar('Id')" scope="col" class="px-6 py-3 cursor-pointer">
                            Id
                        </th>
                        <th wire:click="ordenar('Matricula')" scope="col" class="px-6 py-3 cursor-pointer">
                            Matricula
                        </th>
                        <th wire:click="ordenar('Marca')" scope="col" class="px-6 py-3 cursor-pointer">
                            Marca
                        </th>
                        <th wire:click="ordenar('Modelo')" scope="col" class="px-6 py-3 cursor-pointer">
                            Modelo
                        </th>
                        <th wire:click="ordenar('year')" scope="col" class="px-6 py-3 cursor-pointer">
                            Año
                        </th>
                        <th wire:click="ordenar('Color')" scope="col" class="px-6 py-3 cursor-pointer">
                            Color
                        </th>
                        <th wire:click="ordenar('fecha_ultima_revision')" scope="col"
                            class="px-6 py-3 cursor-pointer">
                            Fecha ultima revision
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                            <th scope="row"
                                class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $car->id }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $car->matricula }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->marca }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->modelo }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->year }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->color }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $car->fecha_ultima_revision }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <br><br>
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                role="alert">
                <span class="font-medium">Mensaje</span> No se ha encontrado ningun coche
            </div>
        @endif
    </div>

</div>
