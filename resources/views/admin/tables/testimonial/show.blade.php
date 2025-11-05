@extends('layouts.admin-app')

@section('content')

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Testimoni</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #f0f2f5; }
        :root { --cafe-dark-blue: #091936; --cafe-accent-brown: #58320D; }
        .text-cafe-accent { color: var(--cafe-accent-brown); }
        .bg-cafe-dark { background-color: var(--cafe-dark-blue); }
    </style>
</head>
<body class="bg-gray-100">

<div class="main-content flex-1 p-6">
    <div class="bg-white rounded-lg shadow-md p-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-[#292929]">Detail Testimoni</h1>
            <a href="{{ route('admin.testimonial.index') }}" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-300 transition-colors duration-200 flex items-center space-x-2">
                <i class="fas fa-arrow-left mr-2"></i>
                <span>Kembali ke Daftar</span>
            </a>
        </div>

        <div class="flex flex-col md:flex-row gap-6">
            {{-- Kolom Avatar --}}
            <div class="md:w-1/3 flex flex-col items-center">
                @if($testimonial->avatar)
                    <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="{{ $testimonial->name }}" class="w-40 h-40 object-cover rounded-full shadow-lg border-4 border-white">
                @else
                    <span class="inline-flex items-center justify-center h-40 w-40 rounded-full bg-gray-200 text-gray-500 shadow-lg border-4 border-white">
                        <i class="fas fa-user fa-5x"></i>
                    </span>
                @endif
                <h2 class="text-2xl font-bold text-gray-800 mt-4">{{ $testimonial->name }}</h2>
                <p class="text-base text-cafe-accent font-medium">{{ $testimonial->role ?? 'Pelanggan' }}</p>
                
                @if($testimonial->rating)
                <div class="text-yellow-500 text-2xl mt-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="{{ $i <= $testimonial->rating ? 'fas' : 'far' }} fa-star"></i>
                    @endfor
                </div>
                @endif
            </div>

            {{-- Kolom Detail --}}
            <div class="md:w-2/3">
                <blockquote class="relative bg-gray-50 border-l-4 border-cafe-accent p-6 rounded-lg shadow-inner">
                    <i class="fas fa-quote-left fa-2x text-cafe-accent absolute -top-3 -left-3 opacity-20"></i>
                    <p class="text-lg italic text-gray-700 leading-relaxed whitespace-pre-line">
                        "{{ $testimonial->quote }}"
                    </p>
                </blockquote>
                
                <dl class="mt-6 divide-y divide-gray-200">
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Status</dt>
                        <dd class="text-gray-900">
                            @if($testimonial->is_visible)
                                <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Tampil di Website</span>
                            @else
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded-full">Disembunyikan</span>
                            @endif
                        </dd>
                    </div>
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Dibuat Pada</dt>
                        <dd class="text-gray-900">{{ $testimonial->created_at->format('d M Y, H:i') }}</Show>
                    </div>
                    <div class="py-3 flex justify-between text-sm">
                        <dt class="font-medium text-gray-500">Terakhir Diperbarui</dt>
                        <dd class="text-gray-900">{{ $testimonial->updated_at->format('d M Y, H:i') }}</Show>
                    </div>
                </dl>
            </div>
        </div>
        
    </div>
</div>

</body>
</html>

@endsection