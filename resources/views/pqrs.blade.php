<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('PQRS') }}
        </h2>
    </x-slot>
    <div class="py-12" 
        x-data="{
            
        }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg py-8 px-12">  
                <section class="flex flex-col justify-center items-center mb-12">
                    <x-section-title class="mb-4">PQRs en Espera</x-section-title>
                    <table class="w-full">
                        <x-table-head :titles="['Nombre','Correo','Información','Tipo', 'Adjunto','Acciones']"></x-table-head>
                        @foreach ($pqrs as $pqr)
                            @if ($pqr->state == 'WAITING')
                                <tr class="text-center">
                                    <td>{{ $pqr->full_name }}</td>
                                    <td>{{ $pqr->email }}</td>
                                    <td>{{ $pqr->information }}</td>
                                    <td>{{ $pqr->type }}</td>
                                    <td><x-link class="fa-regular fa-file" href="show-embed/{{ $pqr->id }}" aria-disabled="{{ $pqr->embed ?? 'true' }}" target="_blank"></x-link></td>
                                    <td><x-link class="fa-solid fa-envelope-circle-check" x-on:click="$dispatch('open', {id: 'ModalSendPqrAnswer', pqr: {{ $pqr->id }}})"></x-link></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </section>
                <section class="flex flex-col justify-center items-center mb-12">
                    <x-section-title class="mb-4">PQRs Procesadas</x-section-title>
                    <table class="w-full">
                        <x-table-head :titles="['Nombre','Correo','Información','Tipo', 'Adjunto']"></x-table-head>
                        @foreach ($pqrs as $pqr)
                            @if ($pqr->state == 'PROCESSED')
                                <tr class="text-center">
                                    <td>{{ $pqr->full_name }}</td>
                                    <td>{{ $pqr->email }}</td>
                                    <td>{{ $pqr->information }}</td>
                                    <td>{{ $pqr->type }}</td>
                                    <td><x-link class="fa-regular fa-file"></x-link></td>
                                </tr>
                            @endif
                        @endforeach
                    </table>
                </section>
            </div>
        </div>
        <x-modal id="ModalSendPqrAnswer">
            <x-slot:title>
                Responder petición
            </x-slot:title>
                <div class="flex-1 flex-col flex">
                    <x-subtitle class="mb-2">Escriba la respuesta que quiere enviar a este Pqr</x-subtitle>
                    <x-textarea class="w-full"></x-textarea>
                </div>
            <x-slot:footer>
                <div class="flex flex-1 justify-between px-6">
                    <x-accept-button type="button" value="Enviar Respuesta" class="bg-primary text-white px-4 py-2" x-on:click="window.location = 'process-pqr/' + params.pqr" />
                    <x-reject-button type="button" value="Cancelar" class="bg-primary text-white px-4 py-2" x-on:click="$dispatch('close', {id:'ModalSendPqrAnswer'})" />
                </div>
            </x-slot:footer>
        </x-modal>
    </div>
</x-app-layout>