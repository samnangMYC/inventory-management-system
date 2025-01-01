
<div x-data="{ sidebarOpen: false }" class="flex h-screen  ">
    <!-- Sidebar backdrop -->
    <div 
        :class="sidebarOpen ? 'block' : 'hidden'" 
        @click="sidebarOpen = false" 
        class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden">
    </div>
    

    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" id="sidebar" class="fixed bg-gradient-to-r dark:bg-gray-900 from-blue-600 to-blue-700  inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform  lg:translate-x-0 lg:static lg:inset-0">
      <button class="absolute pt-4 pl-3 " >
         <svg class="w-10 h-10 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 6H6m12 4H6m12 4H6m12 4H6"/>
          </svg>    
      </button>
        <div class="flex items-center justify-center mt-8 ">
            <div class="flex items-center">     
                <a href="{{route('dashboard')}}" class=" rounded-sm">
                  <img class=" h-32 brightness-200 " src="{{asset('logo2.png')}}" alt="logo">

                </a>
            </div>
        </div>
        @php
            $PermissionUser = App\Models\PermissionRole::getPermission('User',Auth::user()->role_id);
            $PermissionRole = App\Models\PermissionRole::getPermission('Role',Auth::user()->role_id);
            $PermissionCategory = App\Models\PermissionRole::getPermission('Category',Auth::user()->role_id);
            $PermissionSubCategory = App\Models\PermissionRole::getPermission('Sub Category',Auth::user()->role_id);
            $PermissionProduct = App\Models\PermissionRole::getPermission('Product',Auth::user()->role_id);
            $PermissionProductBrand = App\Models\PermissionRole::getPermission('Product Brand',Auth::user()->role_id);
            $PermissionSetting = App\Models\PermissionRole::getPermission('Setting',Auth::user()->role_id);
        @endphp

        <nav class="mt-10 space-y-2 text-lg">
            <!-- Dashboard Link -->
            <a 
            class="{{ request()->routeIs('dashboard') ? 'bg-gray-700 bg-opacity-25 ' : '' }} flex items-center px-6 py-2 mt-4 text-light hover:bg-secondary hover:bg-opacity-25 hover:text-gray-100" 
            href="{{ route('dashboard') }}">
            <svg class="w-8 h-8  text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
               <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
             </svg>
             
            <span class="mx-3">Dashboard</span>
         </a>
            <!-- Sale Link -->
            <a 
            class="{{ request()->routeIs('sale.index') ? 'bg-gray-700 bg-opacity-25 ' : '' }} flex items-center px-6 py-2 text-light hover:bg-secondary hover:bg-opacity-25 hover:text-gray-100" 
            href="{{ route('sale.index') }}">
            <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
               <path fill-rule="evenodd" d="M20.29 8.567c.133.323.334.613.59.85v.002a3.536 3.536 0 0 1 0 5.166 2.442 2.442 0 0 0-.776 1.868 3.534 3.534 0 0 1-3.651 3.653 2.483 2.483 0 0 0-1.87.776 3.537 3.537 0 0 1-5.164 0 2.44 2.44 0 0 0-1.87-.776 3.533 3.533 0 0 1-3.653-3.654 2.44 2.44 0 0 0-.775-1.868 3.537 3.537 0 0 1 0-5.166 2.44 2.44 0 0 0 .775-1.87 3.55 3.55 0 0 1 1.033-2.62 3.594 3.594 0 0 1 2.62-1.032 2.401 2.401 0 0 0 1.87-.775 3.535 3.535 0 0 1 5.165 0 2.444 2.444 0 0 0 1.869.775 3.532 3.532 0 0 1 3.652 3.652c-.012.35.051.697.184 1.02ZM9.927 7.371a1 1 0 1 0 0 2h.01a1 1 0 0 0 0-2h-.01Zm5.889 2.226a1 1 0 0 0-1.414-1.415L8.184 14.4a1 1 0 0 0 1.414 1.414l6.218-6.217Zm-2.79 5.028a1 1 0 1 0 0 2h.01a1 1 0 1 0 0-2h-.01Z" clip-rule="evenodd"/>
             </svg>
             
            <span class="mx-3">Open POS</span>
          </a>
         </a>
         <!-- Sale Link -->
         <a 
            class="{{ request()->routeIs('sale-list.index') ? 'bg-gray-700 bg-opacity-25 ' : '' }} flex items-center px-6 py-2 text-light hover:bg-secondary hover:bg-opacity-25 hover:text-gray-100" 
            href="{{ route('sale-list.index') }}">
            <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
               <path fill-rule="evenodd" d="M7 6a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2h-2v-4a3 3 0 0 0-3-3H7V6Z" clip-rule="evenodd"/>
               <path fill-rule="evenodd" d="M2 11a2 2 0 0 1 2-2h11a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-7Zm7.5 1a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z" clip-rule="evenodd"/>
               <path d="M10.5 14.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"/>
            </svg>
            <span class="mx-3">Sales</span>
            </a>

            <!-- Product Brand Link -->
            @if(!empty($PermissionProductBrand))
            <a 
               class="{{ request()->routeIs('product-brand.index') ? 'bg-gray-700 bg-opacity-25  ' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('product-brand.index') }}">
               <svg class="w-8 h-8 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 12c.263 0 .524-.06.767-.175a2 2 0 0 0 .65-.491c.186-.21.333-.46.433-.734.1-.274.15-.568.15-.864a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 12 9.736a2.4 2.4 0 0 0 .586 1.591c.375.422.884.659 1.414.659.53 0 1.04-.237 1.414-.659A2.4 2.4 0 0 0 16 9.736c0 .295.052.588.152.861s.248.521.434.73a2 2 0 0 0 .649.488 1.809 1.809 0 0 0 1.53 0 2.03 2.03 0 0 0 .65-.488c.185-.209.332-.457.433-.73.1-.273.152-.566.152-.861 0-.974-1.108-3.85-1.618-5.121A.983.983 0 0 0 17.466 4H6.456a.986.986 0 0 0-.93.645C5.045 5.962 4 8.905 4 9.736c.023.59.241 1.148.611 1.567.37.418.865.667 1.389.697Zm0 0c.328 0 .651-.091.94-.266A2.1 2.1 0 0 0 7.66 11h.681a2.1 2.1 0 0 0 .718.734c.29.175.613.266.942.266.328 0 .651-.091.94-.266.29-.174.537-.427.719-.734h.681a2.1 2.1 0 0 0 .719.734c.289.175.612.266.94.266.329 0 .652-.091.942-.266.29-.174.536-.427.718-.734h.681c.183.307.43.56.719.734.29.174.613.266.941.266a1.819 1.819 0 0 0 1.06-.351M6 12a1.766 1.766 0 0 1-1.163-.476M5 12v7a1 1 0 0 0 1 1h2v-5h3v5h7a1 1 0 0 0 1-1v-7m-5 3v2h2v-2h-2Z"/>
                </svg>                
                
               <span class="mx-3">Product Brand</span>
            </a>
            @endif
            <!-- Categories Link -->
            @if(!empty($PermissionCategory))
            <a 
               class="{{ request()->routeIs('categories') ? 'bg-gray-700 bg-opacity-25 ' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('categories') }}">
               <svg class="w-8 h-8 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5"/>
                </svg>
                
               <span class="mx-3">Categories</span>
            </a>
            @endif
            <!--Sub Categories Link -->
            @if(!empty($PermissionSubCategory))
            <a 
               class="{{ request()->routeIs('sub-category.index') ? 'bg-gray-700 bg-opacity-25 ' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('sub-category.index') }}">
               <svg class="w-8 h-8 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961"/>
                </svg>            
               <span class="mx-3">Sub Categories</span>
            </a>
            @endif
            <!-- Product Link -->
            @if(!empty($PermissionProduct))
            <a 
               class="{{ request()->routeIs('product') ? 'bg-gray-700 bg-opacity-25  ' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('product') }}">
               <svg class="w-8 h-8 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z" clip-rule="evenodd"/>
                </svg>
                
               <span class="mx-3">Product</span>
            </a>
            @endif

          <!-- User Link -->
          @if(!empty($PermissionUser))
            <a 
               class="{{ request()->routeIs('users.index') ? 'bg-gray-700 bg-opacity-25 ' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('users.index') }}"> 
               <svg class="w-8 h-8 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                </svg>
                
               <span class="mx-3">User</span>
               
            </a>
            @endif
            <!-- Roles Link -->
            @if(!empty($PermissionRole))
            <a 
               class="{{ request()->routeIs('role.index') ? 'bg-gray-700 bg-opacity-25 ' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('role.index') }}">
               <svg class="w-8 h-8 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z" clip-rule="evenodd"/>
                </svg>
                
               <span class="mx-3">Role / Permission</span>
            </a>
            @endif
        </nav>
        <script>
          
        </script>
    </div>