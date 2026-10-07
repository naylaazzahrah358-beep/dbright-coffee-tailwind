<?php
/**
 * Testimoni Component - D'BRIGHT COFFEE
 * Daftar ulasan pelanggan dengan desain kartu elegan dan modern
 */
?>
<!-- TESTIMONI PELANGGAN -->
<section id="testimoni" class="py-16 bg-white border-b border-cream-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-200 px-3.5 py-1 rounded-full bg-cream-50 shadow-xs">Kata Pelanggan</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-3 mb-2.5">
                Ulasan & Testimoni
            </h2>
            <p class="text-stone-600 text-sm">
                Pendapat jujur dari para pecinta kopi dan pelanggan setia yang telah merasakan nikmatnya menu <?= htmlspecialchars($outlet['nama']) ?>.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($testimonials as $testi): ?>
                <div class="bg-white p-7 rounded-3xl border border-cream-200/90 hover:border-coffee/40 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-amber-400 font-bold text-sm tracking-wider">★★★★★</span>
                            <span class="text-[10px] font-bold bg-cream-100/70 text-coffee px-2.5 py-0.5 rounded-full border border-cream-200"><?= htmlspecialchars($testi['rating']) ?></span>
                        </div>
                        <p class="text-stone-700 text-xs sm:text-sm leading-relaxed italic mb-6">
                            "<?= htmlspecialchars($testi['ulasan']) ?>"
                        </p>
                    </div>
                    <div class="pt-4 border-t border-cream-100 flex items-center gap-3">
                        <div class="w-10 h-10 <?= $testi['avatar_bg'] ?> text-white font-heading font-extrabold text-xs flex items-center justify-center rounded-full shadow-xs select-none">
                            <?= htmlspecialchars($testi['inisial']) ?>
                        </div>
                        <div>
                            <h4 class="font-bold text-sm text-stone-900 leading-tight group-hover:text-coffee transition-colors"><?= htmlspecialchars($testi['nama']) ?></h4>
                            <span class="text-[11px] text-stone-500 font-medium block"><?= htmlspecialchars($testi['lokasi']) ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
