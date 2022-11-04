<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Domiciliarios') }}
        </h2>
    </x-slot>
    <div class="py-12" x-data="{
        popupAccept(event) {
            let answer = confirm('¿Está seguro de que desea aprovar esta solicitud?');

            if(!answer)
                event.preventDefault();

        },
        popupReject(event) {
            let answer = confirm('¿Está seguro de que desea rechazar esta solicitud?');

            if(!answer)
                event.preventDefault();
        }
    }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-8 px-12">  
                <section class="mb-12">
                    <x-section-title class="mb-4">Domiciliarios Activos</x-section-title>
                    <table class="w-full">
                        <x-table-head :titles="['Nombre','Apellido','Correo','Teléfono','Cédula']"></x-table-head>
                        @foreach ($domis as $domi)
                            <tr class="text-center">
                                <td>{{ $domi->name }}</td>
                                <td>{{ $domi->lastname }}</td>
                                <td>{{ $domi->email }}</td>
                                <td>{{ $domi->phone }}</td>
                                <td>{{ $domi->nit }}</td>
                            </tr>
                        @endforeach
                    </table>
                </section>
                <section class="flex flex-col justify-center items-center mb-12">
                    <x-section-title class="mb-4">Solicitudes en espera</x-section-title>
                    <table class="w-full">
                        <x-table-head :titles="['Nombre','Apellido','Correo','Teléfono','Cédula', 'Hoja de vida','Acciones']"></x-table-head>
                        @foreach ($applications as $application)
                            @if ($application->state == 'WAITING')
                                <tr class="text-center">
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->lastname }}</td>
                                    <td>{{ $application->email }}</td>
                                    <td>{{ $application->phone }}</td>
                                    <td>{{ $application->nit }}</td>
                                    <td><a class="fa-regular fa-file text-primary cursor-pointer" href="show-curriculum/{{ $application->id }}" target="_blank"></a></td>
                                    <td>
                                        <a class="fa-regular fa-thumbs-up text-primary cursor-pointer mr-2" x-on:click="popupAccept" href="accept-application/{{ $application->id }}"></a>
                                        <a class="fa-regular fa-thumbs-down text-secondary cursor-pointer" x-on:click="popupReject" href="reject-application/{{ $application->id }}"></a>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </section>
                <section class="flex flex-col justify-center items-center mb-12">
                    <x-section-title class="mb-4">Solicitudes aprovadas</x-section-title>
                    <table class="w-full">
                        <x-table-head :titles="['Nombre','Apellido','Correo','Teléfono','Cédula', 'Hoja de vida']"></x-table-head>
                        @foreach ($applications as $application)
                            @if ($application->state == 'APPROVED')
                                <tr class="text-center">
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->lastname }}</td>
                                    <td>{{ $application->email }}</td>
                                    <td>{{ $application->phone }}</td>
                                    <td>{{ $application->nit }}</td>
                                    <td><a class="fa-regular fa-file text-primary cursor-pointer" href="show-curriculum/{{ $application->id }}" target="_blank"></a></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </section>
                <section class="flex flex-col justify-center items-center">
                    <x-section-title class="mb-4">Solicitudes rechazadas</x-section-title>
                    <table class="w-full">
                        <x-table-head :titles="['Nombre','Apellido','Correo','Teléfono','Cédula', 'Hoja de vida']"></x-table-head>
                        @foreach ($applications as $application)
                            @if ($application->state == 'REJECTED')
                                <tr class="text-center">
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->lastname }}</td>
                                    <td>{{ $application->email }}</td>
                                    <td>{{ $application->phone }}</td>
                                    <td>{{ $application->nit }}</td>
                                    <td><a class="fa-regular fa-file text-primary cursor-pointer" href="show-curriculum/{{ $application->id }}" target="_blank"></a></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </section>
            </div>
        </div>
    </div>
</x-app-layout>