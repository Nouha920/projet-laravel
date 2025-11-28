<nav class="bg-white shadow-md sticky top-0 z-50 border-b-2 border-pink-100">
    <div class="max-w-7xl mx-auto px-6 py-4">
        <div class="flex justify-between items-center">
            
            {{-- Logo / Brand --}}
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-500 rounded-xl flex items-center justify-center shadow-lg">
                    <span class="text-white font-bold text-xl">✨</span>
                </div>
                <div>
                    <h1 class="font-bold text-xl bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">
                        Admin Panel
                    </h1>
                    <p class="text-xs text-gray-500 hidden sm:block">Skincare Guide</p>
                </div>
            </div>

            {{-- Mobile Menu Button --}}
            <button id="mobile-menu-btn" class="lg:hidden p-2 rounded-lg hover:bg-gray-100">
                <svg class="w-6 h-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            {{-- Desktop Navigation --}}
            <ul class="hidden lg:flex items-center space-x-2">
                <li>
                    <a href="{{ url('/admin/dashboard') }}" 
                       class="px-4 py-2 rounded-lg text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-all font-medium flex items-center gap-2 {{ request()->is('admin/dashboard') ? 'bg-pink-50 text-pink-600' : '' }}">
                        <span>🏠</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.articles.index') }}" 
                       class="px-4 py-2 rounded-lg text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-all font-medium flex items-center gap-2 {{ request()->is('admin/articles*') ? 'bg-pink-50 text-pink-600' : '' }}">
                        <span>📝</span>
                        <span>Articles</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="px-4 py-2 rounded-lg text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-all font-medium flex items-center gap-2 {{ request()->is('admin/categories*') ? 'bg-pink-50 text-pink-600' : '' }}">
                        <span>📂</span>
                        <span>Catégories</span>
                    </a>
                </li>

                <li class="h-8 w-px bg-gray-200 mx-2"></li>

                <li>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" 
                                class="px-4 py-2 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all font-medium flex items-center gap-2">
                            <span>🚪</span>
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </li>
            </ul>

        </div>

        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4 border-t border-gray-100 pt-4">
            <ul class="space-y-2">
                <li>
                    <a href="{{ url('/admin/dashboard') }}" 
                       class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-all font-medium flex items-center gap-3 {{ request()->is('admin/dashboard') ? 'bg-pink-50 text-pink-600' : '' }}">
                        <span class="text-xl">🏠</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.articles.index') }}" 
                       class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-all font-medium flex items-center gap-3 {{ request()->is('admin/articles*') ? 'bg-pink-50 text-pink-600' : '' }}">
                        <span class="text-xl">📝</span>
                        <span>Articles</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('admin.categories.index') }}" 
                       class="block px-4 py-3 rounded-lg text-gray-700 hover:bg-pink-50 hover:text-pink-600 transition-all font-medium flex items-center gap-3 {{ request()->is('admin/categories*') ? 'bg-pink-50 text-pink-600' : '' }}">
                        <span class="text-xl">📂</span>
                        <span>Catégories</span>
                    </a>
                </li>

                <li class="pt-2 border-t border-gray-100">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" 
                                class="w-full text-left px-4 py-3 rounded-lg text-gray-700 hover:bg-red-50 hover:text-red-600 transition-all font-medium flex items-center gap-3">
                            <span class="text-xl">🚪</span>
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Toggle Mobile Menu
    document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>