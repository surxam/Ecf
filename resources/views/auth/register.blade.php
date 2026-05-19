<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Instagram-like</title>
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
            --error-color: #ef4444;
            --success-color: #10b981;
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

        .register-side {
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

        .register-form {
            width: 100%;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            color: var(--text-secondary);
            font-size: 0.9rem;
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

        .form-input.error {
            border-color: var(--error-color);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }

        .form-group.has-error .error-message {
            display: block;
        }

        .password-container {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            font-size: 1rem;
        }

        .requirements {
            margin-top: 5px;
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .requirement {
            display: flex;
            align-items: center;
            margin-bottom: 2px;
        }

        .requirement i {
            margin-right: 5px;
            font-size: 0.7rem;
        }

        .requirement.valid {
            color: var(--success-color);
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
            margin-top: 10px;
            margin-bottom: 20px;
        }

        .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
        }

        .login-link {
            text-align: center;
            margin-top: 25px;
            padding-top: 25px;
            border-top: 1px solid var(--border-color);
            color: var(--text-secondary);
        }

        .login-link a {
            color: var(--btn-primary-bg);
            text-decoration: none;
            font-weight: 600;
        }

        .login-link a:hover {
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

        .terms {
            margin-top: 15px;
            font-size: 0.85rem;
            color: var(--text-secondary);
            text-align: center;
        }

        .terms a {
            color: var(--btn-primary-bg);
            text-decoration: none;
        }

        .terms a:hover {
            text-decoration: underline;
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
            .register-side {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Côté formulaire d'inscription -->
        <div class="register-side">
            <div class="brand">
                <div class="instagram-logo">
                    <i class="fab fa-instagram"></i> Instagram
                </div>
                <div class="brand-subtitle">Inscrivez-vous pour partager des photos et vidéos avec vos amis</div>
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

            <form class="register-form" method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf
                
                <div class="form-group">
                    <label for="name" class="form-label">Nom complet</label>
                    <input type="text" name="name" id="name" class="form-input" placeholder="Votre nom complet" required>
                    <div class="error-message" id="nameError">Veuillez saisir votre nom complet (minimum 2 caractères).</div>
                </div>
                
                <div class="form-group">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" name="username" id="username" class="form-input" placeholder="Choisissez un nom d'utilisateur" required>
                    <div class="error-message" id="usernameError">Le nom d'utilisateur doit contenir entre 3 et 20 caractères (lettres, chiffres, _).</div>
                </div>
                
                <div class="form-group">
                    <label for="email" class="form-label">Adresse e-mail</label>
                    <input type="email" name="email" id="email" class="form-input" placeholder="exemple@email.com" required>
                    <div class="error-message" id="emailError">Veuillez saisir une adresse e-mail valide.</div>
                </div>
                
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <div class="password-container">
                        <input type="password" name="password" id="password" class="form-input" placeholder="Créez un mot de passe sécurisé" required>
                        <button type="button" class="password-toggle" id="togglePassword">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="passwordError">Le mot de passe doit contenir au moins 8 caractères avec une majuscule, une minuscule, un chiffre et un caractère spécial.</div>
                    
                    <div class="requirements">
                        <div class="requirement" id="reqLength">
                            <i class="far fa-circle"></i> Au moins 8 caractères
                        </div>
                        <div class="requirement" id="reqUpper">
                            <i class="far fa-circle"></i> Au moins une majuscule
                        </div>
                        <div class="requirement" id="reqLower">
                            <i class="far fa-circle"></i> Au moins une minuscule
                        </div>
                        <div class="requirement" id="reqNumber">
                            <i class="far fa-circle"></i> Au moins un chiffre
                        </div>
                        <div class="requirement" id="reqSpecial">
                            <i class="far fa-circle"></i> Au moins un caractère spécial
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="confirmPassword" class="form-label">Confirmer le mot de passe</label>
                    <div class="password-container">
                        <input type="password" name="password_confirmation" id="confirmPassword" class="form-input" placeholder="Répétez votre mot de passe" required>
                        <button type="button" class="password-toggle" id="toggleConfirmPassword">
                            <i class="far fa-eye"></i>
                        </button>
                    </div>
                    <div class="error-message" id="confirmPasswordError">Les mots de passe ne correspondent pas.</div>
                </div>

                <div class="terms">
                    En vous inscrivant, vous acceptez nos 
                    <a href="#">Conditions d'utilisation</a> et notre 
                    <a href="#">Politique de confidentialité</a>.
                </div>
                
                <button type="submit" class="btn btn-primary" id="submitBtn">S'inscrire</button>
            </form>

            <div class="login-link">
                Vous avez déjà un compte ? <a href="{{ route('login') }}">Connectez-vous</a>
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
                <h2 class="illustration-title">Rejoignez-nous</h2>
                <p class="illustration-text">Créez un compte pour partager vos moments préférés, suivre vos amis et découvrir du contenu inspirant.</p>
                <p class="illustration-text" style="margin-top: 20px;">Notre communauté vous attend ! Inscrivez-vous en quelques secondes et commencez votre expérience.</p>
            </div>
        </div>
    </div>

   <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registerForm');
            const submitBtn = document.getElementById('submitBtn');
            
            // Éléments de formulaire
            const nameInput = document.getElementById('name');
            const usernameInput = document.getElementById('username');
            const emailInput = document.getElementById('email');
            const passwordInput = document.getElementById('password');
            const confirmPasswordInput = document.getElementById('confirmPassword');
            
            // Éléments d'erreur
            const nameError = document.getElementById('nameError');
            const usernameError = document.getElementById('usernameError');
            const emailError = document.getElementById('emailError');
            const passwordError = document.getElementById('passwordError');
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            
            // Éléments de validation du mot de passe
            const reqLength = document.getElementById('reqLength');
            const reqUpper = document.getElementById('reqUpper');
            const reqLower = document.getElementById('reqLower');
            const reqNumber = document.getElementById('reqNumber');
            const reqSpecial = document.getElementById('reqSpecial');
            
            // Fonction pour basculer la visibilité du mot de passe
            function togglePasswordVisibility(inputId, toggleId) {
                const passwordInput = document.getElementById(inputId);
                const toggleBtn = document.getElementById(toggleId);
                
                toggleBtn.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);
                    
                    // Changer l'icône
                    const icon = this.querySelector('i');
                    if (type === 'text') {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            }
            
            // Initialiser les bascules de mot de passe
            togglePasswordVisibility('password', 'togglePassword');
            togglePasswordVisibility('confirmPassword', 'toggleConfirmPassword');
            
            // Fonctions de validation
            function validateName() {
                const name = nameInput.value.trim();
                const isValid = name.length >= 2;
                
                if (!isValid) {
                    nameInput.classList.add('error');
                    nameInput.parentElement.classList.add('has-error');
                } else {
                    nameInput.classList.remove('error');
                    nameInput.parentElement.classList.remove('has-error');
                }
                
                return isValid;
            }
            
            function validateUsername() {
                const username = usernameInput.value.trim();
                const usernameRegex = /^[a-zA-Z0-9_]{3,20}$/;
                const isValid = usernameRegex.test(username);
                
                if (!isValid) {
                    usernameInput.classList.add('error');
                    usernameInput.parentElement.classList.add('has-error');
                } else {
                    usernameInput.classList.remove('error');
                    usernameInput.parentElement.classList.remove('has-error');
                }
                
                return isValid;
            }
            
            function validateEmail() {
                const email = emailInput.value.trim();
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                const isValid = emailRegex.test(email);
                
                if (!isValid) {
                    emailInput.classList.add('error');
                    emailInput.parentElement.classList.add('has-error');
                } else {
                    emailInput.classList.remove('error');
                    emailInput.parentElement.classList.remove('has-error');
                }
                
                return isValid;
            }
            
            function validatePassword() {
                const password = passwordInput.value;
                let isValid = true;
                
                // Validation de la longueur
                const hasLength = password.length >= 8;
                reqLength.classList.toggle('valid', hasLength);
                reqLength.querySelector('i').className = hasLength ? 'fas fa-check-circle' : 'far fa-circle';
                if (!hasLength) isValid = false;
                
                // Validation majuscule
                const hasUpper = /[A-Z]/.test(password);
                reqUpper.classList.toggle('valid', hasUpper);
                reqUpper.querySelector('i').className = hasUpper ? 'fas fa-check-circle' : 'far fa-circle';
                if (!hasUpper) isValid = false;
                
                // Validation minuscule
                const hasLower = /[a-z]/.test(password);
                reqLower.classList.toggle('valid', hasLower);
                reqLower.querySelector('i').className = hasLower ? 'fas fa-check-circle' : 'far fa-circle';
                if (!hasLower) isValid = false;
                
                // Validation chiffre
                const hasNumber = /[0-9]/.test(password);
                reqNumber.classList.toggle('valid', hasNumber);
                reqNumber.querySelector('i').className = hasNumber ? 'fas fa-check-circle' : 'far fa-circle';
                if (!hasNumber) isValid = false;
                
                // Validation caractère spécial
                const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
                reqSpecial.classList.toggle('valid', hasSpecial);
                reqSpecial.querySelector('i').className = hasSpecial ? 'fas fa-check-circle' : 'far fa-circle';
                if (!hasSpecial) isValid = false;
                
                if (!isValid) {
                    passwordInput.classList.add('error');
                    passwordInput.parentElement.classList.add('has-error');
                } else {
                    passwordInput.classList.remove('error');
                    passwordInput.parentElement.classList.remove('has-error');
                }
                
                return isValid;
            }
            
            function validateConfirmPassword() {
                const password = passwordInput.value;
                const confirmPassword = confirmPasswordInput.value;
                const isValid = password === confirmPassword && password !== '';
                
                if (!isValid) {
                    confirmPasswordInput.classList.add('error');
                    confirmPasswordInput.parentElement.classList.add('has-error');
                } else {
                    confirmPasswordInput.classList.remove('error');
                    confirmPasswordInput.parentElement.classList.remove('has-error');
                }
                
                return isValid;
            }
            
            // Valider tous les champs
            function validateAll() {
                const isNameValid = validateName();
                const isUsernameValid = validateUsername();
                const isEmailValid = validateEmail();
                const isPasswordValid = validatePassword();
                const isConfirmPasswordValid = validateConfirmPassword();
                
                return isNameValid && isUsernameValid && isEmailValid && isPasswordValid && isConfirmPasswordValid;
            }
            
            // Événements de validation en temps réel
            nameInput.addEventListener('blur', validateName);
            nameInput.addEventListener('input', validateName);
            
            usernameInput.addEventListener('blur', validateUsername);
            usernameInput.addEventListener('input', validateUsername);
            
            emailInput.addEventListener('blur', validateEmail);
            emailInput.addEventListener('input', validateEmail);
            
            passwordInput.addEventListener('blur', validatePassword);
            passwordInput.addEventListener('input', function() {
                validatePassword();
                // Valider aussi la confirmation si elle a déjà été remplie
                if (confirmPasswordInput.value !== '') {
                    validateConfirmPassword();
                }
            });
            
            confirmPasswordInput.addEventListener('blur', validateConfirmPassword);
            confirmPasswordInput.addEventListener('input', validateConfirmPassword);
            
            // Validation à la soumission du formulaire
            form.addEventListener('submit', function(event) {
                if (!validateAll()) {
                    event.preventDefault();
                    // Forcer l'affichage de toutes les erreurs
                    validateName();
                    validateUsername();
                    validateEmail();
                    validatePassword();
                    validateConfirmPassword();
                    return false;
                }

                // Désactiver le bouton de soumission pour éviter les doubles clics
                submitBtn.disabled = true;
                submitBtn.textContent = 'Inscription en cours...';

                // Laisser le formulaire se soumettre normalement vers Laravel
            });
            
            // Initialiser la validation au chargement
            validateAll();
        });
    </script>
</body>
</html>