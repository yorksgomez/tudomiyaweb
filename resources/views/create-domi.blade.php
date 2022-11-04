<x-guest-layout>
    <main class="min-w-screen min-h-screen flex justify-center items-center flex-col bg-street">
        <section class="flex justify-center flex-col items-center rounded-md w-full">
            <x-jet-authentication-card-logo class="mb-8"></x-jet-authentication-card-logo>
            <form action="{{ route('create-application') }}" enctype="multipart/form-data" class="flex-col flex justify-around bg-cover bg-white shadow-md rounded-md px-6 py-4 max-w-md w-full" method="POST">
                @csrf
                <div class="flex justify-center flex-col mb-6">
                    <x-title>¿Quieres trabajar con nosotros?</x-title>
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
                <div class="flex justify-center flex-col mt-4">
                    <x-jet-label>Adjunte su hoja de vida<x-required-input/></x-jet-label>
                    <x-jet-input type="file" class="flex-1 shadow-none rounded-none" required name="curriculum"></x-jet-input>
                </div>
                <div class="flex justify-center mt-6">
                    <x-jet-button>Enviar Formulario</x-jet-button>
                </div>
            </form>
        </section>
    </main> 
</x-guest-layout>