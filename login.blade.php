{{--tes Thema ptero by paxbar--}}
@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="flex min-h-screen items-center justify-center bg-radial-gradient">
    <!-- Login Card dengan efek Glassmorphism & Animasi Ngembang -->
    <div class="auth-card w-full max-w-md p-8 rounded-2xl shadow-2xl backdrop-blur-md bg-opacity-10 bg-white border border-white/10 transition-all duration-500 ease-out transform hover:scale-[1.02]">
        
        <!-- Logo / Branding Section -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-500 tracking-wider uppercase animate-fade-in">
                {{ config('app.name', 'Pterodactyl') }}
            </h1>
            <p class="text-xs text-gray-400 mt-2 tracking-wide uppercase">Private Access Dashboard</p>
        </div>

        <!-- Form Login -->
        <form method="POST" action="{{ route('auth.login') }}" class="space-y-6">
            @csrf
            
            <!-- Input Email / Username -->
            <div class="relative group">
                <input type="text" name="user" required autofocus class="auth-input w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all duration-300" placeholder="Username or Email" />
            </div>

            <!-- Input Password -->
            <div class="relative group">
                <input type="password" name="password" required class="auth-input w-full px-4 py-3 bg-gray-900/50 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all duration-300" placeholder="Password" />
            </div>

            <!-- Recaptcha / 2FA Note if needed -->
            @if ($errors->any())
                <div class="text-sm text-red-400 bg-red-500/10 border border-red-500/20 p-3 rounded-lg text-center">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <!-- Button Submit (Animasi Glow & Ngembang) -->
            <button type="submit" class="w-full py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 hover:from-blue-600 hover:to-indigo-700 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 uppercase tracking-wider text-sm">
                Sign In
            </button>
        </form>

        <!-- Footer / Copyright -->
        <div class="text-center mt-8 text-xs text-gray-500">
            &copy; {{ date('Y') }} {{ config('app.name', 'Pterodactyl') }}. All rights reserved.
        </div>
    </div>
</div>

<style>
    body {
        background: #090a0f !important;
        overflow: hidden;
    }
    
    .bg-radial-gradient {
        background: radial-gradient(circle at center, #111424 0%, #090a0f 100%);
    }
    .auth-card {
        animation: cardEntrance 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }

    @keyframes cardEntrance {
        from {
            opacity: 0;
            transform: scale(0.92) translateY(20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }
    .auth-input:focus {
        box-shadow: 0 0 15px rgba(59, 130, 246, 0.15);
    }
</style>
@endsection