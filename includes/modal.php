<?php
/**
 * Modal Component - D'BRIGHT COFFEE
 * Modal popup pemesanan menu lengkap dengan kustomisasi varian dan kalkulasi harga
 */
?>
<!-- INTERACTIVE ORDER MODAL (Dengan Fitur Kalkulasi jQuery & Form Pemrosesan) -->
<div id="orderModal" class="fixed inset-0 z-50 bg-stone-900/75 backdrop-blur-xs hidden items-center justify-center p-4">
    <div class="bg-white max-w-md w-full p-6 border-4 border-stone-900 shadow-[10px_10px_0px_0px_#7F5539] relative">
        <button type="button" class="btn-close-modal absolute top-4 right-4 text-stone-600 hover:text-stone-900 font-bold text-xs px-2 py-1 border-2 border-stone-800 hover:bg-cream-200 transition cursor-pointer">
            TUTUP [X]
        </button>

        <div class="flex items-center gap-3 mb-4">
            <img src="<?= htmlspecialchars($outlet['logo']) ?>" alt="Logo <?= htmlspecialchars($outlet['nama']) ?>" class="w-10 h-10 object-cover border-2 border-stone-900">
            <div>
                <h3 class="font-heading font-black text-lg text-stone-900 leading-tight">Form Pemesanan Menu</h3>
                <p class="text-xs text-stone-500">Konfirmasi varian dan lanjutkan ke WhatsApp</p>
            </div>
        </div>

        <form id="modalOrderForm" action="process-order.php" method="POST" class="space-y-3 text-xs">
            <input type="hidden" name="form_type" value="modal_order">
            <div>
                <label class="block font-semibold text-stone-700 mb-1">Menu yang Dipilih:</label>
                <input type="text" name="modal_drink_name" id="modalDrinkName" readonly class="w-full px-3 py-2 bg-cream-50 border border-cream-300 font-bold text-stone-800 outline-none">
                <input type="hidden" name="modal_base_price" id="modalBasePrice" value="15000">
            </div>

            <div>
                <label class="block font-semibold text-stone-700 mb-1">Nama Pemesan:</label>
                <input type="text" name="modal_cust_name" id="modalCustName" required placeholder="Masukkan nama Anda" class="w-full px-3 py-2 border border-cream-300 outline-none focus:border-coffee">
            </div>

            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block font-semibold text-stone-700 mb-1">Jumlah Porsi:</label>
                    <div class="flex items-center">
                        <button type="button" id="modalQtyMinus" class="w-8 h-[34px] bg-cream-100 hover:bg-cream-200 border border-cream-300 font-bold text-stone-700 flex items-center justify-center select-none transition cursor-pointer">-</button>
                        <input type="number" name="modal_qty" id="modalQty" value="1" min="1" max="50" readonly class="w-full h-[34px] text-center border-y border-cream-300 font-bold text-stone-800 outline-none bg-white">
                        <button type="button" id="modalQtyPlus" class="w-8 h-[34px] bg-cream-100 hover:bg-cream-200 border border-cream-300 font-bold text-stone-700 flex items-center justify-center select-none transition cursor-pointer">+</button>
                    </div>
                </div>
                <div>
                    <label class="block font-semibold text-stone-700 mb-1">Ukuran Cup / Porsi:</label>
                    <select name="modal_cup_size" id="modalCupSize" class="w-full px-2 py-2 border border-cream-300 outline-none">
                        <option value="Regular (Medium)" data-extra="0">Regular (Medium)</option>
                        <option value="Large (+Rp 3.000)" data-extra="3000">Large (+Rp 3.000)</option>
                    </select>
                </div>
            </div>

            <div id="drinkOptionSugar">
                <label class="block font-semibold text-stone-700 mb-1">Kadar Gula (Khusus Minuman):</label>
                <select name="modal_sugar_level" id="modalSugarLevel" class="w-full px-2 py-2 border border-cream-300 outline-none">
                    <option value="Normal Sugar (100%)">Normal (100%)</option>
                    <option value="Less Sugar (70%)">Less Sugar (70%)</option>
                    <option value="No Sugar (0%)">No Sugar (0%)</option>
                    <option value="Bukan Minuman (Snack)">Bukan Minuman (Snack)</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-stone-700 mb-1">Topping Tambahan:</label>
                <select name="modal_topping" id="modalTopping" class="w-full px-2 py-2 border border-cream-300 outline-none">
                    <option value="Tanpa Topping Tambahan" data-extra="0">Tanpa Topping Tambahan</option>
                    <option value="Boba (+Rp 3.000)" data-extra="3000">Boba (+Rp 3.000)</option>
                    <option value="Jelly (+Rp 3.000)" data-extra="3000">Jelly (+Rp 3.000)</option>
                    <option value="Keju (+Rp 4.000)" data-extra="4000">Keju (+Rp 4.000)</option>
                </select>
            </div>

            <div>
                <label class="block font-semibold text-stone-700 mb-1">Catatan Tambahan:</label>
                <textarea name="modal_notes" id="modalNotes" rows="2" placeholder="Contoh: Es sedikit / Pedas sedang / Saus dipisah" class="w-full px-3 py-2 border border-cream-300 outline-none"></textarea>
            </div>

            <div class="p-3 bg-cream-50 border border-cream-300 flex items-center justify-between">
                <span class="font-bold text-stone-800">Total Harga:</span>
                <span id="modalTotalPriceDisplay" class="font-heading font-black text-coffee text-base"><?= formatRupiah(15000) ?></span>
            </div>

            <button type="submit" class="w-full py-3 bg-coffee hover:bg-coffee-dark text-white font-bold text-xs uppercase tracking-wider border-2 border-stone-900 shadow-[3px_3px_0px_0px_#1c1917] hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all cursor-pointer">
                Lanjutkan Pesanan ke WhatsApp &rarr;
            </button>
        </form>
    </div>
</div>
