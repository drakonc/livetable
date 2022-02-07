<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
        <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
          <div class="bg-white px-4 py-3 items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex text-gray-500">
              <select class="rounded" wire:model="perPage">
                <option value="5">5</option>
                <option value="10">10</option>
                <option value="15">15</option>
                <option value="20">20</option>
              </select>
              <input type="text" class="form-input w-full ml-6 rounded" wire:model='buscar' placeholder="Ingrese el termino de Busqueda..."/>
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
                  Name
                  <button wire:click="sortable('name')">
                    <span class="fas fa-{{ $camp == 'name' ? $icon:'circle' }}"></span>
                  </button>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                  Email
                  <button wire:click="sortable('email')">
                    <span class="fas fa-{{ $camp == 'email' ? $icon:'circle' }}"></span>
                  </button>
                </th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                <th scope="col" class="relative px-6 py-3"><span class="sr-only">Edit</span></th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
              @foreach ($users as $user)
                <tr>
                  <td class="px-6 py-4 whitespace-nowrap">
                     <div class="text-sm font-medium text-gray-900">{{$user->id}}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{$user->name}}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap">
                    <div class="text-sm text-gray-900">{{$user->email}}</div>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">Admin</span>
                  </td>
                  <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <a href="#" class="text-indigo-600 hover:text-indigo-900">Edit</a>
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
  </div>
