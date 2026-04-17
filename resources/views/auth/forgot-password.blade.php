<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password — InvestPro</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0a0a0f] text-slate-300 font-sans antialiased">

<div class="min-h-screen flex items-center justify-center px-4">
    <div class="w-full max-w-md">

        {{-- Logo --}}
        <a href="/" class="flex items-center justify-center gap-2 mb-10">
            <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
            <span class="text-white font-bold text-xl">InvestPro</span>
        </a>

        <div class="bg-[#111118] border border-[#1e1e2e] rounded-2xl p-8">

            <div class="text-center mb-8">
                <div class="w-14 h-14 bg-blue-600 bg-opacity-20 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-7 h-7 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-white mb-2">Forgot your password?</h1>
                <p class="text-slate-500 text-sm">Enter your email and we'll send you a reset link.</p>
            </div>

            @if(session('status'))
                <div class="bg-green-500 bg-opacity-10 border border-green-500 border-opacity-30 text-green-400 px-4 py-3 rounded-lg mb-6 text-sm text-center">
                    {{ session('status') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-500 bg-opacity-10 border border-red-500 border-opacity-30 text-red-400 px-4 py-3 rounded-lg mb-6 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.request') }}" class="space-y-5">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-slate-400 mb-2">Email Address</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="input @error('email') border-red-500 @enderror"
                        placeholder="you@example.com" required>
                    @error('email') <p class="text-red-400 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <button type="submit" class="btn-primary w-full text-center">
                    Send Reset Link
                </button>

                <div class="text-center">
                    <a href="{{ route('login') }}" class="text-sm text-slate-500 hover:text-white transition-colors">
                        ← Back to login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>