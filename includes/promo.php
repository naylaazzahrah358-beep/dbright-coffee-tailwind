<?php
/**
 * Promo Component - D'BRIGHT COFFEE
 * Paket combo hemat dan countdown timer promo harian
 */
?>
<!-- PROMO & PAKET HEMAT SECTION -->
<section id="promo" class="py-16 bg-white border-b border-cream-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-300 px-3 py-1 bg-cream-50">Paket Hemat</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-4 mb-3">
                Paket Combo Hemat D'Bright
            </h2>
            <p class="text-stone-600 text-sm mb-5">
                Pilihan paket hemat minuman dan snack untuk kumpul seru bareng teman.
            </p>

            <!-- Live Daily Countdown Timer (jQuery) -->
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-cream-100 border border-cream-300 text-xs font-semibold text-stone-800">
                <span class="text-coffee font-bold uppercase tracking-wider">Promo Hari Ini Berakhir:</span>
                <div id="promoTimer" class="font-mono font-bold text-coffee text-sm tracking-widest bg-white px-2 py-0.5 border border-cream-300">
                    <span id="timerHours">08</span> : <span id="timerMins">45</span> : <span id="timerSecs">20</span>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-6">
            <?php foreach ($comboPackages as $combo): ?>
                <?php
                $hemat = $combo['normal_price'] - $combo['price'];
                $hematLabel = 'Hemat ' . ($hemat / 1000) . 'k';
                ?>
                <div class="bg-white p-6 border-2 border-stone-900 shadow-[6px_6px_0px_0px_<?= $combo['shadow_color'] ?>] flex flex-col justify-between relative">
                    <div class="absolute -top-3 left-6 <?= $combo['badge_bg'] ?> text-[10px] font-bold px-3 py-1 border border-stone-900 uppercase tracking-widest">
                        <?= htmlspecialchars($combo['badge']) ?>
                    </div>
                    <div class="pt-2">
                        <span class="text-[11px] font-bold text-coffee uppercase tracking-wider block mb-1"><?= htmlspecialchars($combo['code']) ?></span>
                        <h3 class="font-heading font-extrabold text-xl text-stone-900 mb-1"><?= htmlspecialchars($combo['title']) ?></h3>
                        <p class="text-xs text-stone-500 mb-4"><?= htmlspecialchars($combo['items_desc']) ?></p>
                        <div class="flex items-baseline gap-2 mb-4 bg-cream-50 p-3 border border-cream-300">
                            <span class="font-heading font-black text-2xl <?= $combo['price_color'] ?>"><?= formatRupiah($combo['price']) ?></span>
                            <span class="text-xs text-stone-400 line-through"><?= formatRupiah($combo['normal_price']) ?></span>
                            <span class="ml-auto text-[10px] font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 border border-emerald-300"><?= $hematLabel ?></span>
                        </div>
                        <ul class="space-y-2 text-xs text-stone-600 mb-6 border-t border-cream-200 pt-4">
                            <?php foreach ($combo['features'] as $feat): ?>
                                <li class="flex items-center gap-2"><span class="text-coffee font-bold">&check;</span> <?= htmlspecialchars($feat) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <button class="btn-order-item w-full py-3 bg-coffee hover:bg-coffee-dark text-white font-bold text-xs border-2 border-stone-900 shadow-[3px_3px_0px_0px_#1c1917] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all cursor-pointer" data-name="<?= htmlspecialchars($combo['item_name']) ?>" data-price="<?= $combo['price'] ?>" data-category="combo">
                        Pesan Paket Ini &rarr;
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
