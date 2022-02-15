<div class="m-2">
    <label for="{{$name}}" class="block text-sm font-medium text-gray-700">{{$label}}</label>
    <select class="form-input focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded" wire:model="{{$name}}">
        <option value="">Seleccione uns Opción ...</option>
        @foreach ($options as $key => $option)
            <option value="{{$key}}">{{$option}}</option>
        @endforeach
      </select>
</div>
