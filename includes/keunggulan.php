<?php
/**
 * Keunggulan Component - D'BRIGHT COFFEE
 * 4 Poin keunggulan di-loop dinamis dengan PHP
 */
?>
<!-- KEUNGGULAN SECTION -->
<section id="keunggulan" class="py-16 bg-white border-b border-cream-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-300 px-3 py-1 bg-cream-50">Keunggulan Kami</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-4 mb-3">
                Kualitas Minuman & Rasa
            </h2>
            <p class="text-stone-600 text-sm">
                <?= htmlspecialchars($outlet['nama']) ?> menghadirkan sajian kopi pilihan, racikan non-kopi segar, dan makanan ringan hangat berkualitas.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($keunggulanList as $item): ?>
                <div class="bg-white p-6 border-2 border-cream-300 <?= $item['border'] ?> shadow-[4px_4px_0px_0px_rgba(127,85,57,0.15)] <?= $item['shadow'] ?> hover:-translate-y-1 transition-all duration-200 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="font-mono font-bold text-xs bg-cream-100 <?= $item['color'] ?> px-2 py-1 border border-cream-300">[ <?= $item['nomor'] ?> ]</span>
                            <span class="text-[11px] font-bold uppercase tracking-wider <?= $item['color'] ?>"><?= htmlspecialchars($item['kategori']) ?></span>
                        </div>
                        <h3 class="font-heading font-bold text-lg text-stone-900 mb-2"><?= htmlspecialchars($item['judul']) ?></h3>
                        <p class="text-stone-600 text-xs leading-relaxed">
                            <?= htmlspecialchars($item['deskripsi']) ?>
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-cream-200 text-[11px] font-semibold <?= $item['color'] ?>">
                        <?= htmlspecialchars($item['link']) ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
