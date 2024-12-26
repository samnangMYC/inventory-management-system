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
    <section class="p-2 rounded-t-md  dark:bg-gray-900">
        <form class="max-w-md mx-auto">   
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                </div>
                <input type="search" id="default-search" class="block w-full pl-5 pr-3 py-3 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search Mockups, Logos..." required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Search</button>
            </div>
        </form>
 
    </section>
    
    <section class="flex flex-col">  
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 dark:border-gray-700 shadow rounded-b-lg ">
                <div class="overflow-y-auto max-h-[70vh]">
                <table class="min-w-full sticky top-0 bg-white dark:bg-gray-900 "> 
                    <thead class="sticky top-0 ">
                        <tr class="">
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                Product Code
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                Product Image
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                Product Name
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                               Specification
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                Weight(g)
                             </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                $Price
                            </th>
                    
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                Category
                            </th>

                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                Stock
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                Brand
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                               Create At
                            </th>
                            <th class="text-center px-6 py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 dark:text-white uppercase border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class=" dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($products as $product)
                        <tr class="">
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                {{ $product->code }}
                            </td>
        
                            <td class="px-6 py-2 whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 w-20 ">
                                        <img class="h-16 rounded-md object-cover"  src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}">
                                    </div>
                                </div>
                            </td>
                    
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                {{ $product->productInfo->specification ?? 'No specification' }}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                {{ $product->productInfo->weight ?? '0' }}
                            </td>
                            
                    
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                @if (isset($product_prices[$product->id]) && $product_prices[$product->id] !== null)
                                    {{ $product_prices[$product->id]->price }} <!-- Accessing the price property -->
                                @else
                                    <p class="text-red-600 dark:text-red-400">0</p>
                                @endif
                            </td>

                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                {{ $product->subCategory->name ?? 'Not available' }}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                                @if($product->stock > 0)
                                    {{ $product->stock }}
                                @else
                                <button type="button" class="text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-[8px] w-24 h-8 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Out Of Stock</button>
                                @endif
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                               
                                {{ $brandName->where('id', $product->brand_id)->first()->name  ?? 'No brand' }}
                               
                            </td>  
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200 dark:border-gray-700">
                               {{ $product->created_at->diffForHumans() }}
                            </td>
                            
                            <td class="flex px-6 py-2 gap-3 justify-center whitespace-no-wrap  border-gray-200 dark:border-gray-700">
                                <form action="{{route('product.destroy',$product->id)}}" method="POST" class="">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure you want to delete this product?');" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm p-3 text-center me-2 mb-2">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                                        </svg>             
                                    </button>
                                </form>
                                <button type="button" onclick="window.location='{{ route('product.edit', $product->id) }}'" class="text-white bg-gradient-to-r from-purple-500 via-purple-600 to-purple-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-purple-300 dark:focus:ring-purple-800 font-medium rounded-lg text-sm p-3 text-center me-2 mb-2">
                                    <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                                    </svg>
                                </button>
                                <button type="button" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 shadow-lg shadow-blue-500/50 dark:shadow-lg dark:shadow-blue-800/80 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2 ">
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
            <div class=" dark:bg-gray-900 px-4 py-3 border-t flex justify-center border-gray-200 dark:border-gray-700">  
                <nav aria-label="Page navigation example ">
                    <ul class="inline-flex -space-x-px text-sm ">
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">1</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">2</a>
                    </li>
                    <li>
                        <a href="#" aria-current="page" class="flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white">3</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">4</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">5</a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                    </li>
                    </ul>
                </nav>
            </div>
            </div>
        </div>
        
    </section>
</div>
@endsection