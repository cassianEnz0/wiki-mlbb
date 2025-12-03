<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-yellow-400 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <style>
        /* CSS Variables khusus halaman ini */
        .profile-page-wrapper {
            --bg-card: #ffffff;
            --text-main: #1f2937;
            --text-muted: #6b7280;
            --border-color: #d1d5db;
            --input-bg: #ffffff;
            --input-border: #9ca3af;
        }

        /* Dark Mode Variables */
        html.dark .profile-page-wrapper {
            --bg-card: #0f172a;       /* Lighter Navy */
            --text-main: #ffffff;     /* Pure White */
            --text-muted: #94a3b8;    /* Light Gray */
            --border-color: #ca8a04;  /* Gold Border */
            --input-bg: #1e293b;      /* Input Navy */
            --input-border: #ca8a04;  /* Gold Input Border */
        }

        /* CARD STYLING */
        .profile-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        /* HANYA MENGUBAH INPUT DI DALAM PROFILE CARD */
        .profile-card input[type="text"], 
        .profile-card input[type="email"], 
        .profile-card input[type="password"] {
            background-color: var(--input-bg) !important;
            border: 2px solid var(--input-border) !important;
            color: var(--text-main) !important;
            border-radius: 8px;
            padding: 10px 15px;
            width: 100%;
        }
        .profile-card input:focus {
            border-color: #facc15 !important;
            box-shadow: 0 0 0 3px rgba(250, 204, 21, 0.25) !important;
            outline: none;
        }

        /* HANYA MENGUBAH LABEL DI DALAM PROFILE CARD */
        .profile-card label {
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 5px;
            display: block;
        }
        html.dark .profile-card label { color: #facc15; }

        /* HANYA MENGUBAH TOMBOL DI DALAM PROFILE CARD */
        .profile-card button {
            background-color: #1f2937;
            border: none;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            transition: 0.2s;
        }
        
        /* Tombol Simpan (Primary) di Dark Mode */
        html.dark .profile-card button {
            background-color: #facc15;
            color: #000000;
        }
        html.dark .profile-card button:hover {
            background-color: #eab308;
        }

        /* Tombol Delete (Danger) Override */
        .profile-card button.bg-red-600 {
            background-color: #dc2626 !important;
            color: white !important;
        }
        html.dark .profile-card button.bg-red-600 {
            background-color: #7f1d1d !important;
            border: 1px solid #f87171;
            color: #fca5a5 !important;
        }
    </style>

    <div class="py-12 profile-page-wrapper">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="profile-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="profile-card">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="profile-card">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
