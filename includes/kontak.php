<?php
/**
 * Kontak Component - D'BRIGHT COFFEE
 * Berisi informasi kontak, form order cepat (dengan opsi menu dinamis PHP), dan peta Google Maps yang rapi
 */
?>
<!-- LOKASI & KONTAK OUTLET -->
<section id="kontak" class="py-16 bg-cream-100/50 border-b border-cream-200/80">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white p-7 sm:p-10 rounded-3xl border border-cream-200/90 shadow-xl">
            <div class="grid lg:grid-cols-12 gap-8 items-start">
                
                <!-- Left Column: Informasi Outlet -->
                <div class="lg:col-span-7">
                    <span class="text-coffee font-bold text-xs uppercase tracking-widest border border-cream-200 px-3.5 py-1 rounded-full bg-cream-50 shadow-xs">Informasi Outlet</span>
                    <h2 class="font-heading font-extrabold text-2xl sm:text-3xl text-stone-900 mt-3 mb-2.5">
                        Lokasi & Kontak Pemesanan
                    </h2>
                    <p class="text-stone-600 text-sm leading-relaxed mb-6">
                        Kunjungi kedai kami untuk bersantai atau pesan langsung melalui formulir otomatis WhatsApp di samping.
                    </p>

                    <div class="space-y-3.5 text-xs sm:text-sm text-stone-800">
                        <!-- Lokasi Outlet -->
                        <div class="p-4 bg-cream-50/70 rounded-2xl border border-cream-200 flex flex-col sm:flex-row sm:items-center justify-between gap-3 shadow-xs">
                            <div>
                                <span class="font-bold block text-stone-900 mb-0.5">Alamat Outlet:</span>
                                <span id="outletAddressText" class="text-stone-600 font-medium"><?= htmlspecialchars($outlet['alamat']) ?></span>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button" id="btnCopyAddress" class="px-3 py-1.5 bg-white hover:bg-cream-100 border border-cream-300 rounded-xl font-bold text-xs text-stone-700 transition select-none cursor-pointer shadow-xs">
                                    Salin Alamat
                                </button>
                                <a href="<?= htmlspecialchars($outlet['maps_url']) ?>" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 bg-coffee text-white rounded-xl font-bold text-xs hover:bg-coffee-dark transition select-none shadow-xs">
                                    Peta &rarr;
                                </a>
                            </div>
                        </div>

                        <!-- Jam Operasional -->
                        <div class="p-4 bg-cream-50/70 rounded-2xl border border-cream-200 shadow-xs">
                            <span class="font-bold block text-stone-900 mb-0.5">Jam Operasional:</span>
                            <span class="text-stone-600">Setiap Hari (Senin - Minggu) : <strong><?= sprintf('%02d.00', $outlet['jam_buka']) ?> - <?= sprintf('%02d.00', $outlet['jam_tutup']) ?> WITA</strong></span>
                        </div>

                        <!-- WhatsApp -->
                        <div class="p-4 bg-cream-50/70 rounded-2xl border border-cream-200 flex items-center justify-between gap-3 shadow-xs">
                            <div>
                                <span class="font-bold block text-stone-900 mb-0.5">Kontak WhatsApp Hotline:</span>
                                <a href="https://wa.me/<?= htmlspecialchars($outlet['whatsapp_full']) ?>" target="_blank" rel="noopener noreferrer" class="text-coffee hover:underline font-bold text-base" id="outletPhoneText">
                                    <?= htmlspecialchars($outlet['whatsapp']) ?>
                                </a>
                            </div>
                            <button type="button" id="btnCopyPhone" class="px-3 py-1.5 bg-white hover:bg-cream-100 border border-cream-300 rounded-xl font-bold text-xs text-stone-700 shrink-0 transition select-none cursor-pointer shadow-xs">
                                Salin Nomor
                            </button>
                        </div>

                        <!-- Instagram -->
                        <div class="p-4 bg-cream-50/70 rounded-2xl border border-cream-200 flex items-center justify-between gap-3 shadow-xs">
                            <div>
                                <span class="font-bold block text-stone-900 mb-0.5">Instagram Resmi:</span>
                                <a href="<?= htmlspecialchars($outlet['instagram_url']) ?>" target="_blank" rel="noopener noreferrer" class="text-coffee hover:underline font-bold text-sm">
                                    <?= htmlspecialchars($outlet['instagram']) ?>
                                </a>
                            </div>
                            <a href="<?= htmlspecialchars($outlet['instagram_url']) ?>" target="_blank" rel="noopener noreferrer" class="px-3 py-1.5 bg-white hover:bg-cream-100 border border-cream-300 rounded-xl font-bold text-xs text-stone-700 shrink-0 transition select-none shadow-xs">
                                Kunjungi &rarr;
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Fast Order Form Box -->
                <div class="lg:col-span-5 bg-stone-900 p-6 sm:p-7 rounded-3xl text-cream-100 border border-stone-800 shadow-xl">
                    <h3 class="font-heading font-extrabold text-xl mb-1 text-white">Form Order Cepat</h3>
                    <p class="text-stone-400 text-xs mb-5">Pesan menu favorit Anda dan langsung terhubung ke WhatsApp.</p>
                    
                    <form id="fastOrderForm" action="process-order.php" method="POST" class="space-y-3.5 text-xs text-stone-800">
                        <input type="hidden" name="form_type" value="fast_order">
                        <div>
                            <label class="block text-cream-100 font-semibold mb-1">Nama Pemesan:</label>
                            <input type="text" name="cust_name" id="custName" required placeholder="Nama Anda" class="w-full px-3.5 py-2.5 bg-white border border-cream-300 rounded-xl outline-none font-medium text-stone-900 focus:ring-2 focus:ring-amber-400">
                        </div>

                        <div>
                            <label class="block text-cream-100 font-semibold mb-1">Pilihan Menu:</label>
                            <select name="cust_drink" id="custDrink" class="w-full px-3.5 py-2.5 bg-white border border-cream-300 rounded-xl outline-none font-semibold text-stone-900 focus:ring-2 focus:ring-amber-400">
                                <!-- Coffee -->
                                <optgroup label="-- COFFEE --">
                                    <?php foreach ($menuItems as $m): ?>
                                        <?php if ($m['kategori'] === 'coffee'): ?>
                                            <option value="<?= htmlspecialchars($m['nama']) ?>" data-price="<?= $m['harga'] ?>" <?= $m['nama'] === "Signature D'Bright" ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($m['nama']) ?> - <?= formatRupiah($m['harga']) ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </optgroup>
                                
                                <!-- Non Coffee -->
                                <optgroup label="-- NON COFFEE --">
                                    <?php foreach ($menuItems as $m): ?>
                                        <?php if ($m['kategori'] === 'non-coffee'): ?>
                                            <option value="<?= htmlspecialchars($m['nama']) ?>" data-price="<?= $m['harga'] ?>">
                                                <?= htmlspecialchars($m['nama']) ?> - <?= formatRupiah($m['harga']) ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </optgroup>
                                
                                <!-- Menu Snack -->
                                <optgroup label="-- MENU SNACK --">
                                    <?php foreach ($menuItems as $m): ?>
                                        <?php if ($m['kategori'] === 'snack'): ?>
                                            <option value="<?= htmlspecialchars($m['nama']) ?>" data-price="<?= $m['harga'] ?>">
                                                <?= htmlspecialchars($m['nama']) ?> - <?= formatRupiah($m['harga']) ?>
                                            </option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </optgroup>
                                
                                <!-- Paket Combo -->
                                <optgroup label="-- PAKET COMBO HEMAT --">
                                    <?php foreach ($comboPackages as $c): ?>
                                        <option value="<?= htmlspecialchars($c['item_name']) ?>" data-price="<?= $c['price'] ?>">
                                            <?= htmlspecialchars($c['title']) ?> - <?= formatRupiah($c['price']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </optgroup>
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-cream-100 font-semibold mb-1">Jumlah Porsi:</label>
                                <div class="flex items-center">
                                    <button type="button" id="fastQtyMinus" class="w-9 h-[38px] bg-stone-800 hover:bg-stone-700 text-cream-100 rounded-l-xl border border-cream-300 font-bold text-sm flex items-center justify-center select-none transition cursor-pointer">-</button>
                                    <input type="number" name="cust_qty" id="custQty" value="1" min="1" max="50" readonly class="w-full h-[38px] text-center bg-white border-y border-cream-300 font-bold text-stone-800 outline-none">
                                    <button type="button" id="fastQtyPlus" class="w-9 h-[38px] bg-stone-800 hover:bg-stone-700 text-cream-100 rounded-r-xl border border-cream-300 font-bold text-sm flex items-center justify-center select-none transition cursor-pointer">+</button>
                                </div>
                            </div>
                            <div>
                                <label class="block text-cream-100 font-semibold mb-1">Varian / Gula:</label>
                                <select name="cust_sugar" id="custSugar" class="w-full px-3 py-2.5 bg-white border border-cream-300 rounded-xl outline-none font-medium text-stone-900">
                                    <option value="Normal Sugar (100%)">Normal (100%)</option>
                                    <option value="Less Sugar (70%)">Less (70%)</option>
                                    <option value="No Sugar (0%)">No Sugar (0%)</option>
                                    <option value="Standar Snack (Untuk Makanan)">Standar Snack</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label class="block text-cream-100 font-semibold mb-1">Catatan Tambahan:</label>
                            <input type="text" name="cust_note" id="custNote" placeholder="Contoh: Es sedikit / saus dipisah" class="w-full px-3.5 py-2.5 bg-white border border-cream-300 rounded-xl outline-none font-medium text-stone-900">
                        </div>

                        <!-- Live Price Estimation with jQuery -->
                        <div class="p-3 bg-stone-800 rounded-xl border border-stone-700 text-xs flex justify-between items-center text-cream-100">
                            <span>Estimasi Total:</span>
                            <span id="fastOrderTotal" class="font-heading font-extrabold text-amber-400 text-base"><?= formatRupiah(15000) ?></span>
                        </div>

                        <button type="submit" class="w-full mt-2 py-3.5 bg-coffee hover:bg-coffee-dark text-white font-bold rounded-xl shadow-md hover:shadow-xl transition-all cursor-pointer flex items-center justify-center gap-2 tracking-wide uppercase text-xs">
                            Kirim Pesanan ke WhatsApp &rarr;
                        </button>
                    </form>
                </div>

            </div>

            <!-- GOOGLE MAPS INTERACTIVE LOCATION EMBED -->
            <div class="mt-10 pt-8 border-t border-cream-200">
                <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 mb-4">
                    <div>
                        <div class="flex items-center gap-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-coffee inline-block"></span>
                            <h3 class="font-heading font-extrabold text-lg text-stone-900">
                                Peta Lokasi Outlet <?= htmlspecialchars($outlet['nama']) ?>
                            </h3>
                        </div>
                        <p class="text-xs text-stone-500 mt-0.5">
                            <?= htmlspecialchars($outlet['alamat']) ?> (Area Sekitar Kampus)
                        </p>
                    </div>
                    <div class="flex items-center gap-2 shrink-0">
                        <a href="<?= htmlspecialchars($outlet['maps_url']) ?>" target="_blank" rel="noopener noreferrer" class="px-4 py-2 bg-stone-900 hover:bg-coffee text-white font-bold text-xs rounded-xl shadow-sm hover:shadow-md transition-all flex items-center gap-2 select-none">
                            <span>Buka Google Maps</span>
                            <span>&rarr;</span>
                        </a>
                    </div>
                </div>

                <!-- Map Frame -->
                <div class="relative w-full rounded-2xl overflow-hidden border border-cream-200 shadow-md bg-cream-100">
                    <iframe 
                        src="https://maps.google.com/maps?q=Jl.+Mustafa+Dg.+Bunga+Romang+Polong+Gowa&t=&z=16&ie=UTF8&iwloc=&output=embed" 
                        width="100%" 
                        height="380" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        title="Lokasi <?= htmlspecialchars($outlet['nama']) ?> di Google Maps"
                        class="w-full h-80 sm:h-96 filter contrast-105">
                    </iframe>
                    <!-- Map Overlay Badge -->
                    <div class="absolute top-3 left-3 bg-white/95 backdrop-blur-xs rounded-full border border-cream-200 px-3.5 py-1.5 shadow-md flex items-center gap-2 pointer-events-none">
                        <span class="w-2 h-2 rounded-full bg-emerald-600 inline-block animate-pulse"></span>
                        <span class="text-xs font-heading font-bold text-stone-900">OUTLET D'BRIGHT SAMATA</span>
                    </div>
                </div>

                <!-- Petunjuk Akses / Panduan Menuju Lokasi -->
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3.5 mt-4 text-xs">
                    <div class="bg-cream-50/70 p-4 rounded-2xl border border-cream-200 shadow-xs">
                        <span class="font-bold text-stone-900 block mb-1">📍 Patokan Lokasi:</span>
                        <span class="text-stone-600 leading-relaxed"><?= htmlspecialchars($outlet['patokan']) ?></span>
                    </div>
                    <div class="bg-cream-50/70 p-4 rounded-2xl border border-cream-200 shadow-xs">
                        <span class="font-bold text-stone-900 block mb-1">🚗 Akses & Parkir:</span>
                        <span class="text-stone-600 leading-relaxed">Jalur utama mudah dijangkau, tersedia area parkir aman kendaraan roda dua & empat.</span>
                    </div>
                    <div class="bg-cream-50/70 p-4 rounded-2xl border border-cream-200 shadow-xs">
                        <span class="font-bold text-stone-900 block mb-1">🛵 Pesan Antar Cepat:</span>
                        <span class="text-stone-600 leading-relaxed">Bisa langsung pesan antar ke area kos & kampus via WhatsApp <strong class="text-coffee"><?= htmlspecialchars($outlet['whatsapp']) ?></strong>.</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
