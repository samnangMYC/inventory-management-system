@extends('layout.layout')

@section('content')

<div>
   
    <div class="flex px-4 py-2 justify-between">
        <h1 class="text-3xl font-medium text-gray-700 dark:text-white">All Sale List</h1>
  
    </div>
 
    <section class="flex flex-col">  
        <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
                <div class="overflow-y-auto bg-white max-h-[70vh]">
                <table class="min-w-full sticky top-0 dark:bg-gray-900  ">
                    <thead class="">
                        <tr>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                No
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Customer Name
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Product Name
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Quantity
                            </th>
                            <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Recieved Amount
                            </th>
                            <th class="px-6 text-start py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Total Amount
                            </th>
                            <th class="px-6 text-center py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                To Pay
                            </th>
                            <th class="px-6 text-center py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                discount
                            </th>
                            <th class="px-6 text-center py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                tax
                            </th>
                            <th class="px-6 text-center py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Shipping
                            </th>
                            <th class="px-6 text-center py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Payment Method
                            </th>
                            <th class="px-6 text-center py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                descrtipion
                            </th>
                            <th class="px-6 text-center py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                created at
                            </th>
                            <th class="px-6 text-center py-3 text-xs font-medium leading-4 tracking-wider text text-gray-500 uppercase border-b border-gray-200 bg-gray-50 dark:bg-gray-900 dark:text-white">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @foreach($sales as $sale)
                        <tr>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                               {{$sale->id}}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $customer->where('id', $sale->customer_id)->first()->name }}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                @foreach ($sale->saleItems as $item) 
                                    {{ $item->pro_id }},
                                @endforeach
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                x{{$sale->qty}}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                ${{ number_format($sale->recieved_amount, 2) }}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                               ${{ number_format($sale->total_price,2) }}
                            </td>
                            <td class="px-6 py-2 text-sm text-center leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                @php
                                    $toPay = $sale->recieved_amount - $sale->total_price  ;
                                @endphp
                                
                                @if($toPay == 0)
                                    <span class=" bg-blue-600 px-3 py-1 rounded-lg text-white">Paid</span>
                                @elseif($toPay > 0)
                                <span class="text-green-600 px-3 text-center py-1 rounded-lg">+{{ number_format($toPay,2) }}$</span> 
                                @else 
                                    
                                    <span class="text-red-600 px-3 py-1 rounded-lg ">{{ number_format($toPay,2) }}$</span> 
                                @endif
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $sale->saleInfo->discount ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $sale->saleInfo->tax ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $sale->saleInfo->shipping ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-2 text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{$paymentMethod->where('id', $sale->payment_method_id)->first()->name}}
                            </td>
                            <td class="px-6 py-2  text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                                {{ $sale->saleInfo->description ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-2  text-sm leading-5 text-gray-500 dark:text-white whitespace-no-wrap border-b border-gray-200">
                               {{ $sale->created_at}}
                            </td>
                            <td class="flex px-6 py-2 gap-3 justify-center whitespace-no-wrap  border-gray-200 dark:border-gray-700">
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
            </div>
        </div>
    </section>
</div>
@endsection