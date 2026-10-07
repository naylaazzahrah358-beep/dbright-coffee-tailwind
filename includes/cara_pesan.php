<?php
/**
 * Cara Pesan Component - D'BRIGHT COFFEE
 * 3 Langkah mudah panduan pemesanan online
 */
?>
<!-- CARA PEMESANAN -->
<section id="cara-pesan" class="py-14 bg-stone-900 text-cream-100 border-b border-cream-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-xl mx-auto mb-10">
            <span class="text-cream-300 font-bold text-xs uppercase tracking-widest border border-stone-700 px-3 py-1">Panduan Order</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl mt-3 mb-2 text-white">Cara Memesan</h2>
            <p class="text-stone-400 text-xs">3 langkah singkat untuk menikmati pesanan Anda.</p>
        </div>

        <div class="grid md:grid-cols-3 gap-6 text-center">
            <div class="bg-stone-800 p-6 border border-stone-700">
                <div class="w-10 h-10 bg-coffee text-white flex items-center justify-center font-bold text-lg mx-auto mb-3">
                    1
                </div>
                <h3 class="font-heading font-bold text-base mb-2 text-white">Pilih Menu</h3>
                <p class="text-stone-300 text-xs leading-relaxed">
                    Tentukan pilihan Kopi, Non-Kopi, atau Snack lezat di katalog <?= $totalMenu ?> menu.
                </p>
            </div>

            <div class="bg-stone-800 p-6 border border-stone-700">
                <div class="w-10 h-10 bg-coffee text-white flex items-center justify-center font-bold text-lg mx-auto mb-3">
                    2
                </div>
                <h3 class="font-heading font-bold text-base mb-2 text-white">Atur Jumlah & Rasa</h3>
                <p class="text-stone-300 text-xs leading-relaxed">
                    Pilih ukuran cup, tentukan jumlah porsi, serta catatan khusus pesanan Anda.
                </p>
            </div>

            <div class="bg-stone-800 p-6 border border-stone-700">
                <div class="w-10 h-10 bg-coffee text-white flex items-center justify-center font-bold text-lg mx-auto mb-3">
                    3
                </div>
                <h3 class="font-heading font-bold text-base mb-2 text-white">Kirim ke WhatsApp</h3>
                <p class="text-stone-300 text-xs leading-relaxed">
                    Total harga dihitung otomatis dan langsung kirim pesan konfirmasi ke WhatsApp penjual.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- WAVE TRANSITION DIVIDER KE SECTION TESTIMONI -->
<div class="relative w-full overflow-hidden leading-none bg-stone-900 pointer-events-none select-none -mt-1">
    <svg class="relative block w-full h-8 sm:h-12 text-white fill-current" viewBox="0 0 1200 120" preserveAspectRatio="none">
        <path d="M0,0 C150,70 350,-20 550,50 C750,110 950,20 1200,40 L1200,120 L0,120 Z"></path>
    </svg>
</div>
