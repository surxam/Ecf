<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Post - Instagram-like</title>
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
            --btn-secondary-bg: #363636;
            --btn-hover-opacity: 0.8;
            --upload-area-bg: #121212;
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
            justify-content: center;
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

        /* Main Content */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        .page-title {
            font-size: 2rem;
            text-align: center;
            margin-bottom: 40px;
            background: var(--instagram-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        /* Error/Success Messages */
        .alert {
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: none;
        }

        .alert-error {
            background-color: rgba(237, 73, 86, 0.1);
            border: 1px solid #ed4956;
            color: #ff6b7a;
        }

        .alert-success {
            background-color: rgba(31, 150, 102, 0.1);
            border: 1px solid #1f9666;
            color: #31a24c;
        }

        .alert.show {
            display: block;
        }

        /* Form Card */
        .form-card {
            background-color: var(--bg-card);
            border-radius: 16px;
            border: 1px solid var(--border-color);
            padding: 40px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        /* Image Upload Section */
        .upload-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 30px;
            border: 2px dashed var(--border-color);
            border-radius: 12px;
            background-color: var(--upload-area-bg);
            min-height: 300px;
            transition: all 0.3s;
            margin-bottom: 30px;
            cursor: pointer;
        }

        .upload-section:hover {
            border-color: #555;
        }

        .upload-section.dragover {
            border-color: var(--btn-primary-bg);
            background-color: rgba(0, 149, 246, 0.1);
        }

        .upload-icon {
            font-size: 4rem;
            color: var(--text-secondary);
            margin-bottom: 20px;
        }

        .upload-text {
            color: var(--text-primary);
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .upload-subtext {
            color: var(--text-secondary);
            text-align: center;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .file-input-container {
            position: relative;
            display: inline-block;
        }

        .file-input {
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .upload-btn {
            background-color: var(--btn-primary-bg);
            color: white;
            border: none;
            border-radius: 8px;
            padding: 12px 24px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: opacity 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            position: relative;
        }

        .upload-btn:hover {
            opacity: var(--btn-hover-opacity);
        }

        /* Image Preview */
        .image-preview {
            display: none;
            width: 100%;
            margin-bottom: 20px;
        }

        .image-preview.show {
            display: block;
        }

        .image-preview img {
            width: 100%;
            max-height: 400px;
            border-radius: 8px;
            object-fit: cover;
        }

        .preview-actions {
            margin-top: 10px;
            text-align: center;
        }

        .remove-image-btn {
            background-color: #e74c3c;
            color: white;
            border: none;
            border-radius: 6px;
            padding: 8px 16px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: opacity 0.3s;
        }

        .remove-image-btn:hover {
            opacity: var(--btn-hover-opacity);
        }

        /* Form Section */
        .form-section {
            display: flex;
            flex-direction: column;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-label {
            display: block;
            margin-bottom: 10px;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .label-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .char-count {
            font-size: 0.85rem;
            color: var(--text-secondary);
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
            border-color: #ed4956;
        }

        .caption-input {
            min-height: 100px;
            resize: vertical;
            font-family: inherit;
            line-height: 1.5;
        }

        .hashtag-input {
            font-family: inherit;
        }

        .error-text {
            color: #ff6b7a;
            font-size: 0.85rem;
            margin-top: 6px;
            display: none;
        }

        .error-text.show {
            display: block;
        }

        .hashtag-hint {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-top: 8px;
        }

        /* Submit Section */
        .submit-section {
            display: flex;
            justify-content: flex-end;
            margin-top: 40px;
            gap: 15px;
        }

        .btn {
            padding: 12px 28px;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-secondary {
            background-color: var(--btn-secondary-bg);
            color: var(--text-primary);
        }

        .btn-secondary:hover {
            background-color: #444;
        }

        .btn-primary {
            background-color: var(--btn-primary-bg);
            color: white;
        }

        .btn-primary:hover {
            opacity: var(--btn-hover-opacity);
        }

        .btn:disabled {
            opacity: 0.5;
            cursor: not-allowed;
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
        @media (max-width: 768px) {
            .navbar {
                justify-content: center;
            }
            
            .logo {
                font-size: 1.5rem;
            }
            
            .container {
                padding: 30px 15px;
            }
            
            .form-card {
                padding: 30px 20px;
            }
            
            .upload-section {
                min-height: 250px;
                padding: 20px;
            }
            
            .upload-icon {
                font-size: 3rem;
            }
        }

        @media (max-width: 480px) {
            .page-title {
                font-size: 1.7rem;
                margin-bottom: 30px;
            }
            
            .upload-text {
                font-size: 1.1rem;
            }
            
            .form-label {
                font-size: 1rem;
            }
            
            .submit-section {
                flex-direction: column;
            }
            
            .btn {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <nav class="navbar">
            <a href="{{ route('posts.index') }}" class="logo" style="text-decoration:none">
                <i class="fab fa-instagram"></i> Instagram
            </a>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="container">
        <h1 class="page-title">📸 Nouveau Post</h1>

        @if($errors->any())
            <div class="alert alert-error show">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="successAlert" class="alert alert-success">
            ✅ Post créé avec succès !
        </div>
        
        <div class="form-card">
            <form id="createPostForm" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Image Upload Section -->
                <div id="uploadSection" class="upload-section">
                    <div class="upload-icon">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="upload-text">Téléverser une image</div>
                    <div class="upload-subtext">
                        Cliquez ou glissez une image<br>
                        Formats acceptés : JPG, PNG, GIF (max 2MB)
                    </div>
                    <div class="file-input-container">
                        <input type="file" id="imageInput" name="image" class="file-input" accept="image/*" required>
                        <button type="button" class="upload-btn">
                            <i class="fas fa-image"></i> Choisir une image
                        </button>
                    </div>
                </div>

                <!-- Image Preview -->
                <div id="imagePreview" class="image-preview">
                    <img id="previewImg" src="" alt="Aperçu">
                    <div class="preview-actions">
                        <button type="button" class="remove-image-btn" id="removeImageBtn">
                            <i class="fas fa-trash"></i> Supprimer l'image
                        </button>
                    </div>
                </div>
                
                <!-- Form Section -->
                <div class="form-section">
                    <div class="form-group">
                        <div class="label-info">
                            <label for="caption" class="form-label">Caption</label>
                            <span class="char-count"><span id="captionCount">0</span>/1000</span>
                        </div>
                        <textarea 
                            id="caption" 
                            name="caption" 
                            class="form-input caption-input" 
                            placeholder="Écrivez une légende pour votre post..."
                            rows="4"
                            maxlength="1000"
                        ></textarea>
                        <div class="error-text" id="captionError"></div>
                    </div>
                    
                    <div class="form-group">
                        <label for="hashtags" class="form-label">Hashtags</label>
                        <input 
                            type="text" 
                            id="hashtags" 
                            name="hashtags" 
                            class="form-input hashtag-input" 
                            placeholder="#exemple #instagram #photographie"
                            maxlength="255"
                        >
                        <div class="hashtag-hint">
                            💡 Séparez les hashtags par des espaces
                        </div>
                        <div class="error-text" id="hashtagsError"></div>
                    </div>
                </div>
                
                <!-- Submit Section -->
                <div class="submit-section">
                    <a href="{{ route('posts.index') }}" class="btn btn-secondary">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    <button type="submit" id="submitBtn" class="btn btn-primary" disabled>
                        <i class="fas fa-paper-plane"></i> Publier
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <p>© 2026 Instagram-like. Tous droits réservés.</p>
    </footer>

    <script>
        const imageInput = document.getElementById('imageInput');
        const uploadSection = document.getElementById('uploadSection');
        const imagePreview = document.getElementById('imagePreview');
        const previewImg = document.getElementById('previewImg');
        const removeImageBtn = document.getElementById('removeImageBtn');
        const captionInput = document.getElementById('caption');
        const captionCount = document.getElementById('captionCount');
        const hashtagsInput = document.getElementById('hashtags');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('createPostForm');

        // Drag & Drop
        uploadSection.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadSection.classList.add('dragover');
        });

        uploadSection.addEventListener('dragleave', () => {
            uploadSection.classList.remove('dragover');
        });

        uploadSection.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadSection.classList.remove('dragover');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                imageInput.files = files;
                handleImageSelect();
            }
        });

        // Click to upload
        uploadSection.addEventListener('click', () => {
            imageInput.click();
        });

        // File input change
        imageInput.addEventListener('change', handleImageSelect);

        function handleImageSelect() {
            const file = imageInput.files[0];
            if (!file) return;

            // Validate file type
            if (!file.type.startsWith('image/')) {
                showError('captionError', 'Veuillez sélectionner une image valide');
                imageInput.value = '';
                return;
            }

            // Validate file size (2MB)
            if (file.size > 2 * 1024 * 1024) {
                showError('captionError', 'L\'image doit faire moins de 2MB');
                imageInput.value = '';
                return;
            }

            // Show preview
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                uploadSection.style.display = 'none';
                imagePreview.classList.add('show');
                clearError('captionError');
                checkFormValidity();
            };
            reader.readAsDataURL(file);
        }

        // Remove image
        removeImageBtn.addEventListener('click', (e) => {
            e.preventDefault();
            imageInput.value = '';
            imagePreview.classList.remove('show');
            uploadSection.style.display = 'flex';
            checkFormValidity();
        });

        // Character counter
        captionInput.addEventListener('input', () => {
            captionCount.textContent = captionInput.value.length;
            checkFormValidity();
        });

        // Form validation
        function checkFormValidity() {
            const hasImage = imageInput.files.length > 0;
            const hasCaption = captionInput.value.trim().length > 0;
            submitBtn.disabled = !(hasImage && hasCaption);
        }

        function showError(elementId, message) {
            const errorEl = document.getElementById(elementId);
            errorEl.textContent = message;
            errorEl.classList.add('show');
        }

        function clearError(elementId) {
            const errorEl = document.getElementById(elementId);
            errorEl.classList.remove('show');
        }

        // Form submission
        form.addEventListener('submit', (e) => {
            // Basic validation
            if (!imageInput.files.length) {
                e.preventDefault();
                showError('captionError', 'Veuillez sélectionner une image');
                return;
            }
            if (!captionInput.value.trim()) {
                e.preventDefault();
                showError('captionError', 'La caption est obligatoire');
                return;
            }
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Publication...';
        });

        // Initialize
        checkFormValidity();
    </script>
</body>
</html>