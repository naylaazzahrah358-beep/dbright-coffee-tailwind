<?php
/**
 * Footer Component - D'BRIGHT COFFEE
 * Berisi informasi footer, navigasi bawah, profil pengembang, scroll-to-top button, dan toast
 */
?>
<!-- FOOTER -->
<footer class="bg-stone-950 text-stone-400 text-xs pt-12 pb-8 border-t border-stone-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <!-- Brand Info -->
            <div class="md:col-span-2">
                <div class="flex items-center gap-3 mb-3">
                    <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo <?= htmlspecialchars($outlet['nama']) ?>" class="w-12 h-12 object-cover border border-stone-800">
                    <div>
                        <span class="font-heading font-black text-xl text-white tracking-tight block leading-none">
                            D'BRIGHT <span class="text-coffee-light">COFFEE</span>
                        </span>
                        <span class="text-[10px] text-stone-400 tracking-wider uppercase mt-1 block">Official Coffee & Snack</span>
                    </div>
                </div>
                <p class="text-stone-400 leading-relaxed max-w-sm mb-4">
                    Brand minuman dan kopi kekinian dengan menu Coffee, Non Coffee, dan Snack lezat harga terjangkau untuk seluruh kalangan.
                </p>
                <div class="space-y-1 text-stone-300">
                    <p>Instagram: <a href="<?= htmlspecialchars($outlet['instagram_url']) ?>" target="_blank" rel="noopener noreferrer" class="text-coffee-light hover:underline"><?= htmlspecialchars($outlet['instagram']) ?></a></p>
                    <p>WhatsApp: <a href="https://wa.me/<?= htmlspecialchars($outlet['whatsapp_full']) ?>" target="_blank" rel="noopener noreferrer" class="text-coffee-light hover:underline"><?= htmlspecialchars($outlet['whatsapp']) ?></a></p>
                    <p>Lokasi: <?= htmlspecialchars($outlet['alamat']) ?></p>
                </div>
            </div>

            <!-- Navigasi Cepat -->
            <div>
                <h4 class="font-heading font-bold text-white text-xs uppercase tracking-wider mb-3">Navigasi Halaman</h4>
                <ul class="space-y-2">
                    <li><a href="#beranda" class="hover:text-coffee-light">Beranda</a></li>
                    <li><a href="#keunggulan" class="hover:text-coffee-light">Keunggulan Kami</a></li>
                    <li><a href="#menu" class="hover:text-coffee-light">Daftar Menu (<?= $totalMenu ?>)</a></li>
                    <li><a href="#promo" class="hover:text-coffee-light">Paket Promo</a></li>
                    <li><a href="#testimoni" class="hover:text-coffee-light">Testimoni Pelanggan</a></li>
                    <li><a href="#faq" class="hover:text-coffee-light">Pertanyaan (FAQ)</a></li>
                    <li><a href="#kontak" class="hover:text-coffee-light">Lokasi & WhatsApp</a></li>
                    <li><a href="index.php?admin=1#menu" class="text-amber-400 font-bold hover:underline">Mode Admin (Kelola Menu & Pesanan) ⚙️</a></li>
                </ul>
            </div>

            <!-- Pengembang Info -->
            <div>
                <h4 class="font-heading font-bold text-white text-xs uppercase tracking-wider mb-3">Kreator & Pengembang</h4>
                <div class="space-y-1.5">
                    <p class="font-semibold text-white"><?= htmlspecialchars($outlet['pengembang']['nama']) ?></p>
                    <p><?= htmlspecialchars($outlet['pengembang']['kampus']) ?></p>
                    <p><?= htmlspecialchars($outlet['pengembang']['matkul']) ?></p>
                    <div class="pt-2">
                        <a href="<?= htmlspecialchars($outlet['pengembang']['portofolio']) ?>" target="_blank" rel="noopener noreferrer" class="text-coffee-light hover:underline font-semibold">
                            &rarr; Buka Portofolio Utama
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-6 border-t border-stone-800 text-stone-500 flex flex-col sm:flex-row items-center justify-between gap-2">
            <p>&copy; <?= date('Y') ?> <?= htmlspecialchars($outlet['nama']) ?> &bull; <?= htmlspecialchars($outlet['pengembang']['nama']) ?></p>
            <p>Kelas C Angkatan 2025 &bull; FT-UNM</p>
        </div>
    </div>
</footer>

<!-- FLOATING TOAST NOTIFICATION (JQUERY INTERACTIVE) -->
<div id="toastNotification" class="fixed top-24 right-4 z-50 bg-stone-950 text-white border-2 border-coffee-light px-4 py-3 shadow-2xl text-xs font-semibold hidden items-center gap-3">
    <span class="w-2.5 h-2.5 bg-coffee-light shrink-0"></span>
    <span id="toastMessage">Memuat pesanan...</span>
</div>

<!-- FLOATING SCROLL TO TOP BUTTON (JQUERY INTERACTIVE) -->
<button id="btnScrollTop" title="Kembali ke Atas" class="hidden fixed bottom-6 right-6 z-40 bg-stone-900 hover:bg-coffee text-white px-3.5 py-2.5 border-2 border-cream-300 text-xs font-bold tracking-wider transition shadow-[4px_4px_0px_0px_#7F5539] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 items-center gap-1.5 cursor-pointer">
    <span>&uarr;</span> KE ATAS
</button>
