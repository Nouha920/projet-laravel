@if (session('success'))
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-r-lg animate-slide-down">
        <div class="flex items-center">
            <span class="text-green-500 text-xl mr-3">✅</span>
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    </div>
@endif

@if (session('error'))
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg animate-slide-down">
        <div class="flex items-center">
            <span class="text-red-500 text-xl mr-3">❌</span>
            <p class="text-red-800 font-medium">{{ session('error') }}</p>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-r-lg animate-slide-down">
        <div class="flex items-start">
            <span class="text-red-500 text-xl mr-3">⚠️</span>
            <div>
                <h3 class="font-semibold text-red-800 mb-2">Erreurs de validation</h3>
                <ul class="space-y-1">
                    @foreach ($errors->all() as $error)
                        <li class="text-red-700 text-sm">• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif

<style>
    @keyframes slide-down {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-slide-down {
        animation: slide-down 0.3s ease-out;
    }
</style>