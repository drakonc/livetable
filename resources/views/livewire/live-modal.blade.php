<div>
    <form wire:submit.prevent="{{$method}}" autocomplete="off">
        <x-component-modal :hidden="$hidden" :action="$action">
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">{{$title}}</h3>
                <div class="mt-2">
                    <p class="text-sm text-gray-500">
                        <div class="flex">
                            <x-component-input name="name" placeholder="Ingrese su Nombre" label="Nombre"></x-component-input>
                            <x-component-input name="lastname" placeholder="Ingrese su Apellido" label="Apellido"></x-component-input>
                        </div>
                        <div class="flex">
                            <x-component-input type="email" name="email" placeholder="Ingrese su Correo Electronico" label="Corro"></x-component-input>
                            <x-component-input-select name="role" label="Seleccione un Rol" :options="$options"></x-component-input-select>
                        </div>
                    </p>
                </div>
            </div>
        </x-component-modal>
    </form>
</div>