
<div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">
    <!-- Sidebar backdrop -->
    <div 
        :class="sidebarOpen ? 'block' : 'hidden'" 
        @click="sidebarOpen = false" 
        class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden">
    </div>


    <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gradient-to-r from-blue-500 to-blue-600  lg:translate-x-0 lg:static lg:inset-0">
        <div class="flex items-center justify-center mt-8">
            <div class="flex items-center">     
                <span class="mx-2 text-2xl font-semibold uppercase text-white">Tomnenh</span>
            </div>
        </div>

        <nav class="mt-10 space-y-2 text-lg">
            <!-- Dashboard Link -->
            <a 
            class="{{ request()->routeIs('dashboard') ? ' bg-orange-400 ' : '' }} flex items-center px-6 py-2 mt-4 text-light hover:bg-secondary hover:bg-opacity-25 hover:text-gray-100" 
            href="{{ route('dashboard') }}">
            <svg class="w-8 h-8 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
               <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
             </svg>
             
            <span class="mx-3">Dashboard</span>
         </a>
            <!-- Categories Link -->
            <a 
               class="{{ request()->routeIs('categories') ? 'bg-orange-400' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('categories') }}">
               <svg class="w-8 h-8 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                  <path stroke="currentColor" stroke-linecap="round" stroke-width="2" d="M9 8h10M9 12h10M9 16h10M4.99 8H5m-.02 4h.01m0 4H5"/>
                </svg>
                
               <span class="mx-3">Categories</span>
            </a>
            <!-- Product Link -->
            <a 
               class="{{ request()->routeIs('product') ? 'bg-orange-400 ' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('product') }}">
               <svg class="w-8 h-8 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M14 7h-4v3a1 1 0 0 1-2 0V7H6a1 1 0 0 0-.997.923l-.917 11.924A2 2 0 0 0 6.08 22h11.84a2 2 0 0 0 1.994-2.153l-.917-11.924A1 1 0 0 0 18 7h-2v3a1 1 0 1 1-2 0V7Zm-2-3a2 2 0 0 0-2 2v1H8V6a4 4 0 0 1 8 0v1h-2V6a2 2 0 0 0-2-2Z" clip-rule="evenodd"/>
                </svg>
                
               <span class="mx-3">Product</span>
            </a>

          <!-- User Link -->
            <a 
               class="{{ request()->routeIs('users.index') ? 'bg-orange-400 ' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('users.index') }}"> 
               <svg class="w-8 h-8 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M12 6a3.5 3.5 0 1 0 0 7 3.5 3.5 0 0 0 0-7Zm-1.5 8a4 4 0 0 0-4 4 2 2 0 0 0 2 2h7a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-3Zm6.82-3.096a5.51 5.51 0 0 0-2.797-6.293 3.5 3.5 0 1 1 2.796 6.292ZM19.5 18h.5a2 2 0 0 0 2-2 4 4 0 0 0-4-4h-1.1a5.503 5.503 0 0 1-.471.762A5.998 5.998 0 0 1 19.5 18ZM4 7.5a3.5 3.5 0 0 1 5.477-2.889 5.5 5.5 0 0 0-2.796 6.293A3.501 3.501 0 0 1 4 7.5ZM7.1 12H6a4 4 0 0 0-4 4 2 2 0 0 0 2 2h.5a5.998 5.998 0 0 1 3.071-5.238A5.505 5.505 0 0 1 7.1 12Z" clip-rule="evenodd"/>
                </svg>
                
               <span class="mx-3">User</span>
               
            </a>
                    <!-- Roles Link -->
            <a 
               class="{{ request()->routeIs('role.index') ? 'bg-orange-400 ' : '' }} flex items-center px-6 py-2 text-light hover:bg-gray-700 hover:bg-opacity-25 hover:text-gray-100" 
               href="{{ route('role.index') }}">
               <svg class="w-8 h-8 dark:text-gray-800 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                  <path fill-rule="evenodd" d="M17 10v1.126c.367.095.714.24 1.032.428l.796-.797 1.415 1.415-.797.796c.188.318.333.665.428 1.032H21v2h-1.126c-.095.367-.24.714-.428 1.032l.797.796-1.415 1.415-.796-.797a3.979 3.979 0 0 1-1.032.428V20h-2v-1.126a3.977 3.977 0 0 1-1.032-.428l-.796.797-1.415-1.415.797-.796A3.975 3.975 0 0 1 12.126 16H11v-2h1.126c.095-.367.24-.714.428-1.032l-.797-.796 1.415-1.415.796.797A3.977 3.977 0 0 1 15 11.126V10h2Zm.406 3.578.016.016c.354.358.574.85.578 1.392v.028a2 2 0 0 1-3.409 1.406l-.01-.012a2 2 0 0 1 2.826-2.83ZM5 8a4 4 0 1 1 7.938.703 7.029 7.029 0 0 0-3.235 3.235A4 4 0 0 1 5 8Zm4.29 5H7a4 4 0 0 0-4 4v1a2 2 0 0 0 2 2h6.101A6.979 6.979 0 0 1 9 15c0-.695.101-1.366.29-2Z" clip-rule="evenodd"/>
                </svg>
                
               <span class="mx-3">Role</span>
            </a>
         
        </nav>
    </div>