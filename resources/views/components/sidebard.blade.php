
<nav class="fixed top-0 z-50 w-full bg-gray-800 border-b dark:bg-gray-800 border-gray-700">
    <div class="px-3  lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex md:items-center md:justify-start justify-between w-full rtl:justify-end">
          {{-- <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm text-gray-500  sm:hidden  focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 hover:bg-gray-700 dark:focus:ring-gray-600">
              <span class="sr-only">Open sidebar</span>
              <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                 <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
              </svg>
           </button> --}}
           <div>
               <a href="{{route ('dashboard')}}" class="flex mt-1 md:mt-0 md:mb-1  md:me-[10px]">
                  <img src="../resources/imagen/DobermaN.png" class="h-8 me-3" alt="FlowBite Logo" />
                  <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap text-white">Soporte-CVC</span>
               </a>
           </div>
           <div class=" border-red-500 border-x">
               <button id="toggleSidebar" class="text-white h-full text-lg font-medium px-3 py-2" type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 5.25h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5m-16.5 4.5h16.5" />
                   </svg> 
               </button>
           </div>
        </div>
        {{-- <div class="text-center">
            <button class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium  text-sm px-5 py-2.5 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800" type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
            Show navigation
            </button>
        </div> --}}
        <div class="flex items-center">
            <div class="flex items-center">
               <div class="w-auto">
                  <h1 class="text-white hidden md:!block whitespace-nowrap overflow-hidden text-ellipsis">
                    <span>{{ \Illuminate\Support\Str::limit(Auth::user()->descripcion, 30, '...') }}</span>
                    <span>|| {{Auth::user()->rol->nombre}}</span>
                  </h1>
               </div>            
            </div>
         </div>
      </div>
    </div>
  </nav>
  <br>
  
  <aside id="drawer-navigations" class=" fixed top-0 left-0 z-40 w-56 h-screen pt-16 transition-transform bg-gray-900 border-r border-gray-200 translate-x-0 dark:bg-gray-800 dark:border-gray-700 opacity-90 md:opacity-100" aria-label="Sidebar">
    <div class="h-full px-2 pb-1 overflow-y-auto bg-gray-900 dark:bg-gray-800 flex flex-col ">
       <ul class="space-y-2 font-medium flex-grow">
          <li>
             <a href="{{route ('dashboard')}}" class="flex items-center px-2 py-3   text-white  hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6a7.5 7.5 0 1 0 7.5 7.5h-7.5V6Z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 10.5H21A7.5 7.5 0 0 0 13.5 3v7.5Z" />
                </svg>
                
                <span class="ms-3">Inicio</span>
             </a>
          </li>
          @if(Auth::user()->roleid ===1 || Auth::user()->roleid ===2)
            <li>
                <a href="{{route ('usuario.index')}}" class="flex items-center px-2 py-3   text-white hover:bg-gray-700 group">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                   </svg>
                   
                    <span class="ms-3">Usuarios</span>
                 </a>
            </li>
          @endif
          @if(Auth::user()->roleid===1 || Auth::user()->roleid ===2)
            <li>
                <button type="button" class=" color-toggle flex items-center w-full px-2 py-3 text-base  transition duration-75  group  text-white hover:bg-gray-700 " id="menu" data-type="ins">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
                   </svg>                   
                    <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Equipos</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                    </svg>
                </button>
                <ul id="submenuins" class="hidden overflow-hidden items-center  bg-gray-900  max-h-0 transition-[max-height] duration-500 ease-in-out">
                    <li class="opacity-0 transform -translate-y-5 transition-all duration-500 ease-in-out ">
                        <a href="{{route ('equipo.index')}}" class="flex items-center w-full p-2  transition duration-75 pl-11 group  text-white hover:bg-gray-700">- Equipos por sucursal</a>
                    </li>
                    <li class="opacity-0 transform -translate-y-5 transition-all duration-500 ease-in-out">
                        <a href="{{route ('equiposgeneral')}}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Todos los Equipos</a>
                    </li>
                </ul>
        
            </li>
          @endif
          @if(Auth::user()->roleid===3)
          <li>
            <a href="{{route('misequipos', ['id' => Auth::user()->sucursal])}}" class="flex items-center px-2 py-3   text-white  hover:bg-gray-700 group">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
               </svg>
               <span class="ms-3">Mis Equipos</span>
            </a>
         </li>
          @endif
        {{-- <li>
           <button type="button" class="flex items-center w-full p-2 text-base  transition duration-75  group  text-white hover:bg-gray-700"  id="menu" data-type="esp">
                 <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover: dark:text-gray-400 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 21">
                    <path d="M15 12a1 1 0 0 0 .962-.726l2-7A1 1 0 0 0 17 3H3.77L3.175.745A1 1 0 0 0 2.208 0H1a1 1 0 0 0 0 2h.438l.6 2.255v.019l2 7 .746 2.986A3 3 0 1 0 9 17a2.966 2.966 0 0 0-.184-1h2.368c-.118.32-.18.659-.184 1a3 3 0 1 0 3-3H6.78l-.5-2H15Z"/>
                 </svg>
                 <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Especialidades</span>
                 <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                 </svg>
           </button>
           <ul id="submenuesp" class="hidden overflow-hidden max-h-0 transition-[max-height] duration-500 ease-in-out">
                 <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                    <a href="#" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">Ver Especialidad</a>
                 </li>
                 <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                    <a href="#" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">Crear Especialidad</a>
                 </li>
                 
           </ul>
        </li> --}}
        @if(Auth::user()->roleid===3)
        <li>
           <button type="button" class="flex items-center w-full px-2 py-3 text-base  transition duration-75  group  text-white hover:bg-gray-700" id="menu" data-type="tic">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
               <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
             </svg>             
                 <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Tickets</span>
                 <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                 </svg>
           </button>
           <ul id="submenutic" class="hidden overflow-hidden max-h-0 transition-[max-height] bg-gray-900 duration-500 ease-in-out">
                 {{-- <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                    <a href="{{ route('misreportes', ['id' => Auth::user()->sucursal]) }}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Tickets de Equipos</a>
                 </li> --}}
                 <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                    <a href="{{route ('misreportessoftware', [Auth::user()->id])}}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Tickets de Sistemas</a>
                 </li>
                 
           </ul>
        </li>
        @endif
        @if(Auth::user()->roleid===1 || Auth::user()->roleid===2)
        <li>
           <button type="button" class="flex items-center w-full px-2 py-3 text-base  transition duration-75  group  text-white hover:bg-gray-700" id="menu" data-type="tic">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 6v.75m0 3v.75m0 3v.75m0 3V18m-9-5.25h5.25M7.5 15h3M3.375 5.25c-.621 0-1.125.504-1.125 1.125v3.026a2.999 2.999 0 0 1 0 5.198v3.026c0 .621.504 1.125 1.125 1.125h17.25c.621 0 1.125-.504 1.125-1.125v-3.026a2.999 2.999 0 0 1 0-5.198V6.375c0-.621-.504-1.125-1.125-1.125H3.375Z" />
               </svg>             
                 <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Tickets</span>
                 <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                 </svg>
           </button>
           <ul id="submenutic" class="hidden overflow-hidden max-h-0 transition-[max-height] bg-gray-900 duration-500 ease-in-out">
                 <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                    <a href="{{route('reportessoftware.general')}}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Tickets de Sistemas</a>
                 </li>
                 {{-- <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                    <a href="{{route('reportes.general')}}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Tickets de Equipos</a>
                 </li> --}}
                 
           </ul>
        </li>
        @endif
        @if(Auth::user()->roleid===1 || Auth::user()->roleid===2)
        <li>
           <button type="button" class="flex items-center w-full px-2 py-3 text-base  transition duration-75  group  text-white hover:bg-gray-700" id="menu" data-type="opc">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 12a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
               </svg>
             
                 <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Mas Opciones</span>
                 <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                 </svg>
           </button>
           <ul id="submenuopc" class="hidden overflow-hidden max-h-0 transition-[max-height] bg-gray-900 duration-500 ease-in-out">
              <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                 <a href="{{route ('sistemas.index')}}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Ver Sistemas</a>
              </li>
              <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                 <a href="{{route ('fallas.soluciones')}}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Ver fallas y soluciones</a>
              </li>
              @if(Auth::user()->roleid===1)

                  <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                     <a href="{{route('sucursal.index2')}}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Ver sucursales</a>
                  </li>
               @endif
              {{-- <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                <a href="#" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Categorias de Equipos</a>
              </li> --}}
           </ul>
        </li>
        @endif
        @if(Auth::user()->roleid===3)
         {{-- <li>
            <button type="button" class="flex items-center w-full px-2 py-3 text-base  transition duration-75  group  text-white hover:bg-gray-700" id="menu" data-type="ayu">
               <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                </svg>
                
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Ayuda</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="submenuayu" class="hidden overflow-hidden max-h-0 transition-[max-height] bg-gray-900 duration-500 ease-in-out">
                  <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                     <a href="{{route ('manual.usuario')}}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Manual de Usuario</a>
                  </li>   
            </ul>
         </li> --}}
        @endif
        @if(Auth::user()->roleid===1)
         <li>
            <button type="button" class="flex items-center w-full px-2 py-3 text-base  transition duration-75  group  text-white hover:bg-gray-700" id="menu" data-type="ayu">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                  </svg>
                
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Ayuda</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="submenuayu" class="hidden overflow-hidden max-h-0 transition-[max-height] bg-gray-900 duration-500 ease-in-out">
                  <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                     <a href="{{ asset('storage/pdf/Guia_usuario2_soporte-cvc.pdf') }}" target="_blank" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Manual de tickets de sistemas</a>
                  </li>  
                  
            </ul>
         </li>
        @endif
        @if(Auth::user()->roleid===3)
         <li>
            <button type="button" class="flex items-center w-full px-2 py-3 text-base  transition duration-75  group  text-white hover:bg-gray-700" id="menu" data-type="ayu">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                  </svg>
                
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Ayuda</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="submenuayu" class="hidden overflow-hidden max-h-0 transition-[max-height] bg-gray-900 duration-500 ease-in-out">
                  <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                     <a href="{{ asset('storage/pdf/Guia_usuario2_soporte-cvc.pdf') }}" target="_blank" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">- Manual de tickets de sistemas</a>
                  </li>  
            </ul>
         </li>
        @endif
        {{-- <li>
            <button type="button" class="flex items-center w-full px-2 py-3 text-base  transition duration-75  group  text-white hover:bg-gray-700" id="menu" data-type="vid">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M9.879 7.519c1.171-1.025 3.071-1.025 4.242 0 1.172 1.025 1.172 2.687 0 3.712-.203.179-.43.326-.67.442-.745.361-1.45.999-1.45 1.827v.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 5.25h.008v.008H12v-.008Z" />
                  </svg>
               
                  <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Videos</span>
                  <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                     <path stroke="red" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                  </svg>
            </button>
            <ul id="submenuvid" class="hidden overflow-hidden max-h-0 transition-[max-height] bg-gray-900 duration-500 ease-in-out">
                  <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                     <a href="{{route ('subir.videos')}}"  class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">Subir video</a>
                  </li>  
                  <li class="opacity-0 transform -translate-y-5  transition-all duration-500 ease-in-out">
                  <a href="{{route ('manual.usuario')}}" class="flex items-center w-full p-2  transition duration-75  pl-11 group  text-white hover:bg-gray-700">index</a>
               </li> 
            </ul>
         </li> --}}
          

         
          
       </ul>

       <h1 class="text-white md:hidden mb-4">{{ \Illuminate\Support\Str::limit(Auth::user()->descripcion, 30, '...') }}</h1>



       <ul>
         {{-- <li class="">
            <a href="{{route ('usuarios.datos', [Auth::user()->id])}}">
               <button type="submit" class="flex w-full items-center px-2 py-3   text-white  hover:bg-gray-700 group">
                  <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover: dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                     <path d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z"/>
                  </svg>
                  <span class="flex-1 text-left ms-3 whitespace-nowrap">Mi Cuenta</span>
               </button>
            </a>
         </li> --}}
         <li class="md:!mb-0 mb-16">
            <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                @csrf
                
                <button type="submit" class="flex w-full items-center px-2 py-3   text-white  hover:bg-gray-700 group" onclick="salir(event)">
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="red" class="size-6">
                     <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
                   </svg>
                   
                    <span class="flex-1 text-left ms-3 whitespace-nowrap">Salir</span>
                </button>
            </form>
         </li>

       </ul>
    </div>
</aside>

<div class="modal fade mt-[20%]" id="confirmarsalir" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true">
   <div class="modal-dialog">
       <div class="modal-content p-4">
         <h2 class="text-lg font-semibold text-center">¿Estás seguro que quieres salir?</h2>
         <div class="flex justify-between mt-8">
             <button id="confirmYessalir" class="btn btn-danger text-white px-4 py-2 rounded">
                 Sí, salir
             </button>
             <button id="confirmNosalir" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded">
                 Cancelar
             </button>
         </div>
       </div>
   </div>
</div>



    
<div id="content" class="flex-1  h-full  p-8 transition-all lg:ml-64">
    <div class="  mt-10 pb-4">    
        @yield('content')
        
        
    </div>
</div>



<style>
    #drawer-navigation {
        transition: transform 0.3s ease;
    }
    .hidden2 {
        transform: translateX(-100%); /* Mueve fuera de la vista */
    }
</style>

<script>
   const toggleSidebar = document.getElementById('toggleSidebar');
   const sidebar = document.getElementById('drawer-navigations');
   const content = document.getElementById('content');

   // Verificar el tamaño de la pantalla
   const isSmallScreen = () => window.innerWidth < 700;

   // Recuperar el estado guardado
   let abierto = sessionStorage.getItem('sidebarAbierto') === '1';

   // Si la pantalla es pequeña, forzar el estado cerrado
   if (isSmallScreen()) {
      abierto = false;
      sessionStorage.setItem('sidebarAbierto', '0');
   }

   // Aplicar el estado al cargar la página
   if (abierto) {
      content.classList.add('lg:ml-64');
      sidebar.classList.remove("hidden2");
   } else {
      content.classList.remove('lg:ml-64');
      sidebar.classList.add("hidden2");
   }

   document.addEventListener('click', (event) => {
      const toggleButton = event.target.closest('#toggleSidebar');
      if (!toggleButton) return;

      abierto = !abierto; // Alternar estado

      if (abierto) {
         content.classList.add('lg:ml-64');
         sidebar.classList.remove("hidden2");
      } else {
         content.classList.remove('lg:ml-64');
         sidebar.classList.add("hidden2");
      }

      // Guardar estado en sessionStorage
      sessionStorage.setItem('sidebarAbierto', abierto ? '1' : '0');
   });

   // Cerrar el sidebar si se redimensiona a una pantalla pequeña
   window.addEventListener('resize', () => {
      if (isSmallScreen()) {
         abierto = false;
         content.classList.remove('lg:ml-64');
         sidebar.classList.add("hidden2");
         sessionStorage.setItem('sidebarAbierto', '0');
      }
   });

   // Control de los botones del menú
   const buttons = document.querySelectorAll('#menu');

   buttons.forEach(button => {
      button.addEventListener('click', function () {
         this.classList.toggle('bg-gray-900');
         this.classList.toggle('bg-gray-800');
      });
   });

   // Control de los submenús
   const menuItems = document.querySelectorAll("#menu");

   menuItems.forEach(menu => {
      menu.addEventListener("click", function () {
         const type = this.getAttribute('data-type');
         const instructorList = document.getElementById("submenu" + type);
         const listItems = instructorList.querySelectorAll("li");
         const isHidden = instructorList.classList.contains("hidden");

         if (isHidden) {
               // Mostrar la lista
               instructorList.classList.remove("hidden");
               instructorList.style.maxHeight = `${instructorList.scrollHeight}px`;

               // Mostrar elementos con animación escalonada
               listItems.forEach((item, index) => {
                  setTimeout(() => {
                     item.classList.add("opacity-100", "translate-y-0");
                     item.classList.remove("opacity-0", "-translate-y-5");
                  }, index * 100);
               });
         } else {
               // Ocultar elementos con animación escalonada
               listItems.forEach((item, index) => {
                  setTimeout(() => {
                     item.classList.add("opacity-0", "-translate-y-5");
                     item.classList.remove("opacity-100", "translate-y-0");
                  }, index * 100);
               });

               setTimeout(() => {
                  instructorList.style.maxHeight = "0";
                  setTimeout(() => {
                     instructorList.classList.add("hidden");
                  }, 500);
               }, listItems.length * 100);
         }
      });
   });


    function salir(event){
      event.preventDefault();

      $('#confirmarsalir').modal('show');
      console.log('saliendo');

      $(document).off('click', '#confirmYessalir').on('click', '#confirmYessalir', function(){
         $('#logoutForm').submit();
      })
      $(document).on('click', '#confirmNosalir', function(){
         $('#confirmarsalir').modal('hide');
      })
      
    }
    
    
</script>