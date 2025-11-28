<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Skincare Guide</title>
    
    {{-- Tailwind CSS --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- Font Awesome (optionnel) --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</head>
<body class="bg-gray-50">
    
    {{-- Navigation --}}
    <nav class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-gradient-to-br from-pink-500 to-purple-500 rounded-xl flex items-center justify-center">
                        <span class="text-white text-xl font-bold">✨</span>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold bg-gradient-to-r from-pink-600 to-purple-600 bg-clip-text text-transparent">
                            Skincare Guide
                        </h1>
                    </div>
                </a>

                {{-- Menu Desktop --}}
                <div class="hidden md:flex items-center space-x-6">
                    <a href="{{ url('/') }}" 
                       class="text-gray-700 hover:text-pink-600 font-medium transition {{ request()->is('/') ? 'text-pink-600' : '' }}">
                        🏠 Accueil
                    </a>
                    <a href="{{ route('articles.index') }}" 
                       class="text-gray-700 hover:text-pink-600 font-medium transition {{ request()->is('articles*') ? 'text-pink-600' : '' }}">
                        📝 Articles
                    </a>
                    <a href="{{ route('ingredients.index') }}" 
                       class="text-gray-700 hover:text-pink-600 font-medium transition {{ request()->is('ingredients*') ? 'text-pink-600' : '' }}">
                        🧪 Ingrédients
                    </a>
                    <a href="{{ route('routines.index') }}" 
                       class="text-gray-700 hover:text-pink-600 font-medium transition {{ request()->is('routines*') ? 'text-pink-600' : '' }}">
                        ✨ Routines
                    </a>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ url('/admin/dashboard') }}" 
                               class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-500 text-white rounded-lg hover:from-pink-600 hover:to-purple-600 transition font-medium">
                                👑 Admin
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-red-600 font-medium transition">
                                🚪 Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                           class="text-gray-700 hover:text-pink-600 font-medium transition">
                            🔐 Connexion
                        </a>
                        <a href="{{ route('register') }}" 
                           class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-500 text-white rounded-lg hover:from-pink-600 hover:to-purple-600 transition font-medium">
                            📝 Inscription
                        </a>
                    @endauth
                </div>

                {{-- Menu Mobile Button --}}
                <button id="mobile-menu-btn" class="md:hidden p-2 rounded-lg hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            {{-- Menu Mobile --}}
            <div id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-100 pt-4">
                <div class="space-y-2">
                    <a href="{{ url('/') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-pink-50 hover:text-pink-600 rounded-lg transition">
                        🏠 Accueil
                    </a>
                    <a href="{{ route('articles.index') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-pink-50 hover:text-pink-600 rounded-lg transition">
                        📝 Articles
                    </a>
                    <a href="{{ route('ingredients.index') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-pink-50 hover:text-pink-600 rounded-lg transition">
                        🧪 Ingrédients
                    </a>
                    <a href="{{ route('routines.index') }}" 
                       class="block px-4 py-2 text-gray-700 hover:bg-pink-50 hover:text-pink-600 rounded-lg transition">
                        ✨ Routines
                    </a>
                    
                    @auth
                        @if(auth()->user()->isAdmin())
                            <a href="{{ url('/admin/dashboard') }}" 
                               class="block px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-500 text-white rounded-lg hover:from-pink-600 hover:to-purple-600 transition font-medium">
                                👑 Admin Panel
                            </a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-left px-4 py-2 text-gray-700 hover:bg-red-50 hover:text-red-600 rounded-lg transition">
                                🚪 Déconnexion
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" 
                           class="block px-4 py-2 text-gray-700 hover:bg-pink-50 hover:text-pink-600 rounded-lg transition">
                            🔐 Connexion
                        </a>
                        <a href="{{ route('register') }}" 
                           class="block px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-500 text-white rounded-lg hover:from-pink-600 hover:to-purple-600 transition font-medium">
                            📝 Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- Contenu principal --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                
                {{-- About --}}
                <div>
                    <h3 class="text-lg font-bold mb-4 bg-gradient-to-r from-pink-400 to-purple-400 bg-clip-text text-transparent">
                        ✨ Skincare Guide
                    </h3>
                    <p class="text-gray-400 text-sm">
                        Votre guide complet pour une routine skincare efficace et adaptée à vos besoins.
                    </p>
                </div>

                {{-- Navigation --}}
                <div>
                    <h3 class="text-lg font-bold mb-4">Navigation</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-pink-400 transition">Accueil</a></li>
                        <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-pink-400 transition">Articles</a></li>
                        <li><a href="{{ route('ingredients.index') }}" class="text-gray-400 hover:text-pink-400 transition">Ingrédients</a></li>
                        <li><a href="{{ route('routines.index') }}" class="text-gray-400 hover:text-pink-400 transition">Routines</a></li>
                    </ul>
                </div>

                {{-- Ressources --}}
                <div>
                    <h3 class="text-lg font-bold mb-4">Ressources</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="text-gray-400 hover:text-pink-400 transition">Guide débutant</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-pink-400 transition">FAQ</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-pink-400 transition">Blog</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-pink-400 transition">Contact</a></li>
                    </ul>
                </div>

                {{-- Newsletter --}}
                <div>
                    <h3 class="text-lg font-bold mb-4">Newsletter</h3>
                    <p class="text-gray-400 text-sm mb-4">
                        Recevez nos derniers conseils skincare
                    </p>
                    <form class="flex gap-2">
                        <input type="email" 
                               placeholder="Votre email"
                               class="flex-1 px-3 py-2 rounded-lg bg-gray-800 border border-gray-700 text-sm focus:outline-none focus:border-pink-500">
                        <button type="submit" 
                                class="px-4 py-2 bg-gradient-to-r from-pink-500 to-purple-500 rounded-lg hover:from-pink-600 hover:to-purple-600 transition text-sm font-medium">
                            →
                        </button>
                    </form>
                </div>

            </div>

            {{-- Copyright --}}
            <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
                <p>© {{ date('Y') }} Skincare Guide. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    {{-- Scripts --}}
    <script>
        // Mobile Menu Toggle
        document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });
    </script>

</body>
</html>
