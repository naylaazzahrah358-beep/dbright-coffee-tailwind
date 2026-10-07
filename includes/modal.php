<?php
/**
 * Modal Component - D'BRIGHT COFFEE
 * Modal popup pemesanan menu lengkap dengan kustomisasi varian dan kalkulasi harga yang rapi
 */
?>
<!-- INTERACTIVE ORDER MODAL -->
<div id="orderModal" class="fixed inset-0 z-50 bg-stone-900/60 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white max-w-md w-full p-6 sm:p-7 rounded-3xl border border-cream-200 shadow-2xl relative animate-scaleUp">
        <button type="button" class="btn-close-modal absolute top-5 right-5 text-stone-500 hover:text-stone-900 font-bold text-xs w-8 h-8 rounded-full bg-cream-100 hover:bg-cream-200 flex items-center justify-center transition cursor-pointer" title="Tutup Modal">
            ✕
        </button>

        <div class="flex items-center gap-3 mb-5">
            <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo <?= htmlspecialchars($outlet['nama']) ?>" class="w-11 h-11 object-cover rounded-xl border border-cream-200 shadow-xs">
            <div>
                <h3 class="font-heading font-black text-lg text-stone-900 leading-tight">Form Pemesanan Menu</h3>
                <p class="text-xs text-stone-500">Sesuaikan varian dan lanjutkan pesanan</p>
            </div>
        </div>

        <form id="modalOrderForm" action="process-order.php" method="POST" class="space-y-3.5 text-xs">
            <input type="hidden" name="form_type" value="modal_order">
            <div>
                <label class="block font-semibold text-stone-700 mb-1">Menu yang Dipilih:</label>
                <input type="text" name="modal_drink_name" id="modalDrinkName" readonly class="w-full px-3.5 py-2.5 bg-cream-50 rounded-xl border border-cream-200 font-bold text-coffee text-sm outline-none">
                <input type="hidden" name="modal_base_price" id="modalBasePrice" value="15000">
            </div>

            <div>
                <label class="block font-semibold text-stone-700 mb-1">Nama Pemesan: *</label>
                <input type="text" name="modal_cust_name" id="modalCustName" required placeholder="Masukkan nama Anda" class="w-full px-3.5 py-2.5 rounded-xl border border-cream-300 font-medium text-stone-900 outline-none focus:border-coffee focus:ring-2 focus:ring-coffee/15 transition">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-semibold text-stone-700 mb-1">Jumlah Porsi:</label>
                    <div class="flex items-center">
                        <button type="button" id="modalQtyMinus" class="w-9 h-[38px] bg-cream-100 hover:bg-cream-200 text-stone-700 rounded-l-xl border border-cream-300 font-bold text-sm flex items-center justify-center select-none transition cursor-pointer">-</button>
                        <input type="number" name="modal_qty" id="modalQty" value="1" min="1" max="50" readonly class="w-full h-[38px] text-center border-y border-cream-300 font-bold text-stone-800 outline-none bg-white">
                        <button type="button" id="modalQtyPlus" class="w-9 h-[38px] bg-cream-100 hover:bg-cream-200 text-stone-700 rounded-r-xl border border-cream-300 font-bold text-sm flex items-center justify-center select-none transition cursor-pointer">+</button>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-stone-700 mb-1">Ukuran Cup / Porsi:</label>
                    <select name="modal_cup_size" id="modalCupSize" class="w-full px-3 py-2.5 rounded-xl border border-cream-300 font-medium text-stone-900 outline-none">
                        <option value="Regular (Medium)" data-extra="0">Regular (Medium)</option>
                        <option value="Large (+Rp 3.000)" data-extra="3000">Large (+Rp 3.000)</option>
                    </select>
                </div>
            </div>

            <div id="drinkOptionSugar">
                <label class="block font-semibold text-stone-700 mb-1">Kadar Gula (Khusus Minuman):</label>
                <select name="modal_sugar_level" id="modalSugarLevel" class="w-full px-3 py-2.5 rounded-xl border border-cream-300 font-medium text-stone-900 outline-none">
                    <option value="Normal Sugar (100%)">Normal (100%)</option>
                    <option value="Less Sugar (70%)">Less Sugar (70%)</option>
                    <option value="No Sugar (0%)">No Sugar (0%)</option>
                    <option value="Bukan Minuman (Snack)">Bukan Minuman (Snack)</option>
                </select>
            </div>

            <div id="drinkOptionTopping">
                <label class="block font-semibold text-stone-700 mb-1">Topping Tambahan (Opsional):</label>
                <select name="modal_topping" id="modalTopping" class="w-full px-3 py-2.5 rounded-xl border border-cream-300 font-medium text-stone-900 outline-none">
                    <option value="Tanpa Topping" data-extra="0">Tanpa Topping (Standar)</option>
                    <option value="Boba Brown Sugar (+Rp 3.000)" data-extra="3000">Boba Brown Sugar (+Rp 3.000)</option>
                    <option value="Grass Jelly (+Rp 3.000)" data-extra="3000">Grass Jelly (+Rp 3.000)</option>
                    <option value="Keju Parut (+Rp 3.000)" data-extra="3000">Keju Parut (+Rp 3.000)</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-stone-700 mb-1">Catatan Tambahan:</label>
                <input type="text" name="modal_notes" id="modalNotes" placeholder="Contoh: Es dipisah, saus ekstra, dll" class="w-full px-3.5 py-2.5 rounded-xl border border-cream-300 font-medium text-stone-900 outline-none">
            </div>

            <!-- Price Breakdown Calculation -->
            <div class="p-3.5 bg-cream-50 rounded-2xl border border-cream-200 text-xs flex justify-between items-center">
                <span class="font-bold text-stone-700">Total Harga:</span>
                <span id="modalTotalPrice" class="font-heading font-black text-xl text-coffee"><?= formatRupiah(15000) ?></span>
            </div>

            <button type="submit" class="w-full py-3.5 bg-coffee hover:bg-coffee-dark text-white font-bold rounded-xl shadow-md hover:shadow-lg transition-all cursor-pointer flex items-center justify-center gap-2 tracking-wide uppercase text-xs">
                <span>Konfirmasi & Simpan Pesanan &rarr;</span>
            </button>
        </form>
    </div>
</div>
