<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'InvestPro — Smart Investment Platform')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('styles')
</head>
<body class="bg-[#0a0a0f] text-slate-300 font-sans antialiased">

    {{-- NAVBAR - shown on all pages --}}
    <nav class="fixed top-0 left-0 right-0 z-50 bg-[#0a0a0f]/95 backdrop-blur border-b border-[#1e1e2e]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">

                {{-- Logo --}}
                <a href="/" class="flex items-center gap-2">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                        </svg>
                    </div>
                    <span class="text-white font-bold text-xl">InvestPro</span>
                </a>

                {{-- Desktop Nav Links --}}
                <div class="hidden md:flex items-center gap-8">
                    <a href="/" class="text-slate-400 hover:text-white transition-colors text-sm font-medium {{ request()->is('/') ? 'text-white' : '' }}">Home</a>
                    <a href="/#investments" class="text-slate-400 hover:text-white transition-colors text-sm font-medium">Investments</a>
                    <a href="/#plans" class="text-slate-400 hover:text-white transition-colors text-sm font-medium">Plans</a>
                    <a href="/#about" class="text-slate-400 hover:text-white transition-colors text-sm font-medium">About</a>
                    <a href="/#faq" class="text-slate-400 hover:text-white transition-colors text-sm font-medium">FAQ</a>
                </div>

                {{-- Desktop Auth Buttons --}}
                <div class="hidden md:flex items-center gap-3">
                    @auth
                        <a href="{{ route('user.dashboard') }}" class="text-slate-400 hover:text-white text-sm font-medium transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="btn-outline text-sm py-2 px-4">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium transition-colors {{ request()->is('login') ? 'text-white' : 'text-slate-400 hover:text-white' }}">
                            Log In
                        </a>
                        <a href="{{ route('register') }}"
                            class="btn-primary text-sm py-2 px-4 {{ request()->is('register') ? 'opacity-80' : '' }}">
                            Sign Up
                        </a>
                    @endauth
                </div>

                {{-- Mobile Hamburger --}}
                <button id="menuBtn" class="md:hidden text-slate-400 hover:text-white focus:outline-none">
                    <svg id="iconOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg id="iconClose" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

            </div>
        </div>

        {{-- Mobile Menu --}}
        <div id="mobileMenu" class="hidden md:hidden border-t border-[#1e1e2e] bg-[#0a0a0f]">
            <div class="px-4 py-4 space-y-1">
                <a href="/" class="block text-slate-400 hover:text-white hover:bg-[#111118] transition-colors text-sm font-medium px-3 py-2 rounded-lg">Home</a>
                <a href="/#investments" class="block text-slate-400 hover:text-white hover:bg-[#111118] transition-colors text-sm font-medium px-3 py-2 rounded-lg">Investments</a>
                <a href="/#plans" class="block text-slate-400 hover:text-white hover:bg-[#111118] transition-colors text-sm font-medium px-3 py-2 rounded-lg">Plans</a>
                <a href="/#about" class="block text-slate-400 hover:text-white hover:bg-[#111118] transition-colors text-sm font-medium px-3 py-2 rounded-lg">About</a>
                <a href="/#faq" class="block text-slate-400 hover:text-white hover:bg-[#111118] transition-colors text-sm font-medium px-3 py-2 rounded-lg">FAQ</a>
                <div class="pt-3 border-t border-[#1e1e2e] flex flex-col gap-2 mt-2">
                    @auth
                        <a href="{{ route('user.dashboard') }}" class="btn-outline text-sm text-center py-2">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full btn-outline text-sm py-2">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="btn-outline text-sm text-center py-2">Log In</a>
                        <a href="{{ route('register') }}" class="btn-primary text-sm text-center py-2">Sign Up</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    {{-- MAIN CONTENT --}}
    <main class="@yield('main_class', 'pt-16')">
        @yield('content')
    </main>

    {{-- FOOTER - hidden on auth pages --}}
    @unless(request()->is('login') || request()->is('register') || request()->is('forgot-password'))
    <footer class="border-t border-[#1e1e2e] mt-20">
        <div class="max-w-7xl mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center gap-2 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                            </svg>
                        </div>
                        <span class="text-white font-bold text-xl">InvestPro</span>
                    </div>
                    <p class="text-slate-500 text-sm leading-relaxed">Smart investment platform for crypto, stocks and real estate.</p>
                    <div class="flex gap-3 mt-4">
                        <a href="#" class="w-8 h-8 bg-[#111118] border border-[#1e1e2e] rounded-lg flex items-center justify-center text-slate-500 hover:text-white hover:border-slate-500 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-[#111118] border border-[#1e1e2e] rounded-lg flex items-center justify-center text-slate-500 hover:text-white hover:border-slate-500 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        <a href="#" class="w-8 h-8 bg-[#111118] border border-[#1e1e2e] rounded-lg flex items-center justify-center text-slate-500 hover:text-white hover:border-slate-500 transition-colors">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/></svg>
                        </a>
                    </div>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Investments</h4>
                    <ul class="space-y-2 text-sm text-slate-500">
                        <li><a href="#" class="hover:text-white transition-colors">Cryptocurrency</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Stocks & Shares</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Real Estate</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Investment Plans</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Company</h4>
                    <ul class="space-y-2 text-sm text-slate-500">
                        <li><a href="/#about" class="hover:text-white transition-colors">About Us</a></li>
                        <li><a href="/#faq" class="hover:text-white transition-colors">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">Legal</h4>
                    <ul class="space-y-2 text-sm text-slate-500">
                        <li><a href="#" class="hover:text-white transition-colors">Terms & Conditions</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cookie Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Risk Disclosure</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-[#1e1e2e] mt-10 pt-6 flex flex-col md:flex-row justify-between items-center gap-4">
                <p class="text-slate-600 text-sm">© {{ date('Y') }} InvestPro. All rights reserved.</p>
                <p class="text-slate-600 text-xs">Investment involves risk. Past performance is not indicative of future results.</p>
            </div>
        </div>
    </footer>
    @endunless

    {{-- Hamburger Script --}}
    <script>
        const menuBtn    = document.getElementById('menuBtn');
        const mobileMenu = document.getElementById('mobileMenu');
        const iconOpen   = document.getElementById('iconOpen');
        const iconClose  = document.getElementById('iconClose');

        menuBtn.addEventListener('click', () => {
            mobileMenu.classList.toggle('hidden');
            iconOpen.classList.toggle('hidden');
            iconClose.classList.toggle('hidden');
        });
    </script>

    @yield('scripts')
</body>
</html>