<nav x-data="{ open: false }" class="bg-gradient-to-r from-emerald-50 via-white to-green-50 shadow-lg border-b-2 border-emerald-200 backdrop-blur-sm bg-opacity-95">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3 group">
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-green-600 rounded-xl blur-md opacity-0 group-hover:opacity-30 transition-all duration-500"></div>
                            <div class="relative bg-gradient-to-br from-emerald-500 via-emerald-600 to-green-700 p-2.5 rounded-xl shadow-md group-hover:shadow-lg group-hover:scale-105 transition-all duration-300">
                                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="relative">
                            <span class="text-xl font-bold bg-gradient-to-r from-emerald-600 via-green-600 to-emerald-700 bg-clip-text text-transparent">Pharma<span class="text-green-600">Care</span></span>
                            <div class="absolute -bottom-1 left-0 w-0 h-0.5 bg-gradient-to-r from-emerald-500 to-green-500 group-hover:w-full transition-all duration-500"></div>
                        </div>
                    </a>
                </div>

                <!-- Desktop Navigation Links -->
                <div class="hidden sm:flex items-center space-x-2 sm:ml-12 ml-6">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="group relative px-4 py-2 rounded-lg">
                        <span class="relative z-10 flex items-center space-x-2">
                            <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            <span class="group-hover:text-emerald-700 transition-colors duration-300">{{ __('Dashboard') }}</span>
                        </span>
                        <div class="absolute inset-0 bg-gradient-to-r from-emerald-100/0 via-emerald-50/0 to-green-100/0 group-hover:from-emerald-100/50 group-hover:via-emerald-50/50 group-hover:to-green-100/50 rounded-lg transition-all duration-500"></div>
                        <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-emerald-500 to-green-500 group-hover:w-4/5 transition-all duration-500"></div>
                    </x-nav-link>
                    
                    @if(Auth::check())
                        <x-nav-link href="{{ url('/obat') }}" :active="request()->is('obat*')" class="group relative px-4 py-2 rounded-lg">
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                </svg>
                                <span class="group-hover:text-emerald-700 transition-colors duration-300">{{ __('Obat') }}</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-100/0 via-emerald-50/0 to-green-100/0 group-hover:from-emerald-100/50 group-hover:via-emerald-50/50 group-hover:to-green-100/50 rounded-lg transition-all duration-500"></div>
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-emerald-500 to-green-500 group-hover:w-4/5 transition-all duration-500"></div>
                        </x-nav-link>
                        
                        <x-nav-link href="{{ url('/transaksi') }}" :active="request()->is('transaksi*')" class="group relative px-4 py-2 rounded-lg">
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                <span class="group-hover:text-emerald-700 transition-colors duration-300">{{ __('Transaksi') }}</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-100/0 via-emerald-50/0 to-green-100/0 group-hover:from-emerald-100/50 group-hover:via-emerald-50/50 group-hover:to-green-100/50 rounded-lg transition-all duration-500"></div>
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-emerald-500 to-green-500 group-hover:w-4/5 transition-all duration-500"></div>
                        </x-nav-link>
                        
                        <x-nav-link href="{{ url('/laporan') }}" :active="request()->is('laporan*')" class="group relative px-4 py-2 rounded-lg">
                            <span class="relative z-10 flex items-center space-x-2">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                                <span class="group-hover:text-emerald-700 transition-colors duration-300">{{ __('Laporan') }}</span>
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-emerald-100/0 via-emerald-50/0 to-green-100/0 group-hover:from-emerald-100/50 group-hover:via-emerald-50/50 group-hover:to-green-100/50 rounded-lg transition-all duration-500"></div>
                            <div class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-0 h-0.5 bg-gradient-to-r from-emerald-500 to-green-500 group-hover:w-4/5 transition-all duration-500"></div>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2.5 bg-gradient-to-r from-emerald-50 to-green-50 hover:from-emerald-100 hover:to-green-100 border border-emerald-200 text-sm leading-4 font-medium rounded-xl text-gray-700 hover:text-emerald-800 focus:outline-none transition-all duration-500 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 group shadow-sm hover:shadow-md">
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-8 h-8 bg-gradient-to-br from-emerald-500 to-green-600 text-white rounded-full font-semibold text-sm group-hover:from-emerald-600 group-hover:to-green-700 transition-all duration-300">
                                    {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                                </div>
                                <div class="flex flex-col items-start">
                                    <span class="font-medium group-hover:text-emerald-700 transition-colors duration-300">{{ Auth::user()->name ?? 'User' }}</span>
                                    <span class="text-xs text-gray-500 group-hover:text-emerald-500 transition-colors duration-300">{{ ucfirst(Auth::user()->role ?? 'user') }}</span>
                                </div>
                            </div>
                            <div class="ms-3">
                                <svg class="fill-current h-4 w-4 text-gray-400 group-hover:text-emerald-500 transition-colors duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content" class="shadow-xl border border-emerald-100 mt-2 rounded-xl overflow-hidden">
                        <div class="px-4 py-3 border-b border-gray-100 bg-gradient-to-r from-emerald-50 to-green-50">
                            <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name ?? 'User' }}</p>
                            <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email ?? 'user@example.com' }}</p>
                        </div>
                        
                        <x-dropdown-link :href="route('profile.edit')" class="flex items-center hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 group transition-all duration-300">
                            <svg class="w-4 h-4 mr-2 text-gray-500 group-hover:text-emerald-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span class="group-hover:text-emerald-700 transition-colors duration-300">{{ __('Profile') }}</span>
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();"
                                    class="flex items-center hover:bg-gradient-to-r hover:from-red-50 hover:to-red-50 group transition-all duration-300">
                                <svg class="w-4 h-4 mr-2 text-gray-500 group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                                </svg>
                                <span class="group-hover:text-red-700 transition-colors duration-300">{{ __('Log Out') }}</span>
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2.5 rounded-xl bg-gradient-to-r from-emerald-50 to-green-50 hover:from-emerald-100 hover:to-green-100 text-gray-600 hover:text-emerald-700 focus:outline-none transition-all duration-500 border border-emerald-200 focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 group"
                        :class="{'from-emerald-100 to-green-100': open}">
                    <svg class="h-6 w-6 group-hover:scale-110 transition-transform duration-300" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" 
         class="sm:hidden bg-gradient-to-b from-white to-emerald-50 shadow-lg border-t border-emerald-100"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform -translate-y-2"
         x-transition:enter-end="opacity-100 transform translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0"
         x-transition:leave-end="opacity-0 transform -translate-y-2">
        
        <div class="pt-3 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="group flex items-center px-4 py-3 rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 transition-all duration-300">
                <div class="w-8 h-8 flex items-center justify-center bg-gradient-to-r from-emerald-100 to-green-100 rounded-lg mr-3 group-hover:from-emerald-200 group-hover:to-green-200 transition-all duration-300">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                </div>
                <span class="text-gray-700 group-hover:text-emerald-700 font-medium transition-colors duration-300">{{ __('Dashboard') }}</span>
            </x-responsive-nav-link>
            
            @if(Auth::check())
                <x-responsive-nav-link href="{{ url('/obat') }}" :active="request()->is('obat*')" class="group flex items-center px-4 py-3 rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 transition-all duration-300">
                    <div class="w-8 h-8 flex items-center justify-center bg-gradient-to-r from-emerald-100 to-green-100 rounded-lg mr-3 group-hover:from-emerald-200 group-hover:to-green-200 transition-all duration-300">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                        </svg>
                    </div>
                    <span class="text-gray-700 group-hover:text-emerald-700 font-medium transition-colors duration-300">{{ __('Obat') }}</span>
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="{{ url('/transaksi') }}" :active="request()->is('transaksi*')" class="group flex items-center px-4 py-3 rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 transition-all duration-300">
                    <div class="w-8 h-8 flex items-center justify-center bg-gradient-to-r from-emerald-100 to-green-100 rounded-lg mr-3 group-hover:from-emerald-200 group-hover:to-green-200 transition-all duration-300">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <span class="text-gray-700 group-hover:text-emerald-700 font-medium transition-colors duration-300">{{ __('Transaksi') }}</span>
                </x-responsive-nav-link>
                
                <x-responsive-nav-link href="{{ url('/laporan') }}" :active="request()->is('laporan*')" class="group flex items-center px-4 py-3 rounded-xl hover:bg-gradient-to-r hover:from-emerald-50 hover:to-green-50 transition-all duration-300">
                    <div class="w-8 h-8 flex items-center justify-center bg-gradient-to-r from-emerald-100 to-green-100 rounded-lg mr-3 group-hover:from-emerald-200 group-hover:to-green-200 transition-all duration-300">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <span class="text-gray-700 group-hover:text-emerald-700 font-medium transition-colors duration-300">{{ __('Laporan') }}</span>
                </x-responsive-nav-link>
            @endif
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-5 pb-4 border-t border-emerald-100 px-4 bg-gradient-to-r from-emerald-50 to-green-50 mx-4 rounded-xl my-4">
            <div class="flex items-center px-4 py-3">
                <div class="flex-shrink-0">
                    <div class="flex items-center justify-center w-12 h-12 bg-gradient-to-br from-emerald-500 to-green-600 text-white rounded-full font-semibold text-lg shadow-md">
                        {{ strtoupper(substr(Auth::user()->name ?? 'U', 0, 1)) }}
                    </div>
                </div>
                <div class="ml-4">
                    <div class="text-base font-semibold text-gray-900">{{ Auth::user()->name ?? 'User' }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email ?? 'user@example.com' }}</div>
                    <div class="text-xs mt-1 px-3 py-1 bg-emerald-100 text-emerald-700 rounded-full inline-block">
                        {{ ucfirst(Auth::user()->role ?? 'user') }}
                    </div>
                </div>
            </div>

            <div class="mt-4 space-y-2">
                <x-responsive-nav-link :href="route('profile.edit')" class="flex items-center px-4 py-3 rounded-xl hover:bg-gradient-to-r hover:from-emerald-100 hover:to-green-100 group transition-all duration-300">
                    <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-emerald-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <span class="group-hover:text-emerald-700 transition-colors duration-300">{{ __('Profile') }}</span>
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="flex items-center px-4 py-3 rounded-xl hover:bg-gradient-to-r hover:from-red-50 hover:to-red-100 group transition-all duration-300">
                        <svg class="w-5 h-5 mr-3 text-gray-500 group-hover:text-red-600 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span class="group-hover:text-red-700 transition-colors duration-300">{{ __('Log Out') }}</span>
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-5px); }
    100% { transform: translateY(0px); }
}

.hover-float:hover {
    animation: float 2s ease-in-out infinite;
}

@keyframes pulse-glow {
    0% { box-shadow: 0 0 0 0 rgba(16, 120, 185, 0.4); }
    70% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
    100% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
}

.pulse-glow {
    animation: pulse-glow 2s infinite;
}

/* Smooth transitions for all interactive elements */
* {
    transition-property: background-color, border-color, color, fill, stroke, opacity, box-shadow, transform;
    transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
    transition-duration: 300ms;
}

/* Custom scrollbar for dropdowns */
.dropdown-content::-webkit-scrollbar {
    width: 6px;
}

.dropdown-content::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

.dropdown-content::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #1083b9, #054996);
    border-radius: 3px;
}

.dropdown-content::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #056196, #043e78);
}
</style>