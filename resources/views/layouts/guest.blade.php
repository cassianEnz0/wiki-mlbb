<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* === CONFIGURATION === */
            :root { 
                --bg-body: #f3f4f6; 
                --bg-card: #ffffff; 
                --text-main: #1f2937;     /* Hitam Abu (Light Mode) */
                --text-muted: #4b5563;    /* Abu sedang (Light Mode) */
                --input-bg: #ffffff; 
                --input-border: #d1d5db;
                --gold: #d97706;
                --btn-bg: #1f2937;
                --btn-text: #ffffff;
            }
        
            /* === DARK MODE OVERRIDES === */
            html.dark { 
                --bg-body: #050914;       /* Deep Navy */
                --bg-card: #0f172a;       /* Lighter Navy */
                --text-main: #ffffff;     /* Putih Bersih */
                --text-muted: #cbd5e1;    /* Abu Terang */
                --input-bg: #1e293b;      /* Navy Input */
                --input-border: #facc15;  /* Gold Border */
                --gold: #facc15;          /* Bright Gold */
                --btn-bg: #facc15;        /* Gold Button */
                --btn-text: #000000;      /* Black Text on Gold */
            }
            
            body { 
                background-color: var(--bg-body); 
                color: var(--text-main); 
                font-family: 'Figtree', sans-serif; 
                transition: background-color 0.3s, color 0.3s; 
            }
            
            .min-h-screen { background-color: var(--bg-body); }

            /* AUTH CARD (KOTAK LOGIN) */
            .auth-card { 
                background-color: var(--bg-card); 
                /* LIGHT MODE: Tanpa Border, Cuma Shadow */
                border: none; 
                padding: 2rem;
                border-radius: 0.75rem; 
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
                width: 100%;
                max-width: 28rem;
                margin-top: 1.5rem;
                overflow: hidden;
            }

            /* DARK MODE: Pakai Border Emas */
            html.dark .auth-card {
                border: 1px solid var(--gold);
                box-shadow: 0 0 15px rgba(250, 204, 21, 0.1);
            }

            /* === PERBAIKAN TEKS & LABEL === */
            
            /* 1. INPUT FIELD LABEL (Email, Password) - Uppercase & Bold */
            /* Kita target label yang BUKAN checkbox (bukan inline-flex) */
            label:not(.inline-flex) {
                font-weight: 700 !important;
                text-transform: uppercase;
                font-size: 0.75rem;
                color: var(--text-muted);
                margin-bottom: 4px;
                display: block;
            }
            /* Dark Mode: Label jadi Gold */
            html.dark label:not(.inline-flex) { color: var(--gold); }

            /* 2. CHECKBOX LABEL (Remember Me) - Normal Text */
            label.inline-flex {
                color: var(--text-muted); /* Abu di Light Mode */
                font-weight: 500;
                text-transform: none !important; /* Jangan Uppercase */
            }
            /* Dark Mode: Teks Putih (Biar enak dibaca, jangan Gold) */
            html.dark label.inline-flex { color: #e2e8f0; } 
            
            /* Teks Deskripsi (Forgot Password text, dll) */
            .text-sm, p { color: var(--text-muted); }
            html.dark .text-sm, html.dark p { color: #cbd5e1; }

            /* LINKS (Back to dashboard, Forgot Password) */
            a { color: var(--text-muted); transition: 0.2s; }
            a:hover { color: var(--text-main); text-decoration: underline; }
            html.dark a:hover { color: var(--gold); }

            /* === INPUT FIELDS === */
            input[type="text"], 
            input[type="email"], 
            input[type="password"] {
                background-color: var(--input-bg) !important; 
                border: 2px solid var(--input-border) !important; 
                color: var(--text-main) !important; 
                border-radius: 6px;
            }
            /* Fokus jadi Gold di kedua mode biar konsisten atau bisa diubah */
            input:focus { 
                border-color: #facc15 !important; 
                box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.25) !important; 
                outline: none !important;
            }

            /* === BUTTONS === */
            button, .inline-flex button {
                background-color: var(--btn-bg) !important;
                color: var(--btn-text) !important;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 1px;
                padding: 0.75rem 1.5rem;
                border-radius: 0.5rem;
                border: none;
                transition: all 0.2s;
                cursor: pointer;
            }
            html.dark button:hover {
                background-color: #eab308 !important; /* Gold lebih gelap saat hover */
            }

            /* LOGO FILL */
            .logo-fill { fill: #4b5563; }
            html.dark .logo-fill { fill: var(--gold); }
            
            /* SVG ICONS (Back Arrow) */
            svg { stroke: currentColor; }
        </style>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 logo-fill" />
                </a>
            </div>

            <div class="auth-card">
                {{ $slot }}
            </div>
        </div>

        <script>
            // Paksa Dark Mode Check saat loading
            if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>
    </body>
</html>
