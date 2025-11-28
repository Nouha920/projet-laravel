<!-- resources/views/layouts/admin.blade.php -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin - Skincare Guide')</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <aside class="w-64 bg-gray-900 text-white flex-shrink-0">
            <div class="p-6">
                <h2 class="text-2xl font-bold">🌸 Admin</h2>
                <p class="text-sm text-gray-400 mt-1">Skincare Guide</p>
            </div>
            <nav class="mt-6">
                <a href="{{ url('/admin/dashboard') }}" 
                   class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->is('admin') || request()->is('admin/dashboard') ? 'bg-gray-800 border-l-4 border-pink-500' : '' }}">
                    <span class="mr-3">📊</span>
                    Dashboard
                </a>
                <a href="{{ route('admin.articles.index') }}" 
                   class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/articles*') ? 'bg-gray-800 border-l-4 border-pink-500' : '' }}">
                    <span class="mr-3">📝</span>
                    Articles
                </a>
                <a href="{{ route('admin.categories.index') }}" 
                   class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/categories*') ? 'bg-gray-800 border-l-4 border-pink-500' : '' }}">
                    <span class="mr-3">📁</span>
                    Catégories
                </a>
                <a href="{{ route('admin.ingredients.index') }}" 
                   class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/ingredients*') ? 'bg-gray-800 border-l-4 border-pink-500' : '' }}">
                    <span class="mr-3">🍃</span>
                    Ingrédients
                </a>
                <a href="{{ route('admin.routines.index') }}" 
                   class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/routines*') ? 'bg-gray-800 border-l-4 border-pink-500' : '' }}">
                    <span class="mr-3">✨</span>
                    Routines
                </a>
                <a href="{{ route('admin.types-peau.index') }}" 
                   class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/types-peau*') ? 'bg-gray-800 border-l-4 border-pink-500' : '' }}">
                    <span class="mr-3">💧</span>
                    Types de peau
                </a>
                <a href="{{ route('admin.users.index') }}" 
   class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/users*') ? 'bg-gray-800 border-l-4 border-pink-500' : '' }}">
    <span class="mr-3">👥</span>
    Utilisateurs
</a>
                <a href="{{ route('admin.contacts.index') }}" 
                   class="flex items-center px-6 py-3 hover:bg-gray-800 {{ request()->is('admin/contacts*') ? 'bg-gray-800 border-l-4 border-pink-500' : '' }}">
                    <span class="mr-3">💌</span>
                    Messages
                </a>
                <div class="border-t border-gray-800 my-4"></div>
                <a href="{{ route('home') }}" target="_blank" class="flex items-center px-6 py-3 hover:bg-gray-800">
                    <span class="mr-3">🌐</span>
                    Voir le site
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-6 py-3 hover:bg-gray-800 text-left">
                        <span class="mr-3">🚪</span>
                        Déconnexion
                    </button>
                </form>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Bar -->
            <header class="bg-white shadow-sm">
                <div class="px-8 py-4 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-800">@yield('page-title')</h1>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">👤 {{ auth()->user()->name }}</span>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="p-8">
                @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">✅</span>
                        <p class="text-green-700 font-semibold">{{ session('success') }}</p>
                    </div>
                </div>
                @endif

                @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                    <div class="flex items-center">
                        <span class="text-2xl mr-3">❌</span>
                        <p class="text-red-700 font-semibold">{{ session('error') }}</p>
                    </div>
                </div>
                @endif

                @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded">
                    <div class="flex items-start">
                        <span class="text-2xl mr-3">⚠️</span>
                        <div>
                            <p class="text-red-700 font-semibold mb-2">Il y a des erreurs dans le formulaire :</p>
                            <ul class="list-disc list-inside text-red-600 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endif

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>