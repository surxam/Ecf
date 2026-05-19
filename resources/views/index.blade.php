 @extends('layouts.app')

 @section('title', 'Acceuil')

 @section('content')
 
    <!-- Main Content -->
    <div class="max-w-[1200px] mx-auto px-5 py-[30px] flex flex-col lg:flex-row gap-[30px]">
        
        <!-- Feed -->
        <div class="flex-1 max-w-[700px] mx-auto lg:mx-0 w-full">
            @forelse($posts as $post)
                <article class="bg-[#1a1a1a] rounded-xl border border-[#333333] mb-8 overflow-hidden">
                    
                    <!-- Post Header -->
                    <div class="p-4 flex items-center justify-between border-b border-[#333333]">
                        <div class="flex items-center gap-3 cursor-pointer post-user" data-user-id="{{ $post->user->id }}">
                            @if($post->user->profilepicture)
                                <img src="{{ asset('storage/' . $post->user->profilepicture) }}" alt="{{ $post->user->username }}" class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] flex items-center justify-center text-white font-bold">
                                    {{ strtoupper(substr($post->user->name ?? ($post->user->username ?? 'U'), 0, 1)) }}
                                </div>
                            @endif
                            <div class="user-info">
                                <h3 class="text-base font-semibold">{{ $post->user->username ?? $post->user->name ?? 'Auteur' }}</h3>
                                <span class="text-[#a8a8a8] text-sm">{{ $post->created_at?->diffForHumans() ?? '' }}</span>
                            </div>
                        </div>
                        <div class="text-white text-xl cursor-pointer">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>

                    <!-- Post Image -->
                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="w-full h-[420px] object-cover">
                    @else
                        <div class="h-[420px] flex items-center justify-center bg-[#111] text-[#999]">Aucune image</div>
                    @endif

                    <!-- Post Actions -->
                    <div class="p-4 flex justify-between border-b border-[#333333]">
                        <div class="flex gap-4">
                            <form method="POST" action="{{ route('posts.like', $post->id) }}">
                                @csrf
                                <button class="bg-none border-none text-white text-2xl cursor-pointer hover:scale-110 transition-transform duration-200" title="J'aime">
                                    <i class="far fa-heart"></i>
                                </button>
                            </form>
                            <a href="{{ route('posts.show', $post->id) }}" class="text-white text-2xl cursor-pointer hover:scale-110 transition-transform duration-200" title="Commenter">
                                <i class="far fa-comment"></i>
                            </a>
                            <button class="bg-none border-none text-white text-2xl cursor-pointer hover:scale-110 transition-transform duration-200" title="Partager">
                                <i class="far fa-paper-plane"></i>
                            </button>
                        </div>
                        <div>
                            <button class="bg-none border-none text-white text-2xl cursor-pointer hover:scale-110 transition-transform duration-200" title="Enregistrer">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Post Stats -->
                    <div class="px-4 mt-3 text-[#a8a8a8] text-sm">
                        {{ number_format($post->likes_count ?? 0) }} j'aime • {{ $post->comments_count ?? 0 }} commentaires
                    </div>

                    <!-- Post Description -->
                    <div class="px-4 pt-2 pb-4">
                        <span class="font-semibold mr-2">{{ $post->user->username ?? $post->user->name ?? 'Auteur' }}</span>
                        <span class="text-white">{{ \Illuminate\Support\Str::limit($post->caption ?? '', 300) }}</span>
                    </div>

                    <!-- Comments Link -->
                    <div class="px-4 pb-4">
                        <a href="{{ route('posts.show', $post->id) }}" class="text-[#a8a8a8] no-underline hover:underline">
                            Voir les commentaires et réponses
                        </a>
                    </div>
                </article>
            @empty
                <p class="text-center text-[#aaa] py-10">Aucun post pour le moment.</p>
            @endforelse
        </div>

        <!-- Sidebar -->
        <div class="hidden lg:block w-[350px] sticky top-[90px] h-fit">
            
            <!-- Profile Card -->
            <div class="bg-[#1a1a1a] rounded-xl border border-[#333333] p-5 mb-5">
                <div class="flex items-center mb-5">
                    <div class="w-[60px] h-[60px] rounded-full bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] flex items-center justify-center text-white font-bold text-2xl mr-4">
                        {{ strtoupper(substr(auth()->user()->username ?? auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="profile-details">
                        <h2 class="text-xl font-semibold">{{ auth()->user()->name }}</h2>
                        <p class="text-[#a8a8a8] text-sm">{{ auth()->user()->username }}</p>
                    </div>
                </div>
                
                <div class="flex justify-between pt-4 border-t border-[#333333]">
                    <div class="text-center">
                        <span class="text-lg font-semibold block">{{ auth()->user()->posts()->count() }}</span>
                        <span class="text-[#a8a8a8] text-sm">Publications</span>
                    </div>
                    <div class="text-center">
                        <span class="text-lg font-semibold block">{{ auth()->user()->followers()->count() }}</span>
                        <span class="text-[#a8a8a8] text-sm">Abonnés</span>
                    </div>
                    <div class="text-center">
                        <span class="text-lg font-semibold block">{{ auth()->user()->following()->count() }}</span>
                        <span class="text-[#a8a8a8] text-sm">Abonnements</span>
                    </div>
                </div>
            </div>
            
            <!-- Suggestions -->
            <div class="bg-[#1a1a1a] rounded-xl border border-[#333333] p-5">
                <div class="flex justify-between mb-4">
                    <h3 class="text-lg font-semibold">Suggéré pour vous</h3>
                    <a href="#" class="text-[#0095f6] text-sm font-semibold no-underline hover:underline">Voir tout</a>
                </div>
                
                <!-- Suggestion 1 -->
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] flex items-center justify-center text-white font-bold mr-3">
                        V
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold">voyages_du_monde</h4>
                        <p class="text-[#a8a8a8] text-xs">Suggestions pour vous</p>
                    </div>
                    <button class="bg-[#0095f6] text-white border-none rounded-md px-3 py-1.5 text-xs font-semibold cursor-pointer hover:opacity-80 transition-opacity duration-300">
                        Suivre
                    </button>
                </div>
                
                <!-- Suggestion 2 -->
                <div class="flex items-center mb-4">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] flex items-center justify-center text-white font-bold mr-3">
                        F
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold">fitness_motivation</h4>
                        <p class="text-[#a8a8a8] text-xs">Populaire</p>
                    </div>
                    <button class="bg-[#0095f6] text-white border-none rounded-md px-3 py-1.5 text-xs font-semibold cursor-pointer hover:opacity-80 transition-opacity duration-300">
                        Suivre
                    </button>
                </div>
                
                <!-- Suggestion 3 -->
                <div class="flex items-center">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] flex items-center justify-center text-white font-bold mr-3">
                        A
                    </div>
                    <div class="flex-1">
                        <h4 class="text-sm font-semibold">art_modern</h4>
                        <p class="text-[#a8a8a8] text-xs">Nouveau sur Instagram</p>
                    </div>
                    <button class="bg-[#0095f6] text-white border-none rounded-md px-3 py-1.5 text-xs font-semibold cursor-pointer hover:opacity-80 transition-opacity duration-300">
                        Suivre
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .z-100 { z-index: 100; }
        
        @media (max-width: 1024px) {
            .lg\:block { display: none; }
            .lg\:w-[350px] { width: 100%; }
            .lg\:mx-0 { margin-left: auto; margin-right: auto; }
        }
        
        @media (max-width: 768px) {
            .md\:h-[60px] { height: auto; }
            .md\:flex-row { flex-direction: column; }
            .md\:py-0 { padding-top: 1rem; padding-bottom: 1rem; }
            .md\:my-0 { margin-top: 1rem; margin-bottom: 1rem; }
            .md\:mt-0 { margin-top: 0.5rem; }
        }
        
        @media (max-width: 480px) {
            .post-image { height: 300px; }
            .text-2xl { font-size: 1.3rem; }
        }
        
        .post-user {
            transition: opacity 0.3s;
        }
        .post-user:hover {
            opacity: 0.8;
        }
    </style>
    <script>
        // Gestion du clic sur l'avatar de l'utilisateur pour rediriger vers son profil
        document.addEventListener('click', function(e) {
            const postUser = e.target.closest('.post-user');
            if (postUser && postUser.dataset.userId) {
                e.preventDefault();
                const userId = postUser.dataset.userId;
                window.location.href = `/profiles/${userId}`;
            }
        });

        // Effet de survol pour l'avatar
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.post-user').forEach(postUser => {
                postUser.addEventListener('mouseenter', function() {
                    this.style.opacity = '0.8';
                    this.style.transition = 'opacity 0.3s';
                });
                
                postUser.addEventListener('mouseleave', function() {
                    this.style.opacity = '1';
                });
            });
        });
    </script>
 @endsection
