<?php
/**
 * Keunggulan Component - D'BRIGHT COFFEE
 * 4 Poin keunggulan dengan desain kartu modern dan rapi
 */
?>
<!-- KEUNGGULAN SECTION -->
<section id="keunggulan" class="py-16 bg-white border-b border-cream-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-200 px-3.5 py-1 rounded-full bg-cream-50 shadow-xs">Keunggulan Kami</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-3 mb-2.5">
                Kualitas Minuman & Rasa Autentik
            </h2>
            <p class="text-stone-600 text-sm">
                <?= htmlspecialchars($outlet['nama']) ?> menghadirkan racikan kopi pilihan, minuman non-kopi segar, dan makanan ringan hangat berkualitas terbaik.
            </p>
        </div>

        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <?php foreach ($keunggulanList as $item): ?>
                <div class="bg-white p-6 rounded-2xl border border-cream-200/90 shadow-sm hover:shadow-xl hover:border-coffee/30 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <span class="w-9 h-9 rounded-xl font-mono font-bold text-xs bg-cream-100 <?= $item['color'] ?> flex items-center justify-center border border-cream-200 shadow-xs">
                                <?= $item['nomor'] ?>
                            </span>
                            <span class="text-[10px] font-bold uppercase tracking-wider px-2 py-0.5 rounded-full bg-cream-50 border border-cream-200 <?= $item['color'] ?>">
                                <?= htmlspecialchars($item['kategori']) ?>
                            </span>
                        </div>
                        <h3 class="font-heading font-bold text-base text-stone-900 mb-2 group-hover:text-coffee transition-colors"><?= htmlspecialchars($item['judul']) ?></h3>
                        <p class="text-stone-600 text-xs leading-relaxed">
                            <?= htmlspecialchars($item['deskripsi']) ?>
                        </p>
                    </div>
                    <div class="mt-5 pt-3 border-t border-cream-100 text-[11px] font-bold <?= $item['color'] ?> flex items-center gap-1">
                        <span><?= htmlspecialchars($item['link']) ?></span>
                        <span class="transform group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
