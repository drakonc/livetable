<div class="m-2">
    <div>
        <label for="{{$name}}" class="block text-sm font-medium text-gray-700">{{$label}}</label>
        <div class="mt-1 relative rounded-md shadow-sm">
            <select class="form-input focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded" wire:model="{{$name}}">
                <option value="">Seleccione uns Opción ...</option>
                @foreach ($options as $key => $option)
                    <option value="{{$key}}">{{$option}}</option>
                @endforeach
            </select>
        </div>
        @if ($errors->has($name))
            <small class="text-red-600">{{$errors->first($name)}}</small>
        @endif
    </div>
</div>
