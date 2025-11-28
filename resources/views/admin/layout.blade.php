<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Skincare</title>
    
    {{-- Tailwind CSS CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    
    {{-- OU si vous utilisez Vite --}}
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body class="bg-gray-50 min-h-screen">
    
    {{-- Include Navigation --}}
    @include('admin.partials.nav')

    {{-- Contenu principal --}}
    <main class="container mx-auto py-8 px-4">
        @yield('content')
    </main>

    {{-- Footer (optionnel) --}}
    <footer class="bg-white border-t border-gray-200 mt-auto py-6">
        <div class="max-w-7xl mx-auto px-6 text-center text-gray-600 text-sm">
            <p>© {{ date('Y') }} Skincare Guide - Admin Panel</p>
        </div>
    </footer>

</body>
</html>
