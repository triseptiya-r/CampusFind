<!DOCTYPE html>
<html lang="id" class="scroll-smooth h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CampusFind - Sistem Informasi Barang Hilang & Temuan Kampus</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- FontAwesome Icons CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            accent: '#A7E8BD',    // Light Green Accent
                            pastel: '#E8F8ED',    // Pastel Green Accent
                            deep: '#2ba866',      // Primary Text/Button Green
                            hover: '#1e834d',
                        },
                        surface: {
                            bg: '#F5F6F7',        // Light Soft Background Gray
                            card: '#ffffff',      // Pure White Card
                            border: '#E5E7EB',    // Light Gray Border
                            text: '#374151',      // Dark Gray Text
                            muted: '#6B7280'     // Muted Gray
                        }
                    },
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }
        ::-webkit-scrollbar-track {
            background: #F5F6F7;
        }
        ::-webkit-scrollbar-thumb {
            background: #D1D5DB;
            border-radius: 9999px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #A7E8BD;
        }
        .soft-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03), 0 4px 6px -2px rgba(0, 0, 0, 0.01);
        }
        .soft-shadow-hover {
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .soft-shadow-hover:hover {
            box-shadow: 0 15px 30px -5px rgba(167, 232, 189, 0.25), 0 8px 10px -6px rgba(0, 0, 0, 0.02);
            transform: translateY(-2px);
        }
    </style>
</head>
<body class="bg-surface-bg text-surface-text font-sans antialiased h-full flex flex-col md:flex-row overflow-x-hidden selection:bg-brand-pastel selection:text-brand-deep">

    <!-- Mobile Top Header -->
    <header class="md:hidden bg-white border-b border-surface-border p-4 flex items-center justify-between sticky top-0 z-40 shadow-xs">
        <a href="#" onclick="switchTab('beranda')" class="flex items-center gap-2.5">
            <div class="w-9 h-9 rounded-xl bg-brand-pastel border border-brand-accent flex items-center justify-center text-brand-deep font-extrabold text-base">
                <i class="fa-solid fa-radar"></i>
            </div>
            <span class="text-lg font-bold tracking-tight text-slate-800">Campus<span class="text-brand-deep">Find</span></span>
        </a>
        <button id="mobile-sidebar-toggle" aria-label="Toggle Navigation Menu" class="p-2 rounded-xl bg-surface-bg text-surface-text hover:bg-brand-pastel hover:text-brand-deep transition-colors">
            <i class="fa-solid fa-bars text-lg" id="mobile-sidebar-icon"></i>
        </button>
    </header>

    <!-- Sidebar Overlay for Mobile -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/30 backdrop-blur-xs z-40 hidden md:hidden transition-opacity"></div>

    <!-- Vertical Dashboard Sidebar -->
    <aside id="dashboard-sidebar" class="fixed md:static inset-y-0 left-0 z-50 w-64 bg-white border-r border-surface-border flex flex-col justify-between transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out h-full shrink-0 shadow-xs">
        <div class="p-6">
            <!-- Sidebar Logo -->
            <a href="#" onclick="switchTab('beranda')" class="flex items-center gap-3 mb-8 px-2">
                <div class="w-10 h-10 rounded-xl bg-brand-pastel border border-brand-accent flex items-center justify-center text-brand-deep font-extrabold text-xl shadow-xs">
                    <i class="fa-solid fa-radar"></i>
                </div>
                <div>
                    <span class="text-xl font-bold tracking-tight text-slate-800 block leading-none">Campus<span class="text-brand-deep">Find</span></span>
                    <span class="text-[11px] font-medium text-surface-muted">Portal Layanan Kampus</span>
                </div>
            </a>

            <!-- Sidebar Navigation Items -->
            <nav class="space-y-1.5" id="sidebar-nav">
                <button onclick="switchTab('beranda')" data-tab="beranda" class="nav-btn w-full flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm transition-all text-brand-deep bg-brand-pastel border border-brand-accent">
                    <i class="fa-solid fa-house w-5 text-center text-base"></i> Beranda
                </button>
                <button onclick="switchTab('layanan')" data-tab="layanan" class="nav-btn w-full flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm transition-all text-surface-text hover:bg-surface-bg border border-transparent">
                    <i class="fa-solid fa-grid-2 w-5 text-center text-base"></i> Layanan Utama
                </button>
                <button onclick="switchTab('pencarian')" data-tab="pencarian" class="nav-btn w-full flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm transition-all text-surface-text hover:bg-surface-bg border border-transparent">
                    <i class="fa-solid fa-magnifying-glass w-5 text-center text-base"></i> Pencarian Barang
                </button>
                <button onclick="switchTab('katalog')" data-tab="katalog" class="nav-btn w-full flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm transition-all text-surface-text hover:bg-surface-bg border border-transparent">
                    <i class="fa-solid fa-box-archive w-5 text-center text-base"></i> Katalog Barang
                </button>
                <button onclick="switchTab('laporan')" data-tab="laporan" class="nav-btn w-full flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm transition-all text-surface-text hover:bg-surface-bg border border-transparent">
                    <i class="fa-solid fa-pen-to-square w-5 text-center text-base"></i> Form Laporan
                </button>
                <button onclick="switchTab('admin')" data-tab="admin" class="nav-btn w-full flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm transition-all text-surface-text hover:bg-surface-bg border border-transparent">
                    <i class="fa-solid fa-database w-5 text-center text-base"></i> Kelola Admin & DB
                </button>
                <button onclick="switchTab('kontak')" data-tab="kontak" class="nav-btn w-full flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm transition-all text-surface-text hover:bg-surface-bg border border-transparent">
                    <i class="fa-solid fa-phone-volume w-5 text-center text-base"></i> Posko & Kontak
                </button>
            </nav>
        </div>

        <!-- Sidebar Footer Box -->
        <div class="p-4 m-4 bg-brand-pastel border border-brand-accent rounded-2xl text-center space-y-2">
            <div class="w-8 h-8 rounded-full bg-white border border-brand-accent text-brand-deep flex items-center justify-center mx-auto text-sm font-bold">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <p class="text-xs font-bold text-slate-800">Posko Keamanan Pusat</p>
            <p class="text-[11px] text-surface-muted leading-tight">Serahkan atau klaim fisik di Posko Satpam Utama Kampus.</p>
            <button onclick="switchTab('kontak')" class="w-full py-2 bg-brand-deep hover:bg-brand-hover text-white font-bold text-xs rounded-xl shadow-xs transition-colors">
                Detail Posko
            </button>
        </div>
    </aside>

    <!-- Main Dashboard Content Container -->
    <main class="flex-1 flex flex-col min-w-0 h-full overflow-y-auto">

        <!-- Top Bar Header -->
        <div class="bg-white border-b border-surface-border py-4 px-6 md:px-10 flex flex-col sm:flex-row sm:items-center justify-between gap-4 sticky top-0 z-30 shadow-xs">
            <div>
                <h1 class="text-xl font-bold text-slate-800" id="top-bar-title">Beranda Utama</h1>
                <p class="text-xs text-surface-muted" id="top-bar-subtitle">Pusat informasi dan pelaporan barang tercecer di kampus</p>
            </div>
            <div class="flex items-center gap-3">
                <button onclick="switchTab('admin')" class="px-3.5 py-2 bg-surface-bg hover:bg-surface-border text-surface-text border border-surface-border font-bold text-xs rounded-xl transition-all flex items-center gap-2">
                    <i class="fa-solid fa-sliders text-brand-deep"></i> Panel Admin
                </button>
                <button onclick="switchTab('laporan')" class="px-4 py-2 bg-brand-deep hover:bg-brand-hover text-white font-bold text-xs rounded-xl shadow-xs transition-all flex items-center gap-2">
                    <i class="fa-solid fa-plus-circle"></i> Laporkan Barang
                </button>
            </div>
        </div>

        <!-- Content Sections Wrapper -->
        <div class="p-6 md:p-10 max-w-7xl w-full mx-auto space-y-10">

            <!-- SECTION: BERANDA -->
            <section id="section-beranda" class="tab-content space-y-8">
                <!-- Hero Split Layout -->
                <div class="grid lg:grid-cols-12 gap-8 items-stretch">
                    <!-- Left Column: Hero Intro -->
                    <div class="lg:col-span-7 bg-white border border-surface-border rounded-3xl p-8 sm:p-10 soft-shadow flex flex-col justify-between relative overflow-hidden">
                        <div class="space-y-5 relative z-10">
                            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-brand-pastel text-brand-deep text-xs font-bold border border-brand-accent">
                                <span class="w-2 h-2 rounded-full bg-brand-deep animate-pulse"></span>
                                Sistem Terpadu Keamanan Kampus
                            </div>
                            <h2 class="text-3xl sm:text-4xl font-extrabold text-slate-800 leading-tight">
                                Kehilangan / Menemukan Barang? <br/>
                                <span class="text-brand-deep">Temukan & Report di Sini</span>
                            </h2>
                            <p class="text-surface-muted text-xs sm:text-sm leading-relaxed max-w-xl">
                                Layanan pencarian, pelaporan, dan verifikasi barang tercecer civitas akademika kampus secara mudah, transparan, terverifikasi, dan aman.
                            </p>
                        </div>

                        <div class="pt-6 border-t border-surface-border flex flex-wrap gap-3 mt-8">
                            <button onclick="switchTab('pencarian')" class="px-5 py-2.5 bg-brand-deep hover:bg-brand-hover text-white font-bold text-xs rounded-xl shadow-xs transition-all flex items-center gap-2">
                                <i class="fa-solid fa-magnifying-glass"></i> Cari Barang Hilang
                            </button>
                            <button onclick="switchTab('laporan')" class="px-5 py-2.5 bg-brand-pastel text-brand-deep border border-brand-accent font-bold text-xs rounded-xl hover:bg-white transition-all flex items-center gap-2">
                                <i class="fa-solid fa-hand-holding-heart"></i> Serahkan Temuan
                            </button>
                        </div>
                    </div>

                    <!-- Right Column: Informasi Barang Terbaru Feed -->
                    <div class="lg:col-span-5 bg-white border border-surface-border rounded-3xl p-6 sm:p-8 soft-shadow flex flex-col justify-between">
                        <div class="flex items-center justify-between pb-4 border-b border-surface-border">
                            <div class="flex items-center gap-2.5">
                                <div class="w-9 h-9 rounded-xl bg-brand-pastel border border-brand-accent text-brand-deep flex items-center justify-center font-bold text-base">
                                    <i class="fa-solid fa-clock-rotate-left"></i>
                                </div>
                                <h3 class="font-bold text-slate-800 text-sm sm:text-base">Informasi Barang Terbaru</h3>
                            </div>
                            <span class="px-2.5 py-1 bg-surface-bg text-surface-muted text-[11px] font-bold rounded-lg border border-surface-border">Live Feed</span>
                        </div>

                        <!-- Live Feed Container -->
                        <div class="py-4 space-y-3" id="hero-feed-container">
                            <!-- Populated dynamically via JS -->
                        </div>

                        <button onclick="switchTab('katalog')" class="w-full py-2.5 bg-surface-bg hover:bg-brand-pastel hover:text-brand-deep text-surface-text font-bold text-xs rounded-xl border border-surface-border transition-colors flex items-center justify-center gap-2">
                            Lihat Katalog Lengkap <i class="fa-solid fa-arrow-right"></i>
                        </button>
                    </div>
                </div>

                <!-- 4 Interactive Statistic Cards -->
                <div>
                    <div class="mb-4">
                        <h3 class="text-base font-bold text-slate-800">Ringkasan Statistik Sistem</h3>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Stat Card 1 -->
                        <div class="bg-white border border-surface-border rounded-2xl p-5 soft-shadow flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl bg-brand-pastel border border-brand-accent text-brand-deep flex items-center justify-center text-lg font-bold shrink-0">
                                <i class="fa-solid fa-boxes-stacked"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-slate-800 leading-tight" id="stat-total">0</p>
                                <p class="text-[11px] font-semibold text-surface-muted">Total Laporan</p>
                            </div>
                        </div>

                        <!-- Stat Card 2 -->
                        <div class="bg-white border border-surface-border rounded-2xl p-5 soft-shadow flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl bg-amber-50 border border-amber-200 text-amber-600 flex items-center justify-center text-lg font-bold shrink-0">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-slate-800 leading-tight" id="stat-lost">0</p>
                                <p class="text-[11px] font-semibold text-surface-muted">Barang Hilang</p>
                            </div>
                        </div>

                        <!-- Stat Card 3 -->
                        <div class="bg-white border border-surface-border rounded-2xl p-5 soft-shadow flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl bg-brand-pastel border border-brand-accent text-brand-deep flex items-center justify-center text-lg font-bold shrink-0">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-slate-800 leading-tight" id="stat-found">0</p>
                                <p class="text-[11px] font-semibold text-surface-muted">Barang Ditemukan</p>
                            </div>
                        </div>

                        <!-- Stat Card 4 -->
                        <div class="bg-white border border-surface-border rounded-2xl p-5 soft-shadow flex items-center gap-4">
                            <div class="w-11 h-11 rounded-xl bg-blue-50 border border-blue-200 text-blue-600 flex items-center justify-center text-lg font-bold shrink-0">
                                <i class="fa-solid fa-circle-check"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-extrabold text-slate-800 leading-tight" id="stat-claimed">0</p>
                                <p class="text-[11px] font-semibold text-surface-muted">Selesai / Diklaim</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Horizontal 3 Service Cards Overview -->
                <div>
                    <div class="mb-4">
                        <h3 class="text-base font-bold text-slate-800">Tiga Layanan Utama</h3>
                    </div>
                    <div class="grid md:grid-cols-3 gap-6">
                        <!-- Service Card 1 -->
                        <div class="bg-white rounded-3xl p-6 border border-surface-border soft-shadow soft-shadow-hover flex flex-col justify-between space-y-4">
                            <div class="space-y-3">
                                <div class="w-12 h-12 rounded-2xl bg-brand-pastel border border-brand-accent text-brand-deep flex items-center justify-center text-xl font-bold">
                                    <i class="fa-solid fa-bullhorn"></i>
                                </div>
                                <h4 class="text-base font-bold text-slate-800">1. Laporkan Barang Hilang</h4>
                                <p class="text-surface-muted text-xs leading-relaxed">
                                    Kehilangan KTM, dompet, kunci, atau gadget? Daftarkan rincian barang agar terindeks dalam sistem posko satpam.
                                </p>
                            </div>
                            <button onclick="triggerReportType('Hilang')" class="text-brand-deep font-bold text-xs inline-flex items-center gap-1.5 hover:gap-2.5 transition-all">
                                Buat Laporan Kehilangan <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </div>

                        <!-- Service Card 2 -->
                        <div class="bg-white rounded-3xl p-6 border border-surface-border soft-shadow soft-shadow-hover flex flex-col justify-between space-y-4">
                            <div class="space-y-3">
                                <div class="w-12 h-12 rounded-2xl bg-brand-pastel border border-brand-accent text-brand-deep flex items-center justify-center text-xl font-bold">
                                    <i class="fa-solid fa-hand-holding-heart"></i>
                                </div>
                                <h4 class="text-base font-bold text-slate-800">2. Informasi Barang Temuan</h4>
                                <p class="text-surface-muted text-xs leading-relaxed">
                                    Menemukan barang di area kelas, gazebo, atau parkiran? Publikasikan laporannya agar pemilik sah dapat mengenali.
                                </p>
                            </div>
                            <button onclick="triggerReportType('Ditemukan')" class="text-brand-deep font-bold text-xs inline-flex items-center gap-1.5 hover:gap-2.5 transition-all">
                                Laporkan Temuan <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </div>

                        <!-- Service Card 3 -->
                        <div class="bg-white rounded-3xl p-6 border border-surface-border soft-shadow soft-shadow-hover flex flex-col justify-between space-y-4">
                            <div class="space-y-3">
                                <div class="w-12 h-12 rounded-2xl bg-brand-pastel border border-brand-accent text-brand-deep flex items-center justify-center text-xl font-bold">
                                    <i class="fa-solid fa-headset"></i>
                                </div>
                                <h4 class="text-base font-bold text-slate-800">3. Bantuan Pencarian Barang</h4>
                                <p class="text-surface-muted text-xs leading-relaxed">
                                    Perlu verifikasi fisik atau bantuan langsung? Tim satpam siap membantu pencarian barang secara langsung.
                                </p>
                            </div>
                            <button onclick="switchTab('kontak')" class="text-brand-deep font-bold text-xs inline-flex items-center gap-1.5 hover:gap-2.5 transition-all">
                                Hubungi Posko Satpam <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- CTA Banner Horizontal -->
                <div class="bg-brand-pastel border border-brand-accent rounded-3xl p-8 text-slate-800 soft-shadow flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="space-y-1 text-center md:text-left">
                        <span class="px-2.5 py-1 bg-white border border-brand-accent rounded-md text-[11px] font-bold text-brand-deep">Layanan Respon Cepat</span>
                        <h3 class="text-2xl font-extrabold text-slate-800">Menemukan Barang Milik Orang Lain?</h3>
                        <p class="text-surface-muted text-xs">Serahkan ke Posko Satpam Pusat atau umumkan melalui sistem ini.</p>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto shrink-0">
                        <button onclick="triggerReportType('Ditemukan')" class="px-5 py-3 bg-brand-deep hover:bg-brand-hover text-white font-bold text-xs rounded-xl shadow-xs transition-all text-center">
                            <i class="fa-solid fa-hand-holding-heart mr-1.5"></i> Form Barang Temuan
                        </button>
                        <button onclick="switchTab('kontak')" class="px-5 py-3 bg-white text-slate-800 font-bold text-xs rounded-xl border border-surface-border hover:bg-surface-bg transition-colors text-center">
                            <i class="fa-solid fa-location-dot mr-1.5"></i> Lokasi Posko Keamanan
                        </button>
                    </div>
                </div>
            </section>

            <!-- SECTION: LAYANAN UTAMA -->
            <section id="section-layanan" class="tab-content hidden space-y-8">
                <div class="bg-white border border-surface-border rounded-3xl p-8 soft-shadow">
                    <span class="text-brand-deep font-bold text-xs uppercase tracking-wider">Layanan Terpadu</span>
                    <h2 class="text-2xl font-extrabold text-slate-800 mt-1">3 Pilar Utama Layanan Barang Kampus</h2>
                    <p class="text-xs text-surface-muted mt-1">Sistem informasi untuk efisiensi pengembalian barang tercecer.</p>

                    <div class="grid md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-surface-bg p-6 rounded-2xl border border-surface-border space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-white border border-brand-accent text-brand-deep flex items-center justify-center text-xl font-bold">
                                <i class="fa-solid fa-bullhorn"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 text-base">Laporkan Barang Hilang</h3>
                            <p class="text-xs text-surface-muted leading-relaxed">
                                Tuliskan rincian barang tercecer mulai dari nama, kategori, lokasi terakhir, hingga ciri spesifik untuk mempermudah pencarian.
                            </p>
                            <ul class="text-[11px] text-surface-text space-y-2 pt-2 border-t border-surface-border">
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-deep"></i> Perekaman Database Terpusat</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-deep"></i> Pencocokan Otomatis Katalog</li>
                            </ul>
                            <button onclick="triggerReportType('Hilang')" class="w-full py-2.5 bg-brand-deep text-white font-bold text-xs rounded-xl hover:bg-brand-hover transition-colors">
                                Form Barang Hilang
                            </button>
                        </div>

                        <div class="bg-surface-bg p-6 rounded-2xl border border-surface-border space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-white border border-brand-accent text-brand-deep flex items-center justify-center text-xl font-bold">
                                <i class="fa-solid fa-hand-holding-heart"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 text-base">Informasi Barang Temuan</h3>
                            <p class="text-xs text-surface-muted leading-relaxed">
                                Publikasikan barang yang Anda temukan di lingkungan kampus agar pemilik sah dapat melakukan verifikasi dan klaim.
                            </p>
                            <ul class="text-[11px] text-surface-text space-y-2 pt-2 border-t border-surface-border">
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-deep"></i> Perlindungan Informasi Privasi</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-deep"></i> Penitipan Fisik di Posko Pusat</li>
                            </ul>
                            <button onclick="triggerReportType('Ditemukan')" class="w-full py-2.5 bg-brand-deep text-white font-bold text-xs rounded-xl hover:bg-brand-hover transition-colors">
                                Form Barang Temuan
                            </button>
                        </div>

                        <div class="bg-surface-bg p-6 rounded-2xl border border-surface-border space-y-4">
                            <div class="w-12 h-12 rounded-xl bg-white border border-brand-accent text-brand-deep flex items-center justify-center text-xl font-bold">
                                <i class="fa-solid fa-headset"></i>
                            </div>
                            <h3 class="font-bold text-slate-800 text-base">Bantuan Pencarian Barang</h3>
                            <p class="text-xs text-surface-muted leading-relaxed">
                                Bantuan langsung oleh petugas posko keamanan untuk pencocokan bukti fisik, verifikasi KTM/KTP, dan pengambilan barang.
                            </p>
                            <ul class="text-[11px] text-surface-text space-y-2 pt-2 border-t border-surface-border">
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-deep"></i> Hotline WhatsApp 24 Jam</li>
                                <li class="flex items-center gap-2"><i class="fa-solid fa-check text-brand-deep"></i> Layanan Verifikasi Langsung</li>
                            </ul>
                            <button onclick="switchTab('kontak')" class="w-full py-2.5 bg-brand-deep text-white font-bold text-xs rounded-xl hover:bg-brand-hover transition-colors">
                                Kontak Posko Keamanan
                            </button>
                        </div>
                    </div>
                </div>
            </section>

            <!-- SECTION: PENCARIAN BARANG -->
            <section id="section-pencarian" class="tab-content hidden space-y-6">
                <div class="bg-white border border-surface-border rounded-3xl p-8 soft-shadow space-y-6">
                    <div>
                        <span class="text-brand-deep font-bold text-xs uppercase tracking-wider">Modul Pencarian</span>
                        <h2 class="text-2xl font-extrabold text-slate-800 mt-1">Pencarian Barang Berdasarkan Multi-Filter</h2>
                        <p class="text-xs text-surface-muted mt-1">Gunakan kata kunci nama, kategori, lokasi, tanggal, atau status laporan.</p>
                    </div>

                    <!-- Filter Control Panel -->
                    <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-4 p-4 bg-surface-bg rounded-2xl border border-surface-border">
                        <!-- Keyword Field -->
                        <div>
                            <label class="block text-[10px] font-bold text-surface-muted mb-1.5 uppercase">Nama / Kata Kunci</label>
                            <div class="relative">
                                <input type="text" id="search-keyword" oninput="executeSearch()" placeholder="Cari KTM, Helm, Key..." class="w-full bg-white border border-surface-border rounded-xl px-3 py-2 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-brand-accent font-medium">
                                <i class="fa-solid fa-magnifying-glass absolute right-3 top-2.5 text-slate-400 text-xs"></i>
                            </div>
                        </div>

                        <!-- Category Select -->
                        <div>
                            <label class="block text-[10px] font-bold text-surface-muted mb-1.5 uppercase">Kategori</label>
                            <select id="search-category" onchange="executeSearch()" class="w-full bg-white border border-surface-border rounded-xl px-3 py-2 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-semibold cursor-pointer">
                                <option value="ALL">Semua Kategori</option>
                                <option value="Dokumen/KTM">Dokumen & KTM</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Kunci/Aksesori">Kunci & Aksesori</option>
                                <option value="Tas/Pakaian">Tas & Pakaian</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <!-- Location Field -->
                        <div>
                            <label class="block text-[10px] font-bold text-surface-muted mb-1.5 uppercase">Lokasi Kejadian</label>
                            <input type="text" id="search-location" oninput="executeSearch()" placeholder="Cth: Perpustakaan..." class="w-full bg-white border border-surface-border rounded-xl px-3 py-2 text-xs text-slate-800 placeholder-slate-400 focus:outline-none focus:border-brand-accent font-medium">
                        </div>

                        <!-- Date Field -->
                        <div>
                            <label class="block text-[10px] font-bold text-surface-muted mb-1.5 uppercase">Tanggal</label>
                            <input type="date" id="search-date" onchange="executeSearch()" class="w-full bg-white border border-surface-border rounded-xl px-3 py-2 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium">
                        </div>

                        <!-- Status Field -->
                        <div>
                            <label class="block text-[10px] font-bold text-surface-muted mb-1.5 uppercase">Status Barang</label>
                            <select id="search-status" onchange="executeSearch()" class="w-full bg-white border border-surface-border rounded-xl px-3 py-2 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-semibold cursor-pointer">
                                <option value="ALL">Semua Status</option>
                                <option value="Ditemukan">Status: Ditemukan</option>
                                <option value="Hilang">Status: Hilang</option>
                                <option value="Diklaim">Status: Diklaim/Selesai</option>
                            </select>
                        </div>
                    </div>

                    <!-- Reset & Summary Toolbar -->
                    <div class="flex items-center justify-between pt-1">
                        <span class="text-xs text-surface-muted font-medium" id="search-result-count">Menampilkan semua item...</span>
                        <button onclick="resetSearchFilters()" class="text-xs font-bold text-brand-deep hover:underline flex items-center gap-1.5">
                            <i class="fa-solid fa-rotate-left"></i> Reset Filter Pencarian
                        </button>
                    </div>

                    <!-- Search Results Grid Dynamic -->
                    <div id="search-results-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 pt-2">
                        <!-- Populated dynamically via JS -->
                    </div>
                </div>
            </section>

            <!-- SECTION: KATALOG BARANG -->
            <section id="section-katalog" class="tab-content hidden space-y-6">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div>
                        <span class="text-brand-deep font-bold text-xs uppercase tracking-wider">Database Terpusat</span>
                        <h2 class="text-2xl font-extrabold text-slate-800 mt-1">Katalog Barang Hilang & Temuan</h2>
                    </div>

                    <!-- Status Tabs Filter Buttons -->
                    <div class="inline-flex bg-white border border-surface-border p-1 rounded-2xl shadow-xs">
                        <button onclick="filterCatalogStatus('ALL')" id="cat-tab-ALL" class="cat-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-brand-deep text-white">
                            Semua
                        </button>
                        <button onclick="filterCatalogStatus('Ditemukan')" id="cat-tab-Ditemukan" class="cat-tab-btn px-4 py-2 rounded-xl text-xs font-bold text-surface-text hover:text-slate-800 transition-all">
                            Temuan
                        </button>
                        <button onclick="filterCatalogStatus('Hilang')" id="cat-tab-Hilang" class="cat-tab-btn px-4 py-2 rounded-xl text-xs font-bold text-surface-text hover:text-slate-800 transition-all">
                            Hilang
                        </button>
                        <button onclick="filterCatalogStatus('Diklaim')" id="cat-tab-Diklaim" class="cat-tab-btn px-4 py-2 rounded-xl text-xs font-bold text-surface-text hover:text-slate-800 transition-all">
                            Selesai/Diklaim
                        </button>
                    </div>
                </div>

                <!-- Catalog Grid -->
                <div id="catalog-grid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Populated dynamically via JS -->
                </div>
            </section>

            <!-- SECTION: FORM LAPORAN -->
            <section id="section-laporan" class="tab-content hidden space-y-6">
                <div class="max-w-3xl mx-auto bg-white border border-surface-border rounded-3xl p-6 sm:p-10 soft-shadow">
                    <div class="text-center max-w-lg mx-auto mb-8 space-y-1">
                        <span class="text-brand-deep font-bold text-xs uppercase tracking-wider">Formulir Digital</span>
                        <h2 class="text-2xl font-extrabold text-slate-800">Buat Laporan Barang Baru</h2>
                        <p class="text-xs text-surface-muted">Laporan akan tersimpan otomatis di database browser (LocalStorage).</p>
                    </div>

                    <!-- Notification Box -->
                    <div id="form-alert" class="hidden mb-6 p-4 rounded-2xl text-xs font-medium border transition-all"></div>

                    <form id="report-form" onsubmit="handleReportSubmit(event)" class="space-y-6">
                        <!-- Laporan Type Toggle -->
                        <div>
                            <label class="block text-xs font-bold text-slate-800 uppercase tracking-wider mb-2">Jenis Laporan *</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer">
                                    <input type="radio" name="report_type" value="Hilang" checked class="peer sr-only" onchange="updateFormLabels()">
                                    <div class="p-3.5 text-center rounded-2xl border border-surface-border bg-surface-bg text-xs font-bold text-surface-text peer-checked:border-brand-accent peer-checked:bg-brand-pastel peer-checked:text-brand-deep transition-all flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-magnifying-glass-minus text-sm"></i> Saya Kehilangan Barang
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="report_type" value="Ditemukan" class="peer sr-only" onchange="updateFormLabels()">
                                    <div class="p-3.5 text-center rounded-2xl border border-surface-border bg-surface-bg text-xs font-bold text-surface-text peer-checked:border-brand-accent peer-checked:bg-brand-pastel peer-checked:text-brand-deep transition-all flex items-center justify-center gap-2">
                                        <i class="fa-solid fa-hand-holding-medical text-sm"></i> Saya Menemukan Barang
                                    </div>
                                </label>
                            </div>
                        </div>

                        <!-- Reporter Info -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">Nama & NIM Pelapor *</label>
                                <input type="text" id="input-reporter-name" required placeholder="Cth: Ahmad Fikri (21010190)" class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">Nomor WhatsApp *</label>
                                <input type="tel" id="input-reporter-phone" required placeholder="Cth: 081234567890" class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium">
                            </div>
                        </div>

                        <!-- Item Title & Category -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">Nama Barang *</label>
                                <input type="text" id="input-item-title" required placeholder="Cth: KTM Fakultas Teknik / Helm GM Cokelat" class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">Kategori Barang *</label>
                                <select id="input-item-category" required class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-semibold cursor-pointer">
                                    <option value="">-- Pilih Kategori --</option>
                                    <option value="Dokumen/KTM">Dokumen & KTM</option>
                                    <option value="Elektronik">Elektronik</option>
                                    <option value="Kunci/Aksesori">Kunci & Aksesori</option>
                                    <option value="Tas/Pakaian">Tas & Pakaian</option>
                                    <option value="Lainnya">Lainnya</option>
                                </select>
                            </div>
                        </div>

                        <!-- Location & Date -->
                        <div class="grid sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5" id="label-location">Lokasi Kejadian *</label>
                                <input type="text" id="input-item-location" required placeholder="Cth: Ruang Lab 301 / Kantin FEB" class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">Tanggal Kejadian *</label>
                                <input type="date" id="input-item-date" required class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium">
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">Deskripsi & Ciri Spesifik *</label>
                            <textarea id="input-item-desc" rows="3" required placeholder="Gantungan kunci, warna casing, stiker, merek, scratch, atau ciri khas khusus..." class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" class="w-full py-3.5 bg-brand-deep hover:bg-brand-hover text-white font-extrabold text-xs rounded-xl shadow-xs transition-all flex items-center justify-center gap-2">
                            <i class="fa-solid fa-paper-plane"></i> Kirimkan Laporan Sekarang
                        </button>
                    </form>
                </div>
            </section>

            <!-- SECTION: ADMIN MANAGEMENT & VERIFIKASI -->
            <section id="section-admin" class="tab-content hidden space-y-6">
                <div class="bg-white border border-surface-border rounded-3xl p-6 sm:p-8 soft-shadow space-y-6">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-surface-border">
                        <div>
                            <span class="text-brand-deep font-bold text-xs uppercase tracking-wider">Akses Langsung Admin & Database</span>
                            <h2 class="text-2xl font-extrabold text-slate-800 mt-0.5">Manajemen Data & Skema Database</h2>
                            <p class="text-xs text-surface-muted">Kelola status laporan, ekspor SQL/JSON database, edit data, atau atur ulang database LocalStorage.</p>
                        </div>

                        <div class="flex items-center gap-2 flex-wrap">
                            <button onclick="openDatabaseExportModal()" class="px-3.5 py-2 bg-brand-pastel text-brand-deep border border-brand-accent font-bold text-xs rounded-xl hover:bg-brand-accent/20 transition-colors flex items-center gap-1.5">
                                <i class="fa-solid fa-file-code"></i> Ekspor SQL / JSON DB
                            </button>
                            <button onclick="resetDataToDefault()" class="px-3.5 py-2 bg-amber-50 text-amber-700 hover:bg-amber-100 border border-amber-200 font-bold text-xs rounded-xl transition-colors flex items-center gap-1.5">
                                <i class="fa-solid fa-rotate-left"></i> Reset Demo Data
                            </button>
                        </div>
                    </div>

                    <!-- Database Schema Visualizer Card -->
                    <div class="bg-surface-bg border border-surface-border rounded-2xl p-5 space-y-3">
                        <div class="flex items-center justify-between">
                            <h3 class="font-bold text-slate-800 text-xs uppercase tracking-wider flex items-center gap-2">
                                <i class="fa-solid fa-table-cells text-brand-deep"></i> Skema Relasi Tabel Database (`campusfind_db`)
                            </h3>
                            <span class="px-2 py-0.5 bg-emerald-100 text-emerald-800 text-[10px] font-bold rounded-md border border-emerald-200">Active Engine: LocalStorage + SQL Generator</span>
                        </div>
                        <p class="text-[11px] text-surface-muted leading-relaxed">
                            Struktur kolom data yang digunakan pada sistem ini. Anda dapat mengunduh skema SQL (`CREATE TABLE` & `INSERT INTO`) untuk dimasukkan ke MySQL/PostgreSQL/SQLite.
                        </p>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-2 text-[11px] pt-1">
                            <div class="bg-white p-2.5 rounded-xl border border-surface-border">
                                <span class="font-bold text-slate-800 block">id</span>
                                <span class="text-surface-muted text-[10px]">VARCHAR(20) PRIMARY KEY</span>
                            </div>
                            <div class="bg-white p-2.5 rounded-xl border border-surface-border">
                                <span class="font-bold text-slate-800 block">title</span>
                                <span class="text-surface-muted text-[10px]">VARCHAR(255) NOT NULL</span>
                            </div>
                            <div class="bg-white p-2.5 rounded-xl border border-surface-border">
                                <span class="font-bold text-slate-800 block">category</span>
                                <span class="text-surface-muted text-[10px]">ENUM('Dokumen','Elektronik'...)</span>
                            </div>
                            <div class="bg-white p-2.5 rounded-xl border border-surface-border">
                                <span class="font-bold text-slate-800 block">type & status</span>
                                <span class="text-surface-muted text-[10px]">ENUM('Hilang','Ditemukan','Diklaim')</span>
                            </div>
                        </div>
                    </div>

                    <!-- Admin Table Container -->
                    <div class="overflow-x-auto rounded-2xl border border-surface-border">
                        <table class="w-full text-left text-xs text-surface-text">
                            <thead class="bg-surface-bg text-[11px] font-bold uppercase text-slate-800 border-b border-surface-border">
                                <tr>
                                    <th class="p-3.5">ID / Tgl</th>
                                    <th class="p-3.5">Barang & Kategori</th>
                                    <th class="p-3.5">Pelapor & Kontak</th>
                                    <th class="p-3.5">Jenis</th>
                                    <th class="p-3.5">Status Laporan</th>
                                    <th class="p-3.5 text-center">Aksi / Kontrol</th>
                                </tr>
                            </thead>
                            <tbody id="admin-table-body" class="divide-y divide-surface-border bg-white">
                                <!-- Populated dynamically via JS -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <!-- SECTION: KONTAK POSKO -->
            <section id="section-kontak" class="tab-content hidden space-y-8">
                <div class="grid lg:grid-cols-12 gap-8">
                    <!-- Posko Information -->
                    <div class="lg:col-span-5 bg-white border border-surface-border rounded-3xl p-8 soft-shadow space-y-6">
                        <div>
                            <span class="text-brand-deep font-bold text-xs uppercase tracking-wider">Informasi Fisik</span>
                            <h2 class="text-2xl font-extrabold text-slate-800 mt-1">Posko Satpam Pusat</h2>
                            <p class="text-xs text-surface-muted mt-2 leading-relaxed">
                                Seluruh bukti verifikasi fisik barang temuan ditangani langsung di Posko Satpam Utama Kampus. Mohon bawa KTM/KTP resmi.
                            </p>
                        </div>

                        <div class="space-y-4 pt-2">
                            <div class="flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-brand-pastel border border-brand-accent text-brand-deep flex items-center justify-center text-base shrink-0 font-bold">
                                    <i class="fa-solid fa-building-shield"></i>
                                </div>
                                <div>
                                    <h4 class="text-slate-800 font-bold text-sm">Lokasi Posko Pusat</h4>
                                    <p class="text-xs text-surface-muted mt-0.5">Gedung Student Center Lt. 1 (Samping Gerbang Utama Kampus)</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-brand-pastel border border-brand-accent text-brand-deep flex items-center justify-center text-base shrink-0 font-bold">
                                    <i class="fa-solid fa-clock"></i>
                                </div>
                                <div>
                                    <h4 class="text-slate-800 font-bold text-sm">Jam Operasional Verifikasi</h4>
                                    <p class="text-xs text-surface-muted mt-0.5">Senin - Jumat: 07.30 - 17.00 WIB <br/>Sabtu: 08.00 - 13.00 WIB</p>
                                </div>
                            </div>

                            <div class="flex items-start gap-3.5">
                                <div class="w-10 h-10 rounded-xl bg-brand-pastel border border-brand-accent text-brand-deep flex items-center justify-center text-base shrink-0 font-bold">
                                    <i class="fa-brands fa-whatsapp"></i>
                                </div>
                                <div>
                                    <h4 class="text-slate-800 font-bold text-sm">Hotline WhatsApp Emergency</h4>
                                    <p class="text-xs text-surface-muted mt-0.5">+62 812-3456-7890 (Layanan Fast-Response)</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Direct Form -->
                    <div class="lg:col-span-7 bg-white border border-surface-border rounded-3xl p-8 soft-shadow space-y-6">
                        <div>
                            <h3 class="text-xl font-bold text-slate-800">Kirim Pesan ke Posko Keamanan</h3>
                            <p class="text-xs text-surface-muted mt-1">Gunakan formulir ini untuk konfirmasi status penyerahan atau klaim barang.</p>
                        </div>

                        <div id="contact-form-alert" class="hidden p-4 rounded-2xl text-xs font-medium border"></div>

                        <form id="contact-form" onsubmit="handleContactSubmit(event)" class="space-y-4">
                            <div class="grid sm:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">Nama Lengkap *</label>
                                    <input type="text" id="contact-name" required placeholder="Cth: Budi Santoso" class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">No WhatsApp / Email *</label>
                                    <input type="text" id="contact-contact" required placeholder="Cth: 081234567890" class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium">
                                </div>
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">Subjek *</label>
                                <input type="text" id="contact-subject" required placeholder="Cth: Konfirmasi Klaim KTM Teknik #LF-2026-001" class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium">
                            </div>
                            <div>
                                <label class="block text-[11px] font-bold text-slate-800 uppercase tracking-wider mb-1.5">Pesan Detail *</label>
                                <textarea id="contact-message" rows="3" required placeholder="Tuliskan pertanyaan atau deskripsi tambahan..." class="w-full bg-surface-bg border border-surface-border rounded-xl px-4 py-3 text-xs text-slate-800 focus:outline-none focus:border-brand-accent font-medium"></textarea>
                            </div>
                            <button type="submit" class="w-full py-3 bg-brand-deep hover:bg-brand-hover text-white font-bold text-xs rounded-xl shadow-xs transition-colors">
                                Kirimkan Pesan ke Satpam
                            </button>
                        </form>
                    </div>
                </div>
            </section>

        </div>

        <!-- Footer -->
        <!-- Database SQL / JSON Export Modal -->
        <div id="db-modal" class="fixed inset-0 z-50 bg-slate-900/40 backdrop-blur-xs hidden items-center justify-center p-4">
            <div class="bg-white border border-surface-border rounded-3xl max-w-2xl w-full p-6 sm:p-8 space-y-5 relative shadow-xl">
                <button onclick="closeDatabaseExportModal()" aria-label="Close Database Modal" class="absolute top-5 right-5 text-surface-muted hover:text-slate-800 p-2 text-lg">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="space-y-1">
                    <span class="text-brand-deep font-bold text-xs uppercase tracking-wider">Database Exporter & Script</span>
                    <h3 class="text-xl font-bold text-slate-800">Skema SQL & Dataset JSON</h3>
                    <p class="text-xs text-surface-muted">Salin query DDL / DML SQL atau ekspor file JSON untuk integrasi database server.</p>
                </div>

                <div class="flex items-center gap-2 border-b border-surface-border pb-2">
                    <button id="btn-db-tab-sql" onclick="switchDbExportTab('sql')" class="px-4 py-1.5 rounded-xl text-xs font-bold bg-brand-deep text-white transition-all">Script SQL (MySQL/PostgreSQL)</button>
                    <button id="btn-db-tab-json" onclick="switchDbExportTab('json')" class="px-4 py-1.5 rounded-xl text-xs font-bold bg-surface-bg text-surface-text hover:bg-surface-border transition-all">Format Raw JSON</button>
                </div>

                <div class="space-y-2">
                    <div class="relative">
                        <textarea id="db-export-code" readonly rows="10" class="w-full bg-slate-900 text-emerald-400 font-mono text-[11px] p-4 rounded-2xl leading-relaxed focus:outline-none resize-none border border-slate-800"></textarea>
                    </div>
                </div>

                <div class="flex items-center justify-between gap-3 pt-2">
                    <span class="text-[11px] text-surface-muted"><i class="fa-solid fa-info-circle text-brand-deep mr-1"></i>Siap untuk di-import ke MySQL Workbench atau phpMyAdmin.</span>
                    <div class="flex items-center gap-2">
                        <button onclick="copyDbCodeToClipboard()" class="px-4 py-2.5 bg-brand-pastel hover:bg-brand-accent text-brand-deep font-bold text-xs rounded-xl border border-brand-accent transition-colors flex items-center gap-1.5">
                            <i class="fa-regular fa-copy"></i> Salin Kode
                        </button>
                        <button onclick="closeDatabaseExportModal()" class="px-4 py-2.5 bg-surface-bg hover:bg-surface-border text-surface-text font-bold text-xs rounded-xl border border-surface-border transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>

    <!-- Item Detail Pop-up Modal -->
    <div id="item-modal" class="fixed inset-0 z-50 bg-slate-900/30 backdrop-blur-xs hidden items-center justify-center p-4">
        <div class="bg-white border border-surface-border rounded-3xl max-w-lg w-full p-6 sm:p-8 space-y-6 relative shadow-xl">
            <button onclick="closeItemModal()" aria-label="Close Modal" class="absolute top-5 right-5 text-surface-muted hover:text-slate-800 p-2 text-lg">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div id="modal-content">
                <!-- Injected dynamically via JS -->
            </div>
        </div>
    </div>

    <script>
        // Initial Mock Seed Dataset
        const defaultSeedDatabase = [
            {
                id: 'LF-2026-001',
                title: 'KTM Teknik Informatika (a.n. Rian Ardianto)',
                category: 'Dokumen/KTM',
                type: 'Ditemukan',
                location: 'Gedung MIPA Lt. 2 (Ruang 204)',
                date: '2026-03-28',
                reporter: 'Pak Ahmad (Satpam MIPA)',
                phone: '081234560001',
                desc: 'Tercecer di meja baris ketiga. KTM dilengkapi gantungan tali hijau motif kampus.',
                status: 'Ditemukan',
                icon: 'fa-id-card'
            },
            {
                id: 'LF-2026-002',
                title: 'Kunci Motor Honda + Smart Key',
                category: 'Kunci/Aksesori',
                type: 'Ditemukan',
                location: 'Kantin Parkir Barat',
                date: '2026-03-29',
                reporter: 'Ibu Siti (Pengelola Kantin)',
                phone: '081234560002',
                desc: 'Gantungan pita hitam. Terjatuh di area bangku makan outdoor #04.',
                status: 'Ditemukan',
                icon: 'fa-key'
            },
            {
                id: 'LF-2026-003',
                title: 'AirPods Pro Gen 2 Case Transparan',
                category: 'Elektronik',
                type: 'Ditemukan',
                location: 'Perpustakaan Pusat Lt. 3',
                date: '2026-03-27',
                reporter: 'Staf Perpustakaan',
                phone: '081234560003',
                desc: 'Tertinggal di kubikel belajar no 12. Case menggunakan silikon transparan.',
                status: 'Diklaim',
                icon: 'fa-headphones'
            },
            {
                id: 'LF-2026-004',
                title: 'Jaket Parka Hitam Size L',
                category: 'Tas/Pakaian',
                type: 'Hilang',
                location: 'Auditorium Utama Kampus',
                date: '2026-03-29',
                reporter: 'Dina (Mahasiswa BHS)',
                phone: '081234560004',
                desc: 'Hilang saat seminar. Terdapat pin logo himpunan mahasiswa di dada kiri.',
                status: 'Hilang',
                icon: 'fa-shirt'
            },
            {
                id: 'LF-2026-005',
                title: 'Dompet Kulit Cokelat Eiger',
                category: 'Dokumen/KTM',
                type: 'Hilang',
                location: 'Lapangan Basket Outdoor',
                date: '2026-03-30',
                reporter: 'Fikri (Mahasiswa FEB)',
                phone: '081234560005',
                desc: 'Berisi SIM A, KTP, dan kartu debit. Terjatuh di tribun penonton.',
                status: 'Hilang',
                icon: 'fa-wallet'
            }
        ];

        // LocalStorage Management
        function getCatalogData() {
            const data = localStorage.getItem('campusfind_catalog_db');
            if (!data) {
                localStorage.setItem('campusfind_catalog_db', JSON.stringify(defaultSeedDatabase));
                return defaultSeedDatabase;
            }
            try {
                return JSON.parse(data);
            } catch (e) {
                return defaultSeedDatabase;
            }
        }

        function saveCatalogData(data) {
            localStorage.setItem('campusfind_catalog_db', JSON.stringify(data));
        }

        function resetDataToDefault() {
            if (confirm('Apakah Anda yakin ingin mengembalikan database ke data demo awal?')) {
                localStorage.setItem('campusfind_catalog_db', JSON.stringify(defaultSeedDatabase));
                refreshAllViews();
                alert('Database telah berhasil di-reset ke data demo!');
            }
        }

        let activeCatalogFilter = 'ALL';

        // Initialization
        document.addEventListener('DOMContentLoaded', () => {
            const dateInput = document.getElementById('input-item-date');
            if (dateInput) {
                const today = new Date().toISOString().split('T')[0];
                dateInput.setAttribute('max', today);
                dateInput.value = today;
            }

            refreshAllViews();
        });

        function refreshAllViews() {
            const catalog = getCatalogData();
            renderHeroFeed(catalog);
            renderCatalog(catalog);
            executeSearch();
            updateStats(catalog);
            renderAdminTable(catalog);
        }

        // Mobile Drawer Toggle
        const mobileToggleBtn = document.getElementById('mobile-sidebar-toggle');
        const sidebar = document.getElementById('dashboard-sidebar');
        const overlay = document.getElementById('sidebar-overlay');
        const mobileIcon = document.getElementById('mobile-sidebar-icon');

        function toggleSidebar() {
            const isOpen = !sidebar.classList.contains('-translate-x-full');
            if (isOpen) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                mobileIcon.className = 'fa-solid fa-bars text-lg';
            } else {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
                mobileIcon.className = 'fa-solid fa-xmark text-lg';
            }
        }

        if (mobileToggleBtn) mobileToggleBtn.addEventListener('click', toggleSidebar);
        if (overlay) overlay.addEventListener('click', toggleSidebar);

        // Sidebar Navigation Switcher
        function switchTab(tabId) {
            document.querySelectorAll('.tab-content').forEach(section => {
                section.classList.add('hidden');
            });

            const targetSection = document.getElementById(`section-${tabId}`);
            if (targetSection) {
                targetSection.classList.remove('hidden');
            }

            document.querySelectorAll('.nav-btn').forEach(btn => {
                const btnTab = btn.getAttribute('data-tab');
                if (btnTab === tabId) {
                    btn.className = 'nav-btn w-full flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm transition-all text-brand-deep bg-brand-pastel border border-brand-accent';
                } else {
                    btn.className = 'nav-btn w-full flex items-center gap-3.5 px-4 py-3 rounded-xl font-semibold text-sm transition-all text-surface-text hover:bg-surface-bg border border-transparent';
                }
            });

            const topTitle = document.getElementById('top-bar-title');
            const topSubtitle = document.getElementById('top-bar-subtitle');

            const tabMeta = {
                'beranda': ['Beranda Utama', 'Pusat informasi dan pelaporan barang tercecer di kampus'],
                'layanan': ['Layanan Utama', '3 Pilar utama penanganan barang tercecer dan bantuan posko'],
                'pencarian': ['Pencarian Barang', 'Cari berdasarkan nama, lokasi, tanggal, kategori, dan status'],
                'katalog': ['Katalog Terpusat', 'Daftar lengkap barang hilang dan temuan terverifikasi'],
                'laporan': ['Formulir Laporan', 'Kirimkan laporan baru ke sistem posko keamanan'],
                'admin': ['Panel Admin & Kelola Status', 'Update status barang, verifikasi laporan, dan kontrol data'],
                'kontak': ['Posko Satpam Pusat', 'Lokasi fisik, hotline WhatsApp, dan konfirmasi klaim']
            };

            if (tabMeta[tabId]) {
                topTitle.innerText = tabMeta[tabId][0];
                topSubtitle.innerText = tabMeta[tabId][1];
            }

            if (window.innerWidth < 768) {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
                mobileIcon.className = 'fa-solid fa-bars text-lg';
            }

            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        // Render Hero Preview Feed
        function renderHeroFeed(catalog) {
            const container = document.getElementById('hero-feed-container');
            if (!container) return;

            const items = catalog.slice(0, 3);
            container.innerHTML = items.map(item => `
                <div onclick="openItemModal('${item.id}')" class="flex items-center justify-between p-3 rounded-2xl bg-surface-bg hover:bg-brand-pastel border border-surface-border hover:border-brand-accent transition-all cursor-pointer">
                    <div class="flex items-center gap-3 truncate">
                        <div class="w-8 h-8 rounded-xl bg-white border border-brand-accent text-brand-deep flex items-center justify-center text-xs shrink-0 font-bold">
                            <i class="fa-solid ${item.icon}"></i>
                        </div>
                        <div class="truncate">
                            <p class="text-xs font-bold text-slate-800 truncate">${item.title}</p>
                            <p class="text-[11px] text-surface-muted truncate"><i class="fa-solid fa-location-dot text-brand-deep mr-1"></i>${item.location}</p>
                        </div>
                    </div>
                    <span class="px-2 py-0.5 ${item.status === 'Diklaim' ? 'bg-slate-200 text-slate-700' : item.type === 'Ditemukan' ? 'bg-brand-pastel text-brand-deep border border-brand-accent' : 'bg-amber-100 text-amber-800 border border-amber-200'} text-[10px] font-bold rounded-md shrink-0 ml-2">
                        ${item.status === 'Diklaim' ? 'Selesai' : item.type}
                    </span>
                </div>
            `).join('');
        }

        // Update 4 Statistics Counters
        function updateStats(catalog) {
            document.getElementById('stat-total').innerText = catalog.length;
            document.getElementById('stat-lost').innerText = catalog.filter(i => i.type === 'Hilang' && i.status !== 'Diklaim').length;
            document.getElementById('stat-found').innerText = catalog.filter(i => i.type === 'Ditemukan' && i.status !== 'Diklaim').length;
            document.getElementById('stat-claimed').innerText = catalog.filter(i => i.status === 'Diklaim').length;
        }

        // Render Catalog Section Grid
        function renderCatalog(data) {
            const grid = document.getElementById('catalog-grid');
            if (!grid) return;

            grid.innerHTML = '';

            if (data.length === 0) {
                grid.innerHTML = `
                    <div class="col-span-full text-center py-12 text-surface-muted bg-white rounded-3xl border border-surface-border p-8">
                        <i class="fa-solid fa-box-open text-4xl mb-3 text-brand-accent"></i>
                        <p class="text-sm font-bold text-slate-800">Tidak ada barang dalam kategori / filter ini.</p>
                    </div>
                `;
                return;
            }

            data.forEach(item => {
                const isClaimed = item.status === 'Diklaim';
                const isFound = item.type === 'Ditemukan';

                const badgeClass = isClaimed ? 'bg-slate-100 text-slate-700 border-slate-300' :
                                   isFound ? 'bg-brand-pastel text-brand-deep border-brand-accent' : 
                                   'bg-amber-50 text-amber-800 border-amber-200';

                const card = document.createElement('div');
                card.className = "bg-white rounded-3xl p-6 border border-surface-border soft-shadow soft-shadow-hover flex flex-col justify-between space-y-4";

                card.innerHTML = `
                    <div class="space-y-3">
                        <div class="flex items-center justify-between gap-2">
                            <span class="px-2.5 py-0.5 text-[10px] font-bold rounded-lg border ${badgeClass}">
                                ${isClaimed ? 'Diklaim / Selesai' : 'Status: ' + item.type}
                            </span>
                            <span class="text-[11px] text-surface-muted font-medium"><i class="fa-regular fa-calendar mr-1"></i>${item.date}</span>
                        </div>

                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-xl bg-brand-pastel border border-brand-accent flex items-center justify-center text-brand-deep text-base shrink-0 font-bold">
                                <i class="fa-solid ${item.icon}"></i>
                            </div>
                            <div class="overflow-hidden">
                                <h3 class="text-slate-800 font-bold text-sm truncate">${item.title}</h3>
                                <p class="text-[11px] text-surface-muted mt-0.5"><i class="fa-solid fa-tag text-brand-deep mr-1"></i>${item.category}</p>
                            </div>
                        </div>

                        <p class="text-xs text-surface-text line-clamp-2 leading-relaxed">${item.desc}</p>

                        <div class="text-[11px] text-surface-muted space-y-1 bg-surface-bg p-3 rounded-xl border border-surface-border">
                            <p class="truncate"><i class="fa-solid fa-location-dot text-brand-deep mr-1.5"></i><strong>Lokasi:</strong> ${item.location}</p>
                            <p class="truncate"><i class="fa-solid fa-user-shield text-brand-deep mr-1.5"></i><strong>Pelapor:</strong> ${item.reporter}</p>
                        </div>
                    </div>

                    <button onclick="openItemModal('${item.id}')" class="w-full py-2 bg-brand-pastel hover:bg-brand-deep hover:text-white text-brand-deep text-xs font-bold rounded-xl border border-brand-accent transition-all flex items-center justify-center gap-1.5">
                        <i class="fa-solid fa-circle-info"></i> Detail & Klaim Fisik
                    </button>
                `;
                grid.appendChild(card);
            });
        }

        // Filter Catalog by Status Button Tabs
        function filterCatalogStatus(status) {
            activeCatalogFilter = status;
            document.querySelectorAll('.cat-tab-btn').forEach(btn => {
                btn.className = 'cat-tab-btn px-4 py-2 rounded-xl text-xs font-bold text-surface-text hover:text-slate-800 transition-all';
            });

            const activeBtn = document.getElementById(`cat-tab-${status}`);
            if (activeBtn) {
                activeBtn.className = 'cat-tab-btn px-4 py-2 rounded-xl text-xs font-bold transition-all bg-brand-deep text-white shadow-xs';
            }

            const catalog = getCatalogData();
            const filtered = catalog.filter(item => {
                if (status === 'ALL') return true;
                if (status === 'Diklaim') return item.status === 'Diklaim';
                return item.type === status && item.status !== 'Diklaim';
            });

            renderCatalog(filtered);
        }

        // Execute Search Function (Multi-Filter)
        function executeSearch() {
            const keyword = document.getElementById('search-keyword').value.toLowerCase().trim();
            const category = document.getElementById('search-category').value;
            const location = document.getElementById('search-location').value.toLowerCase().trim();
            const date = document.getElementById('search-date').value;
            const status = document.getElementById('search-status').value;

            const catalog = getCatalogData();

            const filtered = catalog.filter(item => {
                const matchKeyword = !keyword || 
                    item.title.toLowerCase().includes(keyword) ||
                    item.desc.toLowerCase().includes(keyword) ||
                    item.reporter.toLowerCase().includes(keyword);

                const matchCategory = (category === 'ALL') || (item.category === category);
                const matchLocation = !location || item.location.toLowerCase().includes(location);
                const matchDate = !date || item.date === date;
                const matchStatus = (status === 'ALL') || (item.status === status) || (status === item.type && item.status !== 'Diklaim');

                return matchKeyword && matchCategory && matchLocation && matchDate && matchStatus;
            });

            const resultsGrid = document.getElementById('search-results-grid');
            const resultCountLabel = document.getElementById('search-result-count');

            if (resultCountLabel) {
                resultCountLabel.innerText = `Menampilkan ${filtered.length} dari ${catalog.length} item barang.`;
            }

            if (!resultsGrid) return;
            resultsGrid.innerHTML = '';

            if (filtered.length === 0) {
                resultsGrid.innerHTML = `
                    <div class="col-span-full text-center py-12 text-surface-muted bg-surface-bg rounded-2xl border border-surface-border">
                        <i class="fa-solid fa-magnifying-glass text-3xl mb-2 text-brand-accent"></i>
                        <p class="text-xs font-bold text-slate-800">Tidak ada barang yang cocok dengan kriteria pencarian.</p>
                    </div>
                `;
                return;
            }

            filtered.forEach(item => {
                const card = document.createElement('div');
                card.className = "bg-white rounded-2xl p-5 border border-surface-border soft-shadow flex flex-col justify-between space-y-3";
                card.innerHTML = `
                    <div class="space-y-2">
                        <div class="flex items-center justify-between">
                            <span class="px-2 py-0.5 text-[10px] font-bold rounded ${item.status === 'Diklaim' ? 'bg-slate-200 text-slate-700' : item.type === 'Ditemukan' ? 'bg-brand-pastel text-brand-deep border border-brand-accent' : 'bg-amber-100 text-amber-800 border border-amber-200'}">
                                ${item.status === 'Diklaim' ? 'Diklaim' : item.type}
                            </span>
                            <span class="text-[10px] text-surface-muted font-medium">${item.date}</span>
                        </div>
                        <h4 class="font-bold text-xs text-slate-800 truncate">${item.title}</h4>
                        <p class="text-[11px] text-surface-muted"><i class="fa-solid fa-location-dot text-brand-deep mr-1"></i>${item.location}</p>
                    </div>
                    <button onclick="openItemModal('${item.id}')" class="w-full py-1.5 bg-surface-bg hover:bg-brand-deep hover:text-white text-surface-text font-bold text-[11px] rounded-lg border border-surface-border transition-all">
                        Lihat Detail
                    </button>
                `;
                resultsGrid.appendChild(card);
            });
        }

        // Reset Search Filters
        function resetSearchFilters() {
            document.getElementById('search-keyword').value = '';
            document.getElementById('search-category').value = 'ALL';
            document.getElementById('search-location').value = '';
            document.getElementById('search-date').value = '';
            document.getElementById('search-status').value = 'ALL';
            executeSearch();
        }

        // Trigger External Report Selection
        function triggerReportType(type) {
            switchTab('laporan');
            const radio = document.querySelector(`input[name="report_type"][value="${type}"]`);
            if (radio) {
                radio.checked = true;
                updateFormLabels();
            }
        }

        function updateFormLabels() {
            const type = document.querySelector('input[name="report_type"]:checked').value;
            const labelLoc = document.getElementById('label-location');
            if (labelLoc) {
                labelLoc.innerText = type === 'Hilang' ? 'Lokasi Kehilangan Terakhir *' : 'Lokasi Ditemukan / Penyerahan *';
            }
        }

        // Handle Form Submission (Add to LocalStorage)
        function handleReportSubmit(e) {
            e.preventDefault();

            const type = document.querySelector('input[name="report_type"]:checked').value;
            const name = document.getElementById('input-reporter-name').value;
            const phone = document.getElementById('input-reporter-phone').value;
            const title = document.getElementById('input-item-title').value;
            const category = document.getElementById('input-item-category').value;
            const location = document.getElementById('input-item-location').value;
            const date = document.getElementById('input-item-date').value;
            const desc = document.getElementById('input-item-desc').value;

            const catalog = getCatalogData();
            const newId = 'LF-2026-00' + (catalog.length + 1);

            let icon = 'fa-box';
            if (category.includes('Dokumen')) icon = 'fa-id-card';
            else if (category.includes('Elektronik')) icon = 'fa-laptop';
            else if (category.includes('Kunci')) icon = 'fa-key';
            else if (category.includes('Tas')) icon = 'fa-bag-shopping';

            const newItem = {
                id: newId,
                title: title,
                category: category,
                type: type,
                location: location,
                date: date,
                reporter: name,
                phone: phone,
                desc: desc,
                status: type === 'Ditemukan' ? 'Ditemukan' : 'Hilang',
                icon: icon
            };

            catalog.unshift(newItem);
            saveCatalogData(catalog);
            refreshAllViews();

            const alertBox = document.getElementById('form-alert');
            alertBox.className = "mb-6 p-4 rounded-2xl text-xs font-medium bg-brand-pastel border border-brand-accent text-brand-deep block";
            alertBox.innerHTML = `
                <div class="flex items-center gap-2.5">
                    <i class="fa-solid fa-circle-check text-base"></i>
                    <div>
                        <strong class="font-bold">Laporan Berhasil Disimpan!</strong> Registrasi ID: <strong>#${newId}</strong>. Data telah masuk ke database LocalStorage.
                    </div>
                </div>
            `;

            document.getElementById('report-form').reset();
            updateFormLabels();

            setTimeout(() => {
                switchTab('katalog');
            }, 1200);
        }

        // Admin Table Rendering & CRUD
        function renderAdminTable(catalog) {
            const tbody = document.getElementById('admin-table-body');
            if (!tbody) return;

            tbody.innerHTML = '';

            catalog.forEach(item => {
                const tr = document.createElement('tr');
                tr.className = "hover:bg-surface-bg transition-colors";
                tr.innerHTML = `
                    <td class="p-3.5 font-mono font-bold text-slate-800">
                        #${item.id}
                        <div class="text-[10px] text-surface-muted font-sans font-normal">${item.date}</div>
                    </td>
                    <td class="p-3.5">
                        <div class="font-bold text-slate-800">${item.title}</div>
                        <div class="text-[10px] text-surface-muted"><i class="fa-solid fa-tag text-brand-deep mr-1"></i>${item.category}</div>
                    </td>
                    <td class="p-3.5">
                        <div class="font-semibold text-slate-800">${item.reporter}</div>
                        <div class="text-[10px] text-surface-muted">${item.phone}</div>
                    </td>
                    <td class="p-3.5">
                        <span class="px-2 py-0.5 text-[10px] font-bold rounded ${item.type === 'Ditemukan' ? 'bg-brand-pastel text-brand-deep border border-brand-accent' : 'bg-amber-100 text-amber-800 border border-amber-200'}">
                            ${item.type}
                        </span>
                    </td>
                    <td class="p-3.5">
                        <select onchange="updateItemStatus('${item.id}', this.value)" class="bg-surface-bg border border-surface-border rounded-lg px-2 py-1 text-[11px] font-bold text-slate-800 focus:outline-none focus:border-brand-accent cursor-pointer">
                            <option value="Hilang" ${item.status === 'Hilang' ? 'selected' : ''}>Hilang</option>
                            <option value="Ditemukan" ${item.status === 'Ditemukan' ? 'selected' : ''}>Ditemukan</option>
                            <option value="Diklaim" ${item.status === 'Diklaim' ? 'selected' : ''}>Diklaim / Selesai</option>
                        </select>
                    </td>
                    <td class="p-3.5 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <button onclick="openItemModal('${item.id}')" title="Lihat Detail" class="p-1.5 bg-surface-bg hover:bg-brand-pastel hover:text-brand-deep text-slate-600 rounded-lg border border-surface-border transition-colors">
                                <i class="fa-solid fa-eye text-xs"></i>
                            </button>
                            <button onclick="deleteItem('${item.id}')" title="Hapus Data" class="p-1.5 bg-red-50 hover:bg-red-100 text-red-600 rounded-lg border border-red-200 transition-colors">
                                <i class="fa-solid fa-trash-can text-xs"></i>
                            </button>
                        </div>
                    </td>
                `;
                tbody.appendChild(tr);
            });
        }

        function updateItemStatus(id, newStatus) {
            const catalog = getCatalogData();
            const index = catalog.findIndex(i => i.id === id);
            if (index !== -1) {
                catalog[index].status = newStatus;
                saveCatalogData(catalog);
                refreshAllViews();
            }
        }

        function deleteItem(id) {
            if (confirm(`Apakah Anda yakin ingin menghapus data #${id}?`)) {
                let catalog = getCatalogData();
                catalog = catalog.filter(i => i.id !== id);
                saveCatalogData(catalog);
                refreshAllViews();
            }
        }

        // Contact Form Submission
        function handleContactSubmit(e) {
            e.preventDefault();
            const name = document.getElementById('contact-name').value;
            const alertBox = document.getElementById('contact-form-alert');

            alertBox.className = "mb-4 p-4 rounded-2xl text-xs font-medium bg-brand-pastel border border-brand-accent text-brand-deep block";
            alertBox.innerHTML = `Terima kasih <strong>${name}</strong>, pesan Anda telah dikirimkan ke petugas Posko Satpam Pusat.`;

            document.getElementById('contact-form').reset();
        }

        // Modal Dialog Controls
        function openItemModal(id) {
            const catalog = getCatalogData();
            const item = catalog.find(i => i.id === id);
            if (!item) return;

            const modalContent = document.getElementById('modal-content');
            modalContent.innerHTML = `
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="px-2.5 py-0.5 text-[10px] font-bold rounded ${item.status === 'Diklaim' ? 'bg-slate-200 text-slate-700' : item.type === 'Ditemukan' ? 'bg-brand-pastel text-brand-deep border border-brand-accent' : 'bg-amber-100 text-amber-800 border border-amber-200'}">
                            ${item.type}
                        </span>
                        <span class="text-xs text-surface-muted font-mono">ID: #${item.id}</span>
                    </div>

                    <h3 class="text-lg font-bold text-slate-800">${item.title}</h3>

                    <div class="bg-surface-bg p-4 rounded-2xl border border-surface-border space-y-2 text-xs">
                        <p class="text-surface-text"><strong class="text-surface-muted">Kategori:</strong> ${item.category}</p>
                        <p class="text-surface-text"><strong class="text-surface-muted">Lokasi Kejadian:</strong> ${item.location}</p>
                        <p class="text-surface-text"><strong class="text-surface-muted">Tanggal:</strong> ${item.date}</p>
                        <p class="text-surface-text"><strong class="text-surface-muted">Pelapor:</strong> ${item.reporter} (${item.phone})</p>
                        <p class="text-surface-text leading-relaxed"><strong class="text-surface-muted">Ciri Spesifik:</strong> ${item.desc}</p>
                    </div>

                    <div class="p-3 bg-brand-pastel border border-brand-accent rounded-xl text-[11px] text-brand-deep leading-relaxed">
                        <i class="fa-solid fa-shield-halved mr-1"></i>
                        <strong>Syarat Klaim:</strong> Mohon tunjukkan KTM/KTP asli di Posko Satpam Pusat untuk pengembalian barang.
                    </div>

                    <div class="flex items-center gap-3 pt-2">
                        <a href="https://wa.me/6281234567890?text=Halo%20Posko%20Satpam,%20saya%20ingin%20mengonfirmasi%20barang%20ID%20${item.id}%20(${encodeURIComponent(item.title)})" target="_blank" class="flex-1 py-2.5 bg-brand-deep hover:bg-brand-hover text-white font-bold text-xs rounded-xl text-center shadow-xs transition-colors flex items-center justify-center gap-2">
                            <i class="fa-brands fa-whatsapp text-sm"></i> Konfirmasi WA Posko
                        </a>
                        <button onclick="closeItemModal()" class="px-4 py-2.5 bg-surface-bg hover:bg-surface-border text-surface-text font-bold text-xs rounded-xl border border-surface-border transition-colors">
                            Tutup
                        </button>
                    </div>
                </div>
            `;

            const modal = document.getElementById('item-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeItemModal() {
            const modal = document.getElementById('item-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        // Database Export Modal Controls & SQL Generator
        let currentDbTab = 'sql';

        function openDatabaseExportModal() {
            const modal = document.getElementById('db-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            switchDbExportTab('sql');
        }

        function closeDatabaseExportModal() {
            const modal = document.getElementById('db-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function switchDbExportTab(type) {
            currentDbTab = type;
            const btnSql = document.getElementById('btn-db-tab-sql');
            const btnJson = document.getElementById('btn-db-tab-json');
            const codeArea = document.getElementById('db-export-code');
            const catalog = getCatalogData();

            if (type === 'sql') {
                btnSql.className = "px-4 py-1.5 rounded-xl text-xs font-bold bg-brand-deep text-white transition-all";
                btnJson.className = "px-4 py-1.5 rounded-xl text-xs font-bold bg-surface-bg text-surface-text hover:bg-surface-border transition-all";

                let sqlScript = `-- Database Schema: Campus Lost & Found System (CampusFind)\n`;
                sqlScript += `-- Created: 2026\n\n`;
                sqlScript += `CREATE TABLE IF NOT EXISTS items (\n`;
                sqlScript += `  id VARCHAR(20) PRIMARY KEY,\n`;
                sqlScript += `  title VARCHAR(255) NOT NULL,\n`;
                sqlScript += `  category VARCHAR(100) NOT NULL,\n`;
                sqlScript += `  type ENUM('Hilang', 'Ditemukan') NOT NULL,\n`;
                sqlScript += `  location VARCHAR(255) NOT NULL,\n`;
                sqlScript += `  date DATE NOT NULL,\n`;
                sqlScript += `  reporter VARCHAR(100) NOT NULL,\n`;
                sqlScript += `  phone VARCHAR(30) NOT NULL,\n`;
                sqlScript += `  description TEXT,\n`;
                sqlScript += `  status ENUM('Hilang', 'Ditemukan', 'Diklaim') NOT NULL DEFAULT 'Hilang',\n`;
                sqlScript += `  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP\n`;
                sqlScript += `);\n\n`;
                sqlScript += `-- Data Seed Inserts (${catalog.length} Rows)\n`;

                catalog.forEach(item => {
                    const cleanTitle = item.title.replace(/'/g, "''");
                    const cleanDesc = item.desc.replace(/'/g, "''");
                    const cleanReporter = item.reporter.replace(/'/g, "''");
                    const cleanLoc = item.location.replace(/'/g, "''");

                    sqlScript += `INSERT INTO items (id, title, category, type, location, date, reporter, phone, description, status) VALUES ('${item.id}', '${cleanTitle}', '${item.category}', '${item.type}', '${cleanLoc}', '${item.date}', '${cleanReporter}', '${item.phone}', '${cleanDesc}', '${item.status}');\n`;
                });

                codeArea.value = sqlScript;
            } else {
                btnJson.className = "px-4 py-1.5 rounded-xl text-xs font-bold bg-brand-deep text-white transition-all";
                btnSql.className = "px-4 py-1.5 rounded-xl text-xs font-bold bg-surface-bg text-surface-text hover:bg-surface-border transition-all";

                codeArea.value = JSON.stringify(catalog, null, 2);
            }
        }

        function copyDbCodeToClipboard() {
            const codeArea = document.getElementById('db-export-code');
            codeArea.select();
            document.execCommand('copy');
            alert('Kode database SQL/JSON berhasil disalin ke clipboard!');
        }
    </script>
</body>
</html>