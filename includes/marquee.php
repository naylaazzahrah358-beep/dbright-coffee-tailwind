<?php
/**
 * Marquee Component - D'BRIGHT COFFEE
 * Teks berjalan animasi D'BRIGHT COFFEE
 */
?>
<!-- ANIMATED RUNNING MARQUEE BANNER (TEKS BERJALAN: D'BRIGHT COFFEE) -->
<div class="bg-stone-900 text-cream-100 py-3 border-y-2 border-stone-950 overflow-hidden relative shadow-inner">
    <div class="flex whitespace-nowrap animate-marquee">
        <span class="mx-4 text-xs sm:text-sm font-heading font-black tracking-widest uppercase flex items-center gap-6">
            <?php for ($i = 0; $i < 8; $i++): ?>
                <span><?= htmlspecialchars($outlet['nama']) ?></span>
                <span class="text-coffee-light text-base">•</span>
            <?php endfor; ?>
        </span>
        <span class="mx-4 text-xs sm:text-sm font-heading font-black tracking-widest uppercase flex items-center gap-6" aria-hidden="true">
            <?php for ($i = 0; $i < 8; $i++): ?>
                <span><?= htmlspecialchars($outlet['nama']) ?></span>
                <span class="text-coffee-light text-base">•</span>
            <?php endfor; ?>
        </span>
    </div>
</div>
