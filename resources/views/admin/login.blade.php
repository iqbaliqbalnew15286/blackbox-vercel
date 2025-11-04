<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Definisi Variabel Warna Baru */
        :root {
            --primary-blue: #091936; /* Warna Biru Gelap Baru */
            --accent-brown: #58320D; /* Warna Cokelat Kopi Baru */
            --text-color: #f0f0f0; 
            --input-bg-color: #FFFFFF;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            /* Background dengan pattern motor seperti di gambar */
            background-image: url('{{ asset('assets/image/motorcycle_pattern.jpg') }}'); 
            /* Ganti dengan URL placeholder gambar pattern Anda */
            background-repeat: repeat;
            background-size: 200px;
        }

        .login-card {
            background-color: var(--primary-blue);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        }

        .input-group:focus-within .input-icon {
            color: var(--accent-brown); /* Ikon fokus berubah menjadi cokelat */
        }

        .input-field {
            background-color: var(--input-bg-color) !important;
            color: #1a202c !important; /* Warna teks gelap */
            border: 1px solid #ddd;
        }

        .input-field::placeholder {
            color: #888;
        }

        .input-field:focus {
            box-shadow: 0 0 0 2px var(--accent-brown); /* Fokus input border cokelat */
        }
        
        .login-button {
            background-color: var(--accent-brown); /* Tombol utama cokelat */
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #704010; /* Hover cokelat yang sedikit lebih gelap */
        }

        .text-brown-custom {
            color: var(--accent-brown);
        }
    </style>
</head>

{{-- Mengubah body menjadi flex container untuk menengahkan card --}}
<body class="min-h-screen flex items-center justify-center p-4">

    {{-- CARD LOGIN --}}
    <div class="w-full max-w-md login-card p-8 rounded-2xl">
        <div class="text-center mb-8">
            {{-- Placeholder Logo --}}
            <img src="{{ asset('assets/warghe.png') }}" alt="Logo Warung Kopi" 
                 class="w-20 h-20 object-contain mx-auto mb-4 rounded-full border-4 border-white"
                 style="background-color: white;">
            {{-- End Placeholder Logo --}}

            <h1 class="text-white text-2xl font-extrabold mb-1">
                Login As Admin
            </h1>
            <p class="text-gray-400 text-sm font-medium">Enter Your Email And Password Below To Log In</p>
        </div>

        <form id="loginForm" class="space-y-5" action="{{ route('login') }}" method="POST">
            @csrf

            {{-- Notifikasi Error --}}
            @if ($errors->any())
                <div class="bg-red-600 text-white text-xs rounded-lg p-3 font-medium">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- Notifikasi Sukses --}}
            @if (session('status'))
                <div class="bg-green-600 text-white text-xs rounded-lg p-2 font-medium">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Input Email --}}
            <div class="relative group input-group">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 input-icon">
                    <i class="fas fa-user"></i>
                </span>
                <input id="emailField"
                    class="input-field w-full rounded-xl py-3 pl-12 pr-4 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brown-custom"
                    placeholder="admin@examples.com" type="email" name="email" value="{{ old('email') }}" required>
            </div>

            {{-- Input Password --}}
            <div class="relative group input-group">
                <span class="absolute inset-y-0 left-4 flex items-center text-gray-400 input-icon">
                    <i class="fas fa-lock"></i>
                </span>
                <input id="passwordField"
                    class="input-field w-full rounded-xl py-3 pl-12 pr-4 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-brown-custom"
                    placeholder="password" type="password" name="password" required>
            </div>

            {{-- Opsi Show Password dan Forgot Password --}}
            <div class="flex items-center justify-between text-xs font-medium">
                <div class="flex items-center space-x-2 text-gray-300 cursor-pointer">
                    {{-- Checkbox diserasikan dengan warna cokelat --}}
                    <input id="showPasswordToggle" type="checkbox"
                        class="form-checkbox h-4 w-4 text-brown-custom focus:ring-brown-custom rounded" name="show-password" style="color: var(--accent-brown);">
                    <span>Show Password</span>
                </div>
                <a href="#" class="text-gray-400 hover:text-white">Forgot Password?</a>
            </div>

            {{-- Tombol Login --}}
            <button
                class="login-button w-full py-3 rounded-xl text-white font-extrabold text-lg transition-transform duration-300 transform hover:scale-[1.01] active:scale-95"
                type="submit">
                Login
            </button>
        </form>

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