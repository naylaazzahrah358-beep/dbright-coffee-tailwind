<?php
/**
 * Cara Pesan Component - D'BRIGHT COFFEE
 * 3 Langkah mudah panduan pemesanan online dengan kartu modern
 */
?>
<!-- CARA PEMESANAN -->
<section id="cara-pesan" class="py-16 bg-stone-900 text-cream-100 border-b border-stone-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-12">
            <span class="text-amber-300 font-bold text-xs uppercase tracking-widest border border-stone-700 px-3.5 py-1 rounded-full bg-stone-800/80 shadow-xs">Panduan Praktis</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl mt-3 mb-2 text-white">Cara Mudah Memesan</h2>
            <p class="text-stone-400 text-xs sm:text-sm">3 langkah singkat untuk menikmati hidangan kopi dan snack favorit Anda.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 text-center">
            <div class="bg-stone-800/80 p-7 rounded-3xl border border-stone-700/80 shadow-lg hover:shadow-2xl hover:border-amber-500/40 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center">
                <div class="w-12 h-12 rounded-2xl bg-coffee text-white flex items-center justify-center font-black text-lg mb-4 shadow-md">
                    1
                </div>
                <h3 class="font-heading font-bold text-base mb-2 text-white">Pilih Menu</h3>
                <p class="text-stone-300 text-xs leading-relaxed max-w-xs">
                    Tentukan pilihan Kopi, Non-Kopi, atau Snack lezat favorit Anda dari katalog lengkap <?= $totalMenu ?> menu.
                </p>
            </div>

            <div class="bg-stone-800/80 p-7 rounded-3xl border border-stone-700/80 shadow-lg hover:shadow-2xl hover:border-amber-500/40 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center">
                <div class="w-12 h-12 rounded-2xl bg-coffee text-white flex items-center justify-center font-black text-lg mb-4 shadow-md">
                    2
                </div>
                <h3 class="font-heading font-bold text-base mb-2 text-white">Atur Jumlah & Varian</h3>
                <p class="text-stone-300 text-xs leading-relaxed max-w-xs">
                    Pilih ukuran cup (Regular/Large), atur tingkat kemanisan gula, topping, serta jumlah porsi yang diinginkan.
                </p>
            </div>

            <div class="bg-stone-800/80 p-7 rounded-3xl border border-stone-700/80 shadow-lg hover:shadow-2xl hover:border-amber-500/40 hover:-translate-y-1.5 transition-all duration-300 flex flex-col items-center">
                <div class="w-12 h-12 rounded-2xl bg-coffee text-white flex items-center justify-center font-black text-lg mb-4 shadow-md">
                    3
                </div>
                <h3 class="font-heading font-bold text-base mb-2 text-white">Konfirmasi WhatsApp</h3>
                <p class="text-stone-300 text-xs leading-relaxed max-w-xs">
                    Total pesanan dihitung otomatis dan tersimpan di database, lalu dikirim via pesan WhatsApp resmi outlet kami.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- WAVE SECTION DIVIDER -->
<div class="relative w-full overflow-hidden leading-none bg-stone-900 pointer-events-none select-none -mt-1">
    <svg class="relative block w-full h-6 sm:h-10 text-white fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 C150,70 350,-20 550,50 C750,110 950,20 1200,40 L1200,120 L0,120 Z"></path>
    </svg>
</div>
