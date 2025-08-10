<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
           
            <div class="flex items-center space-x-8">
               
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="w-32 h-10">
                    </a>
                </div>

                
                <div class="hidden sm:flex space-x-8">
                    <a href="{{ route('dashboard') }}"
                        class="text-sm font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-600 hover:text-gray-800' }}">
                        Home
                    </a>

                    <a href="{{ route('artigos.index') }}"
                        class="text-sm font-medium {{ request()->routeIs('artigos.index') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-600 hover:text-gray-800' }}">
                        Cadastrar Artigo
                    </a>

                    <a href="{{ route('desenvolvedores') }}"
                        class="text-sm font-medium {{ request()->routeIs('desenvolvedores') ? 'text-indigo-600 border-b-2 border-indigo-600' : 'text-gray-600 hover:text-gray-800' }}">
                        Desenvolvedores
                    </a>
                </div>
            </div>

           
            <div class="hidden sm:flex sm:items-center sm:ml-6 relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition">
                    <span>{{ Auth::user()->name }}</span>
                    <svg class="ml-1 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 011.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd" />
                    </svg>
                </button>

                
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg z-50">
                    
                    <a href="{{ route('profile.show') }}" 
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                       Ver Perfil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Sair
                        </button>
                    </form>
                </div>
            </div>

            
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:text-gray-500 focus:bg-gray-100 transition">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}"
                class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('dashboard') ? 'text-indigo-700 bg-indigo-50' : 'text-gray-600 hover:bg-gray-100' }}">
                Home
            </a>

            <a href="{{ route('artigos.index') }}"
                class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('artigos.index') ? 'text-indigo-700 bg-indigo-50' : 'text-gray-600 hover:bg-gray-100' }}">
                Cadastrar Artigo
            </a>

            <a href="{{ route('desenvolvedores') }}"
                class="block pl-3 pr-4 py-2 text-base font-medium {{ request()->routeIs('desenvolvedores') ? 'text-indigo-700 bg-indigo-50' : 'text-gray-600 hover:bg-gray-100' }}">
                Desenvolvedores
            </a>
        </div>

        
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.show') }}"
                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                   Ver Perfil
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                        Sair
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
