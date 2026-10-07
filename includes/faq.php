<?php
/**
 * FAQ Component - D'BRIGHT COFFEE
 * Accordion tanya jawab interaktif dengan looping PHP
 */
?>
<!-- FAQ ACCORDION SECTION (JQUERY INTERACTIVE SLIDETOGGLE) -->
<section id="faq" class="py-16 bg-white border-b border-cream-200">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-300 px-3 py-1 bg-cream-50">Tanya Jawab</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-4 mb-3">
                Pertanyaan yang Sering Diajukan (FAQ)
            </h2>
            <p class="text-stone-600 text-sm">
                Klik pertanyaan di bawah untuk melihat rincian informasi seputar pemesanan dan layanan <?= htmlspecialchars($outlet['nama']) ?>.
            </p>
        </div>

        <div class="space-y-3" id="faqAccordion">
            <?php foreach ($faqList as $faq): ?>
                <div class="faq-item border border-cream-300 bg-cream-50">
                    <button type="button" class="faq-toggle w-full px-5 py-4 text-left font-heading font-bold text-stone-900 flex items-center justify-between text-sm sm:text-base hover:text-coffee transition cursor-pointer">
                        <span><?= htmlspecialchars($faq['pertanyaan']) ?></span>
                        <span class="faq-icon text-base font-bold text-coffee ml-3 w-6 h-6 border border-cream-300 flex items-center justify-center bg-white shrink-0 select-none">+</span>
                    </button>
                    <div class="faq-content hidden px-5 pb-4 pt-1 text-xs sm:text-sm text-stone-600 border-t border-cream-200 leading-relaxed bg-white">
                        <?= $faq['jawaban'] ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
