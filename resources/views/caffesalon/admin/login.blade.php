<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Dosis:wght@600;800&display=swap" rel="stylesheet">

    <style>
        /* Variabel Warna Tema Dual */
        :root {
            --dark-bg: #0d1117;
            /* Background Sangat Gelap */
            --glass-bg: rgba(255, 255, 255, 0.05);
            /* Background Card Transparan */
            --accent-pink: #ec4899;
            /* Pink Neon (Salon) */
            --accent-cyan: #06b6d4;
            /* Cyan (Kafe/Modern) */
            --primary-text: #e5e7eb;
        }

        body {
            font-family: 'Poppins', sans-serif;
            /* Background gelap dengan gradasi halus */
            background: linear-gradient(135deg, #111827, #030712);
        }

        .font-title {
            font-family: 'Dosis', sans-serif;
        }

        /* Card Login dengan Efek Glassmorphism dan Border Neon */
        .login-card {
            background-color: var(--glass-bg);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            /* Border dan Shadow yang lebih futuristik */
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.7),
                        0 0 15px var(--accent-pink),
                        0 0 5px var(--accent-cyan);
        }

        .input-field {
            background-color: rgba(255, 255, 255, 0.9) !important;
            color: #1a202c !important;
            border: 1px solid #ddd;
            transition: all 0.2s;
        }

        .input-group:focus-within .input-icon {
            color: var(--accent-cyan);
            /* Ikon fokus berubah menjadi Cyan */
        }

        .input-field:focus {
            border-color: var(--accent-cyan);
            box-shadow: 0 0 0 3px rgba(6, 182, 212, 0.4);
        }

        .login-button {
            background-color: var(--accent-pink);
            /* Tombol utama Pink */
            transition: background-color 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 15px rgba(236, 72, 153, 0.5);
        }

        .login-button:hover {
            background-color: #d12f7c;
            /* Hover pink yang sedikit lebih gelap */
            box-shadow: 0 4px 20px rgba(236, 72, 153, 0.8);
            transform: scale(1.01);
        }

        .text-accent-pink {
            color: var(--accent-pink);
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center p-4">

    {{-- CARD LOGIN --}}
    <div class="w-full max-w-sm login-card p-8 rounded-2xl">
        <div class="text-center mb-10">

            {{-- Logo Gabungan Salon dan Kafe --}}
            <div class="w-24 h-24 mx-auto mb-4 rounded-full flex items-center justify-center border-4 border-white shadow-xl"
                style="background: linear-gradient(135deg, var(--accent-pink) 0%, #1e293b 100%);">
                {{-- Menggunakan dua ikon yang saling berdekatan --}}
                <i class="fas fa-spa text-white text-3xl mr-1" style="text-shadow: 0 0 5px #ffedd5;"></i>
                <i class="fas fa-mug-hot text-white text-3xl ml-1" style="text-shadow: 0 0 5px #06b6d4;"></i>
            </div>
            {{-- End Logo --}}

            <h1 class="text-white text-4xl font-extrabold mb-1 tracking-wider font-title" style="text-shadow: 0 0 5px var(--accent-cyan);">
                ADMIN PORTAL
            </h1>
            <p class="text-gray-400 text-sm font-medium">Masuk untuk mengelola dua dunia Anda.</p>
        </div>

        <form id="loginForm" class="space-y-6" action="{{ route('login') }}" method="POST">
            @csrf

            {{-- Notifikasi Error/Sukses --}}
            @if ($errors->any())
                <div class="bg-red-700/50 border border-red-700 text-white text-xs rounded-lg p-3 font-medium">
                    <i class="fas fa-exclamation-triangle mr-2 text-red-400"></i>
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="bg-green-700/50 border border-green-700 text-white text-xs rounded-lg p-3 font-medium">
                    <i class="fas fa-check-circle mr-2 text-green-400"></i>
                    {{ session('status') }}
                </div>
            @endif

            {{-- Input Email --}}
            <div class="relative group input-group">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 input-icon transition-colors duration-200">
                    <i class="fas fa-envelope"></i>
                </span>
                <input id="emailField"
                    class="input-field w-full rounded-xl py-3 pl-12 pr-4 placeholder-gray-500 text-sm"
                    placeholder="Masukkan Email Admin" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            {{-- Input Password --}}
            <div class="relative group input-group">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 input-icon transition-colors duration-200">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="passwordField"
                    class="input-field w-full rounded-xl py-3 pl-12 pr-4 placeholder-gray-500 text-sm"
                    placeholder="Masukkan Kata Sandi" type="password" name="password" required>
            </div>

            {{-- Opsi Show Password dan Forgot Password --}}
            <div class="flex items-center justify-between text-xs font-medium pt-1">
                <label class="flex items-center space-x-2 text-gray-300 cursor-pointer">
                    {{-- Checkbox diserasikan dengan warna pink --}}
                    <input id="showPasswordToggle" type="checkbox" class="form-checkbox h-4 w-4 rounded" style="background-color: var(--accent-pink);">
                    <span>Show Password</span>
                </label>
                <a href="#" class="text-accent-pink hover:text-white transition-colors duration-200">Lupa Password?</a>
            </div>

            {{-- Tombol Login --}}
            <button
                class="login-button w-full py-3 rounded-xl text-white font-extrabold text-base tracking-wider shadow-lg"
                type="submit">
                <i class="fas fa-sign-in-alt mr-2"></i> MASUK
            </button>
        </form>

        <p class="text-center text-xs text-gray-500 mt-6">
            <span class="text-accent-pink">Elegance</span> & <span class="text-cyan-400">Black Box</span> Enterprise © 2025
        </p>

    </div>

    <script>
        const passwordField = document.getElementById("passwordField");
        const showPasswordToggle = document.getElementById("showPasswordToggle");

        if (showPasswordToggle && passwordField) {
            showPasswordToggle.addEventListener("change", () => {
                passwordField.type = showPasswordToggle.checked ? "text" : "password";
            });
        }
    </script>
</body>

</html>
