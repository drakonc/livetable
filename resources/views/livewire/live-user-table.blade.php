<div class="flex flex-col">
  <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
      <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
          <div class="flex text-gray-500">
            <button type="button" wire:click="showModal()" class="mr-4 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
              <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="transform transition-transform duration-500 ease-in-out text-blue-600">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path>
              </svg>
            </button>
            <select class="rounded" wire:model="perPage">
              <option value="5">5</option>
              <option value="10">10</option>
              <option value="15">15</option>
              <option value="20">20</option>
            </select>
            <input type="text" class="form-input w-full ml-6 rounded mr-5" wire:model='buscar'
              placeholder="Ingrese el termino de Busqueda..." />
            <select class="rounded" wire:model="user_role">
              <option value="">Seleccione...</option>
              <option value="admin">Administrador</option>
              <option value="seller">Vendedor</option>
              <option value="client">Cliente</option>
            </select>
            <button wire:click="clear" class="ml-6"><span class="fas fa-eraser"></span></button>
          </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200">
          <thead class="bg-gray-50">
            <tr>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Id
                <button wire:click="sortable('id')">
                  <span class="fas fa-{{ $camp == 'id' ? $icon:'circle' }}"></span>
                </button>
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Imagen
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Nombre
                <button wire:click="sortable('name')">
                  <span class="fas fa-{{ $camp == 'name' ? $icon:'circle' }}"></span>
                </button>
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Apellido
                <button wire:click="sortable('lastname')">
                  <span class="fas fa-{{ $camp == 'lastname' ? $icon:'circle' }}"></span>
                </button>
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Email
                <button wire:click="sortable('email')">
                  <span class="fas fa-{{ $camp == 'email' ? $icon:'circle' }}"></span>
                </button>
              </th>
              <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Role
              </th>
              <th scope="col" class="relative px-6 py-3"><span class="sr-only">Acciones</span></th>
            </tr>
          </thead>
          <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($users as $user)
            <tr>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900">{{$user->id}}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm font-medium text-gray-900 w-10 h-10">
                  <img class="rounded-full" src="{{asset('storage/'.$user->image_user)}}" alt="{{$user->name}}"/>
                </div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{$user->name}}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{$user->r_lastname->lastname}}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap">
                <div class="text-sm text-gray-900">{{$user->email}}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <div class="text-sm text-gray-900">{{$user->rol}}</div>
              </td>
              <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                <a href="javascript:void(0);" class="text-indigo-600 hover:text-indigo-900" wire:click="showModal({{$user->id}})">Edit</a>
                <a href="javascript:void(0);" class="text-red-600 hover:text-red-900" onClick="emitir({{$user->id}})" id="borrar">Delete</a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
          {{$users->links()}}
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
    <script>
      function emitir(id) {
        let eliminar = confirm("¿Desea Eliminar el Usuario?");
        if(eliminar){
            Livewire.emit('deleteUser',id)
        }
      }

      Livewire.on('deleteUserConfirm',(user) => {
        alert(`El usuario ${user.name} se borro Correctamente`)
      });
    </script>
  @endpush
</div>