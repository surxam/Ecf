 @extends('layouts.app')

 @section('content')

    <!-- Main Content -->
    <div class="max-w-[935px] mx-auto px-5 pt-[30px] pb-[60px]">
        
        <!-- Profile Header - CENTRÉ -->
        <div class="flex flex-col items-center text-center mb-11 pb-11 border-b border-[#333333]">
            
            <div class="mb-5 flex items-center justify-center">
                <div class="w-[150px] h-[150px] rounded-full overflow-hidden border-3 border-transparent bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] p-[3px]">
                    @if(auth()->user()->profilepicture)
                        <img src="{{ asset('storage/' . auth()->user()->profilepicture) }}" alt="{{ auth()->user()->username }}" class="w-full h-full rounded-full object-cover bg-gradient-to-r from-[#f9a825] to-[#ff9800] flex items-center justify-center text-white text-5xl font-bold">
                    @else
                        <div class="w-full h-full rounded-full bg-gradient-to-r from-[#f9a825] to-[#ff9800] flex items-center justify-center text-white text-5xl font-bold">{{ substr(auth()->user()->username, 0, 1) }}</div>
                    @endif
                </div>
            </div>
            
            <div class="w-full max-w-[600px] flex flex-col items-center">
                <div class="flex flex-col items-center mb-5 w-full">
                    <h1 class="text-[28px] font-light mb-4">{{ auth()->user()->username }}</h1>
                    <div class="flex gap-2 justify-center mb-5 flex-wrap">
                        <a href="{{ route('profile.edit') }}" class="px-4 py-[7px] border-none rounded-lg text-sm font-semibold cursor-pointer transition-all duration-300 bg-[#0095f6] text-white hover:opacity-80 hover:-translate-y-[2px]">
                            <i class="fas fa-edit"></i> Modifier le profil
                        </a>
                    </div>
                </div>
                
                <div class="flex justify-center mb-5 w-full max-w-[400px]">
                    <div class="flex-1 text-center px-2.5">
                        <span class="font-semibold text-white block text-lg mb-1">{{ auth()->user()->posts()->count() }}</span>
                        <span class="text-[#a8a8a8] text-sm">Publications</span>
                    </div>
                    <div class="flex-1 text-center px-2.5">
                        <span class="font-semibold text-white block text-lg mb-1">{{ auth()->user()->followers()->count() }}</span>
                        <span class="text-[#a8a8a8] text-sm">Abonnés</span>
                    </div>
                    <div class="flex-1 text-center px-2.5">
                        <span class="font-semibold text-white block text-lg mb-1">{{ auth()->user()->following()->count() }}</span>
                        <span class="text-[#a8a8a8] text-sm">Abonnements</span>
                    </div>
                </div>
                
                <div class="leading-relaxed text-center max-w-[500px] w-full">
                    <div class="font-semibold text-base mb-2">{{ auth()->user()->name }}</div>
                    <div class="text-white text-sm mb-2.5">
                        {{ auth()->user()->bio ?? 'Pas de bio' }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Profile Tabs -->
        <div class="flex justify-center border-t border-[#333333] mb-10">
            <div class="flex flex-col items-center px-5 py-4 mx-4 text-[#a8a8a8] text-xs font-semibold uppercase tracking-[1px] border-t border-transparent -mt-px cursor-pointer min-w-[120px] hover:text-white active text-white border-t-white" data-tab="posts">
                <i class="fas fa-table-cells-large text-base mb-2"></i>
                <span class="text-center leading-tight">Publications</span>
            </div>
            <div class="flex flex-col items-center px-5 py-4 mx-4 text-[#a8a8a8] text-xs font-semibold uppercase tracking-[1px] border-t border-transparent -mt-px cursor-pointer min-w-[120px] hover:text-white" data-tab="followers">
                <i class="fas fa-users text-base mb-2 text-[#4CAF50] group-hover:text-[#8BC34A]"></i>
                <span class="text-center leading-tight">Abonnés</span>
            </div>
            <div class="flex flex-col items-center px-5 py-4 mx-4 text-[#a8a8a8] text-xs font-semibold uppercase tracking-[1px] border-t border-transparent -mt-px cursor-pointer min-w-[120px] hover:text-white" data-tab="following">
                <i class="fas fa-user-plus text-base mb-2 text-[#2196F3] group-hover:text-[#03A9F4]"></i>
                <span class="text-center leading-tight">Abonnements</span>
            </div>
        </div>
        
        <!-- Contenu des onglets -->
        
        <!-- Onglet Publications (actif par défaut) -->
        <div class="block mb-10" id="posts-tab">
            @if(auth()->user()->posts()->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-7 justify-center">
                    @foreach(auth()->user()->posts()->withCount(['likes', 'comments'])->get() as $post)
                        <div class="aspect-square bg-[#1a1a1a] rounded-[3px] overflow-hidden relative cursor-pointer border border-[#333333] group" data-post-id="{{ $post->id }}">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post" class="w-full h-full object-cover bg-gradient-to-br from-[#667eea] to-[#764ba2]">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-[#667eea] to-[#764ba2] flex items-center justify-center text-white">
                                    <i class="fas fa-image text-4xl"></i>
                                </div>
                            @endif
                            <div class="absolute top-0 left-0 w-full h-full bg-black/50 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="flex items-center gap-8 text-white font-semibold">
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-heart text-xl"></i>
                                        <span>{{ number_format($post->likes_count ?? 0) }}</span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <i class="fas fa-comment text-xl"></i>
                                        <span>{{ $post->comments_count ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-[60px] px-5 text-[#a8a8a8]">
                    <i class="fas fa-image text-5xl mb-5 block opacity-50"></i>
                    <h3 class="text-2xl mb-2.5 font-light">Aucune publication</h3>
                    <p class="text-base">Vous n'avez pas encore publié de contenu.</p>
                </div>
            @endif
        </div>
        
        <!-- Onglet Abonnés -->
        <div class="hidden mb-10" id="followers-tab">
            @if(auth()->user()->followers()->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-[repeat(auto-fill,minmax(200px,1fr))] gap-5 mt-5">
                    @foreach(auth()->user()->followers as $follower)
                        <div class="bg-[#1a1a1a] rounded-[10px] p-5 flex flex-col items-center text-center border border-[#333333] hover:-translate-y-1 transition-transform duration-300" data-user-id="{{ $follower->id }}">
                            <div class="w-[60px] h-[60px] rounded-full bg-gradient-to-r from-[#f9a825] to-[#ff9800] flex items-center justify-center text-white font-bold mb-4 text-2xl">
                                @if($follower->profilepicture)
                                    <img src="{{ asset('storage/' . $follower->profilepicture) }}" alt="{{ $follower->username }}" class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] flex items-center justify-center text-white font-bold text-xl">{{ substr($follower->username, 0, 1) }}</div>
                                @endif
                            </div>
                            <div class="font-semibold mb-1.5">{{ $follower->name ?? $follower->username }}</div>
                            <div class="text-[#a8a8a8] text-sm mb-4">{{'@'. $follower->username }}</div>
                            <button class="px-3 py-1.5 text-xs w-full border-none rounded-lg font-semibold cursor-pointer transition-all duration-300 bg-[#363636] text-white border border-[#333333] hover:bg-[#444] hover:-translate-y-[2px] follow-btn" 
                                    data-user-id="{{ $follower->id }}"
                                    data-is-following="{{ auth()->user()->following()->where('following_id', $follower->id)->exists() ? 'true' : 'false' }}">
                                {{ auth()->user()->following()->where('following_id', $follower->id)->exists() ? 'Suivi' : 'Suivre' }}
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-[60px] px-5 text-[#a8a8a8]">
                    <i class="fas fa-users text-5xl mb-5 block opacity-50"></i>
                    <h3 class="text-2xl mb-2.5 font-light">Aucun abonné</h3>
                    <p class="text-base">Vous n'avez pas encore d'abonnés.</p>
                </div>
            @endif
        </div>
        
        <!-- Onglet Abonnements -->
        <div class="hidden mb-10" id="following-tab">
            @if(auth()->user()->following()->count() > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-[repeat(auto-fill,minmax(200px,1fr))] gap-5 mt-5">
                    @foreach(auth()->user()->following as $followingUser)
                        <div class="bg-[#1a1a1a] rounded-[10px] p-5 flex flex-col items-center text-center border border-[#333333] hover:-translate-y-1 transition-transform duration-300" data-user-id="{{ $followingUser->id }}">
                            <div class="w-[60px] h-[60px] rounded-full bg-gradient-to-r from-[#f9a825] to-[#ff9800] flex items-center justify-center text-white font-bold mb-4 text-2xl">
                                @if($followingUser->profilepicture)
                                    <img src="{{ asset('storage/' . $followingUser->profilepicture) }}" alt="{{ $followingUser->username }}" class="w-full h-full rounded-full object-cover">
                                @else
                                    <div class="w-full h-full rounded-full bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] flex items-center justify-center text-white font-bold text-xl">{{ substr($followingUser->username, 0, 1) }}</div>
                                @endif
                            </div>
                            <div class="font-semibold mb-1.5">{{ $followingUser->name ?? $followingUser->username }}</div>
                            <div class="text-[#a8a8a8] text-sm mb-4">{{'@' . $followingUser->username }}</div>
                            <button class="px-3 py-1.5 text-xs w-full border-none rounded-lg font-semibold cursor-pointer transition-all duration-300 bg-[#363636] text-white border border-[#333333] hover:bg-[#444] hover:-translate-y-[2px] follow-btn" 
                                    data-user-id="{{ $followingUser->id }}"
                                    data-is-following="true">
                                Suivi
                            </button>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-[60px] px-5 text-[#a8a8a8]">
                    <i class="fas fa-user-plus text-5xl mb-5 block opacity-50"></i>
                    <h3 class="text-2xl mb-2.5 font-light">Aucun abonnement</h3>
                    <p class="text-base">Vous ne suivez personne pour le moment.</p>
                </div>
            @endif
        </div>
    </div>


    <style>
        /* Styles complémentaires pour certaines interactions non couvertes par Tailwind */
        .z-100 { z-index: 100; }
        .border-3 { border-width: 3px; }
        .group:hover .group-hover\:text-\[\#8BC34A\] { color: #8BC34A; }
        .group:hover .group-hover\:text-\[\#03A9F4\] { color: #03A9F4; }
        
        @media (max-width: 768px) {
            .md\:grid-cols-\[repeat\(auto-fill\,minmax\(200px\,1fr\)\)\] {
                grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            }
        }
        
        @media (max-width: 480px) {
            .sm\:grid-cols-2 { grid-template-columns: 1fr; }
            .md\:grid-cols-\[repeat\(auto-fill\,minmax\(200px\,1fr\)\)\] { grid-template-columns: 1fr; }
        }
    </style>

    <script>
        // Gestion des onglets
        const tabs = document.querySelectorAll('[data-tab]');
        const tabContents = {
            'posts': document.getElementById('posts-tab'),
            'followers': document.getElementById('followers-tab'),
            'following': document.getElementById('following-tab')
        };
        
        // Initialisation: onglet actif
        document.querySelector('[data-tab="posts"]').classList.add('text-white', 'border-t-white');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                // Retirer la classe active de tous les onglets
                tabs.forEach(t => {
                    t.classList.remove('text-white', 'border-t-white');
                    t.classList.add('text-[#a8a8a8]');
                });
                
                // Ajouter la classe active à l'onglet cliqué
                this.classList.add('text-white', 'border-t-white');
                this.classList.remove('text-[#a8a8a8]');
                
                // Afficher le contenu correspondant
                const tabId = this.dataset.tab;
                Object.values(tabContents).forEach(tc => tc.classList.add('hidden'));
                tabContents[tabId].classList.remove('hidden');
            });
        });
        
        // Follow/Unfollow pour les listes
        document.addEventListener('click', async function(e) {
            if (e.target.classList.contains('follow-btn')) {
                e.stopPropagation();
                const userId = e.target.dataset.userId;
                const isFollowing = e.target.dataset.isFollowing === 'true';
                
                try {
                    const response = await fetch(`/users/${userId}/follow`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                            'Content-Type': 'application/json'
                        }
                    });
                    
                    const data = await response.json();
                    
                    if (data.success) {
                        // Mettre à jour le bouton
                        e.target.dataset.isFollowing = data.isFollowing;
                        e.target.textContent = data.isFollowing ? 'Suivi' : 'Suivre';
                        e.target.className = `px-3 py-1.5 text-xs w-full border-none rounded-lg font-semibold cursor-pointer transition-all duration-300 hover:-translate-y-[2px] follow-btn ${data.isFollowing ? 'bg-[#363636] text-white border border-[#333333] hover:bg-[#444]' : 'bg-[#0095f6] text-white hover:opacity-80'}`;
                        
                        // Mettre à jour le compteur d'abonnés
                        const followersCount = document.querySelectorAll('.stat-number')[1];
                        if (followersCount) {
                            followersCount.textContent = data.followersCount;
                        }
                    }
                } catch (error) {
                    console.error('Erreur lors du follow/unfollow:', error);
                }
            }
        });
        
        // Navigation vers les profils
        document.addEventListener('click', function(e) {
            const userItem = e.target.closest('[data-user-id]');
            if (userItem && !e.target.classList.contains('follow-btn')) {
                const userId = userItem.dataset.userId;
                window.location.href = `/profiles/${userId}`;
            }
        });
        
        // Navigation vers les posts
        document.addEventListener('click', function(e) {
            const postItem = e.target.closest('[data-post-id]');
            if (postItem) {
                const postId = postItem.dataset.postId;
                window.location.href = `/posts/${postId}`;
            }
        });
        
        // Ajouter un effet de survol aux boutons
        document.querySelectorAll('.btn, .follow-btn, a[href*="profile.edit"]').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
 @endsection