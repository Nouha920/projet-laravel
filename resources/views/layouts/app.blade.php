<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Skincare Guide - Votre guide beauté')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'rose-pastel': '#FFE4E9',
                        'vert-mint': '#D4F4DD',
                        'peche': '#FFD9C0',
                        'lavande': '#E8DEF8',
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Navigation -->
    <nav class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center">
                        <span class="text-2xl">🌸</span>
                        <span class="ml-2 text-xl font-bold text-pink-600">Skincare Guide</span>
                    </a>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-pink-600 transition">Accueil</a>
                    <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-pink-600 transition">Articles</a>
                    <a href="{{ route('routines.index') }}" class="text-gray-700 hover:text-pink-600 transition">Routines</a>
                    <a href="{{ route('ingredients.index') }}" class="text-gray-700 hover:text-pink-600 transition">Ingrédients</a>
                    <a href="{{ route('contact.create') }}" class="text-gray-700 hover:text-pink-600 transition">Contact</a>

                    @auth
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-700 hover:text-pink-600 transition">Déconnexion</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-pink-600 transition">Connexion</a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-pink-600 transition">Inscription</a>
                    @endauth
                </div>

                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button id="mobile-menu-btn" class="text-gray-700">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <div class="px-2 pt-2 pb-3 space-y-1">
                <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:bg-pink-50 rounded">Accueil</a>
                <a href="{{ route('articles.index') }}" class="block px-3 py-2 text-gray-700 hover:bg-pink-50 rounded">Articles</a>
                <a href="{{ route('types-peau.index') }}" class="block px-3 py-2 text-gray-700 hover:bg-pink-50 rounded">Types de peau</a>
                <a href="{{ route('routines.index') }}" class="block px-3 py-2 text-gray-700 hover:bg-pink-50 rounded">Routines</a>
                <a href="{{ route('ingredients.index') }}" class="block px-3 py-2 text-gray-700 hover:bg-pink-50 rounded">Ingrédients</a>
                <a href="{{ route('contact.create') }}" class="block px-3 py-2 text-gray-700 hover:bg-pink-50 rounded">Contact</a>

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block px-3 py-2 text-gray-700 hover:bg-pink-50 rounded w-full text-left">Déconnexion</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-700 hover:bg-pink-50 rounded">Connexion</a>
                    <a href="{{ route('register') }}" class="block px-3 py-2 text-gray-700 hover:bg-pink-50 rounded">Inscription</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

 <!-- Footer -->
<footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 py-12">
        <div class="grid md:grid-cols-4 gap-8">
            
            <!-- About -->
            <div>
                <h3 class="text-lg font-bold mb-4 bg-gradient-to-r from-pink-400 to-purple-400 bg-clip-text text-transparent">
                    ✨ Skincare Guide
                </h3>
                <p class="text-gray-400 text-sm">
                    Votre guide complet pour une routine skincare efficace et adaptée à vos besoins.
                </p>
            </div>

            <!-- Navigation -->
            <div>
                <h3 class="text-lg font-bold mb-4">Navigation</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ url('/') }}" class="text-gray-400 hover:text-pink-400 transition">Accueil</a></li>
                    <li><a href="{{ route('articles.index') }}" class="text-gray-400 hover:text-pink-400 transition">Articles</a></li>
                    <li><a href="{{ route('ingredients.index') }}" class="text-gray-400 hover:text-pink-400 transition">Ingrédients</a></li>
                    <li><a href="{{ route('routines.index') }}" class="text-gray-400 hover:text-pink-400 transition">Routines</a></li>
                </ul>
            </div>

            <!-- Ressources -->
            <div>
                <h3 class="text-lg font-bold mb-4">Ressources</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="#" class="text-gray-400 hover:text-pink-400 transition">Guide débutant</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-pink-400 transition">FAQ</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-pink-400 transition">Blog</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-pink-400 transition">Contact</a></li>
                </ul>
            </div>

            <!-- Newsletter -->
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

                <!-- Admin -->
                <div class="mt-6">
                    <h4 class="font-semibold mb-4">Admin</h4>
                    <ul class="space-y-2 text-sm text-gray-600">
                        @auth
                        <li><a href="{{ url('/admin/dashboard') }}" class="hover:text-pink-600">Dashboard</a></li>
                        @endauth
                    </ul>
                </div>
            </div>

        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400 text-sm">
            <p>© {{ date('Y') }} Skincare Guide. Tous droits réservés.</p>
        </div>
    </div>
</footer>

    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-btn').addEventListener('click', function() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        });
    </script>
</body>
</html>
