<?php
// Handle search functionality
$results = [];
$searched = false;

if (isset($_POST['cari'])) {
    $searched = true;
    // Simulated data - this would normally come from a database
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
    <title>Cek Rekening - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        }
        .main-gradient {
            background: linear-gradient(135deg, rgba(30, 58, 138, 0.1) 0%, rgba(30, 64, 175, 0.1) 100%);
        }
        .decorative-shape {
            position: absolute;
            right: 0;
            bottom: 0;
            opacity: 0.1;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="sidebar-gradient w-64 text-white p-6 shadow-lg flex flex-col">
            <!-- Logo/Title -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold">CBR</h1>
                <p class="text-sm text-blue-100 mt-1">Cek Rekening</p>
            </div>

            <!-- Navigation -->
            <nav class="flex-1">
                <p class="text-xs font-semibold text-blue-100 uppercase tracking-wider mb-4">Main Navigation</p>
                <ul class="space-y-3">
                    <li>
                        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors bg-blue-700">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path>
                                <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z"></path>
                            </svg>
                            <span>Cek Saldo Rekening</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center space-x-3 p-3 rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6a1 1 0 011-1h12a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zm0 8a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2z"></path>
                            </svg>
                            <span>Data Rekening</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Footer -->
            <div class="text-xs text-blue-100">
                <p>&copy; 2023 Cek Nomor Rekening</p>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-gray-200 px-8 py-4 shadow-sm">
                <div class="flex items-center justify-between">
                    <nav class="flex items-center space-x-2 text-sm text-gray-600">
                        <a href="#" class="hover:text-blue-600">Home</a>
                        <span class="text-gray-400">/</span>
                        <span class="text-gray-900 font-medium">Saldo</span>
                    </nav>
                    <div class="flex items-center space-x-4">
                        <svg class="w-6 h-6 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <div class="flex-1 overflow-auto p-8">
                <div class="max-w-6xl">
                    <!-- Card -->
                    <div class="bg-white rounded-lg shadow-md p-8 relative overflow-hidden">
                        <div class="absolute right-0 top-0 opacity-5">
                            <svg width="300" height="300" viewBox="0 0 300 300" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 100L100 0V200L0 300V100Z" fill="#1e3a8a"></path>
                                <path d="M100 0L200 100V200L100 300V0Z" fill="#3b82f6"></path>
                                <path d="M200 100L300 0V300L200 200V100Z" fill="#60a5fa"></path>
                            </svg>
                        </div>

                        <!-- Title -->
                        <h2 class="text-2xl font-bold text-gray-800 mb-6 relative z-10">Cek Saldo Rekening</h2>

                        <!-- Search Section -->
                        <form method="POST" class="mb-8 relative z-10">
                            <div class="flex gap-4 items-end flex-wrap">
                                <div class="flex-1 min-w-xs">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Masukkan key pencarian</label>
                                    <input 
                                        type="text" 
                                        name="search_key" 
                                        placeholder="Cari..." 
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition"
                                    >
                                </div>
                                <div class="min-w-xs">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari pada indeks</label>
                                    <select name="search_index" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition bg-white">
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
                            <div class="mt-8 relative z-10">
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

            <!-- Footer -->
            <footer class="bg-white border-t border-gray-200 px-8 py-4 text-center text-sm text-gray-600">
                <p>&copy; 2023 Cek Nomor Rekening. All rights reserved.</p>
            </footer>
        </div>
    </div>
</body>
</html>
