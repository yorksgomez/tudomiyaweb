<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Colaboradores') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-8 px-12">  
                <section class="mb-12">
                    <x-section-title class="mb-4">Colaboradores Activos</x-section-title>
                    <table class="w-full">
                        <x-table-head :titles="['Nombre','Apellido','Correo','Teléfono','Cédula']"></x-table-head>
                        @foreach ($colaboradores as $colaborador)
                            <tr class="text-center">
                                <td>{{ $colaborador->name }}</td>
                                <td>{{ $colaborador->lastname }}</td>
                                <td>{{ $colaborador->email }}</td>
                                <td>{{ $colaborador->phone }}</td>
                                <td>{{ $colaborador->nit }}</td>
                            </tr>
                        @endforeach
                    </table>
                </section>
                <section class="flex flex-col justify-center items-center">
                    <x-section-title class="mb-4">Agregar Nuevo Colaborador</x-section-title>
                    <form class="max-w-md" action="{{ route('put-colaborator') }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="flex justify-center flex-col mb-6">
                            <x-subtitle>Rellena este formulario</x-subtitle>
                        </div>
                        <div class="flex justify-center">
                            <div class="mr-1">
                                <x-jet-label>Nombre<x-required-input/></x-jet-label>
                                <x-jet-input type="text" class="" required name="name"></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label>Apellido<x-required-input/></x-jet-label>
                                <x-jet-input type="text" class="flex-1" required name="lastname"></x-jet-input>
                            </div>
                        </div>
                        <div class="flex justify-center mt-4">
                            <div class="mr-1">
                                <x-jet-label>Cédula<x-required-input/></x-jet-label>
                                <x-jet-input type="text" class="flex-1" required name="nit"></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label>Celular<x-required-input/></x-jet-label>
                                <x-jet-input type="text" class="flex-1" required name="phone"></x-jet-input>
                            </div>
                        </div>
                        <div class="flex justify-center flex-col mt-4">
                            <x-jet-label>Correo<x-required-input/></x-jet-label>
                            <x-jet-input type="email" class="flex-1" required name="email"></x-jet-input>
                        </div>
                        <div class="flex justify-center mt-4">
                            <div class="mr-1">
                                <x-jet-label>Contraseña<x-required-input/></x-jet-label>
                                <x-jet-input type="password" class="flex-1" required name="password"></x-jet-input>
                            </div>
                            <div>
                                <x-jet-label>Confirmar Contraseña<x-required-input/></x-jet-label>
                                <x-jet-input type="password" class="flex-1" required name="c_password"></x-jet-input>
                            </div>
                        </div>
                        <div class="flex justify-center mt-6">
                            <x-jet-button>Agregar Colaborador</x-jet-button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>