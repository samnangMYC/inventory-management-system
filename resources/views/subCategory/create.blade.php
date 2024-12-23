@extends('layout.layout')

@section('content')

<div class="">

    <div class="flex px-4 py-8 justify-between">
        <h1 class="text-3xl font-medium text-gray-700">Add Sub Categories Form</h1>
    </div>
    
           <!-- Display success message -->
        @if (session('success'))
           <div class="bg-green-500 text-white p-4 rounded mb-4">
               {{ session('success') }}
           </div>
         @endif
  
          <!-- Display validation errors -->
          @if ($errors->any())
              <div class="bg-red-500 text-white p-4 rounded mb-4">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                      @endforeach
                  </ul>
              </div>
    @endif

    <section class="flex flex-col dark:bg-gray-900 rounded-lg">  
        <div class="py-2  overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
            <div class="px-4 inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
               
                <form action="{{route('sub-category.store')}}" method="POST">
                    @csrf
                    @method('POST')
                    <div class=" py-4 space-y-4">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sub Category Name *</label>
                            <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Electronic" required />
                        </div>
                     <!--Type of Category  -->
                      <div class="relative w-full inline-block text-left" name="role">
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Role *</label>
                        <div>
                            <button id="dropdownButton" data-dropdown-toggle="dropdownMenu" class="flex items-center justify-between w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-100 focus:ring-indigo-500" type="button">
                                Choose Category *
                                <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5H7z" />
                                </svg>
                            </button>
                        </div>
                
                        <!-- Dropdown menu -->
                        <div id="dropdownMenu" class="hidden absolute z-10 w-full bg-white rounded-md shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButton">
                            <div class="py-1" role="none">
                                @foreach($categories as $category)
                                <a href="#" data-value="{{ $category->id }}" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100" role="menuitem"> {{$category->name}}</a>
                                @endforeach
                            </div>
                           
                        </div>
                        
                        <!-- Hidden input to store the category ID -->
                        <input type="hidden" id="role_id" name="cat_id">
                    </div>
                     <!--End Type of Category  -->

                      <div class="mb-6">
                        <label for="des-input" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <input type="text" name="descriptions" id="description" placeholder="lorem" class="block w-full py-4 px-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-base focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
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
        <!-- Dropdown Button JS -->
    <script >
        $(document).ready(function() {
        // Toggle dropdown visibility on button click
        $('#dropdownButton').on('click', function() {
            $('#dropdownMenu').toggleClass('hidden');
        });

        // Close the dropdown if clicking outside of it
        $(document).on('click', function(event) {
            if (!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownMenu').length) {
                $('#dropdownMenu').addClass('hidden');
            }
        });

        // Update button text and hidden input value when a dropdown item is clicked
        $('#dropdownMenu a').on('click', function(event) {
            event.preventDefault(); // Prevent the default anchor click behavior
            const selectedValue = $(this).data('value'); // Get the value from data attribute
            const selectedText = $(this).text(); // Get the text of the selected role

            // Update the button text and hidden input value
            $('#dropdownButton').text(selectedText); // Update the button text
            $('#role_id').val(selectedValue); // Set the value of the hidden input to the role ID
            console.log(selectedText); // Log the selected value (role ID)
            console.log('Hidden Input Value:', $('#role').val()); // Log the value of the hidden input
            $('#dropdownMenu').addClass('hidden'); // Hide the dropdown menu
            });
            });
    </script>
</div>
@endsection