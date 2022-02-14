<div>
    <x-componant-modal :hidden="$hidden">
        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">Edicion de Usuario</h3>
            <div class="mt-2">
                <p class="text-sm text-gray-500">
                    <form method="POST" action="" autocomplete="off">
                        <div class="flex">
                            <x-componant-input name="name" placeholder="Ingrese su Nombre" label="Nombre"></x-componant-input>
                            <x-componant-input name="lastname" placeholder="Ingrese su Apellido" label="Apellido"></x-componant-input>
                        </div>
                        <div class="flex">
                            <x-componant-input type="email" name="email" placeholder="Ingrese su Correo Electronico" label="Corro"></x-componant-input>
                        </div>
                    </form>
                </p>
            </div>
        </div>
    </x-componant-modal>
</div>