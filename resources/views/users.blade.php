@extends('layout.layout')

@section('content')

    <div>
        <div class="flex px-4 py-2 justify-between">
            <h1 class="text-3xl font-medium text-gray-700 dark:text-white">All User</h1>
            @if(!empty($PermissionAdd))
            <button type="button" onclick="window.location='{{ route('users.create') }}'" class="flex items-center gap-2 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M9 4a4 4 0 1 0 0 8 4 4 0 0 0 0-8Zm-2 9a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2v-1a4 4 0 0 0-4-4H7Zm8-1a1 1 0 0 1 1-1h1v-1a1 1 0 1 1 2 0v1h1a1 1 0 1 1 0 2h-1v1a1 1 0 1 1-2 0v-1h-1a1 1 0 0 1-1-1Z" clip-rule="evenodd"/>
                  </svg>
                  
                Add User</button>
            @endif
        </div>
  
        
        <section class="flex flex-col">  
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                    <div class="overflow-y-auto max-h-[70vh]">
                    <table class="min-w-full bg-white ">
                        <thead class="sticky top-0">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                    No
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                    UserName
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                    CreateAt
                                </th>
                                <th class="px-6 text-center py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="dark:bg-gray-900 ">
                            <tr>
                                @foreach($users as $user)
                                <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                 {{ $user->id }}
                                </td>
    
                                <td class="px-6 font-bold py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                    {{ $user->name }}
                                </td>
                                <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                    {{ $user->email }}
                                </td>
                                <td class="px-6 font-bold py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                    {{ $roles->where('id', $user->role_id)->first()->name }}
                                </td>
                                <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                    @if($user->status == '1')
                                        <span class="text-green-500">Active</span>
                                    @else
                                        <span class="text-red-500 ">Inactive</span>
                                    @endif
                                </td>
                                <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                    {{ $user->created_at->diffForHumans() }}
                                </td>
                            
                               
             
                                <td class="px-6 flex py-2 justify-center items-center whitespace-no-wrap border-b border-gray-200">
                                    <form action="{{route('users.destroy',$user->id) }}"  method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        @if(!empty($PermissionDelete))
                                        <button type="submit" onclick="return confirm('Are you sure you want to delete this category?');" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm p-3 text-center me-2 mb-2">
                                            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                              </svg>                       
                                        </button>
                                        @endif
                                    </form>
                                    @if(!empty($PermissionEdit))
                                    <button type="button"  onclick="window.location='{{ route('users.edit', $user->id) }}'"class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm p-3 text-center me-2 mb-2">
                                        <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                        </svg>
                                    </button>
                                    @endif
                                    <button type="button" class="text-white bg-blue-600  hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm p-3 text-center me-2 mb-2">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-width="2" d="M21 12c0 1.2-4.03 6-9 6s-9-4.8-9-6c0-1.2 4.03-6 9-6s9 4.8 9 6Z"/>
                                            <path stroke="currentColor" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                        </svg>  
                                    </button>
                                </td>       
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </section>
    </div>
    
@endsection