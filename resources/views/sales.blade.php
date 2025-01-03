@extends('layout.layout')

@section('content')

<div class="dark:text-white py-4  -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8 rounded-lg">
    
    @include('components/alert')
    @include('components/error-alert')
    <!--Product and Cash -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 h-screen dark:text-gray-800 rounded-lg">
        
        <!-- List of Product  -->
        <div class="col-span-3 bg-gray-100  overflow-y-scroll h-[80vh] xl:h-screen dark:bg-gray-900 p-12 rounded-lg">
            <!-- Product List Header -->
            <div class="flex sticky ">
                <!-- Search Product -->
                <div class="flex px-4 py-3 mb-12 rounded-md border-2 border-blue-500 overflow-hidden max-w-md mx-auto font-[sans-serif]">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 192.904 192.904" width="16px" class="fill-gray-600 mr-3 rotate-90">
                        <path d="m190.707 180.101-47.078-47.077c11.702-14.072 18.752-32.142 18.752-51.831C162.381 36.423 125.959 0 81.191 0 36.422 0 0 36.423 0 81.193c0 44.767 36.422 81.187 81.191 81.187 19.688 0 37.759-7.049 51.831-18.751l47.079 47.078a7.474 7.474 0 0 0 5.303 2.197 7.498 7.498 0 0 0 5.303-12.803zM15 81.193C15 44.694 44.693 15 81.191 15c36.497 0 66.189 29.694 66.189 66.193 0 36.496-29.692 66.187-66.189 66.187C44.693 147.38 15 117.689 15 81.193z"></path>
                    </svg>
                    <input type="email" placeholder="Search Something..." class="w-full outline-none bg-transparent text-gray-600 text-sm" />
                </div>

                <form class="max-w-sm mx-auto" method="POST" action="{{ route('sale.index') }}">
                    @csrf
                    <select id="filter" name="subcategory_id" class="block w-full px-4 py-3 text-base text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected>Select Category *</option>
                        @foreach($subCategories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </form>
            </div>

            <!-- List Product -->
            <div class="grid grid-cols-2 lg:grid-cols-3  xl:grid-cols-4 gap-12  ">
                <!-- This div takes up the full height of the parent div -->
                @foreach($products as $product)
                <form action="{{ route('cart.add') }}" method="POST" class="col-span-1">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <input type="hidden" name="name" value="{{ $product->name }}">
                    <input type="hidden" name="discount" value="{{ $product->productInfo->discount ?? 0 }}">
                    <input type="hidden" name="price" value="{{$product->prices->first()->price ?? 0 }}">
                    <input type="hidden" name="tax" value="{{$product->productInfo->tax ?? 0 }}">
                    <input type="hidden" name="stock" value="{{$product->stock }}">
                    <div class="col-span-1 relative border bg-white dark:bg-black  h-80 rounded-xl shadow p-3 space-y-3">
                        <div class="mt-12  ">
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="h-32 place-self-center rounded-lg">
                            <h1 class="text-lg text-center line-clamp-2 mt-3">{{ $product->name }}</h1>
                            <p class="text-center opacity-75 uppercase">{{ $product->subCategory->name }}</p>

                            @if($product->prices->isNotEmpty())
                            <p class="text-lg font-bold absolute top-4 bg-blue-500 px-2 rounded-sm text-white">
                                $ {{ number_format($product->prices->first()->price, 2) }}
                            </p>
                            @endif

                            <p class="text-lg font-bold absolute top-4 right-2 text-white">
                                @if ($product->stock > 0)
                                <span  class="bg-green-500 px-2 py-0.5 rounded-lg"><span>{{$product->stock}}</span> Pieces</span>
                                @else
                                    <span class="bg-red-600 px-2 py-0.5 rounded-lg">Out of Stock</span>
                                @endif
                            </p>
                            <button type="submit" class="text-base flex items-center gap-3 font-bold absolute bottom-4 left-0 bg-blue-500 px-2 py-2.5 rounded-e-full hover:bg-green-400 text-white">
                                <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4h1.5L8 16m0 0h8m-8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm8 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm.75-3H7.5M11 7H6.312M17 4v6m-3-3h6" />
                                </svg>
                                Add to Cart
                            </button>
                            <p class="text-lg font-bold absolute bottom-0 right-0 bg-red-500 p-2 rounded-s-full text-white">

                                {{$product->productInfo->discount ?? 0}}%
                            </p>
                        </div>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
        <div class="col-span-1 bg-whiteoverflow-y-scroll h-[80vh] bg-white  md:h-full">
            <!-- Product In Card -->
            <div class="flex flex-col h-full  dark:bg-gray-900  ">
                <table class="min-w-full mb-64 sticky top-0 dark:bg-gray-900">
                    <thead class="">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Product Name
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium leading-4 tracking-wider text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                QTY
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Subtotal
                            </th>
                        </tr>
                    </thead>
                    <tbody class="">
                      @if(session('cart'))
                        @foreach(session('cart') as $productId => $item)
                        <tr>
                            <td class="px-6 py-3 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                <span class="line-clamp-2"> {{ $item['name'] }}</span>
                            </td>

                            <td class="px-6 text-center font-bold py-3 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                <form action="{{ route('cart.update', $productId) }}" method="POST" class="flex gap-2">
                                    @csrf
                                    @method('PUT') <!-- Use PATCH for updating -->

                                    <!-- Decrease Quantity Button -->
                                    <button type="submit" name="action" value="decrease" class="border flex justify-center items-center w-10 h-10 bg-red-700 hover:bg-slate-400 rounded-full">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14" />
                                        </svg>
                                    </button>

                                    <span class="p-2">{{ $item['quantity'] }}</span>

                                    <!-- Increase Quantity Button -->
                                    <button type="submit" name="action" value="increase" class="border flex justify-center items-center w-10 h-10 bg-blue-700 hover:bg-slate-400 rounded-full">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-3 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                <div class="flex gap-4 items-center">
                                    ${{ number_format($item['price'], 2) }}
                                    <form action="{{ route('cart.destroy', $productId)}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <svg class="w-6 h-6 text-end text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                      @else
                        <tr>
                            <td colspan="3" class="px-6 py-3 text-sm leading-5 text-gray-500 dark:text-white text-center border-b border-gray-200">
                                Your cart is empty.
                            </td>
                        </tr>
                      @endif
                        
                    </tbody>
                </table>

                <!--Total Cash section -->
            <form action="{{route('sale.store')}}" method="POST">
                @csrf
              
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 p-2 dark:bg-gray-900">
                    <div class="col-span-1 p-4 flex flex-col items-center justify-center space-y-3 w-full">
                          <div class="w-full">
                            <label for="category" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Payment Method *</label>
                           
                            <select id="category" name="payment" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($payments as $payment)
                                <option value="{{$payment->id}}" >{{ $payment->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full">
                            <label for="customer" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Customer *</label>
                            <select id="customer" name="customer_name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="w-full">
                            <label for="shipping" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Shipping Amount *</label>
                            <input type="text" id="shipping" name="shipping" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="2.3 $" />
                        </div>
                 
                        <div id="message" class="mt-4"></div>
                        
                    </div>
                    <div class="p-4 flex flex-col mt-20 justify-start dark:text-white">
                        <h1 class="text-lg lg:text-xl opacity-75">Total QTY: {{ $totalQty}}</h1>
                        <h1 class="text-lg lg:text-xl font-bold">Total : {{ $totalPrice}} $</h1>
                    
                    </div>
                </div>
                <!-- Submit Button -->
                <div class="flex justify-center">
                    <button type="button" class="text-white flex items-center gap-2 bg-gradient-to-br from-pink-500 to-orange-400 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-pink-200 dark:focus:ring-pink-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 9H8a5 5 0 0 0 0 10h9m4-10-4-4m4 4-4 4" />
                        </svg>
                        Reset
                    </button>
               
                    <button  data-modal-target="crud-modal" data-modal-toggle="crud-modal" type="button" class="text-white flex items-center gap-2 bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 17.345a4.76 4.76 0 0 0 2.558 1.618c2.274.589 4.512-.446 4.999-2.31.487-1.866-1.273-3.9-3.546-4.49-2.273-.59-4.034-2.623-3.547-4.488.486-1.865 2.724-2.899 4.998-2.31.982.236 1.87.793 2.538 1.592m-3.879 12.171V21m0-18v2.2" />
                        </svg>
                        Pay Now
                    </button>
                    
                <!-- Main modal -->
                <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden animate flip-up bg-slate-200 bg-opacity-50 overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 max-h-full  ">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow ">
                            <!-- Modal header -->
                            <div class="flex items-center dark:bg-gray-900 dark:text-white justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Ready to create new sale!!
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="flex flex-col gap-4 p-5 dark:bg-gray-900 dark:text-white">
                                    <div class="relative   overflow-x-auto shadow-md sm:rounded-lg">
                                        <table class="w-full text-sm text-left  rtl:text-right text-gray-500 dark:text-gray-400">
                                            <thead class="text-xs text-gray-700 uppercase   dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Product name
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        QTY
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Sub Price
                                                    </th>
                    
                                                    <th scope="col" class="px-6 py-3">
                                                        Total Sub Price
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Discount
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Tax
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Shipping
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(session('cart'))
                                                @foreach(session('cart') as $productId => $item)
                                                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                       {{ $item['name'] }}
                                                    </th>
                                                    <td class="px-6 py-4">
                                                       x{{ $item['quantity'] }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item['price'] }}$
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ number_format($item['quantity'] * $item['price'],2) }}$
                                                       
                                                    </td>
        
                                                    <td class="px-6 py-4">
                                                        {{ $item['discount'] }}%
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $item['tax'] ?? 0}}%
                                                    </td>
                                                    <td class="px-6 py-4">
                                                       0
                                                    </td>
                                                </tr>
                                             
                                                @endforeach
                                                @else
                                                <tr>
                                                    <td colspan="7" class="px-6 py-3 text-sm leading-5 text-gray-500 dark:text-white text-center border-b border-gray-200">
                                                        Your cart is empty.
                                                    </td>
                                                </tr>
                                                @endif
                                                <tr class="font-bold border-b text-blue-500 dark:border-gray-700">
                                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                       Total: <span class="text-blue-500 font-bold text-lg text-center"> {{ $finalPrice }}$</span>
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        x{{ $totalQty }}
                                                     </td>
                                                     <td class="px-6 py-4">
                                                        0
                                                     </td>
                                        
                                                    <td class="px-6 py-4">
                                                        {{ $totalPrice }}$
                                                     </td>
                                                    <td class="px-6 py-4">
                                                        {{ $totalDiscount }}$
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $totalTax  }}$
                                                    </td>
                                                    <td class="px-6 py-4">
                                                       {{ $totalShipping}}$
                                                    </td>
                                                </tr>
                                            </tbody>
                                            
                                        </table>
                                    </div>
                                
                                <div class="w-full mt-8 mb-4">
                                    <label for="recieved_amount" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Recieved Amount *</label>
                                    <input type="text" id="recieved_amount" name="recieved_amount" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="2.3 $" required />
                                </div>
                                <div class="w-full">
                                        <label for="description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sale Note</label>
                                        <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write sale description here"></textarea>                    
                                    </div>
        
                                <div class="mt-8 flex gap-4 items-center ">
                                    @if(!empty($PermissionAdd))
                                    <button type="submit" class="text-white flex gap-2 items-center bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-3 py-2.5 text-center me-2 mb-2">
                                        <svg class="w-6 h-6 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="2" d="M16.444 18H19a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h2.556M17 11V5a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v6h10ZM7 15h10v4a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1v-4Z"/>
                                          </svg>
                                          
                                       Create & Print</button>
                                    @endif
                                    
                        </div>
                    </div>
                    </div>
                </div> 
                </form>
                </div>
            </div>
        </div>
    </div>
<script>
         $(document).ready(function() {
            $('#subcategory_id').change(function() {
                var subcategoryId = $(this).val();

                if (subcategoryId) {
                    $.ajax({
                        url: '/sale' + subcategoryId, // Adjust the URL as needed
                        type: 'GET',
                        success: function(data) {
                            $('#related-data').html(data); // Update the related data section
                        },
                        error: function(xhr) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    $('#related-data').empty(); // Clear the related data if no subcategory is selected
                }
            });
        });
  
</script>
</div>

@endsection
