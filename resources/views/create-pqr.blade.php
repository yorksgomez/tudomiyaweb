<x-guest-layout>
    <main class="min-w-screen min-h-screen flex justify-center items-center flex-col bg-street">
        <section class="flex justify-center flex-col items-center rounded-md w-full">
            <x-jet-authentication-card-logo class="mb-8"></x-jet-authentication-card-logo>
            <form action="{{ route('create-pqr-post') }}" enctype="multipart/form-data" class="flex-col flex justify-around bg-cover bg-white shadow-md rounded-md px-6 py-4 max-w-md w-full" method="POST">
                @csrf
                <div class="flex justify-center flex-col mb-6">
                    <x-title>¿Tienes alguna petición, queja o reclamo?</x-title>
                    <x-subtitle>Rellena este formulario</x-subtitle>
                </div>
                <div class="flex justify-center flex-col">
                        <x-jet-label>Nombre Completo<x-required-input/></x-jet-label>
                        <x-jet-input type="text" class="" required name="full_name"></x-jet-input>
                </div>
                <div class="flex justify-center flex-col mt-4">
                    <x-jet-label>Correo<x-required-input/></x-jet-label>
                    <x-jet-input type="email" class="flex-1" required name="email"></x-jet-input>
                </div>
                <div class="flex justify-center flex-col mt-4">
                    <x-jet-label>Información sobre su PQR<x-required-input/></x-jet-label>
                    <x-textarea class="flex-1" required name="information"></x-textarea>
                </div>
                <div class="flex justify-center flex-col mt-4">
                    <x-jet-label>Tipo de PQR<x-required-input/></x-jet-label>
                    <div class="flex justify-center">
                        <x-radio name="type" value="PETICIÓN" checked>Petición</x-radio>
                        <x-radio name="type" class="ml-4" value="QUEJA">Queja</x-radio>
                        <x-radio name="type" class="ml-4" value="RECLAMO">Reclamo</x-radio>
                    </div>
                </div>
                <div class="flex justify-center flex-col mt-4">
                    <x-jet-label>Ingrese un adjunto</x-jet-label>
                    <x-jet-input type="file" class="flex-1 shadow-none rounded-none" name="embed"></x-jet-input>
                </div>
                <div class="flex justify-center mt-6">
                    <x-jet-button>Enviar PQR</x-jet-button>
                </div>
            </form>
        </section>
    </main> 
</x-guest-layout>
