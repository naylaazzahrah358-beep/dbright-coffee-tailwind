<?php
/**
 * Promo Component - D'BRIGHT COFFEE
 * Paket combo hemat dan countdown timer promo harian dengan tampilan modern dan rapi
 */
?>
<!-- PROMO & PAKET HEMAT SECTION -->
<section id="promo" class="py-16 bg-white border-b border-cream-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-10">
            <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-200 px-3.5 py-1 rounded-full bg-cream-50 shadow-xs">Paket Hemat Spesial</span>
            <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-3 mb-2.5">
                Paket Combo Hemat D'Bright
            </h2>
            <p class="text-stone-600 text-sm mb-5">
                Pilihan bundling hemat minuman dan snack favorit untuk dinikmati bersama teman atau sendiri.
            </p>

            <!-- Live Daily Countdown Timer -->
            <div class="inline-flex items-center gap-3 px-4 py-2 bg-cream-100/80 border border-cream-200 rounded-full text-xs font-semibold text-stone-700 shadow-xs">
                <span class="text-coffee font-bold uppercase tracking-wider flex items-center gap-1">
                    <span>⏳</span>
                    <span>Promo Hari Ini Berakhir:</span>
                </span>
                <div id="promoTimer" class="font-mono font-bold text-coffee text-sm tracking-widest bg-white px-3 py-0.5 rounded-full border border-cream-300 shadow-xs">
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
                <div class="bg-white p-6 sm:p-7 rounded-3xl border border-cream-200/90 shadow-md hover:shadow-2xl hover:border-coffee/40 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between relative group">
                    <div class="flex items-center justify-between mb-4">
                        <span class="text-[11px] font-bold text-coffee uppercase tracking-wider bg-cream-100/70 px-2.5 py-1 rounded-full border border-cream-200"><?= htmlspecialchars($combo['code']) ?></span>
                        <span class="<?= $combo['badge_bg'] ?> text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider shadow-xs">
                            <?= htmlspecialchars($combo['badge']) ?>
                        </span>
                    </div>

                    <div>
                        <h3 class="font-heading font-extrabold text-xl text-stone-900 mb-1 group-hover:text-coffee transition-colors"><?= htmlspecialchars($combo['title']) ?></h3>
                        <p class="text-xs text-stone-500 mb-4"><?= htmlspecialchars($combo['items_desc']) ?></p>
                        
                        <div class="flex items-baseline gap-2 mb-4 bg-cream-50/80 p-3.5 rounded-2xl border border-cream-200">
                            <span class="font-heading font-black text-2xl <?= $combo['price_color'] ?>"><?= formatRupiah($combo['price']) ?></span>
                            <span class="text-xs text-stone-400 line-through"><?= formatRupiah($combo['normal_price']) ?></span>
                            <span class="ml-auto text-[10px] font-bold text-emerald-800 bg-emerald-100 px-2.5 py-1 rounded-full border border-emerald-200"><?= $hematLabel ?></span>
                        </div>

                        <ul class="space-y-2 text-xs text-stone-600 mb-6 border-t border-cream-100 pt-4">
                            <?php foreach ($combo['features'] as $feat): ?>
                                <li class="flex items-center gap-2"><span class="text-emerald-600 font-bold">✓</span> <?= htmlspecialchars($feat) ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>

                    <button class="btn-order-item w-full py-3 bg-coffee hover:bg-coffee-dark text-white font-bold text-xs rounded-xl shadow-md hover:shadow-lg transition-all cursor-pointer flex items-center justify-center gap-1.5" data-name="<?= htmlspecialchars($combo['item_name']) ?>" data-price="<?= $combo['price'] ?>" data-category="combo">
                        <span>Pesan Paket Ini</span>
                        <span>&rarr;</span>
                    </button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
