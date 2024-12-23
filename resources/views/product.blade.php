@extends('layout.layout')

@section('content')

<div>
    <div class="flex px-4 py-2 justify-between">
        <h1 class="text-3xl font-medium text-gray-700 dark:text-white">All Product</h1>

        <button type="button" onclick="window.location='{{ route('product.create') }}'" class="text-white flex items-center gap-2 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-3 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
              </svg>                 
             Add Product</button>
    </div>
    
    <section class="flex flex-col">  
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <table class="min-w-full ">
                    <thead class="">
                        <tr class="">
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                Product Image
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                Product Name
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                $Price
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                Product Code
                            </th>
                    
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                Category
                            </th>

                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                Stock
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                Brand
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                description
                            </th>
                            <th class="text-center px-6 py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 dark:text-white uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class=" bg-white  ">
                        <tr class="dark:bg-gray-900 ">
                            @foreach($products as $product)
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $product->id }}
                            </td>
        
                            <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-20 h-20  ">
                                        <img class="w-20 h-20 rounded-md object-cover" src="assets/images/iphone-15-Pro-Max.jpg" alt="iPhone 15 Pro Max">
                                    </div>
                                </div>
                            </td>
                    
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $product->name }}
                            </td>
                            
                    
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                433.34
                            </td>
                            
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $product->code }}
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                Phone
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                100
                            </td>
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $product->brand_id }}
                            </td>  
                            <td class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $product->descriptions }}
                            </td>
                            
                            <td class="flex px-6 py-5 gap-3 text-center whitespace-no-wrap border-b border-gray-200">
                                <form  method="POST" class="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this category?');" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm p-3 text-center me-2 mb-2">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg>             
                                    </button>
                                </form>
                                <button type="button"  class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm p-3 text-center me-2 mb-2">
                                    <svg class="w-6 h-6 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                  </svg>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>
@endsection