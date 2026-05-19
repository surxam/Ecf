<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau Post - Instagram-like</title>
    <!-- Tailwind via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome pour les icônes -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#0f0f0f] text-white min-h-screen font-[-apple-system,BlinkMacSystemFont,'Segoe_UI',Roboto,Helvetica,Arial,sans-serif]">

    <!-- Header avec menu de navigation -->
    <header class="bg-[#1a1a1a] border-b border-[#333333] px-5 sticky top-0 z-100">
        <nav class="flex flex-col md:flex-row justify-between items-center h-auto md:h-[60px] max-w-[1200px] mx-auto py-4 md:py-0">
            <a href="{{ route('posts.index') }}" class="text-[1.8rem] font-semibold bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] bg-clip-text text-transparent no-underline">
                <i class="fab fa-instagram"></i> Instagram
            </a>
            
            <div class="flex gap-6 flex-wrap justify-center my-4 md:my-0">
                <a href="{{ route('posts.index') }}" class="text-[#a8a8a8] hover:text-white text-[1.1rem] transition-colors duration-300"><i class="fas fa-home"></i> Actualités</a>
                <a href="{{ route('posts.create') }}" class="text-white font-semibold text-[1.1rem]"><i class="fas fa-plus-square"></i> Nouveau Post</a>
                <a href="#" class="text-[#a8a8a8] hover:text-white text-[1.1rem] transition-colors duration-300"><i class="fas fa-search"></i> Explorer</a>
                <a href="#" class="text-[#a8a8a8] hover:text-white text-[1.1rem] transition-colors duration-300"><i class="fas fa-heart"></i> Notifications</a>
                <a href="{{ route('dashboard') }}" class="text-[#a8a8a8] hover:text-white text-[1.1rem] transition-colors duration-300"><i class="fas fa-user"></i> Profil</a>
            </div>
            
            <div class="flex items-center gap-4 mt-4 md:mt-0">
                <a href="{{ route('profile.edit') }}" class="w-[30px] h-[30px] rounded-full bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] flex items-center justify-center text-white font-bold">
                    {{ substr(auth()->user()->username, 0, 1) }}
                </a>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <div class="max-w-[600px] mx-auto px-5 md:px-5 px-[15px] pt-10 md:pt-10 pt-[30px] pb-[60px] md:pb-[60px] pb-[30px]">
        
        <h1 class="text-2xl md:text-2xl text-[1.7rem] text-center mb-10 md:mb-10 mb-[30px] bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] bg-clip-text text-transparent font-semibold">
            📸 Nouveau Post
        </h1>

        @if($errors->any())
            <div class="p-4 rounded-lg mb-5 block bg-[rgba(237,73,86,0.1)] border border-[#ed4956] text-[#ff6b7a]">
                <ul class="m-0 pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div id="successAlert" class="hidden p-4 rounded-lg mb-5 bg-[rgba(31,150,102,0.1)] border border-[#1f9666] text-[#31a24c]">
            ✅ Post créé avec succès !
        </div>
        
        <div class="bg-[#1a1a1a] rounded-2xl border border-[#333333] p-10 md:p-10 p-[30px_20px] shadow-[0_10px_30px_rgba(0,0,0,0.3)]">
            <form id="createPostForm" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                @csrf

                <!-- Image Upload Section -->
                <div id="uploadSection" class="flex flex-col items-center justify-center p-[30px] md:p-[30px] p-5 border-2 border-dashed border-[#333333] rounded-xl bg-[#121212] min-h-[300px] md:min-h-[300px] min-h-[250px] transition-all duration-300 cursor-pointer mb-8 hover:border-[#555]">
                    <div class="text-5xl md:text-5xl text-4xl text-[#a8a8a8] mb-5">
                        <i class="fas fa-cloud-upload-alt"></i>
                    </div>
                    <div class="text-white text-xl md:text-xl text-[1.1rem] font-semibold mb-2.5">
                        Téléverser une image
                    </div>
                    <div class="text-[#a8a8a8] text-center mb-8 leading-relaxed">
                        Cliquez ou glissez une image<br>
                        Formats acceptés : JPG, PNG, GIF (max 2MB)
                    </div>
                    <div class="relative inline-block">
                        <input type="file" id="imageInput" name="image" class="absolute left-0 top-0 opacity-0 w-full h-full cursor-pointer" accept="image/*" required>
                        <button type="button" class="bg-[#0095f6] text-white border-none rounded-lg px-6 py-3 text-base font-semibold cursor-pointer transition-opacity duration-300 hover:opacity-80 inline-flex items-center gap-2.5 relative">
                            <i class="fas fa-image"></i> Choisir une image
                        </button>
                    </div>
                </div>

                <!-- Image Preview -->
                <div id="imagePreview" class="hidden w-full mb-5">
                    <img id="previewImg" src="" alt="Aperçu" class="w-full max-h-[400px] rounded-lg object-cover">
                    <div class="mt-2.5 text-center">
                        <button type="button" id="removeImageBtn" class="bg-[#e74c3c] text-white border-none rounded-lg px-4 py-2 text-sm cursor-pointer transition-opacity duration-300 hover:opacity-80">
                            <i class="fas fa-trash"></i> Supprimer l'image
                        </button>
                    </div>
                </div>
                
                <!-- Form Section -->
                <div class="flex flex-col">
                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2.5">
                            <label for="caption" class="font-semibold text-[1.1rem] md:text-[1.1rem] text-base">Caption</label>
                            <span class="text-[0.85rem] text-[#a8a8a8]"><span id="captionCount">0</span>/1000</span>
                        </div>
                        <textarea 
                            id="caption" 
                            name="caption" 
                            class="w-full p-[14px_16px] bg-[#262626] border border-[#333333] rounded-lg text-white text-base transition-colors duration-300 focus:outline-none focus:border-[#555] min-h-[100px] resize-y font-inherit leading-relaxed"
                            placeholder="Écrivez une légende pour votre post..."
                            rows="4"
                            maxlength="1000"
                        ></textarea>
                        <div class="text-[#ff6b7a] text-[0.85rem] mt-1.5 hidden" id="captionError"></div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="hashtags" class="block mb-2.5 font-semibold text-[1.1rem] md:text-[1.1rem] text-base">Hashtags</label>
                        <input 
                            type="text" 
                            id="hashtags" 
                            name="hashtags" 
                            class="w-full p-[14px_16px] bg-[#262626] border border-[#333333] rounded-lg text-white text-base transition-colors duration-300 focus:outline-none focus:border-[#555] font-inherit"
                            placeholder="#exemple #instagram #photographie"
                            maxlength="255"
                        >
                        <div class="text-[#a8a8a8] text-[0.9rem] mt-2">
                            💡 Séparez les hashtags par des espaces
                        </div>
                        <div class="text-[#ff6b7a] text-[0.85rem] mt-1.5 hidden" id="hashtagsError"></div>
                    </div>
                </div>
                
                <!-- Submit Section -->
                <div class="flex md:flex-row flex-col justify-end mt-10 gap-4">
                    <a href="{{ route('posts.index') }}" class="md:w-auto w-full px-7 py-3 border-none rounded-lg text-base font-semibold cursor-pointer transition-all duration-300 bg-[#363636] text-white hover:bg-[#444] text-center no-underline">
                        <i class="fas fa-times"></i> Annuler
                    </a>
                    <button type="submit" id="submitBtn" class="md:w-auto w-full px-7 py-3 border-none rounded-lg text-base font-semibold cursor-pointer transition-all duration-300 bg-[#0095f6] text-white hover:opacity-80 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                        <i class="fas fa-paper-plane"></i> Publier
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center p-5 text-[#a8a8a8] text-sm border-t border-[#333333] mt-10">
        <p>© 2026 Instagram-like. Tous droits réservés.</p>
    </footer>

    <style>
        .z-100 { z-index: 100; }
        
        .upload-section.dragover {
            border-color: #0095f6 !important;
            background-color: rgba(0, 149, 246, 0.1) !important;
        }
        
        .error-text.show {
            display: block !important;
        }
        
        .image-preview.show {
            display: block !important;
        }
        
        .alert.show {
            display: block !important;
        }
        
        @media (max-width: 768px) {
            .md\:text-[1.1rem] { font-size: 1rem; }
            .md\:p-10 { padding: 30px 20px; }
            .md\:min-h-[300px] { min-height: 250px; }
            .md\:text-5xl { font-size: 3rem; }
            .md\:text-2xl { font-size: 1.7rem; }
            .md\:px-5 { padding-left: 15px; padding-right: 15px; }
            .md\:pt-10 { padding-top: 30px; }
            .md\:pb-[60px] { padding-bottom: 30px; }
            .md\:mb-10 { margin-bottom: 30px; }
            .md\:text-[1.8rem] { font-size: 1.5rem; }
        }
    </style>

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
        const captionError = document.getElementById('captionError');
        const hashtagsError = document.getElementById('hashtagsError');

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

            if (!file.type.startsWith('image/')) {
                showError(captionError, 'Veuillez sélectionner une image valide');
                imageInput.value = '';
                return;
            }

            if (file.size > 2 * 1024 * 1024) {
                showError(captionError, 'L\'image doit faire moins de 2MB');
                imageInput.value = '';
                return;
            }

            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                uploadSection.style.display = 'none';
                imagePreview.classList.add('show');
                clearError(captionError);
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

        function checkFormValidity() {
            const hasImage = imageInput.files.length > 0;
            const hasCaption = captionInput.value.trim().length > 0;
            submitBtn.disabled = !(hasImage && hasCaption);
        }

        function showError(element, message) {
            element.textContent = message;
            element.classList.add('show');
        }

        function clearError(element) {
            element.classList.remove('show');
        }

        form.addEventListener('submit', (e) => {
            if (!imageInput.files.length) {
                e.preventDefault();
                showError(captionError, 'Veuillez sélectionner une image');
                return;
            }
            if (!captionInput.value.trim()) {
                e.preventDefault();
                showError(captionError, 'La caption est obligatoire');
                return;
            }
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Publication...';
        });

        checkFormValidity();
    </script>
</body>
</html>