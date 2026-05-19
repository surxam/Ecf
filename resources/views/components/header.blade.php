
    <header class="bg-[#1a1a1a] border-b border-[#333333] px-5 sticky top-0 z-100">
        <nav class="flex flex-col md:flex-row justify-between items-center h-auto md:h-[60px] max-w-[1200px] mx-auto py-4 md:py-0">
            <div class="text-[1.8rem] font-semibold bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] bg-clip-text text-transparent">
                <i class="fab fa-instagram"></i> Instagram
            </div>
            
            <div class="flex gap-6 flex-wrap justify-center my-4 md:my-0">
                <a href="{{ route('posts.index') }}" class="text-white font-semibold text-[1.1rem]"><i class="fas fa-home"></i> Actualités</a>
                <a href="#" class="text-[#a8a8a8] hover:text-white text-[1.1rem] transition-colors duration-300"><i class="fas fa-search"></i> Explorer</a>
                <a href="{{ route('posts.create') }}" class="text-[#a8a8a8] hover:text-white text-[1.1rem] transition-colors duration-300"><i class="fas fa-plus-square"></i> Créer</a>
                <a href="{{ route('dashboard') }}" class="text-[#a8a8a8] hover:text-white text-[1.1rem] transition-colors duration-300"><i class="fas fa-heart"></i> Notifications</a>
                <a href="{{ route('dashboard') }}" class="text-[#a8a8a8] hover:text-white text-[1.1rem] transition-colors duration-300"><i class="fas fa-user"></i> Profil</a>
            </div>
            
            <div class="flex items-center gap-4 mt-4 md:mt-0">
                <a href="{{ route('profile.edit') }}" class="w-[30px] h-[30px] rounded-full bg-gradient-to-r from-[#f09433] via-[#dc2743] to-[#bc1888] flex items-center justify-center text-white font-bold">
                    {{ strtoupper(substr(auth()->user()->username ?? auth()->user()->name ?? 'U', 0, 1)) }}
                </a>
            </div>
        </nav>
    </header>