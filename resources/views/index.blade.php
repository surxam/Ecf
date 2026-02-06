<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
            <!-- Logo -->
            <div class="text-2xl font-bold text-blue-600">Logo</div>
            
            <!-- Menu Hamburger -->
            <button id="menu-toggle" class="text-gray-600 text-2xl md:hidden">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>

            <!-- Navigation -->
            <nav id="nav-menu" class="hidden md:flex gap-6">
                <a href="#" class="text-gray-600 hover:text-blue-600 transition">Accueil</a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition">Profil</a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition">Messages</a>
                <a href="#" class="text-gray-600 hover:text-blue-600 transition">Paramètres</a>
            </nav>
        </div>

        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t">
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Accueil</a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Profil</a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Messages</a>
            <a href="#" class="block px-4 py-2 text-gray-600 hover:bg-gray-100">Paramètres</a>
        </div>
    </header>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 py-8">
        <!-- Section Titre -->
        <h1 class="text-3xl font-bold text-gray-800 mb-8">Actualités</h1>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($posts ?? [] as $post)
                <!-- Post Card -->
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition">
                    <!-- Image -->
                    <div class="bg-gray-300 h-40 flex items-center justify-center">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="w-full h-full object-cover">
                        @else
                            <span class="text-gray-500 font-semibold">IMG</span>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-4">
                        <!-- Description -->
                        <p class="text-gray-700 text-sm font-semibold mb-2">{{ Str::limit($post->description, 60) }}</p>

                        <!-- Author -->
                        <p class="text-gray-600 text-xs mb-3">
                            <span class="font-semibold">{{ $post->user->name ?? 'Auteur' }}</span>
                        </p>

                        <!-- Actions -->
                        <div class="flex items-center justify-between">
                            <!-- Likes -->
                            <div class="flex items-center gap-2">
                                <button class="text-red-500 hover:text-red-600 transition">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                    </svg>
                                </button>
                                <span class="text-gray-600 text-sm font-semibold">{{ $post->likes_count ?? 0 }}</span>
                            </div>

                            <!-- Comment Button -->
                            <a href="{{ route('posts.show', $post->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded text-sm font-semibold hover:bg-blue-600 transition">
                                Commenter
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <!-- Empty State -->
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">Aucun post pour le moment</p>
                </div>
            @endforelse
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; 2026 Tous droits réservés</p>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const menuToggle = document.getElementById('menu-toggle');
        const mobileMenu = document.getElementById('mobile-menu');
        
        menuToggle?.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
        });
    </script>
</body>
</html>
