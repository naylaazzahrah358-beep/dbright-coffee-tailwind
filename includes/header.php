<?php
/**
 * Header Component - D'BRIGHT COFFEE
 * Berisi HTML Head, Tailwind Configuration, Google Fonts, dan SVG Definitions
 */
?>
<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($outlet['nama']) ?> - Menu Kopi, Non-Kopi & Snack</title>
    <meta name="description" content="<?= htmlspecialchars($outlet['deskripsi']) ?>">
    <link rel="icon" type="image/jpeg" href="<?= htmlspecialchars($outlet['logo']) ?>">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Poppins:wght@600;700;800&display=swap" rel="stylesheet">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['"Plus Jakarta Sans"', 'sans-serif'],
                        heading: ['Poppins', 'sans-serif'],
                    },
                    colors: {
                        cream: {
                            50: '#FDFBF7',
                            100: '#FAF6EE',
                            200: '#F4ECE1',
                            300: '#EAE0D0',
                            400: '#DECDB5',
                            500: '#CBB496',
                            600: '#A98D6C',
                            700: '#846747',
                            800: '#5C442D',
                            900: '#382819',
                        },
                        coffee: {
                            light: '#B08968',
                            DEFAULT: '#7F5539',
                            dark: '#4A3525',
                        }
                    }
                }
            }
        }
    </script>

    <!-- Custom CSS Animasi & Efek Gelombang (Wave Effects) -->
    <style>
        /* 1. Animasi Mengapung Bergelombang (Floating Wave Motion) */
        @keyframes floatWave {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-8px) rotate(0.6deg);
            }
        }
        .animate-float-wave {
            animation: floatWave 4.5s ease-in-out infinite;
        }

        /* 2. Animasi Denyut Halus Gelombang (Pulse Shimmer) */
        @keyframes waveShimmer {
            0% {
                transform: translateX(-150%) skewX(-20deg);
            }
            100% {
                transform: translateX(250%) skewX(-20deg);
            }
        }
        .animate-wave-shimmer {
            animation: waveShimmer 3.5s cubic-bezier(0.4, 0, 0.2, 1) infinite;
        }

        /* 3. Animasi Running Marquee (Teks Berjalan Halus) */
        @keyframes marqueeScroll {
            0% {
                transform: translateX(0%);
            }
            100% {
                transform: translateX(-50%);
            }
        }
        .animate-marquee {
            display: inline-flex;
            white-space: nowrap;
            animation: marqueeScroll 28s linear infinite;
        }
        .animate-marquee:hover {
            animation-play-state: paused;
        }

        /* 4. Bentuk Gelombang Sedikit pada Gambar (Wavy Clip-Path) */
        .wavy-image-shape {
            clip-path: url(#subtleWaveClip);
            -webkit-clip-path: url(#subtleWaveClip);
        }

        .wavy-image-bottom {
            clip-path: url(#bottomWaveClip);
            -webkit-clip-path: url(#bottomWaveClip);
        }
    </style>

    <!-- jQuery CDN -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body class="font-sans text-stone-800 bg-cream-50 antialiased selection:bg-coffee selection:text-white">

    <!-- SVG CLIP PATH DEFINITIONS FOR WAVY IMAGE SHAPING -->
    <svg class="absolute w-0 h-0 pointer-events-none opacity-0 overflow-hidden" aria-hidden="true" focusable="false">
        <defs>
            <!-- Gelombang Sedikit Bagian Atas & Bawah (Subtle Organic Wave) -->
            <clipPath id="subtleWaveClip" clipPathUnits="objectBoundingBox">
                <path d="M 0,0.02 C 0.25,-0.02 0.75,0.04 1,0.01 L 1,0.92 C 0.75,0.97 0.5,0.88 0.25,0.96 L 0,0.91 Z" />
            </clipPath>
            <!-- Gelombang Sedikit Khusus Bawah -->
            <clipPath id="bottomWaveClip" clipPathUnits="objectBoundingBox">
                <path d="M 0,0 L 1,0 L 1,0.90 C 0.75,0.96 0.5,0.86 0.25,0.94 L 0,0.89 Z" />
            </clipPath>
        </defs>
    </svg>
