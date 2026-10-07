<?php
/**
 * FAQ Component - D'BRIGHT COFFEE
 * Accordion tanya jawab interaktif dengan desain rounded modern
 */
?>
<!-- FAQ ACCORDION SECTION -->
<section id="faq" class="py-16 bg-cream-50/60 border-b border-cream-200/80">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-200 px-3.5 py-1 rounded-full bg-white shadow-xs">Pusat Bantuan</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-3 mb-2.5">
                Pertanyaan yang Sering Diajukan (FAQ)
            </h2>
            <p class="text-stone-600 text-sm">
                Jawaban seputar pemesanan, jam buka, dan layanan terbaik di <?= htmlspecialchars($outlet['nama']) ?>.
            </p>
        </div>

        <div class="space-y-3.5" id="faqAccordion">
            <?php foreach ($faqList as $faq): ?>
                <div class="faq-item rounded-2xl border border-cream-200/90 bg-white shadow-xs hover:border-cream-300 transition-all overflow-hidden">
                    <button type="button" class="faq-toggle w-full px-6 py-4.5 text-left font-heading font-bold text-stone-900 flex items-center justify-between text-sm sm:text-base hover:text-coffee transition cursor-pointer">
                        <span><?= htmlspecialchars($faq['pertanyaan']) ?></span>
                        <span class="faq-icon text-sm font-bold text-coffee ml-3 w-7 h-7 rounded-full bg-cream-100/70 border border-cream-200 flex items-center justify-center shrink-0 select-none shadow-xs">+</span>
                    </button>
                    <div class="faq-content hidden px-6 pb-5 pt-1 text-xs sm:text-sm text-stone-600 border-t border-cream-100 leading-relaxed bg-cream-50/40">
                        <?= $faq['jawaban'] ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
