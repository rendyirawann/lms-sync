<!DOCTYPE html>
<html lang="id" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS Sync - Sederhana & Powerfull</title>
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Instrument+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        body { font-family: 'Instrument Sans', sans-serif; }
        .gradient-text {
            background: linear-gradient(90deg, #6366f1 0%, #a855f7 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .bg-mesh {
            background-color: #ffffff;
            background-image: 
                radial-gradient(at 0% 0%, hsla(253,16%,7%,0.02) 0, transparent 50%), 
                radial-gradient(at 100% 0%, hsla(225,39%,30%,0.03) 0, transparent 50%);
        }
    </style>
</head>
<body class="bg-mesh antialiased h-screen overflow-hidden flex flex-col">

    <!-- Header -->
    <header class="w-full flex-none bg-white/70 backdrop-blur-md border-b border-gray-100">
        <div class="container mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-8">
                <a href="#" class="flex items-center gap-2">
                    <img src="{{ asset('assets/media/landing/logo-landing.png') }}" alt="Logo" class="h-8">
                    <span class="text-xl font-extrabold tracking-tight text-gray-900">LMS</span>
                </a>
                <nav class="hidden lg:flex items-center gap-6 text-xs font-bold text-gray-600 uppercase tracking-wider">
                    <a href="#" class="hover:text-indigo-600 transition">Fitur</a>
                    <a href="#" class="hover:text-indigo-600 transition">Solusi</a>
                    <a href="#" class="hover:text-indigo-600 transition">Sumber Daya</a>
                    <a href="#" class="hover:text-indigo-600 transition">Harga</a>
                </nav>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('student.login') }}" class="text-xs font-bold text-gray-700 px-4 py-2 rounded-full hover:bg-gray-50 transition">Masuk</a>
                <a href="#" class="bg-indigo-600 text-white text-xs font-bold px-6 py-2.5 rounded-xl hover:bg-indigo-700 transition shadow-lg shadow-indigo-200">Mulai Sekarang</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="flex-grow flex flex-col justify-center overflow-hidden">
        <div class="container mx-auto px-6 py-4">
            <!-- Hero Section -->
            <div class="flex flex-col lg:flex-row items-center gap-10">
                <div class="lg:w-5/12">
                    <div class="inline-flex items-center gap-2 bg-indigo-50 text-indigo-700 px-3 py-1.5 rounded-full text-[10px] font-bold mb-4">
                        <span class="flex h-1.5 w-1.5 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-indigo-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-indigo-500"></span>
                        </span>
                        Belajar Cerdas, Masa Depan Cerah
                    </div>
                    <h1 class="text-4xl lg:text-5xl font-extrabold text-gray-900 leading-[1.1] mb-4">
                        Kelola Pembelajaran Jadi Mudah, <br>
                        <span class="gradient-text">Belajar Jadi Lebih Bermakna</span>
                    </h1>
                    <p class="text-sm text-gray-500 mb-6 leading-relaxed max-w-md">
                        LMS adalah platform serba ada untuk membuat, mengelola, dan memberikan pengalaman belajar digital yang interaktif dan modern.
                    </p>
                    <div class="flex items-center gap-4">
                        <a href="#" class="bg-indigo-600 text-white text-sm font-bold px-8 py-3.5 rounded-xl hover:bg-indigo-700 transition shadow-xl shadow-indigo-300 flex items-center gap-2">
                            Mulai Gratis <i data-lucide="arrow-right" class="w-4 h-4"></i>
                        </a>
                        <button class="flex items-center gap-3 group">
                            <span class="w-10 h-10 flex items-center justify-center rounded-full bg-white shadow-lg border border-gray-50 group-hover:scale-105 transition">
                                <i data-lucide="play" class="w-4 h-4 text-indigo-600 fill-indigo-600"></i>
                            </span>
                            <span class="text-xs font-bold text-gray-900">Lihat Demo</span>
                        </button>
                    </div>
                </div>

                <div class="lg:w-7/12">
                    <div class="relative">
                        <img src="{{ asset('assets/media/landing/hero-landing.png') }}" alt="Dashboard" class="rounded-[2rem] shadow-2xl border-4 border-white/50 w-full max-h-[400px] object-cover object-left-top">
                        <div class="absolute -top-6 -right-6 w-20 h-20 bg-indigo-100 rounded-full blur-2xl opacity-50"></div>
                    </div>
                </div>
            </div>

            <!-- Trusted By -->
            <div class="mt-12 pt-8 border-t border-gray-100 text-center">
                <p class="text-[10px] font-bold text-indigo-600 tracking-widest uppercase mb-6">Dipercaya oleh 1000+ institusi di seluruh dunia</p>
                <div class="flex flex-wrap justify-center gap-10 opacity-30 grayscale scale-75">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/2f/Google_2015_logo.svg" class="h-6" alt="Google">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/4/44/Microsoft_logo.svg" class="h-6" alt="Microsoft">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/8/8d/Adobe_Systems_logo_and_wordmark.svg" class="h-6" alt="Adobe">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/2/26/Spotify_logo_with_text.svg" class="h-6" alt="Spotify">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a9/Amazon_logo.svg" class="h-6" alt="Amazon">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/d/d5/Dropbox_logo_2017.svg" class="h-6" alt="Dropbox">
                </div>
            </div>
        </div>
    </main>

    <!-- Bottom Container -->
    <div class="flex-none bg-white border-t border-gray-100">
        <div class="container mx-auto px-6 py-6">
            <!-- Features -->
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
                @php
                    $features = [
                        ['icon' => 'layers', 'color' => 'purple', 'title' => 'Buat Kursus', 'desc' => 'Builder materi intuitif'],
                        ['icon' => 'users', 'color' => 'green', 'title' => 'Interaksi', 'desc' => 'Kuis & diskusi aktif'],
                        ['icon' => 'bar-chart-3', 'color' => 'blue', 'title' => 'Analitik', 'desc' => 'Pantau performa'],
                        ['icon' => 'smartphone', 'color' => 'orange', 'title' => 'Mobile', 'desc' => 'Belajar di mana saja'],
                        ['icon' => 'award', 'color' => 'purple', 'title' => 'Sertifikat', 'desc' => 'Apresiasi prestasi'],
                        ['icon' => 'puzzle', 'color' => 'cyan', 'title' => 'Integrasi', 'desc' => 'Terhubung banyak alat']
                    ];
                @endphp
                @foreach($features as $f)
                <div class="bg-gray-50 p-4 rounded-2xl border border-gray-100 flex items-center gap-3">
                    <div class="w-10 h-10 flex-none rounded-xl bg-{{ $f['color'] }}-50 flex items-center justify-center">
                        <i data-lucide="{{ $f['icon'] }}" class="w-5 h-5 text-{{ $f['color'] }}-600"></i>
                    </div>
                    <div>
                        <h4 class="text-[11px] font-extrabold text-gray-900 leading-tight">{{ $f['title'] }}</h4>
                        <p class="text-[9px] text-gray-500 leading-tight">{{ $f['desc'] }}</p>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Stats Bar -->
            <div class="bg-gradient-to-r from-indigo-600 to-purple-600 rounded-2xl p-4 text-white mb-6">
                <div class="grid grid-cols-4 gap-4 text-center divide-x divide-white/10">
                    <div class="flex items-center justify-center gap-3">
                        <i data-lucide="school" class="w-5 h-5 opacity-70"></i>
                        <div class="text-left">
                            <span class="text-sm font-extrabold block">1,200+</span>
                            <span class="text-[8px] text-indigo-100 font-bold uppercase tracking-widest">Institusi</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-3">
                        <i data-lucide="book-open" class="w-5 h-5 opacity-70"></i>
                        <div class="text-left">
                            <span class="text-sm font-extrabold block">45,000+</span>
                            <span class="text-[8px] text-indigo-100 font-bold uppercase tracking-widest">Materi</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-3">
                        <i data-lucide="users-2" class="w-5 h-5 opacity-70"></i>
                        <div class="text-left">
                            <span class="text-sm font-extrabold block">2.5M+</span>
                            <span class="text-[8px] text-indigo-100 font-bold uppercase tracking-widest">Siswa Aktif</span>
                        </div>
                    </div>
                    <div class="flex items-center justify-center gap-3">
                        <i data-lucide="smile" class="w-5 h-5 opacity-70"></i>
                        <div class="text-left">
                            <span class="text-sm font-extrabold block">98%</span>
                            <span class="text-[8px] text-indigo-100 font-bold uppercase tracking-widest">Kepuasan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="flex flex-col md:flex-row justify-between items-center gap-4 text-[10px] font-bold text-gray-400 uppercase tracking-widest border-t border-gray-50 pt-4">
                <p>&copy; 2024 LMS Sync. Hak Cipta Dilindungi.</p>
                <div class="flex gap-8">
                    <a href="#" class="hover:text-indigo-600 transition">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-indigo-600 transition">Syarat & Ketentuan</a>
                    <a href="#" class="hover:text-indigo-600 transition">Pusat Bantuan</a>
                </div>
            </footer>
        </div>
    </div>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
