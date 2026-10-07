<?php
/**
 * Splash Screen Component - D'BRIGHT COFFEE
 * Tampilan pembuka animasi proses pembuatan kopi
 */
?>
<!-- OPENING SCREEN (SPLASH SCREEN & LOGO RESMI SEBELUM MASUK HALAMAN) -->
<div id="openingScreen" class="fixed inset-0 z-50 bg-cream-100 flex flex-col items-center justify-center p-6 text-center select-none">
    <div class="max-w-md w-full flex flex-col items-center">
        
        <!-- Logo Container with Tactile Frame & Floating Wave Motion -->
        <div class="relative mb-6 animate-float-wave">
            <!-- Offset Brutalist Shadow Box -->
            <div class="absolute inset-0 bg-coffee translate-x-2.5 translate-y-2.5"></div>
            <!-- Main White Box with Official Logo -->
            <div class="relative bg-white p-5 border-4 border-stone-900 shadow-2xl">
                <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo Resmi <?= htmlspecialchars($outlet['nama']) ?>" class="w-28 h-28 sm:w-36 sm:h-36 object-cover mx-auto">
            </div>
            <!-- Badge At Bottom of Logo -->
            <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 bg-stone-900 text-cream-100 border border-cream-300 px-3 py-0.5 text-[10px] font-bold uppercase tracking-widest whitespace-nowrap">
                Official Coffee & Snack
            </div>
        </div>

        <!-- Brand Typography -->
        <h1 class="font-heading font-black text-2xl sm:text-3xl text-stone-900 tracking-tight mt-2 mb-1">
            D'BRIGHT <span class="text-coffee">COFFEE</span>
        </h1>
        <p class="text-xs sm:text-sm text-stone-600 font-semibold tracking-wider uppercase mb-6">
            <?= htmlspecialchars($outlet['slogan']) ?>
        </p>

        <!-- Animated Progress Bar -->
        <div class="w-60 sm:w-72 bg-cream-200 border-2 border-stone-900 p-0.5 mb-2.5 shadow-[3px_3px_0px_0px_#1c1917]">
            <div id="openingProgressBar" class="h-2.5 bg-coffee transition-all duration-300 w-0"></div>
        </div>
        <p id="openingStatusText" class="text-[11px] font-bold text-stone-500 tracking-wider uppercase mb-6">
            Menyeduh Pengalaman Terbaik...
        </p>

        <!-- Action Button (Pengguna dapat langsung klik masuk tanpa menunggu) -->
        <button id="btnEnterSite" type="button" class="px-7 py-3 bg-stone-900 hover:bg-coffee text-white font-bold text-xs uppercase tracking-wider border-2 border-cream-300 shadow-[4px_4px_0px_0px_#7F5539] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all cursor-pointer flex items-center gap-2">
            <span>Masuk ke Halaman</span>
            <span>&rarr;</span>
        </button>

        <!-- Outlet Location Note -->
        <div class="mt-8 pt-4 border-t border-cream-300/80 text-[11px] text-stone-500 flex items-center justify-center gap-2">
            <span class="w-2 h-2 bg-emerald-600 inline-block animate-pulse"></span>
            <span>Romang Polong, Samata - Gowa &bull; Buka <?= sprintf('%02d:00', $outlet['jam_buka']) ?> - <?= sprintf('%02d:00', $outlet['jam_tutup']) ?> WITA</span>
        </div>

    </div>
</div>
