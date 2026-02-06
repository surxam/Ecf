<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Instagram-like</title>
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
            --btn-google: #db4437;
            --btn-facebook: #4267B2;
            --btn-hover-opacity: 0.8;
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
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            display: flex;
            max-width: 900px;
            width: 100%;
            background-color: var(--bg-card);
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .login-side {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .instagram-logo {
            font-size: 3.5rem;
            background: var(--instagram-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .brand-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
        }

        .login-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-input {
            width: 100%;
            padding: 14px 16px;
            background-color: var(--input-bg);
            border: 1px solid var(--border-color);
            border-radius: 8px;
            color: var(--text-primary);
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .form-input:focus {
            outline: none;
            border-color: #555;
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .btn:hover {
            opacity: var(--btn-hover-opacity);
        }

        .btn-primary {
            background-color: var(--btn-primary-bg);
            color: white;
            margin-bottom: 20px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 25px 0;
            color: var(--text-secondary);
        }

        .divider::before,
        .divider::after {
            content: "";
            flex: 1;
            height: 1px;
            background-color: var(--border-color);
        }

        .divider span {
            padding: 0 15px;
            font-size: 0.9rem;
        }

        .social-logins {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 25px;
        }

        .btn-google {
            background-color: var(--btn-google);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .btn-facebook {
            background-color: var(--btn-facebook);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            text-decoration: none;
        }

        .forgot-password {
            text-align: center;
            margin-top: 15px;
        }

        .forgot-password a {
            color: var(--btn-primary-bg);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .forgot-password a:hover {
            text-decoration: underline;
        }

        .signup-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        .signup-link a {
            color: var(--btn-primary-bg);
            text-decoration: none;
            font-weight: 600;
        }

        .signup-link a:hover {
            text-decoration: underline;
        }

        .illustration-side {
            flex: 1;
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1611605698323-b1e99cfd37ea?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80');
            background-size: cover;
            background-position: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 40px;
            position: relative;
        }

        .illustration-content {
            text-align: center;
        }

        .illustration-title {
            font-size: 2rem;
            margin-bottom: 15px;
            background: var(--instagram-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .illustration-text {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        .mobile-only {
            display: none;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 0.9rem;
        }

        .alert-error {
            background-color: rgba(220, 38, 38, 0.2);
            border: 1px solid rgba(220, 38, 38, 0.3);
            color: #f87171;
        }

        .alert-success {
            background-color: rgba(34, 197, 94, 0.2);
            border: 1px solid rgba(34, 197, 94, 0.3);
            color: #4ade80;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                max-width: 450px;
            }
            
            .illustration-side {
                display: none;
            }
            
            .mobile-only {
                display: block;
                text-align: center;
                margin-top: 20px;
                color: var(--text-secondary);
            }
        }

        @media (max-width: 480px) {
            .login-side {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Côté formulaire de connexion -->
        <div class="login-side">
            <div class="brand">
                <div class="instagram-logo">
                    <i class="fab fa-instagram"></i> Instagram
                </div>
                <div class="brand-subtitle">Connectez-vous pour découvrir des photos et vidéos de vos amis</div>
            </div>

            <!-- Messages d'erreur/succès Laravel -->
            @if(session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="form-group">
                    <input type="email" name="email" class="form-input" placeholder="Adresse e-mail" required>
                </div>
                
                <div class="form-group">
                    <input type="password" name="password" class="form-input" placeholder="Mot de passe" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Se connecter</button>
            </form>

            <div class="divider">
                <span>OU</span>
            </div>

            <div class="social-logins">
                <!-- Connexion avec Google -->
                <a href="#" class="btn btn-google">
                    <i class="fab fa-google"></i> Se connecter avec Google
                </a>
                
                <!-- Connexion avec Facebook -->
                <a href="#" class="btn btn-facebook">
                    <i class="fab fa-facebook-f"></i> Se connecter avec Facebook
                </a>
            </div>

            <div class="forgot-password">
                <a href="#">Mot de passe oublié ?</a>
            </div>

            <div class="signup-link">
                Vous n'avez pas de compte ? <a href="{{ route('register') }}">Inscrivez-vous</a>
            </div>
            
            <div class="mobile-only">
                <p>Téléchargez l'application.</p>
                <div style="margin-top: 10px;">
                    <i class="fab fa-apple" style="font-size: 1.5rem; margin-right: 10px;"></i>
                    <i class="fab fa-google-play" style="font-size: 1.5rem;"></i>
                </div>
            </div>
        </div>

        <!-- Côté illustration -->
        <div class="illustration-side">
            <div class="illustration-content">
                <h2 class="illustration-title">Bienvenue</h2>
                <p class="illustration-text">Rejoignez notre communauté et partagez vos moments préférés avec vos amis et le monde entier.</p>
                <p class="illustration-text" style="margin-top: 20px;">Découvrez des contenus inspirants et connectez-vous avec des personnes partageant les mêmes centres d'intérêt.</p>
            </div>
        </div>
    </div>
</body>
</html>