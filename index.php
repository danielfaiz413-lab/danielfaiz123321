<?php
// Handle navigation
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
$results = [];
$searched = false;

if (isset($_POST['cari']) && $page === 'cek-saldo') {
    $searched = true;
    // Simulated data
    $results = [
        [
            'no' => 1,
            'nomor_rekening' => '0562018901234567',
            'nama_pemilik' => 'Andi Taufik',
            'saldo' => 'IDR 506.000.670.543',
            'tanggal' => '08/04/2025 10:45:20'
        ],
        [
            'no' => 2,
            'nomor_rekening' => '0562018987654321',
            'nama_pemilik' => 'Budi Santoso',
            'saldo' => 'IDR 250.500.000.000',
            'tanggal' => '08/04/2025 11:30:15'
        ],
        [
            'no' => 3,
            'nomor_rekening' => '0562018912345678',
            'nama_pemilik' => 'Siti Nurhaliza',
            'saldo' => 'IDR 1.200.000.000',
            'tanggal' => '08/04/2025 09:15:45'
        ]
    ];
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cek Rekening - Dashboard BRI</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #1e3a8a 0%, #1e40af 100%);
        }
        .logo-bri {
            font-weight: bold;
            font-size: 32px;
            letter-spacing: 3px;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .bri-logo-large {
            font-size: 120px;
            font-weight: bold;
            letter-spacing: 4px;
            color: #1e3a8a;
            text-shadow: 0 4px 8px rgba(30, 58, 138, 0.3);
        }
        .decorative-chevron {
            position: absolute;
            right: 0;
            bottom: 0;
            width: 400px;
            height: 400px;
            background: linear-gradient(135deg, #2563eb 0%, #60a5fa 50%, transparent 100%);
            opacity: 0.15;
            clip-path: polygon(100% 0, 0 0, 100% 100%);
            z-index: 0;
        }
        .decorative-chevron-secondary {
            position: absolute;
            right: -100px;
            bottom: -100px;
            width: 300px;
            height: 300px;
            background: linear-gradient(135deg, #f97316 0%, #fed7aa 50%, transparent 100%);
            opacity: 0.2;
            clip-path: polygon(100% 0, 0 0, 100% 100%);
            z-index: 0;
        }
        .header-bar {
            background: linear-gradient(90deg, #1e3a8a 0%, #1e40af 50%, #2563eb 100%);
            height: 8px;
        }
        .splash-background {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            position: relative;
            overflow: hidden;
        }
        .splash-chevron-large {
            position: absolute;
            width: 600px;
            height: 600px;
            background: linear-gradient(135deg, #2563eb 0%, #60a5fa 50%, transparent 100%);
            opacity: 0.2;
            clip-path: polygon(100% 0, 0 0, 100% 100%);
        }
        .splash-chevron-secondary-large {
            position: absolute;
            width: 500px;
            height: 500px;
            background: linear-gradient(135deg, #f97316 0%, #fed7aa 50%, transparent 100%);
            opacity: 0.25;
            clip-path: polygon(100% 0, 0 0, 100% 100%);
        }

        /* Professional BRI Geometric Background */
        .bri-geometric-background {
            background: linear-gradient(135deg, #f0f2f5 0%, #e8eaed 100%);
            position: relative;
            overflow: hidden;
        }

        /* Light gray diagonal pattern (top) */
        .bri-geometric-background::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 30%;
            background: linear-gradient(180deg, 
                rgba(211, 215, 220, 0.6) 0%,
                rgba(211, 215, 220, 0.3) 50%,
                transparent 100%);
            clip-path: polygon(0 0, 100% 0, 85% 100%, 0 80%);
            z-index: 1;
        }

        /* Main geometric shapes (chevron/arrow) */
        .bri-geometric-background::after {
            content: '';
            position: absolute;
            bottom: 0;
            right: 0;
            width: 65%;
            height: 65%;
            background: linear-gradient(135deg, 
                #1e3a8a 0%,
                #1e3a8a 15%,
                #1e40af 25%,
                #0e7490 40%,
                #0891b2 55%,
                #06b6d4 70%,
                transparent 100%);
            clip-path: polygon(
                100% 100%,
                0 100%,
                0 75%,
                25% 50%,
                0 25%,
                0 0,
                100% 0,
                75% 30%,
                65% 50%,
                75% 70%,
                100% 100%
            );
            z-index: 2;
        }

        /* Orange accent triangle top-right */
        .orange-accent-top {
            position: absolute;
            top: 2%;
            right: 1%;
            width: 0;
            height: 0;
            border-left: 50px solid transparent;
            border-right: 0px solid transparent;
            border-top: 0px solid transparent;
            border-bottom: 80px solid #f97316;
            z-index: 5;
        }

        /* Orange accent triangle bottom-right */
        .orange-accent-bottom {
            position: absolute;
            bottom: 5%;
            right: 0.5%;
            width: 0;
            height: 0;
            border-left: 40px solid transparent;
            border-right: 0px solid transparent;
            border-top: 0px solid transparent;
            border-bottom: 60px solid #f97316;
            z-index: 5;
        }

        /* Cyan stripe accent */
        .cyan-stripe {
            position: absolute;
            bottom: 20%;
            right: 10%;
            width: 120px;
            height: 15px;
            background: linear-gradient(90deg, transparent 0%, #06b6d4 50%, transparent 100%);
            transform: rotate(-45deg);
            z-index: 3;
            opacity: 0.9;
        }

        /* Gold accent lines (bottom) */
        .gold-accent {
            position: absolute;
            bottom: 8%;
            right: 2%;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, transparent 0%, #d4af37 50%, transparent 100%);
            z-index: 5;
        }

        .main-content-wrapper {
            position: relative;
            z-index: 10;
        }
    </style>
</head>
<body class="bg-gray-50">

<?php if ($page === 'dashboard'): ?>
    <!-- SPLASH/DASHBOARD PAGE -->
    <div class="w-screen h-screen splash-background flex items-center justify-center relative overflow-hidden">
        <!-- Decorative Chevrons -->
        <div class="splash-chevron-large" style="right: -100px; bottom: -100px;"></div>
        <div class="splash-chevron-secondary-large" style="right: -50px; bottom: -50px;"></div>
        <div class="splash-chevron-large" style="left: -100px; top: -100px; opacity: 0.1;"></div>

        <!-- Logo Section -->
        <div class="relative z-10 text-center">
            <div class="bri-logo-large mb-8">
                BRI
            </div>
            <p class="text-2xl text-gray-600 mb-12">Cek Rekening</p>
            
            <!-- Navigation Tabs -->
            <div class="flex gap-4 justify-center">
                <a href="?page=dashboard" class="px-8 py-3 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-md">
                    Dashboard
                </a>
                <a href="?page=cek-saldo" class="px-8 py-3 bg-white text-blue-600 border-2 border-blue-600 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                    Cek Saldo Rekening
                </a>
            </div>
        </div>

        <!-- Footer -->
        <div class="absolute bottom-8 left-0 right-0 text-center text-sm text-gray-600">
            <p>&copy; 2023 Cek Nomor Rekening. All rights reserved.</p>
        </div>
    </div>

<?php elseif ($page === 'cek-saldo'): ?>
    <!-- CEK SALDO PAGE -->
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar-gradient w-64 text-white flex flex-col shadow-lg relative">
            <!-- Logo/Title -->
            <div class="p-6 border-b border-blue-700">
                <h1 class="logo-bri">BRI</h1>
                <p class="text-xs text-blue-100 mt-2">Cek Rekening</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 px-4 py-6">
                <p class="text-xs font-semibold text-blue-200 uppercase tracking-wider mb-4">Main Navigation</p>
                <ul class="space-y-2">
                    <li>
                        <a href="?page=dashboard" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors text-blue-50">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            <span class="text-sm font-medium">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=cek-saldo" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors bg-blue-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 6H6.414l.286-1.142A1 1 0 006 4H4a1 1 0 000 2h1l2.752 11.01A1 1 0 009 18a1 1 0 11-2 0 1 1 0 01-1-.9l-.748-2.998a1 1 0 00-.999-.85H2a1 1 0 100 2h1l.5 2a1.972 1.972 0 11-3.898.118L.02 7.971A1 1 0 000 7V4a1 1 0 001-1z"></path>
                                <path d="M16 16a2 2 0 11-4 0 2 2 0 014 0zM4 12a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span class="text-sm font-medium">Cek Saldo Rekening</span>
                        </a>
                    </li>
                    <li>
                        <a href="?page=data-rekening" class="flex items-center space-x-3 px-4 py-3 rounded-lg hover:bg-blue-700 transition-colors text-blue-50">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm0 8a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"></path>
                            </svg>
                            <span class="text-sm font-medium">Data Rekening</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer -->
            <div class="px-4 py-4 border-t border-blue-700">
                <p class="text-xs text-blue-200 text-center">&copy; 2023 Cek Nomor Rekening. All rights reserved.</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden relative bri-geometric-background">
            <!-- Accent decorations -->
            <div class="orange-accent-top"></div>
            <div class="orange-accent-bottom"></div>
            <div class="cyan-stripe"></div>
            <div class="gold-accent"></div>

            <!-- Header Bar -->
            <div class="header-bar"></div>
            
            <!-- Header -->
            <header class="bg-white bg-opacity-95 border-b border-gray-200 px-8 py-4 shadow-sm relative z-10">
                <div class="flex items-center justify-between">
                    <nav class="flex items-center space-x-2 text-sm text-gray-600">
                        <a href="?page=dashboard" class="hover:text-blue-600 transition">Home</a>
                        <span class="text-gray-400">/</span>
                        <span class="text-gray-900 font-medium">Saldo</span>
                    </nav>
                    <div class="flex items-center space-x-4">
                        <button class="p-2 hover:bg-gray-100 rounded-full transition">
                            <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-8 main-content-wrapper">
                <div class="max-w-6xl">
                    <!-- Card -->
                    <div class="bg-white rounded-lg shadow-md p-8 relative overflow-hidden">
                        <!-- Decorative Elements -->
                        <div class="decorative-chevron"></div>
                        <div class="decorative-chevron-secondary"></div>

                        <!-- Content Container -->
                        <div class="relative z-10">
                            <!-- Title -->
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Cek Saldo Rekening</h2>

                            <!-- Search Section -->
                            <form method="POST" class="mb-8">
                                <div class="flex gap-4 items-end flex-wrap">
                                    <div class="flex-1 min-w-64">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Masukkan key pencarian</label>
                                        <input 
                                            type="text" 
                                            name="search_key" 
                                            placeholder="Cari..." 
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                        >
                                    </div>
                                    <div class="min-w-64">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Cari pada indeks</label>
                                        <select name="search_index" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                                            <option value="">Cari pada indeks</option>
                                            <option value="nomor_rekening">Nomor Rekening</option>
                                            <option value="nama_pemilik">Nama Pemilik</option>
                                        </select>
                                    </div>
                                    <button 
                                        type="submit" 
                                        name="cari" 
                                        class="px-8 py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition-colors shadow-md hover:shadow-lg"
                                    >
                                        Cari
                                    </button>
                                </div>
                            </form>

                            <!-- Results Table -->
                            <?php if ($searched): ?>
                                <div class="mt-8">
                                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Hasil Cek Saldo Rekening</h3>
                                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                                        <table class="w-full">
                                            <thead class="bg-blue-50 border-b border-gray-200">
                                                <tr>
                                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">#</th>
                                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nomor Rekening</th>
                                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Nama Pemilik</th>
                                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Saldo</th>
                                                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody class="divide-y divide-gray-200">
                                                <?php foreach ($results as $row): ?>
                                                    <tr class="hover:bg-gray-50 transition-colors">
                                                        <td class="px-6 py-4 text-sm text-gray-600"><?php echo $row['no']; ?></td>
                                                        <td class="px-6 py-4 text-sm text-gray-800 font-medium"><?php echo htmlspecialchars($row['nomor_rekening']); ?></td>
                                                        <td class="px-6 py-4 text-sm text-gray-800"><?php echo htmlspecialchars($row['nama_pemilik']); ?></td>
                                                        <td class="px-6 py-4 text-sm font-semibold text-blue-600"><?php echo htmlspecialchars($row['saldo']); ?></td>
                                                        <td class="px-6 py-4 text-sm text-gray-600"><?php echo htmlspecialchars($row['tanggal']); ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 px-8 py-4 text-center text-sm text-gray-600 relative z-10">
                <p>&copy; 2023 Cek Nomor Rekening. All rights reserved.</p>
            </footer>
        </div>
    </div>

<?php endif; ?>

</body>
</html>
