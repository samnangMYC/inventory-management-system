@extends('layout.layout')

@section('content')

<div class="">

    <div class="flex px-4 py-2 justify-between">
        <h1 class="text-3xl font-medium text-gray-700 dark:text-white">Edit Form</h1>
    </div>
   @include('components/alert')
    
    <section class="flex flex-col dark:bg-gray-900 rounded-lg">  
        <div class="py-2 overflow-y-auto h-[80vh] sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="px-4 inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
               
                <form action="{{route('role.update',$getRecord->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class=" py-4 space-y-4 ">
                        
                        <div class="container">
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                            <input value="{{ $getRecord->name }}" type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required />
                        </div>

                     <div class="container mt-5">
                    <h1 class="text-lg  dark:text-white">Permissions</h1>
                    <table class="table table-bordered ">
                        <thead class=" dark:text-white">
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                    
                            </tr>
                        </thead>
                        <tbody class="dark:text-white">
                        
                            @foreach($getPermission as $permission)         
                                <tr>
                                    <td class=" text-black dark:text-white">{{ $permission['name'] }}</td>
                                    <td>
                                        <ul class="text-white">
                                            @foreach($permission['group'] as $group)
                                                @php
                                                $checked = '';
                                                @endphp
                                                @foreach($getRolePermission as $role)
                                                    @if($role->permission_id == $group['id'])
                                                        @php
                                                        $checked = 'checked';
                                                        @endphp
                                                    @endif
                                                @endforeach
                                                <li class="flex gap-2 text-black dark:text-white">
                                                    <label>
                                                        <input type="checkbox" {{$checked}} value="{{ $group['id'] }}" name="permission_id[]">
                                                        {{ $group['name'] }}
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                </tr>  
                        </tbody>
                        @endforeach
                    </table>

                </div>
                      </div>
                        <div class="py-6 text-end">
                            <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 ">Reset</button>
                            <button type="submit" class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">Submit</button>
                        </div> 
                </div>

                </form>
            </div>
        </div>
    </section>
</div>
@endsection