<?php
/**
 * Scripts Component - D'BRIGHT COFFEE
 * Berisi seluruh logika interaktivitas jQuery dan integrasi WhatsApp
 */
?>
<!-- IMPLEMENTASI JQUERY LENGKAP & INTERAKTIF -->
<script>
    // WhatsApp Hotline Resmi D'Bright Coffee dari Data PHP
    const WA_PHONE_NUMBER = "<?= $outlet['whatsapp_full'] ?>";
    const OUTLET_PHONE_DISPLAY = "<?= $outlet['whatsapp'] ?>";

    $(document).ready(function() {
        
        // ========================================================
        // 0. OPENING / SPLASH SCREEN CONTROLLER
        // ========================================================
        let openingProgress = 0;
        let openingDismissed = false;

        function dismissOpeningScreen() {
            if (openingDismissed) return;
            openingDismissed = true;
            $('#openingScreen').fadeOut(500, function() {
                $(this).remove();
                $('body').removeClass('overflow-hidden');
            });
        }

        // Kunci scroll halaman saat opening screen aktif
        $('body').addClass('overflow-hidden');

        // Tombol klik 'Masuk ke Halaman' untuk langsung masuk
        $('#btnEnterSite').on('click', function() {
            dismissOpeningScreen();
        });

        // Simulasi pengisian progress bar seduhan kopi secara bertahap
        const openingInterval = setInterval(function() {
            if (openingDismissed) {
                clearInterval(openingInterval);
                return;
            }

            openingProgress += Math.floor(Math.random() * 20) + 15;
            if (openingProgress > 100) openingProgress = 100;

            $('#openingProgressBar').css('width', openingProgress + '%');

            if (openingProgress < 35) {
                $('#openingStatusText').text('Menyiapkan Biji Kopi Pilihan...');
            } else if (openingProgress < 70) {
                $('#openingStatusText').text("Memuat <?= $totalMenu ?> Varian Menu D'Bright...");
            } else if (openingProgress < 100) {
                $('#openingStatusText').text('Menyiapkan Pengalaman Terbaik...');
            } else {
                $('#openingStatusText').text('Selamat Menikmati!');
                clearInterval(openingInterval);
                setTimeout(dismissOpeningScreen, 400);
            }
        }, 220);

        // Batas waktu pengaman: otomatis masuk setelah 2.8 detik
        setTimeout(dismissOpeningScreen, 2800);

        // ========================================================
        // 1. HELPER: NOTIFIKASI TOAST JQUERY
        // ========================================================
        let toastTimer;
        function showToast(message) {
            $('#toastMessage').text(message);
            $('#toastNotification').stop(true, true).css('display', 'flex').hide().fadeIn(200);
            clearTimeout(toastTimer);
            toastTimer = setTimeout(function() {
                $('#toastNotification').fadeOut(300);
            }, 2500);
        }

        // ========================================================
        // 2. STATUS OPERASIONAL OUTLET (09.00 - 22.00 WITA = UTC+8)
        // ========================================================
        function updateOutletStatus() {
            const now = new Date();
            const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
            const witaDate = new Date(utc + (3600000 * 8));
            const hours = witaDate.getHours();

            if (hours >= <?= $outlet['jam_buka'] ?> && hours < <?= $outlet['jam_tutup'] ?>) {
                $('#outletStatusBadge').html('<span class="relative flex h-2 w-2 mr-1"><span class="animate-ping absolute inline-flex h-full w-full bg-emerald-400 opacity-75"></span><span class="relative inline-flex h-2 w-2 bg-emerald-600"></span></span><span class="text-emerald-800 font-bold">BUKA SEKARANG (Tutup <?= sprintf('%02d:00', $outlet['jam_tutup']) ?> WITA)</span>');
            } else {
                $('#outletStatusBadge').html('<span class="w-2 h-2 bg-amber-600 inline-block mr-1"></span><span class="text-amber-800 font-bold">TUTUP SEMENTARA (Buka <?= sprintf('%02d:00', $outlet['jam_buka']) ?> WITA)</span>');
            }
        }
        updateOutletStatus();

        // ========================================================
        // 3. HITUNG MUNDUR PROMO HARIAN (COUNTDOWN TIMER JQUERY)
        // ========================================================
        function updatePromoCountdown() {
            const now = new Date();
            const utc = now.getTime() + (now.getTimezoneOffset() * 60000);
            const wita = new Date(utc + (3600000 * 8));

            // Target jam operasional tutup WITA hari ini
            let target = new Date(wita);
            target.setHours(<?= $outlet['jam_tutup'] ?>, 0, 0, 0);

            // Jika sudah lewat jam tutup, target besok
            if (wita.getTime() >= target.getTime()) {
                target.setDate(target.getDate() + 1);
            }

            const diff = target.getTime() - wita.getTime();
            const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
            const mins = Math.floor((diff / (1000 * 60)) % 60);
            const secs = Math.floor((diff / 1000) % 60);

            $('#timerHours').text(String(hours).padStart(2, '0'));
            $('#timerMins').text(String(mins).padStart(2, '0'));
            $('#timerSecs').text(String(secs).padStart(2, '0'));
        }
        updatePromoCountdown();
        setInterval(updatePromoCountdown, 1000);

        // ========================================================
        // 4. MOBILE DRAWER NAVIGATION DENGAN SLIDETOGGLE
        // ========================================================
        $('#mobileMenuBtn').on('click', function() {
            $('#mobileMenu').stop(true, true).slideToggle(200);
        });

        $('#mobileMenu a').on('click', function() {
            $('#mobileMenu').slideUp(200);
        });

        // ========================================================
        // 5. SMOOTH SCROLL DENGAN OFFSET NAVBAR
        // ========================================================
        $('a[href^="#"]').on('click', function(e) {
            const targetId = $(this).attr('href');
            if (targetId && targetId !== '#') {
                const $target = $(targetId);
                if ($target.length) {
                    e.preventDefault();
                    $('html, body').animate({
                        scrollTop: $target.offset().top - 80
                    }, 400);
                }
            }
        });

        // ========================================================
        // 6. SCROLL TO TOP BUTTON
        // ========================================================
        $(window).on('scroll', function() {
            if ($(this).scrollTop() > 350) {
                $('#btnScrollTop').fadeIn(200).css('display', 'flex');
            } else {
                $('#btnScrollTop').fadeOut(200);
            }
        });

        $('#btnScrollTop').on('click', function() {
            $('html, body').animate({ scrollTop: 0 }, 400);
        });

        // ========================================================
        // 7. FILTER KATEGORI & PENCARIAN MENU INSTAN (JQUERY LIVE SEARCH)
        // ========================================================
        let currentCategory = 'all';

        function filterMenuCards() {
            const query = $('#menuSearch').val().toLowerCase().trim();
            let visibleCount = 0;

            // Tampilkan / sembunyikan tombol reset pencarian
            if (query.length > 0) {
                $('#clearSearchBtn').show();
            } else {
                $('#clearSearchBtn').hide();
            }

            $('.menu-item').each(function() {
                const itemCat = $(this).data('category');
                const itemText = $(this).text().toLowerCase();

                const matchCategory = (currentCategory === 'all' || itemCat === currentCategory);
                const matchQuery = (query === '' || itemText.indexOf(query) !== -1);

                if (matchCategory && matchQuery) {
                    $(this).stop(true, true).fadeIn(200);
                    visibleCount++;
                } else {
                    $(this).stop(true, true).hide();
                }
            });

            // Update counter menu
            $('#menuCountNumber').text(visibleCount);

            // Tampilkan empty state jika tidak ada menu yang cocok
            if (visibleCount === 0) {
                $('#noMenuFound').fadeIn(200);
            } else {
                $('#noMenuFound').hide();
            }
        }

        // Event saat tombol kategori diklik
        $('.filter-btn').on('click', function() {
            currentCategory = $(this).data('category');

            $('.filter-btn')
                .removeClass('bg-coffee text-white border-coffee-dark active-filter shadow-sm')
                .addClass('bg-white text-stone-800 border-cream-300');
            
            $(this)
                .addClass('bg-coffee text-white border-coffee-dark active-filter shadow-sm')
                .removeClass('bg-white text-stone-800 border-cream-300');

            filterMenuCards();
        });

        // Event saat mengetik di form pencarian
        $('#menuSearch').on('keyup input', function() {
            filterMenuCards();
        });

        // Tombol Reset Pencarian
        $('#clearSearchBtn').on('click', function() {
            $('#menuSearch').val('').focus();
            filterMenuCards();
        });

        // Tombol Reset Filter di Empty State
        $('#resetFilterBtn').on('click', function() {
            $('#menuSearch').val('');
            currentCategory = 'all';
            $('.filter-btn')
                .removeClass('bg-coffee text-white border-coffee-dark active-filter shadow-sm')
                .addClass('bg-white text-stone-800 border-cream-300');
            $('.filter-btn[data-category="all"]')
                .addClass('bg-coffee text-white border-coffee-dark active-filter shadow-sm')
                .removeClass('bg-white text-stone-800 border-cream-300');
            filterMenuCards();
        });

        // ========================================================
        // 8. INTERACTIVE FAQ ACCORDION
        // ========================================================
        $('.faq-toggle').on('click', function() {
            const $item = $(this).closest('.faq-item');
            const $content = $item.find('.faq-content');
            const $icon = $item.find('.faq-icon');
            const isCurrentlyOpen = !$content.is(':hidden');

            // Tutup semua item lain
            $('.faq-content').slideUp(200);
            $('.faq-icon').text('+').removeClass('bg-coffee text-white').addClass('bg-white text-coffee');
            $('.faq-item').removeClass('border-coffee').addClass('border-cream-300');

            // Toggle item yang diklik
            if (!isCurrentlyOpen) {
                $content.stop(true, true).slideDown(200);
                $icon.text('−').removeClass('bg-white text-coffee').addClass('bg-coffee text-white');
                $item.removeClass('border-cream-300').addClass('border-coffee');
            }
        });

        // ========================================================
        // 9. STEPPER JUMLAH PORSI (+ / -) JQUERY
        // ========================================================
        // Stepper Modal Order
        $('#modalQtyPlus').on('click', function() {
            let val = parseInt($('#modalQty').val(), 10) || 1;
            if (val < 50) {
                $('#modalQty').val(val + 1);
                updateModalTotal();
            }
        });

        $('#modalQtyMinus').on('click', function() {
            let val = parseInt($('#modalQty').val(), 10) || 1;
            if (val > 1) {
                $('#modalQty').val(val - 1);
                updateModalTotal();
            }
        });

        // Stepper Fast Order Form
        $('#fastQtyPlus').on('click', function() {
            let val = parseInt($('#custQty').val(), 10) || 1;
            if (val < 50) {
                $('#custQty').val(val + 1);
                updateFastOrderTotal();
            }
        });

        $('#fastQtyMinus').on('click', function() {
            let val = parseInt($('#custQty').val(), 10) || 1;
            if (val > 1) {
                $('#custQty').val(val - 1);
                updateFastOrderTotal();
            }
        });

        // ========================================================
        // 10. KALKULATOR HARGA REALTIME MODAL ORDER
        // ========================================================
        function updateModalTotal() {
            const basePrice = parseInt($('#modalBasePrice').val(), 10) || 0;
            const sizeExtra = parseInt($('#modalCupSize').find(':selected').data('extra') || 0, 10);
            const toppingExtra = parseInt($('#modalTopping').find(':selected').data('extra') || 0, 10);
            const qty = parseInt($('#modalQty').val(), 10) || 1;

            const total = (basePrice + sizeExtra + toppingExtra) * qty;
            $('#modalTotalPriceDisplay').text('Rp ' + total.toLocaleString('id-ID'));
        }

        $('#modalCupSize, #modalTopping').on('change', function() {
            updateModalTotal();
        });

        // ========================================================
        // 11. KALKULATOR HARGA REALTIME FAST ORDER FORM
        // ========================================================
        function updateFastOrderTotal() {
            const selectedOption = $('#custDrink').find(':selected');
            const price = parseInt(selectedOption.data('price'), 10) || 15000;
            const qty = parseInt($('#custQty').val(), 10) || 1;

            const total = price * qty;
            $('#fastOrderTotal').text('Rp ' + total.toLocaleString('id-ID'));
        }

        $('#custDrink').on('change', function() {
            updateFastOrderTotal();
        });
        updateFastOrderTotal();

        // ========================================================
        // 12. BUKA & TUTUP MODAL ORDER
        // ========================================================
        $(document).on('click', '.btn-order-item', function(e) {
            e.preventDefault();
            const name = $(this).data('name') || "Signature D'Bright";
            const price = parseInt($(this).data('price'), 10) || 15000;
            const category = $(this).data('category') || 'coffee';

            $('#modalDrinkName').val(name);
            $('#modalBasePrice').val(price);
            $('#modalQty').val(1);
            $('#modalCupSize').val('Regular (Medium)');
            $('#modalTopping').val('Tanpa Topping Tambahan');

            if (category === 'snack') {
                $('#modalSugarLevel').val('Bukan Minuman (Snack)');
            } else {
                $('#modalSugarLevel').val('Normal Sugar (100%)');
            }

            updateModalTotal();

            $('#orderModal').css('display', 'flex').hide().fadeIn(200);
            $('body').addClass('overflow-hidden');
            showToast(`Pilihan menu: ${name}`);
        });

        $('.btn-close-modal').on('click', function() {
            $('#orderModal').fadeOut(200, function() {
                $('body').removeClass('overflow-hidden');
            });
        });

        $('#orderModal').on('click', function(e) {
            if (e.target === this) {
                $(this).fadeOut(200, function() {
                    $('body').removeClass('overflow-hidden');
                });
            }
        });

        // ========================================================
        // 13. SALIN ALAMAT & KONTAK WHATSAPP DENGAN FEEDBACK
        // ========================================================
        $('#btnCopyAddress').on('click', function() {
            const address = $('#outletAddressText').text().trim();
            navigator.clipboard.writeText(address).then(() => {
                const $btn = $(this);
                $btn.text('Tersalin! ✓').addClass('bg-coffee text-white border-coffee');
                showToast("Alamat D'Bright Coffee berhasil disalin!");
                setTimeout(() => {
                    $btn.text('Salin Alamat').removeClass('bg-coffee text-white border-coffee');
                }, 2000);
            });
        });

        $('#btnCopyPhone').on('click', function() {
            navigator.clipboard.writeText(OUTLET_PHONE_DISPLAY).then(() => {
                const $btn = $(this);
                $btn.text('Tersalin! ✓').addClass('bg-coffee text-white border-coffee');
                showToast(`Nomor WhatsApp ${OUTLET_PHONE_DISPLAY} berhasil disalin!`);
                setTimeout(() => {
                    $btn.text('Salin Nomor').removeClass('bg-coffee text-white border-coffee');
                }, 2000);
            });
        });

        // ========================================================
        // 14. SUBMIT FORM MODAL -> LANGSUNG KE BACKEND DATABASE
        // ========================================================
        $('#modalOrderForm').on('submit', function() {
            showToast('Menyimpan pesanan ke database tugasnela_db...');
            // Form otomatis terkirim langsung ke process-order.php untuk disimpan ke MySQL
        });

        // ========================================================
        // 15. SUBMIT FAST ORDER FORM -> LANGSUNG KE BACKEND DATABASE
        // ========================================================
        $('#fastOrderForm').on('submit', function() {
            showToast('Menyimpan pesanan ke database tugasnela_db...');
            // Form otomatis terkirim langsung ke process-order.php untuk disimpan ke MySQL
        });

        // ========================================================
        // 16. KONTROL ADMIN TERPADU (TAMBAH, EDIT, LIHAT PESANAN)
        // ========================================================
        $('#btnAdminTambahMenu, #btnAdminTambahMenuTop').on('click', function() {
            $('#modalTambahMenu').css('display', 'flex').hide().fadeIn(150);
        });

        $('#btnAdminLihatPesanan').on('click', function() {
            $('#modalRiwayatPesanan').css('display', 'flex').hide().fadeIn(150);
        });

        $(document).on('click', '.btn-edit-menu-action', function(e) {
            e.preventDefault();
            const id        = $(this).data('id');
            const nama      = $(this).data('nama');
            const kategori  = $(this).data('kategori');
            const harga     = $(this).data('harga');
            const badge     = $(this).data('badge');
            const subjudul  = $(this).data('subjudul');
            const deskripsi = $(this).data('deskripsi');
            const featured  = $(this).data('featured') == 1;

            $('#editMenuId').val(id);
            $('#editMenuNama').val(nama);
            $('#editMenuKategori').val(kategori);
            $('#editMenuHarga').val(harga);
            $('#editMenuBadge').val(badge);
            $('#editMenuSubjudul').val(subjudul);
            $('#editMenuDeskripsi').val(deskripsi);
            $('#editMenuFeatured').prop('checked', featured);

            $('#modalEditMenu').css('display', 'flex').hide().fadeIn(150);
        });

    });
</script>
</body>
</html>
