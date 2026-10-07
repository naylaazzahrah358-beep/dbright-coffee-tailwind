<?php
/**
 * Testimoni Component - D'BRIGHT COFFEE
 * Daftar ulasan pelanggan dirender dinamis via PHP
 */
?>
<!-- TESTIMONI PELANGGAN -->
<section id="testimoni" class="py-16 bg-white border-b border-cream-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-300 px-3 py-1 bg-cream-50">Ulasan</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-4 mb-2">
                Testimoni Pelanggan
            </h2>
            <p class="text-stone-600 text-sm">
                Ulasan dari para pelanggan yang telah mencoba menu <?= htmlspecialchars($outlet['nama']) ?>.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($testimonials as $testi): ?>
                <div class="bg-white p-6 border-2 border-cream-300 hover:border-coffee shadow-[4px_4px_0px_0px_rgba(127,85,57,0.15)] hover:shadow-[6px_6px_0px_0px_#7F5539] hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-amber-500 font-bold text-sm tracking-widest">★★★★★</span>
                            <span class="text-[10px] font-bold bg-cream-100 text-coffee px-2 py-0.5 border border-cream-300"><?= htmlspecialchars($testi['rating']) ?></span>
                        </div>
                        <p class="text-stone-700 text-xs sm:text-sm leading-relaxed italic mb-6">
                            "<?= htmlspecialchars($testi['ulasan']) ?>"
                        </p>
                    </div>
                    <div class="pt-4 border-t border-cream-200 flex items-center gap-3">
                        <div class="w-9 h-9 <?= $testi['avatar_bg'] ?> text-white font-heading font-extrabold text-xs flex items-center justify-center border border-stone-900 select-none">
                            <?= htmlspecialchars($testi['inisial']) ?>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-stone-900 leading-tight"><?= htmlspecialchars($testi['nama']) ?></h4>
                            <span class="text-[10px] text-stone-500 font-semibold block"><?= htmlspecialchars($testi['lokasi']) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
