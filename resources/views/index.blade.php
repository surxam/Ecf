<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instagram-like - Actualités</title>
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bg-dark: #0f0f0f;
            --bg-card: #1a1a1a;
            --text-primary: #ffffff;
            --text-secondary: #a8a8a8;
            --instagram-gradient: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%);
            --border-color: #333333;
            --input-bg: #262626;
            --btn-primary-bg: #0095f6;
            --btn-hover-opacity: 0.8;
            --comment-bg: #262626;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-primary);
            min-height: 100vh;
        }

        /* Header */
        header {
            background-color: var(--bg-card);
            border-bottom: 1px solid var(--border-color);
            padding: 0 20px;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 600;
            background: var(--instagram-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .nav-links {
            display: flex;
            gap: 25px;
        }

        .nav-links a {
            color: var(--text-primary);
            text-decoration: none;
            font-size: 1.1rem;
            transition: color 0.3s;
        }

        .nav-links a:hover {
            color: #a8a8a8;
        }

        .nav-links a.active {
            color: #fff;
            font-weight: 600;
        }

        .user-actions {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .profile-icon {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background: var(--instagram-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 30px 20px;
            display: flex;
            gap: 30px;
        }

        /* Feed */
        .feed {
            flex: 1;
            max-width: 700px;
        }

        /* Post Card */
        .post-card {
            background-color: var(--bg-card);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            margin-bottom: 30px;
            overflow: hidden;
        }

        .post-header {
            padding: 16px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
        }

        .post-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--instagram-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .user-info h3 {
            font-size: 1rem;
            margin-bottom: 3px;
        }

        .user-info span {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .post-options {
            color: var(--text-primary);
            font-size: 1.2rem;
            cursor: pointer;
        }

        .post-image {
            width: 100%;
            height: 420px;
            display: block;
            object-fit: cover;
        }

        .post-actions {
            padding: 16px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid var(--border-color);
        }

        .actions-left {
            display: flex;
            gap: 16px;
        }

        .action-btn {
            background: none;
            border: none;
            color: var(--text-primary);
            font-size: 1.5rem;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .action-btn:hover {
            transform: scale(1.1);
        }

        .action-btn.liked {
            color: #ed4956;
        }

        .post-stats {
            padding: 0 16px;
            margin-top: 12px;
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .post-description {
            padding: 16px;
            padding-top: 8px;
        }

        .post-description .author {
            font-weight: 600;
            margin-right: 8px;
        }

        .post-description .text {
            color: var(--text-primary);
        }

        /* Comments Section */
        .comments-section {
            padding: 0 16px 16px;
        }

        .comment {
            display: flex;
            margin-bottom: 12px;
        }

        .comment-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--instagram-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9rem;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .comment-content {
            flex: 1;
            background-color: var(--comment-bg);
            padding: 10px 14px;
            border-radius: 18px;
        }

        .comment-author {
            font-weight: 600;
            margin-bottom: 4px;
        }

        .comment-text {
            color: var(--text-primary);
            line-height: 1.4;
        }

        .add-comment {
            display: flex;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid var(--border-color);
        }

        .comment-input {
            flex: 1;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 20px;
            padding: 10px 16px;
            color: var(--text-primary);
            font-size: 0.95rem;
        }

        .comment-input:focus {
            outline: none;
            border-color: #555;
        }

        .post-comment-btn {
            background: var(--btn-primary-bg);
            color: white;
            border: none;
            border-radius: 20px;
            padding: 10px 20px;
            margin-left: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .post-comment-btn:hover {
            opacity: var(--btn-hover-opacity);
        }

        /* Sidebar */
        .sidebar {
            width: 350px;
            position: sticky;
            top: 90px;
            height: fit-content;
        }

        .profile-card {
            background-color: var(--bg-card);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 20px;
            margin-bottom: 20px;
        }

        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-avatar {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--instagram-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
            margin-right: 15px;
        }

        .profile-details h2 {
            font-size: 1.2rem;
            margin-bottom: 5px;
        }

        .profile-details p {
            color: var(--text-secondary);
            font-size: 0.9rem;
        }

        .stats {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
        }

        .stat {
            text-align: center;
        }

        .stat-value {
            font-size: 1.1rem;
            font-weight: 600;
            display: block;
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .suggestions {
            background-color: var(--bg-card);
            border-radius: 12px;
            border: 1px solid var(--border-color);
            padding: 20px;
        }

        .suggestions-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
        }

        .suggestions-header h3 {
            font-size: 1.1rem;
        }

        .suggestions-header a {
            color: var(--btn-primary-bg);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
        }

        .suggestions-header a:hover {
            text-decoration: underline;
        }

        .suggestion {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
        }

        .suggestion-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--instagram-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 12px;
        }

        .suggestion-info {
            flex: 1;
        }

        .suggestion-info h4 {
            font-size: 0.95rem;
            margin-bottom: 3px;
        }

        .suggestion-info p {
            color: var(--text-secondary);
            font-size: 0.85rem;
        }

        .follow-btn {
            background: var(--btn-primary-bg);
            color: white;
            border: none;
            border-radius: 6px;
            padding: 6px 12px;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .follow-btn:hover {
            opacity: var(--btn-hover-opacity);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 20px;
            color: var(--text-secondary);
            font-size: 0.9rem;
            border-top: 1px solid var(--border-color);
            margin-top: 40px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .sidebar {
                display: none;
            }
            
            .container {
                justify-content: center;
            }
        }

        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                height: auto;
                padding: 15px 0;
            }
            
            .nav-links {
                margin: 15px 0;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            .user-actions {
                margin-top: 10px;
            }
            
            .container {
                padding: 20px 10px;
            }
        }

        @media (max-width: 480px) {
            .post-header, .post-actions, .post-description, .comments-section {
                padding: 12px;
            }
            
            .comment-input {
                font-size: 0.9rem;
                padding: 8px 12px;
            }
            
            .post-comment-btn {
                padding: 8px 15px;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <div class="logo">
                <i class="fab fa-instagram"></i> Instagram
            </div>
            
            <div class="nav-links">
                <a href="{{ route('posts.index') }}" class="active"><i class="fas fa-home"></i> Actualités</a>
                <a href="{{ route('posts.index') }}"><i class="fas fa-search"></i> Explorer</a>
                <a href="{{ route('posts.create') }}"><i class="fas fa-plus-square"></i> Créer</a>
                <a href="{{ route('dashboard') }}"><i class="fas fa-heart"></i> Notifications</a>
                <a href="{{ route('dashboard') }}"><i class="fas fa-user"></i> Profil</a>
            </div>
            
            <div class="user-actions">
                <a href="{{ route('profile.edit') }}" class="profile-icon">
                    {{ strtoupper(substr(auth()->user()->username ?? auth()->user()->name ?? 'U', 0, 1)) }}
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container">
        <!-- Feed -->
        <div class="feed">
            @forelse($posts as $post)
                <article class="post-card">
                    <div class="post-header">
                        <div class="post-user">
                            <div class="user-avatar">{{ strtoupper(substr($post->user->name ?? ($post->user->username ?? 'U'), 0, 1)) }}</div>
                            <div class="user-info">
                                <h3>{{ $post->user->username ?? $post->user->name ?? 'Auteur' }}</h3>
                                <span>{{ $post->created_at?->diffForHumans() ?? '' }}</span>
                            </div>
                        </div>
                        <div class="post-options">
                            <i class="fas fa-ellipsis-h"></i>
                        </div>
                    </div>

                    @if($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="post-image">
                    @else
                        <div style="height:420px;display:flex;align-items:center;justify-content:center;background:#111;color:#999">Aucune image</div>
                    @endif

                    <div class="post-actions">
                        <div class="actions-left">
                            <form method="POST" action="{{ route('posts.like', $post->id) }}">
                                @csrf
                                <button class="action-btn" title="J'aime">
                                    <i class="far fa-heart"></i>
                                </button>
                            </form>
                            <a href="{{ route('posts.show', $post->id) }}" class="action-btn" title="Commenter">
                                <i class="far fa-comment"></i>
                            </a>
                            <button class="action-btn" title="Partager">
                                <i class="far fa-paper-plane"></i>
                            </button>
                        </div>
                        <div class="actions-right">
                            <button class="action-btn" title="Enregistrer">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>

                    <div class="post-stats">
                        {{ number_format($post->likes_count ?? 0) }} j'aime • {{ $post->comments_count ?? 0 }} commentaires
                    </div>

                    <div class="post-description">
                        <span class="author">{{ $post->user->username ?? $post->user->name ?? 'Auteur' }}</span>
                        <span class="text">{{ \Illuminate\Support\Str::limit($post->caption ?? '', 300) }}</span>
                    </div>

                    <div class="comments-section">
                        <a href="{{ route('posts.show', $post->id) }}" style="color:var(--text-secondary);text-decoration:none">Voir les commentaires et réponses</a>
                    </div>
                </article>
            @empty
                <p class="text-center" style="color:#aaa;padding:40px;">Aucun post pour le moment.</p>
            @endforelse
        </div>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Profile Card -->
            <div class="profile-card">
                <div class="profile-info">
                    <div class="profile-avatar">J</div>
                    <div class="profile-details">
                        <h2>jean_dupont</h2>
                        <p>Jean Dupont</p>
                    </div>
                </div>
                
                <div class="stats">
                    <div class="stat">
                        <span class="stat-value">128</span>
                        <span class="stat-label">Publications</span>
                    </div>
                    <div class="stat">
                        <span class="stat-value">1.2k</span>
                        <span class="stat-label">Abonnés</span>
                    </div>
                    <div class="stat">
                        <span class="stat-value">356</span>
                        <span class="stat-label">Abonnements</span>
                    </div>
                </div>
            </div>
            
            <!-- Suggestions -->
            <div class="suggestions">
                <div class="suggestions-header">
                    <h3>Suggéré pour vous</h3>
                    <a href="#">Voir tout</a>
                </div>
                
                <!-- Suggestion 1 -->
                <div class="suggestion">
                    <div class="suggestion-avatar">V</div>
                    <div class="suggestion-info">
                        <h4>voyages_du_monde</h4>
                        <p>Suggestions pour vous</p>
                    </div>
                    <button class="follow-btn">Suivre</button>
                </div>
                
                <!-- Suggestion 2 -->
                <div class="suggestion">
                    <div class="suggestion-avatar">F</div>
                    <div class="suggestion-info">
                        <h4>fitness_motivation</h4>
                        <p>Populaire</p>
                    </div>
                    <button class="follow-btn">Suivre</button>
                </div>
                
                <!-- Suggestion 3 -->
                <div class="suggestion">
                    <div class="suggestion-avatar">A</div>
                    <div class="suggestion-info">
                        <h4>art_modern</h4>
                        <p>Nouveau sur Instagram</p>
                    </div>
                    <button class="follow-btn">Suivre</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2026 Instagram-like. Tous droits réservés.</p>
    </footer>
</body>
</html>