@extends('layouts.app')

@section('title', 'InvestPro — Smart Investment Platform')

@section('content')

{{-- ===== HERO SECTION ===== --}}
<section style="min-height:100vh; background:#0a0a0f; position:relative; overflow:hidden; display:flex; align-items:center; padding:80px 0 60px;">

    {{-- Background radial gradient --}}
    <div style="position:absolute; inset:0; background:radial-gradient(ellipse at 70% 50%, rgba(30,40,100,0.5) 0%, transparent 70%); pointer-events:none;"></div>

    {{-- Dot grid --}}
    <div style="position:absolute; inset:0; background-image:radial-gradient(circle, #1e3a6e 1px, transparent 1px); background-size:32px 32px; opacity:0.15; pointer-events:none;"></div>

    {{-- Globe - desktop only --}}
    <div id="globe" style="position:absolute; right:-80px; top:50%; transform:translateY(-50%); width:520px; height:520px; opacity:0.3; pointer-events:none;">
        <svg viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg" style="width:100%; height:100%; animation:spinGlobe 18s linear infinite;">
            <defs>
                <radialGradient id="glow" cx="50%" cy="50%" r="50%">
                    <stop offset="0%" stop-color="#3b82f6" stop-opacity="0.3"/>
                    <stop offset="100%" stop-color="#0a0a0f" stop-opacity="0"/>
                </radialGradient>
            </defs>
            <circle cx="300" cy="300" r="280" fill="none" stroke="#1e3a6e" stroke-width="1"/>
            <circle cx="300" cy="300" r="280" fill="url(#glow)"/>
            <ellipse cx="300" cy="300" rx="280" ry="60"  fill="none" stroke="#1e3a8a" stroke-width="0.8" opacity="0.6"/>
            <ellipse cx="300" cy="300" rx="280" ry="130" fill="none" stroke="#1e3a8a" stroke-width="0.8" opacity="0.6"/>
            <ellipse cx="300" cy="300" rx="280" ry="200" fill="none" stroke="#1e3a8a" stroke-width="0.8" opacity="0.6"/>
            <ellipse cx="300" cy="300" rx="280" ry="260" fill="none" stroke="#1e3a8a" stroke-width="0.8" opacity="0.5"/>
            <ellipse cx="300" cy="300" rx="60"  ry="280" fill="none" stroke="#1e3a8a" stroke-width="0.8" opacity="0.6"/>
            <ellipse cx="300" cy="300" rx="130" ry="280" fill="none" stroke="#1e3a8a" stroke-width="0.8" opacity="0.6"/>
            <ellipse cx="300" cy="300" rx="200" ry="280" fill="none" stroke="#1e3a8a" stroke-width="0.8" opacity="0.6"/>
            <ellipse cx="300" cy="300" rx="260" ry="280" fill="none" stroke="#1e3a8a" stroke-width="0.8" opacity="0.5"/>
            <circle cx="300" cy="120" r="4" fill="#3b82f6" opacity="0.9"/>
            <circle cx="420" cy="200" r="3" fill="#60a5fa" opacity="0.8"/>
            <circle cx="480" cy="320" r="4" fill="#3b82f6" opacity="0.9"/>
            <circle cx="400" cy="420" r="3" fill="#60a5fa" opacity="0.7"/>
            <circle cx="260" cy="460" r="4" fill="#3b82f6" opacity="0.8"/>
            <circle cx="160" cy="380" r="3" fill="#60a5fa" opacity="0.7"/>
            <circle cx="140" cy="240" r="4" fill="#3b82f6" opacity="0.9"/>
            <circle cx="220" cy="160" r="3" fill="#60a5fa" opacity="0.8"/>
            <circle cx="360" cy="280" r="5" fill="#60a5fa" opacity="1"/>
            <line x1="300" y1="120" x2="420" y2="200" stroke="#3b82f6" stroke-width="0.8" opacity="0.4"/>
            <line x1="420" y1="200" x2="480" y2="320" stroke="#3b82f6" stroke-width="0.8" opacity="0.4"/>
            <line x1="480" y1="320" x2="400" y2="420" stroke="#3b82f6" stroke-width="0.8" opacity="0.4"/>
            <line x1="140" y1="240" x2="300" y2="120" stroke="#3b82f6" stroke-width="0.8" opacity="0.3"/>
            <line x1="160" y1="380" x2="260" y2="460" stroke="#3b82f6" stroke-width="0.8" opacity="0.3"/>
            <line x1="360" y1="280" x2="480" y2="320" stroke="#60a5fa" stroke-width="1"   opacity="0.5"/>
        </svg>
    </div>

    {{-- CONTENT --}}
    <div style="position:relative; z-index:10; max-width:1280px; margin:0 auto; padding:0 24px; width:100%; box-sizing:border-box;">

        {{-- Rating badge --}}
        <div style="display:inline-flex; align-items:center; gap:8px; background:rgba(255,255,255,0.05); border:1px solid #1e3a6e; border-radius:40px; padding:6px 16px; margin-bottom:28px;">
            <div style="display:flex; gap:2px;">
                @for($i=0;$i<5;$i++)
                <svg width="13" height="13" fill="#fbbf24" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                @endfor
            </div>
            <span style="color:#94a3b8; font-size:12px; font-weight:500;">4.8/5 &nbsp;·&nbsp; Trusted by 24,500+ investors</span>
        </div>

        {{-- Headline --}}
        <h1 class="hero-headline" style="color:#fff; font-weight:800; line-height:1.0; margin:0 0 24px; letter-spacing:-2px; text-transform:uppercase;">
            TRUSTED BY<br>
            <span style="color:#3b82f6;">24K+</span><br>
            INVESTORS
        </h1>

        {{-- Subheading --}}
        <p style="color:#94a3b8; font-size:17px; margin:0 0 36px; max-width:500px; line-height:1.7;">
            Grow your wealth with crypto, stocks and real estate. Earn up to <strong style="color:#fff;">20% ROI</strong> — get paid on demand.
        </p>

        {{-- CTA Button --}}
        <div style="margin-bottom:24px;">
            <a href="{{ route('register') }}"
                style="background:#3b82f6; color:#fff; font-weight:700; font-size:15px; padding:16px 36px; border-radius:40px; text-decoration:none; letter-spacing:0.5px; display:inline-block; border:2px solid #3b82f6;"
                onmouseover="this.style.background='#2563eb';this.style.borderColor='#2563eb'"
                onmouseout="this.style.background='#3b82f6';this.style.borderColor='#3b82f6'">
                START INVESTING
            </a>
        </div>

        {{-- Badge Pills --}}
        <div class="badge-pills" style="display:flex; gap:10px; flex-wrap:wrap; margin-bottom:48px;">
            <div style="display:flex; align-items:center; gap:7px; background:rgba(255,255,255,0.04); border:1px solid #1e2e4a; border-radius:40px; padding:7px 14px;">
                <svg width="14" height="14" fill="none" stroke="#fbbf24" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                <span style="color:#94a3b8; font-size:12px; font-weight:500; letter-spacing:0.5px;">FAST REWARDS</span>
            </div>
            <div style="display:flex; align-items:center; gap:7px; background:rgba(255,255,255,0.04); border:1px solid #1e2e4a; border-radius:40px; padding:7px 14px;">
                <svg width="14" height="14" fill="none" stroke="#4ade80" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                <span style="color:#94a3b8; font-size:12px; font-weight:500; letter-spacing:0.5px;">NO HIDDEN FEES</span>
            </div>
            <div style="display:flex; align-items:center; gap:7px; background:rgba(255,255,255,0.04); border:1px solid #1e2e4a; border-radius:40px; padding:7px 14px;">
                <svg width="14" height="14" fill="none" stroke="#60a5fa" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                <span style="color:#94a3b8; font-size:12px; font-weight:500; letter-spacing:0.5px;">ALWAYS AVAILABLE</span>
            </div>
        </div>

        {{-- Stats Bar --}}
        <div class="stats-bar" style="display:grid; grid-template-columns:repeat(4,1fr); background:rgba(255,255,255,0.03); border:1px solid #1e2e4a; border-radius:16px; overflow:hidden; max-width:760px;">
            @foreach([
                ['$10.6M+', 'TOTAL REWARDS'],
                ['24,500+', 'ACTIVE INVESTORS'],
                ['2020',    'FOUNDED'],
                ['24h',     'AVG PAYOUT TIME'],
            ] as $i => $stat)
            <div style="padding:20px 16px; {{ $i > 0 ? 'border-left:1px solid #1e2e4a;' : '' }} text-align:center;">
                <p style="color:#fff; font-weight:800; font-size:20px; margin:0 0 4px; letter-spacing:-0.5px;">{{ $stat[0] }}</p>
                <p style="color:#475569; font-size:10px; font-weight:600; letter-spacing:0.8px; margin:0; text-transform:uppercase;">{{ $stat[1] }}</p>
            </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ===== WHY CHOOSE SECTION ===== --}}
<section style="background:#0a0a0f; padding:80px 0;">
    <div style="max-width:1280px; margin:0 auto; padding:0 24px; box-sizing:border-box;">

        <p style="color:#94a3b8; font-size:15px; font-weight:500; margin:0 0 28px;">Why People Choose InvestPro</p>

        {{-- Big Image Banner --}}
        <div style="position:relative; border-radius:20px; overflow:hidden; margin-bottom:16px; background:#111118; border:1px solid #1e1e2e;" class="why-banner">

            <img src="{{ asset('images/see.png') }}" alt="Why InvestPro"
                style="width:100%; height:100%; object-fit:cover; display:block; position:absolute; inset:0; z-index:1;"
                onerror="this.style.display='none'">

            <div style="position:absolute; inset:0; background:linear-gradient(135deg, #0d1b3e 0%, #1a1040 40%, #0d0d14 100%); z-index:0;"></div>
            <div style="position:absolute; inset:0; background:linear-gradient(to right, rgba(0,0,0,0.88) 0%, rgba(0,0,0,0.5) 60%, transparent 100%); z-index:2;"></div>

            {{-- Text --}}
            <div class="why-text" style="position:relative; z-index:3; padding:40px;">
                <h2 style="color:#fff; font-weight:800; margin:0 0 8px; line-height:1.1;" class="why-heading">More Power,<br>Less Risk</h2>
                <p style="color:#94a3b8; font-size:15px; margin:0;">Earn up to 20% ROI across crypto, stocks & real estate</p>
            </div>

            {{-- Floating Card --}}
            <div class="floating-card" style="position:absolute; bottom:32px; right:32px; z-index:3; background:rgba(17,17,24,0.92); border:1px solid #1e1e2e; border-radius:16px; padding:20px 24px; backdrop-filter:blur(12px);">
                <div style="display:flex; align-items:center; gap:10px; margin-bottom:14px;">
                    <div style="width:30px; height:30px; background:#3b82f6; border-radius:8px; display:flex; align-items:center; justify-content:center;">
                        <svg width="15" height="15" fill="none" stroke="white" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <span style="color:#fff; font-weight:600; font-size:13px;">InvestPro Account</span>
                </div>
                <div style="display:flex; justify-content:space-between; align-items:flex-start; gap:16px; margin-bottom:14px;">
                    <div>
                        <p style="color:#64748b; font-size:10px; margin:0 0 2px; text-transform:uppercase; letter-spacing:0.5px;">Result</p>
                        <p style="color:#4ade80; font-size:13px; font-weight:600; margin:0;">+18.5%</p>
                    </div>
                    <div>
                        <p style="color:#64748b; font-size:10px; margin:0 0 2px; text-transform:uppercase; letter-spacing:0.5px;">Balance</p>
                        <p style="color:#fff; font-size:13px; font-weight:600; margin:0;">$219,999.43</p>
                    </div>
                    <svg width="70" height="32" viewBox="0 0 80 36">
                        <polyline points="0,30 15,22 25,26 35,14 45,18 55,8 65,12 80,4" fill="none" stroke="#4ade80" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <polyline points="0,30 15,22 25,26 35,14 45,18 55,8 65,12 80,4 80,36 0,36" fill="rgba(74,222,128,0.08)" stroke="none"/>
                    </svg>
                </div>
                <div style="display:flex; gap:8px;">
                    <button style="flex:1; background:rgba(255,255,255,0.06); border:1px solid #1e1e2e; color:#94a3b8; font-size:11px; padding:7px; border-radius:8px; cursor:pointer;">Portfolio</button>
                    <button style="flex:1; background:rgba(255,255,255,0.06); border:1px solid #1e1e2e; color:#94a3b8; font-size:11px; padding:7px; border-radius:8px; cursor:pointer;">Analytics</button>
                </div>
            </div>
        </div>

        {{-- 4 Feature Cards --}}
        <div class="feature-cards" style="display:grid; grid-template-columns:repeat(2,1fr); gap:14px;">
            @foreach([
                ['icon'=>'M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z','color'=>'#3b82f6','bg'=>'rgba(59,130,246,0.1)','title'=>'Rewards','desc'=>'Fast and easy profit withdrawals directly to your wallet or bank'],
                ['icon'=>'M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z','color'=>'#a78bfa','bg'=>'rgba(167,139,250,0.1)','title'=>'Advanced Support','desc'=>'Dedicated support via Live chat, email, or WhatsApp 24/7'],
                ['icon'=>'M9 3H5a2 2 0 00-2 2v4m6-6h10a2 2 0 012 2v4M9 3v18m0 0h10a2 2 0 002-2V9M9 21H5a2 2 0 01-2-2V9m0 0h18','color'=>'#fbbf24','bg'=>'rgba(251,191,36,0.1)','title'=>'Multi-Asset Platform','desc'=>'Invest in crypto, stocks and real estate all in one place'],
                ['icon'=>'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z','color'=>'#4ade80','bg'=>'rgba(74,222,128,0.1)','title'=>'Secure & Trusted','desc'=>'Bank-level encryption and verified investment plans'],
            ] as $card)
            <div style="background:#111118; border:1px solid #1e1e2e; border-radius:16px; padding:24px; display:flex; align-items:flex-start; gap:16px;">
                <div style="width:44px; height:44px; min-width:44px; background:{{ $card['bg'] }}; border-radius:12px; display:flex; align-items:center; justify-content:center;">
                    <svg width="20" height="20" fill="none" stroke="{{ $card['color'] }}" stroke-width="1.8" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="{{ $card['icon'] }}"/>
                    </svg>
                </div>
                <div>
                    <h3 style="color:#fff; font-weight:700; font-size:16px; margin:0 0 6px;">{{ $card['title'] }}</h3>
                    <p style="color:#64748b; font-size:14px; margin:0; line-height:1.6;">{{ $card['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

@endsection

@section('scripts')
<style>
@keyframes spinGlobe {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

/* ── Hero Headline ── */
.hero-headline { font-size: clamp(48px, 7vw, 96px); }

/* ── Globe: hide on mobile ── */
@media (max-width: 768px) {
    #globe { display: none !important; }
}

/* ── Stats bar: 2 cols on mobile ── */
@media (max-width: 600px) {
    .stats-bar {
        grid-template-columns: repeat(2, 1fr) !important;
    }
    .stats-bar > div:nth-child(2) { border-left: 1px solid #1e2e4a !important; }
    .stats-bar > div:nth-child(3) { border-left: none !important; border-top: 1px solid #1e2e4a !important; }
    .stats-bar > div:nth-child(4) { border-left: 1px solid #1e2e4a !important; border-top: 1px solid #1e2e4a !important; }
}

/* ── Why banner height ── */
.why-banner { height: 420px; }
.why-heading { font-size: 38px; }

@media (max-width: 900px) {
    .why-banner { height: auto !important; min-height: 320px; }
    .floating-card { display: none !important; }
}

@media (max-width: 600px) {
    .why-banner { min-height: 260px; }
    .why-text { padding: 28px 24px !important; }
    .why-heading { font-size: 28px !important; }
}

/* ── Feature cards: 1 col on mobile ── */
@media (max-width: 640px) {
    .feature-cards {
        grid-template-columns: 1fr !important;
    }
}

/* ── Badge pills wrap nicely ── */
@media (max-width: 480px) {
    .badge-pills { gap: 8px !important; }
}

/* ── General padding on small screens ── */
@media (max-width: 480px) {
    .hero-headline { letter-spacing: -1px !important; }
}
</style>
@endsection