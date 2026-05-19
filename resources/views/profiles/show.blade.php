
 @extends('layouts.app')

 @section('content')
    <!-- Main Content -->
    <div class="container">
        <!-- Profile Header -->
        <div class="profile-header">
            <div class="profile-avatar">
                <div class="avatar-container">
                    @if($user->profilepicture)
                        <img src="{{ asset('storage/' . $user->profilepicture) }}" alt="{{ $user->username }}" class="avatar-img">
                    @else
                        <div class="avatar-placeholder">{{ substr($user->username, 0, 1) }}</div>
                    @endif
                </div>
            </div>
            
            <div class="profile-info">
                <div class="profile-top">
                    <h1 class="profile-username">{{ $user->username }}</h1>
                    <div class="profile-actions">
                        @if(auth()->id() !== $user->id)
                            <button class="btn {{ $isFollowing ? 'btn-secondary' : 'btn-primary' }}" 
                                    id="follow-btn" 
                                    data-user-id="{{ $user->id }}" 
                                    data-is-following="{{ $isFollowing }}">
                                {{ $isFollowing ? 'Suivi' : 'Suivre' }}
                            </button>
                        @endif
                        <button class="btn btn-secondary">
                            <i class="fas fa-envelope"></i> Message
                        </button>
                        @if(auth()->id() !== $user->id)
                            <button class="btn-icon">
                                <i class="fas fa-user-plus"></i>
                            </button>
                        @endif
                    </div>
                </div>
                
                <div class="profile-stats">
                    <div class="stat">
                        <span class="stat-number">{{ $user->posts()->count() }}</span>
                        <span class="stat-label">Publications</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">{{ $user->followers()->count() }}</span>
                        <span class="stat-label">Abonnés</span>
                    </div>
                    <div class="stat">
                        <span class="stat-number">{{ $user->following()->count() }}</span>
                        <span class="stat-label">Abonnements</span>
                    </div>
                </div>
                
                <div class="profile-bio">
                    <div class="profile-name">{{ $user->name }}</div>
                    <div class="profile-bio-text">
                        {{ $user->bio ?? 'Pas de bio' }}
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Profile Tabs -->
        <div class="profile-tabs">
            <div class="tab active" data-tab="posts">
                <i class="fas fa-table-cells-large tab-icon"></i>
                <span class="tab-text">Publications</span>
            </div>
            <div class="tab" data-tab="followers">
                <i class="fas fa-users tab-icon"></i>
                <span class="tab-text">Abonnés</span>
            </div>
            <div class="tab" data-tab="following">
                <i class="fas fa-user-plus tab-icon"></i>
                <span class="tab-text">Abonnements</span>
            </div>
        </div>
        
        <!-- Contenu des onglets -->
        
        <!-- Onglet Publications (actif par défaut) -->
        <div class="tab-content active" id="posts-tab">
            @if($posts->count() > 0)
                <div class="posts-grid">
                    @foreach($posts as $post)
                        <div class="post-item" data-post-id="{{ $post->id }}">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post" class="post-image">
                            @else
                                <div class="post-placeholder">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                            <div class="post-overlay">
                                <div class="post-stats">
                                    <div class="post-stat">
                                        <i class="fas fa-heart"></i>
                                        <span>{{ $post->likes_count ?? 0 }}</span>
                                    </div>
                                    <div class="post-stat">
                                        <i class="fas fa-comment"></i>
                                        <span>{{ $post->comments_count ?? 0 }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <i class="fas fa-image"></i>
                    <h3>Aucune publication</h3>
                    <p>{{ $user->username }} n'a pas encore publié de contenu.</p>
                </div>
            @endif
        </div>
        
        <!-- Onglet Abonnés -->
        <div class="tab-content" id="followers-tab">
            @forelse($followers as $follower)
                <div class="followers-grid">
                    <div class="follower-item" data-user-id="{{ $follower->id }}">
                        <div class="follower-avatar">
                            @if($follower->profilepicture)
                                <img src="{{ asset('storage/' . $follower->profilepicture) }}" alt="{{ $follower->username }}">
                            @else
                                <div class="avatar-placeholder-small">{{ substr($follower->username, 0, 1) }}</div>
                            @endif
                        </div>
                        <div class="follower-name">{{ $follower->name }}</div>
                        <div class="follower-username">{{ '@' . $follower->username }}</div>
                        @if(auth()->id() !== $follower->id)
                            <button class="btn btn-secondary follow-btn" 
                                    data-user-id="{{ $follower->id }}"
                                    data-is-following="{{ auth()->user()->following()->where('following_id', $follower->id)->exists() }}">
                                {{ auth()->user()->following()->where('following_id', $follower->id)->exists() ? 'Suivi' : 'Suivre' }}
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-users"></i>
                    <h3>Aucun abonné</h3>
                    <p>{{ $user->username }} n'a pas encore d'abonnés.</p>
                </div>
            @endforelse
        </div>
        
        <!-- Onglet Abonnements -->
        <div class="tab-content" id="following-tab">
            @forelse($following as $followingUser)
                <div class="following-grid">
                    <div class="following-item" data-user-id="{{ $followingUser->id }}">
                        <div class="following-avatar">
                            @if($followingUser->profilepicture)
                                <img src="{{ asset('storage/' . $followingUser->profilepicture) }}" alt="{{ $followingUser->username }}">
                            @else
                                <div class="avatar-placeholder-small">{{ substr($followingUser->username, 0, 1) }}</div>
                            @endif
                        </div>
                        <div class="following-name">{{ $followingUser->name }}</div>
                        <div class="following-username">{{'@'. $followingUser->username }}</div>
                        @if(auth()->id() !== $followingUser->id)
                            <button class="btn btn-secondary follow-btn" 
                                    data-user-id="{{ $followingUser->id }}"
                                    data-is-following="true">
                                Suivi
                            </button>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-user-plus"></i>
                    <h3>Aucun abonnement</h3>
                    <p>{{ $user->username }} ne suit personne pour le moment.</p>
                </div>
            @endforelse
        </div>
    </div>

    <script>
        // Gestion des onglets
        const tabs = document.querySelectorAll('.tab');
        const tabContents = document.querySelectorAll('.tab-content');
        
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                const targetTab = this.dataset.tab;
                
                // Retirer la classe active de tous les onglets et contenus
                tabs.forEach(t => t.classList.remove('active'));
                tabContents.forEach(content => content.classList.remove('active'));
                
                // Ajouter la classe active à l'onglet cliqué et son contenu
                this.classList.add('active');
                document.getElementById(`${targetTab}-tab`).classList.add('active');
            });
        });
        
        // Follow/Unfollow pour le profil principal
        const followBtn = document.getElementById('follow-btn');
        if (followBtn) {
            followBtn.addEventListener('click', async function() {
                const userId = this.dataset.userId;
                const isFollowing = this.dataset.isFollowing === 'true';
                
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
                        this.dataset.isFollowing = data.isFollowing;
                        this.textContent = data.isFollowing ? 'Suivi' : 'Suivre';
                        this.className = `btn ${data.isFollowing ? 'btn-secondary' : 'btn-primary'}`;
                        
                        // Mettre à jour le compteur d'abonnés
                        const followersCount = document.querySelector('.stat:nth-child(2) .stat-number');
                        if (followersCount) {
                            followersCount.textContent = data.followersCount;
                        }
                    }
                } catch (error) {
                    console.error('Erreur lors du follow/unfollow:', error);
                }
            });
        }
        
        // Follow/Unfollow pour les listes
        document.addEventListener('click', async function(e) {
            if (e.target.classList.contains('follow-btn') && e.target.id !== 'follow-btn') {
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
                        e.target.className = `btn ${data.isFollowing ? 'btn-secondary' : 'btn-primary'} follow-btn`;
                    }
                } catch (error) {
                    console.error('Erreur lors du follow/unfollow:', error);
                }
            }
        });
        
        // Navigation vers les profils
        document.addEventListener('click', function(e) {
            const userItem = e.target.closest('.follower-item, .following-item');
            if (userItem && !e.target.classList.contains('follow-btn')) {
                const userId = userItem.dataset.userId;
                window.location.href = `/profiles/${userId}`;
            }
        });
        
        // Navigation vers les posts
        document.addEventListener('click', function(e) {
            const postItem = e.target.closest('.post-item');
            if (postItem) {
                const postId = postItem.dataset.postId;
                window.location.href = `/posts/${postId}`;
            }
        });
        
        // Effet de survol pour les boutons
        document.querySelectorAll('.btn').forEach(button => {
            button.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-2px)';
            });
            
            button.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
 @endsection