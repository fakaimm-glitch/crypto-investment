@extends('layouts.app')

@section('title', 'Login — InvestPro')

@section('content')
<div style="min-height:calc(100vh - 64px); display:flex;">

    {{-- LEFT SIDE --}}
    <div style="width:100%; max-width:580px; display:flex; flex-direction:column; justify-content:center; padding:48px 64px; overflow-y:auto;">

        <h1 style="color:#fff; font-size:32px; font-weight:700; margin:0 0 8px;">Log in to InvestPro</h1>
        <p style="color:#64748b; margin:0 0 32px; font-size:15px;">
            Don't have a profile yet?
            <a href="{{ route('register') }}" style="color:#60a5fa; text-decoration:none;">Create a profile</a>
        </p>

        @if(session('error'))
            <div style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.2); color:#f87171; padding:12px 16px; border-radius:8px; margin-bottom:24px; font-size:14px;">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div style="background:rgba(34,197,94,0.1); border:1px solid rgba(34,197,94,0.2); color:#4ade80; padding:12px 16px; border-radius:8px; margin-bottom:24px; font-size:14px;">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom:20px;">
                <label style="display:block; color:#94a3b8; font-size:14px; font-weight:500; margin-bottom:8px;">Email</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    style="width:100%; background:#111118; border:1px solid {{ $errors->has('email') ? '#ef4444' : '#1e1e2e' }}; color:#fff; border-radius:8px; padding:12px 16px; outline:none; font-size:14px; box-sizing:border-box; font-family:'Inter',sans-serif;"
                    placeholder="Email" required autofocus
                    onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='{{ $errors->has('email') ? '#ef4444' : '#1e1e2e' }}'">
                @error('email')<p style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div style="margin-bottom:20px;">
                <label style="display:block; color:#94a3b8; font-size:14px; font-weight:500; margin-bottom:8px;">Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password"
                        style="width:100%; background:#111118; border:1px solid {{ $errors->has('password') ? '#ef4444' : '#1e1e2e' }}; color:#fff; border-radius:8px; padding:12px 48px 12px 16px; outline:none; font-size:14px; box-sizing:border-box; font-family:'Inter',sans-serif;"
                        placeholder="Password" required
                        onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='{{ $errors->has('password') ? '#ef4444' : '#1e1e2e' }}'">
                    <button type="button" onclick="togglePassword('password')"
                        style="position:absolute; right:14px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#64748b;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
                @error('password')<p style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;">
                <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                    <input type="checkbox" name="remember" style="width:16px; height:16px;">
                    <span style="color:#94a3b8; font-size:14px;">Remember me</span>
                </label>
                <a href="{{ route('password.request') }}" style="color:#94a3b8; font-size:14px; text-decoration:none;">Forgot Password?</a>
            </div>

            <button type="submit"
                style="width:100%; background:#3b82f6; color:#fff; font-weight:600; padding:14px; border-radius:8px; border:none; cursor:pointer; font-size:15px; font-family:'Inter',sans-serif; transition:background 0.2s;"
                onmouseover="this.style.background='#2563eb'" onmouseout="this.style.background='#3b82f6'">
                Log in
            </button>
        </form>
    </div>

    {{-- RIGHT SIDE --}}
    <div style="flex:1; background:#0d0d14; border-left:1px solid #1e1e2e; flex-direction:column; justify-content:center; padding:48px 56px; position:relative; overflow:hidden; display:none;"
         id="rightPanel">

        <div style="position:absolute; top:-100px; right:-100px; width:400px; height:400px; background:#3b82f6; opacity:0.04; border-radius:50%; filter:blur(80px);"></div>

        <div style="position:relative; z-index:1;">

            {{-- TOP BANNER --}}
            <div style="background:#111118; border:1px solid #1e1e2e; border-radius:16px; overflow:hidden; margin-bottom:20px; height:220px; display:flex; align-items:center; justify-content:center;">
                <div style="text-align:center; padding:32px;">
                    <div style="display:flex; justify-content:center; gap:10px; margin-bottom:16px; flex-wrap:wrap;">
                        <span style="background:#1a1a2e; border:1px solid #1e1e2e; color:#94a3b8; font-size:12px; padding:4px 12px; border-radius:20px;">Forbes</span>
                        <span style="background:#1a1a2e; border:1px solid #1e1e2e; color:#94a3b8; font-size:12px; padding:4px 12px; border-radius:20px;">Bloomberg</span>
                        <span style="background:#1a1a2e; border:1px solid #1e1e2e; color:#94a3b8; font-size:12px; padding:4px 12px; border-radius:20px;">Reuters</span>
                        <span style="background:#1a1a2e; border:1px solid #1e1e2e; color:#94a3b8; font-size:12px; padding:4px 12px; border-radius:20px;">CoinDesk</span>
                    </div>
                    <img src="{{ asset('images/pla.png') }}" alt="Banner"
                        style="max-height:80px; object-fit:contain; margin-bottom:12px;"
                        onerror="this.style.display='none'">
                </div>
            </div>

            {{-- TWO CARDS --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">

                <div style="background:#111118; border:1px solid #1e1e2e; border-radius:16px; padding:24px;">
                    <div style="display:flex; gap:4px; margin-bottom:16px; flex-wrap:wrap;">
                        @foreach(['🇺🇸','🇬🇧','🇳🇬','🇩🇪','🇫🇷','🇦🇺'] as $flag)
                            <span style="font-size:20px;">{{ $flag }}</span>
                        @endforeach
                    </div>
                    <p style="color:#fff; font-weight:700; font-size:22px; margin:0 0 4px;">3 Million+</p>
                    <p style="color:#64748b; font-size:13px; margin:0;">Trusted by customers worldwide</p>
                </div>

                <div style="background:#111118; border:1px solid #1e1e2e; border-radius:16px; padding:24px;">
                    <div style="display:flex; flex-direction:column; gap:8px; margin-bottom:16px;">
                        <span style="background:#1a1a2e; border:1px solid #1e1e2e; color:#60a5fa; font-size:12px; padding:4px 10px; border-radius:8px; width:fit-content;">Crypto</span>
                        <span style="background:#1a1a2e; border:1px solid #1e1e2e; color:#4ade80; font-size:12px; padding:4px 10px; border-radius:8px; width:fit-content;">Stocks</span>
                        <span style="background:#1a1a2e; border:1px solid #1e1e2e; color:#fbbf24; font-size:12px; padding:4px 10px; border-radius:8px; width:fit-content;">Real Estate</span>
                    </div>
                    <p style="color:#fff; font-weight:700; font-size:22px; margin:0 0 4px;">All Platforms</p>
                    <p style="color:#64748b; font-size:13px; margin:0;">All top trading platforms available</p>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection

@section('scripts')
<script>
function togglePassword(id) {
    const el = document.getElementById(id);
    el.type = el.type === 'password' ? 'text' : 'password';
}
function checkWidth() {
    const panel = document.getElementById('rightPanel');
    panel.style.display = window.innerWidth >= 1024 ? 'flex' : 'none';
}
checkWidth();
window.addEventListener('resize', checkWidth);
</script>
@endsection