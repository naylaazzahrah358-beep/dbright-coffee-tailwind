<?php
/**
 * D'BRIGHT COFFEE - Data & Konfigurasi Utama
 * Mata Kuliah : Praktikum Pemrograman Web
 * Pengembang  : Nayla Azzahra R (Kelas C - Angkatan 2025, FT-UNM)
 */

// Set Timezone ke WITA (Makassar / Gowa / Waktu Indonesia Tengah)
date_default_timezone_set('Asia/Makassar');

// ========================================================
// 1. INFORMASI OUTLET & KONFIGURASI
// ========================================================
$outlet = [
    'nama'           => "D'BRIGHT COFFEE",
    'slogan'         => "Segarkan Harimu Bersama D'Bright Coffee",
    'sub_slogan'     => "Coffee • Non Coffee • Snack",
    'deskripsi'      => "Menu D'BRIGHT COFFEE: Coffee, Non Coffee, dan Snack lezat harga terjangkau mulai Rp 8.000 di Jl. Mustafa Dg. Bunga No.33 Romang Polong, Gowa.",
    'alamat'         => "Jl. Mustafa Dg. Bunga No.33 Romang Polong, Gowa - Samata",
    'patokan'        => "Dekat bundaran Samata & area kampus UIN Alauddin Romang Polong",
    'whatsapp'       => "085705952173",
    'whatsapp_full'  => "6285705952173",
    'instagram'      => "@bright_c0ffee",
    'instagram_url'  => "https://instagram.com/bright_c0ffee",
    'maps_url'       => "https://maps.google.com/?q=Jl.+Mustafa+Dg.+Bunga+Romang+Polong+Gowa",
    'jam_buka'       => 9,  // 09.00 WITA
    'jam_tutup'      => 22, // 22.00 WITA
    'logo'           => 'dbright-logo.jpg',
    'banner'         => 'dbright-banner.jpg',
    'pengembang'     => [
        'nama'       => 'Nayla Azzahra R',
        'kampus'     => 'Teknik Komputer FT-UNM (Kelas C - Angkatan 2025)',
        'matkul'     => 'Praktikum Pemrograman Web',
        'portofolio' => 'https://naylaazzahrah358-beep.github.io',
        'github'     => 'https://github.com/naylaazzahrah358-beep'
    ]
];

// ========================================================
// 2. FUNGSI HELPER (FORMAT RUPIAH & CEK OPERASIONAL)
// ========================================================

/**
 * Format angka ke format mata uang Rupiah
 * Contoh: 15000 -> "Rp 15.000"
 */
function formatRupiah(int|float $angka): string {
    return 'Rp ' . number_format($angka, 0, ',', '.');
}

/**
 * Cek apakah outlet sedang buka saat ini berdasarkan jam WITA
 */
function isOutletBuka(): bool {
    global $outlet;
    $jamSekarang = (int)date('G'); // Format jam 0-23
    return ($jamSekarang >= $outlet['jam_buka'] && $jamSekarang < $outlet['jam_tutup']);
}

/**
 * Mengambil teks status operasional
 */
function getStatusOperasional(): array {
    global $outlet;
    if (isOutletBuka()) {
        return [
            'status' => true,
            'label'  => 'BUKA SEKARANG (Tutup ' . sprintf('%02d:00', $outlet['jam_tutup']) . ' WITA)',
            'class'  => 'text-emerald-800'
        ];
    } else {
        return [
            'status' => false,
            'label'  => 'TUTUP SEMENTARA (Buka ' . sprintf('%02d:00', $outlet['jam_buka']) . ' WITA)',
            'class'  => 'text-amber-800'
        ];
    }
}

// ========================================================
// 3. KATEGORI MENU
// ========================================================
$categories = [
    'all'        => 'Semua Menu',
    'coffee'     => 'Coffee',
    'non-coffee' => 'Non Coffee',
    'snack'      => 'Menu Snack'
];

// ========================================================
// 4. DAFTAR 24 MENU RESMI D'BRIGHT COFFEE
// ========================================================
$menuItems = [
    // --- KATEGORI COFFEE (7 Menu) ---
    [
        'id'          => 1,
        'nama'        => 'Americano (Hot/ice)',
        'kategori'    => 'coffee',
        'kategori_label' => 'Coffee',
        'badge'       => 'Hot / Ice',
        'subjudul'    => 'Espresso Murni',
        'deskripsi'   => 'Seduhan espresso murni dengan air panas atau es batu segar, rasa kopi kuat dan pekat tanpa ampas.',
        'harga'       => 10000,
        'is_featured' => false
    ],
    [
        'id'          => 2,
        'nama'        => 'Kopi Susu Klasik',
        'kategori'    => 'coffee',
        'kategori_label' => 'Coffee',
        'badge'       => 'Favorit',
        'subjudul'    => 'Kopi & Kental Manis',
        'deskripsi'   => 'Perpaduan seimbang antara racikan kopi hitam mantap dengan gurihnya susu kental manis klasik.',
        'harga'       => 13000,
        'is_featured' => false
    ],
    [
        'id'          => 3,
        'nama'        => "Signature D'Bright",
        'kategori'    => 'coffee',
        'kategori_label' => 'Coffee',
        'badge'       => 'Best Seller',
        'subjudul'    => "Racikan Khas D'Bright",
        'deskripsi'   => "Menu kopi andalan khas D'Bright Coffee dengan formulasi rahasia yang creamy, gurih, dan nikmat.",
        'harga'       => 15000,
        'is_featured' => true
    ],
    [
        'id'          => 4,
        'nama'        => 'Kopi Pandan',
        'kategori'    => 'coffee',
        'kategori_label' => 'Coffee',
        'badge'       => 'Aromatik',
        'subjudul'    => 'Kopi Susu & Sari Pandan',
        'deskripsi'   => 'Sensasi kopi susu creamy berpadu keharuman aroma pandan wangi yang segar dan khas di lidah.',
        'harga'       => 15000,
        'is_featured' => false
    ],
    [
        'id'          => 5,
        'nama'        => 'Caramel Coffee',
        'kategori'    => 'coffee',
        'kategori_label' => 'Coffee',
        'badge'       => 'Manis Gurih',
        'subjudul'    => 'Espresso & Saus Karamel',
        'deskripsi'   => 'Kombinasi espresso mantap berbalut saus karamel manis legit dan susu dingin yang gurih menggugah selera.',
        'harga'       => 15000,
        'is_featured' => false
    ],
    [
        'id'          => 6,
        'nama'        => 'Butterscoth',
        'kategori'    => 'coffee',
        'kategori_label' => 'Coffee',
        'badge'       => 'Creamy Butter',
        'subjudul'    => 'Butterscotch & Coffee',
        'deskripsi'   => 'Cita rasa unik sirup butterscotch berpadu susu segar dan espresso, memberikan sensasi buttery manis lembut.',
        'harga'       => 15000,
        'is_featured' => false
    ],
    [
        'id'          => 7,
        'nama'        => 'Coffee Latte',
        'kategori'    => 'coffee',
        'kategori_label' => 'Coffee',
        'badge'       => 'Klasik',
        'subjudul'    => 'Espresso & Steamed Milk',
        'deskripsi'   => 'Keseimbangan sempurna single shot espresso berkualitas dengan susu segar gurih yang lembut di lidah.',
        'harga'       => 15000,
        'is_featured' => false
    ],

    // --- KATEGORI NON COFFEE (9 Menu) ---
    [
        'id'          => 8,
        'nama'        => 'Matcha Latte',
        'kategori'    => 'non-coffee',
        'kategori_label' => 'Non Coffe',
        'badge'       => 'Matcha Asli',
        'subjudul'    => 'Teh Hijau Jepang & Susu',
        'deskripsi'   => 'Bubuk teh hijau matcha murni berkualitas dipadu dengan susu murni segar, harum dan kaya antioksidan.',
        'harga'       => 18000,
        'is_featured' => false
    ],
    [
        'id'          => 9,
        'nama'        => 'Matcha Strawberry',
        'kategori'    => 'non-coffee',
        'kategori_label' => 'Non Coffe',
        'badge'       => 'Spesial',
        'subjudul'    => 'Matcha & Buah Strawberry',
        'deskripsi'   => 'Perpaduan estetik matcha hijau pekat dengan layer selai strawberry asam manis yang segar menggoda.',
        'harga'       => 23000,
        'is_featured' => false
    ],
    [
        'id'          => 10,
        'nama'        => 'Choco Matcha',
        'kategori'    => 'non-coffee',
        'kategori_label' => 'Non Coffe',
        'badge'       => 'Dual Flavour',
        'subjudul'    => 'Cokelat & Teh Hijau',
        'deskripsi'   => 'Kombinasi kaya rasa cokelat premium pekat berpadu kelembutan matcha dalam satu tegukan istimewa.',
        'harga'       => 23000,
        'is_featured' => false
    ],
    [
        'id'          => 11,
        'nama'        => 'Matcha Oreo',
        'kategori'    => 'non-coffee',
        'kategori_label' => 'Non Coffe',
        'badge'       => 'Topping Oreo',
        'subjudul'    => 'Matcha & Biskuit Oreo',
        'deskripsi'   => 'Matcha latte creamy dengan limpahan remahan biskuit Oreo renyah yang gurih manis di setiap sedotan.',
        'harga'       => 23000,
        'is_featured' => false
    ],
    [
        'id'          => 12,
        'nama'        => 'Chocolate',
        'kategori'    => 'non-coffee',
        'kategori_label' => 'Non Coffe',
        'badge'       => 'Cokelat Murni',
        'subjudul'    => 'Dark Chocolate Kental',
        'deskripsi'   => 'Minuman cokelat murni kaya rasa dengan tekstur lembut yang manis pas dan sangat memanjakan lidah.',
        'harga'       => 13000,
        'is_featured' => false
    ],
    [
        'id'          => 13,
        'nama'        => 'Red Velvet',
        'kategori'    => 'non-coffee',
        'kategori_label' => 'Non Coffe',
        'badge'       => 'Manis Gurih',
        'subjudul'    => 'Red Velvet & Susu Segar',
        'deskripsi'   => 'Karakter rasa kue red velvet dengan hint cocoa manis gurih berpadu susu murni dingin yang menyegarkan.',
        'harga'       => 13000,
        'is_featured' => false
    ],
    [
        'id'          => 14,
        'nama'        => 'Thai Tea',
        'kategori'    => 'non-coffee',
        'kategori_label' => 'Non Coffe',
        'badge'       => 'Teh Rempah',
        'subjudul'    => 'Teh Asli Thailand',
        'deskripsi'   => 'Seduhan teh daun rempah Thailand asli dipadukan kental manis dan susu evaporasi yang gurih lezat.',
        'harga'       => 13000,
        'is_featured' => false
    ],
    [
        'id'          => 15,
        'nama'        => 'Taro latte',
        'kategori'    => 'non-coffee',
        'kategori_label' => 'Non Coffe',
        'badge'       => 'Taro Lembut',
        'subjudul'    => 'Taro Ungu & Fresh Milk',
        'deskripsi'   => 'Minuman taro ungu harum dengan rasa manis gurih lembut berpadu susu murni yang nikmat dan mengenyangkan.',
        'harga'       => 13000,
        'is_featured' => false
    ],
    [
        'id'          => 16,
        'nama'        => 'Lemon/Lyche Tea',
        'kategori'    => 'non-coffee',
        'kategori_label' => 'Non Coffe',
        'badge'       => 'Super Segar',
        'subjudul'    => 'Pilihan Lemon atau Leci',
        'deskripsi'   => 'Pilihan teh dingin segar rasa lemon citrus asam segar atau buah leci manis harum penghilang dahaga seketika.',
        'harga'       => 13000,
        'is_featured' => false
    ],

    // --- KATEGORI MENU SNACK (8 Menu) ---
    [
        'id'          => 17,
        'nama'        => 'Kentang Goreng',
        'kategori'    => 'snack',
        'kategori_label' => 'Menu Snack',
        'badge'       => 'Renyah',
        'subjudul'    => 'French Fries Gurih',
        'deskripsi'   => 'Potongan kentang goreng renyah di luar dan lembut di dalam, disajikan hangat lengkap dengan saus sambal dan mayones.',
        'harga'       => 13000,
        'is_featured' => false
    ],
    [
        'id'          => 18,
        'nama'        => 'Ubi Goreng',
        'kategori'    => 'snack',
        'kategori_label' => 'Menu Snack',
        'badge'       => 'Tradisional',
        'subjudul'    => 'Ubi Manis Renyah',
        'deskripsi'   => 'Camilan ubi goreng khas yang renyah gurih di luar dan pulen manis di dalam, teman sempurna ngopi santai.',
        'harga'       => 13000,
        'is_featured' => false
    ],
    [
        'id'          => 19,
        'nama'        => 'Roti Bakar',
        'kategori'    => 'snack',
        'kategori_label' => 'Menu Snack',
        'badge'       => 'Topping Melimpah',
        'subjudul'    => 'Roti Panggang Krispi',
        'deskripsi'   => 'Roti bakar empuk dipanggang wangi mentega dengan pilihan isian manis lumer yang memanjakan lidah.',
        'harga'       => 15000,
        'is_featured' => false
    ],
    [
        'id'          => 20,
        'nama'        => 'Banana Stick (choco& Tiramisu)',
        'kategori'    => 'snack',
        'kategori_label' => 'Menu Snack',
        'badge'       => 'Manis Lumer',
        'subjudul'    => 'Pisang Cokelat Tiramisu',
        'deskripsi'   => 'Stik pisang krispi dengan limpahan glaze cokelat tebal dan aroma tiramisu yang lezat menggoda selera.',
        'harga'       => 13000,
        'is_featured' => false
    ],
    [
        'id'          => 21,
        'nama'        => 'Platter (kentang,sosis,nugget)',
        'kategori'    => 'snack',
        'kategori_label' => 'Menu Snack',
        'badge'       => 'Paling Komplit',
        'subjudul'    => 'Kombinasi 3 Camilan',
        'deskripsi'   => 'Paket komplit berisi kentang goreng gurih, potongan sosis panggang empuk, dan nugget ayam renyah.',
        'harga'       => 22000,
        'is_featured' => true
    ],
    [
        'id'          => 22,
        'nama'        => 'Dimsum Mentai',
        'kategori'    => 'snack',
        'kategori_label' => 'Menu Snack',
        'badge'       => 'Saus Mentai',
        'subjudul'    => 'Dimsum Lembut & Saus Mentai',
        'deskripsi'   => 'Olahan dimsum lembut isi padat disiram saus mentai gurih creamy yang dibakar aromatik khas kafe.',
        'harga'       => 20000,
        'is_featured' => false
    ],
    [
        'id'          => 23,
        'nama'        => 'Indomie Biasa',
        'kategori'    => 'snack',
        'kategori_label' => 'Menu Snack',
        'badge'       => 'Cepat Saji',
        'subjudul'    => 'Goreng atau Kuah',
        'deskripsi'   => 'Sajian mie instan Indomie favorit dimasak hangat dengan tingkat kematangan pas untuk pengganjal lapar.',
        'harga'       => 8000,
        'is_featured' => false
    ],
    [
        'id'          => 24,
        'nama'        => 'Indomie Komplit',
        'kategori'    => 'snack',
        'kategori_label' => 'Menu Snack',
        'badge'       => 'Telur & Sayur',
        'subjudul'    => 'Paket Telur & Topping',
        'deskripsi'   => 'Indomie lezat disajikan komplit dengan tambahan telur matang/setengah matang dan pelengkap sayur segar.',
        'harga'       => 13000,
        'is_featured' => false
    ]
];

// ========================================================
// 4.1 INTEGRASI DATABASE MYSQL (tugasnela_db)
// ========================================================
// Hubungkan ke database tugasnela_db di phpMyAdmin
require_once __DIR__ . '/db.php';

if (isset($conn) && $conn && !$conn->connect_error) {
    $dbMenuQuery = $conn->query("SELECT * FROM `menu` ORDER BY `id` ASC");
    if ($dbMenuQuery && $dbMenuQuery->num_rows > 0) {
        $dbMenus = [];
        while ($row = $dbMenuQuery->fetch_assoc()) {
            $dbMenus[] = [
                'id'             => (int)$row['id'],
                'nama'           => $row['nama'],
                'kategori'       => $row['kategori'],
                'kategori_label' => $row['kategori_label'],
                'badge'          => $row['badge'],
                'subjudul'       => $row['subjudul'],
                'deskripsi'      => $row['deskripsi'],
                'harga'          => (int)$row['harga'],
                'is_featured'    => (bool)$row['is_featured']
            ];
        }
        $menuItems = $dbMenus;
    }
}

// Menghitung jumlah menu berdasarkan kategori dengan fungsi PHP
$countCoffee    = count(array_filter($menuItems, fn($i) => $i['kategori'] === 'coffee'));
$countNonCoffee = count(array_filter($menuItems, fn($i) => $i['kategori'] === 'non-coffee'));
$countSnack     = count(array_filter($menuItems, fn($i) => $i['kategori'] === 'snack'));
$totalMenu      = count($menuItems);

// ========================================================
// 5. PAKET COMBO HEMAT
// ========================================================
$comboPackages = [
    [
        'id'            => 'combo-1',
        'code'          => 'Paket Kombo 01',
        'title'         => 'Combo Kopi & Snack',
        'item_name'     => "Combo Kopi & Snack (Signature + Kentang)",
        'items_desc'    => "1x Signature D'Bright + 1x Kentang Goreng",
        'price'         => 25000,
        'normal_price'  => 28000,
        'badge'         => 'Paling Laris',
        'badge_bg'      => 'bg-coffee text-white',
        'shadow_color'  => '#7F5539',
        'price_color'   => 'text-coffee',
        'features'      => [
            "1 Cup Kopi Khas Signature D'Bright",
            "1 Porsi Kentang Goreng Renyah",
            "Pilihan Varian Es / Panas"
        ]
    ],
    [
        'id'            => 'combo-2',
        'code'          => 'Paket Kombo 02',
        'title'         => 'Combo Nongkrong Berdua',
        'item_name'     => "Combo Nongkrong Berdua (Matcha + Kopsus)",
        'items_desc'    => "1x Matcha Latte + 1x Kopi Susu Klasik",
        'price'         => 28000,
        'normal_price'  => 31000,
        'badge'         => 'Nongkrong Berdua',
        'badge_bg'      => 'bg-stone-800 text-white',
        'shadow_color'  => '#44403c',
        'price_color'   => 'text-stone-900',
        'features'      => [
            "1 Cup Matcha Latte Creamy",
            "1 Cup Kopi Susu Klasik Gurih",
            "Bebas Atur Kadar Gula"
        ]
    ],
    [
        'id'            => 'combo-3',
        'code'          => 'Paket Kombo 03',
        'title'         => 'Combo Kenyang Mabar',
        'item_name'     => "Combo Kenyang Mabar (Platter + Tea)",
        'items_desc'    => "1x Platter Komplit + 1x Lemon/Lyche Tea",
        'price'         => 32000,
        'normal_price'  => 35000,
        'badge'         => 'Kenyang Mabar',
        'badge_bg'      => 'bg-coffee-light text-white',
        'shadow_color'  => '#B08968',
        'price_color'   => 'text-stone-900',
        'features'      => [
            "1 Platter Komplit (Kentang, Sosis, Nugget)",
            "1 Cup Lemon/Lyche Tea Segar",
            "Saus Sambal & Mayones"
        ]
    ]
];

// ========================================================
// 6. KEUNGGULAN (4 POIN)
// ========================================================
$keunggulanList = [
    [
        'nomor'     => '01',
        'kategori'  => 'Coffee Series',
        'judul'     => 'Biji Kopi Pilihan',
        'deskripsi' => "Diracik dari espresso bermutu tinggi untuk Americano, Kopi Susu Klasik, hingga Signature D'Bright yang harum dan mantap.",
        'link'      => '7 Varian Kopi →',
        'color'     => 'text-coffee',
        'border'    => 'hover:border-coffee',
        'shadow'    => 'hover:shadow-[6px_6px_0px_0px_#7F5539]'
    ],
    [
        'nomor'     => '02',
        'kategori'  => 'Non Coffee',
        'judul'     => 'Varian Rasa Lengkap',
        'deskripsi' => 'Pilihan segar favorit: Matcha Series (Strawberry, Oreo, Choco), Cokelat pekat, Red Velvet lembut, Taro, dan Tea segar.',
        'link'      => '9 Varian Non-Kopi →',
        'color'     => 'text-stone-700',
        'border'    => 'hover:border-stone-700',
        'shadow'    => 'hover:shadow-[6px_6px_0px_0px_#292524]'
    ],
    [
        'nomor'     => '03',
        'kategori'  => 'Snack & Food',
        'judul'     => 'Teman Nongkrong',
        'deskripsi' => 'Camilan hangat lezat: Kentang, Ubi Goreng, Dimsum Mentai viral, Banana Stick choco & tiramisu, hingga Indomie komplit.',
        'link'      => '8 Pilihan Snack →',
        'color'     => 'text-coffee-light',
        'border'    => 'hover:border-coffee-light',
        'shadow'    => 'hover:shadow-[6px_6px_0px_0px_#B08968]'
    ],
    [
        'nomor'     => '04',
        'kategori'  => 'Ramah Kantong',
        'judul'     => 'Harga Mulai Rp 8.000',
        'deskripsi' => 'Sangat hemat dan pas di kantong pelajar serta mahasiswa tanpa mengorbankan kualitas rasa dan porsi sajian.',
        'link'      => 'Hemat & Terjangkau →',
        'color'     => 'text-coffee',
        'border'    => 'hover:border-coffee',
        'shadow'    => 'hover:shadow-[6px_6px_0px_0px_#7F5539]'
    ]
];

// ========================================================
// 7. TESTIMONI PELANGGAN
// ========================================================
$testimonials = [
    [
        'nama'      => 'Nayla Azzahra R',
        'inisial'   => 'NA',
        'lokasi'    => 'Pelanggan Setia • Samata',
        'rating'    => '5.0 / 5.0',
        'ulasan'    => "Signature D'Bright-nya mantap banget! Kopinya terasa berkarakter dan pas manisnya. Ditambah Kentang Goreng hangat, cocok banget buat teman santai atau ngerjain tugas.",
        'avatar_bg' => 'bg-coffee'
    ],
    [
        'nama'      => 'Naswa Zahira',
        'inisial'   => 'NZ',
        'lokasi'    => 'Pelanggan Setia • Samata',
        'rating'    => '5.0 / 5.0',
        'ulasan'    => "Matcha Strawberry sama Dimsum Mentai-nya recommended banget! Minumannya segar dan saus mentainya gurih nikmat. Harganya juga sangat ramah di kantong.",
        'avatar_bg' => 'bg-stone-800'
    ],
    [
        'nama'      => 'Abid Aqila',
        'inisial'   => 'AA',
        'lokasi'    => 'Pelanggan Setia • Samata',
        'rating'    => '5.0 / 5.0',
        'ulasan'    => "Pelayanannya ramah dan prosesnya cepat. Platter komplitnya pas buat makan bareng pas kumpul bareng teman-teman di Samata.",
        'avatar_bg' => 'bg-coffee'
    ]
];

// ========================================================
// 8. PERTANYAAN UMUM (FAQ)
// ========================================================
$faqList = [
    [
        'pertanyaan' => 'Apakah minuman kopi & non-kopi bisa diatur kadar gulanya (less sugar / no sugar)?',
        'jawaban'    => 'Tentu bisa! Anda bebas memilih varian <strong>Normal Sugar (100%)</strong>, <strong>Less Sugar (70%)</strong>, atau <strong>No Sugar (0%)</strong>, serta tingkat es batu pada formulir pemesanan web kami atau langsung lewat pesan WhatsApp.'
    ],
    [
        'pertanyaan' => "Berapa jam operasional dan hari buka D'Bright Coffee?",
        'jawaban'    => "D'Bright Coffee buka <strong>setiap hari (Senin sampai Minggu)</strong> mulai pukul <strong>09.00 hingga 22.00 WITA</strong>. Anda dapat berkunjung langsung ke outlet kami di Jl. Mustafa Dg. Bunga No.33 Romang Polong, Gowa - Samata, ataupun order pesan antar."
    ],
    [
        'pertanyaan' => 'Apakah menerima pesanan partai banyak untuk kegiatan kampus / rapat?',
        'jawaban'    => 'Sangat bisa! Kami melayani pesanan partai besar (katering minuman kopi/non-kopi & snack) untuk acara seminar, rapat kampus, gathering organisasi, atau perayaan. Silakan hubungi nomor WhatsApp kami untuk koordinasi dan paket harga terbaik.'
    ],
    [
        'pertanyaan' => "Metode pembayaran apa saja yang diterima di D'Bright Coffee?",
        'jawaban'    => 'Kami menerima pembayaran tunai (cash), QRIS (mendukung GoPay, OVO, Dana, ShopeePay, LinkAja, serta seluruh aplikasi mobile banking), dan transfer bank langsung.'
    ]
];
