@extends('layouts.app')

@section('title', 'Register — InvestPro')

@section('content')
<div style="min-height:calc(100vh - 64px); display:flex;">

    {{-- LEFT SIDE --}}
    <div style="width:100%; max-width:580px; display:flex; flex-direction:column; justify-content:center; padding:48px 64px; overflow-y:auto;">

        <h1 style="color:#fff; font-size:32px; font-weight:700; margin:0 0 8px;">Create your new profile</h1>
        <p style="color:#64748b; margin:0 0 32px; font-size:15px;">
            Already have a profile?
            <a href="{{ route('login') }}" style="color:#60a5fa; text-decoration:none;">Log in</a>
        </p>

        @if(session('error'))
            <div style="background:rgba(239,68,68,0.1); border:1px solid rgba(239,68,68,0.2); color:#f87171; padding:12px 16px; border-radius:8px; margin-bottom:24px; font-size:14px;">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Full Name --}}
            <div style="margin-bottom:18px;">
                <label style="display:block; color:#94a3b8; font-size:14px; font-weight:500; margin-bottom:8px;">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}"
                    style="width:100%; background:#111118; border:1px solid {{ $errors->has('name') ? '#ef4444' : '#1e1e2e' }}; color:#fff; border-radius:8px; padding:12px 16px; outline:none; font-size:14px; box-sizing:border-box; font-family:'Inter',sans-serif;"
                    placeholder="John Doe" required
                    onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='{{ $errors->has('name') ? '#ef4444' : '#1e1e2e' }}'">
                @error('name')<p style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            {{-- Email --}}
            <div style="margin-bottom:18px;">
                <label style="display:block; color:#94a3b8; font-size:14px; font-weight:500; margin-bottom:8px;">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}"
                    style="width:100%; background:#111118; border:1px solid {{ $errors->has('email') ? '#ef4444' : '#1e1e2e' }}; color:#fff; border-radius:8px; padding:12px 16px; outline:none; font-size:14px; box-sizing:border-box; font-family:'Inter',sans-serif;"
                    placeholder="you@example.com" required
                    onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='{{ $errors->has('email') ? '#ef4444' : '#1e1e2e' }}'">
                @error('email')<p style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
            </div>

            {{-- Phone + Country --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:18px;" class="grid-2">
                <div>
                    <label style="display:block; color:#94a3b8; font-size:14px; font-weight:500; margin-bottom:8px;">Phone Number</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                        style="width:100%; background:#111118; border:1px solid #1e1e2e; color:#fff; border-radius:8px; padding:12px 16px; outline:none; font-size:14px; box-sizing:border-box; font-family:'Inter',sans-serif;"
                        placeholder="+1 234 567 8900"
                        onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#1e1e2e'">
                    @error('phone')<p style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label style="display:block; color:#94a3b8; font-size:14px; font-weight:500; margin-bottom:8px;">Country</label>
                    <select name="country"
                        style="width:100%; background:#111118; border:1px solid #1e1e2e; color:#fff; border-radius:8px; padding:12px 16px; outline:none; font-size:14px; box-sizing:border-box; font-family:'Inter',sans-serif;"
                        onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#1e1e2e'">
                        <option value="" disabled selected>Select country</option>
                        <option value="US" {{ old('country')=='US'?'selected':'' }}>United States</option>
                        <option value="GB" {{ old('country')=='GB'?'selected':'' }}>United Kingdom</option>
                        <option value="CA" {{ old('country')=='CA'?'selected':'' }}>Canada</option>
                        <option value="AU" {{ old('country')=='AU'?'selected':'' }}>Australia</option>
                        <option value="NG" {{ old('country')=='NG'?'selected':'' }}>Nigeria</option>
                        <option value="GH" {{ old('country')=='GH'?'selected':'' }}>Ghana</option>
                        <option value="ZA" {{ old('country')=='ZA'?'selected':'' }}>South Africa</option>
                        <option value="IN" {{ old('country')=='IN'?'selected':'' }}>India</option>
                        <option value="DE" {{ old('country')=='DE'?'selected':'' }}>Germany</option>
                        <option value="FR" {{ old('country')=='FR'?'selected':'' }}>France</option>
                        <option value="AE" {{ old('country')=='AE'?'selected':'' }}>UAE</option>
                        <option value="SG" {{ old('country')=='SG'?'selected':'' }}>Singapore</option>
                        <option value="OTHER" {{ old('country')=='OTHER'?'selected':'' }}>Other</option>
                    </select>
                    @error('country')<p style="color:#f87171; font-size:12px; margin-top:4px;">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Password --}}
            <div style="margin-bottom:18px;">
                <label style="display:block; color:#94a3b8; font-size:14px; font-weight:500; margin-bottom:8px;">Password</label>
                <div style="position:relative;">
                    <input type="password" name="password" id="password"
                        style="width:100%; background:#111118; border:1px solid {{ $errors->has('password') ? '#ef4444' : '#1e1e2e' }}; color:#fff; border-radius:8px; padding:12px 48px 12px 16px; outline:none; font-size:14px; box-sizing:border-box; font-family:'Inter',sans-serif;"
                        placeholder="Min. 6 characters" required
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

            {{-- Confirm Password --}}
            <div style="margin-bottom:18px;">
                <label style="display:block; color:#94a3b8; font-size:14px; font-weight:500; margin-bottom:8px;">Confirm Password</label>
                <div style="position:relative;">
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        style="width:100%; background:#111118; border:1px solid #1e1e2e; color:#fff; border-radius:8px; padding:12px 48px 12px 16px; outline:none; font-size:14px; box-sizing:border-box; font-family:'Inter',sans-serif;"
                        placeholder="Repeat your password" required
                        onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#1e1e2e'">
                    <button type="button" onclick="togglePassword('password_confirmation')"
                        style="position:absolute; right:14px; top:50%; transform:translateY(-50%); background:none; border:none; cursor:pointer; color:#64748b;">
                        <svg width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0zM2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Referral --}}
            <div style="margin-bottom:24px;">
                <label style="display:block; color:#94a3b8; font-size:14px; font-weight:500; margin-bottom:8px;">
                    Referral Code <span style="color:#475569;">(optional)</span>
                </label>
                <input type="text" name="referral_code"
                    value="{{ old('referral_code') ?? request('ref') }}"
                    style="width:100%; background:#111118; border:1px solid #1e1e2e; color:#fff; border-radius:8px; padding:12px 16px; outline:none; font-size:14px; box-sizing:border-box; font-family:'Inter',sans-serif;"
                    placeholder="Enter referral code"
                    onfocus="this.style.borderColor='#3b82f6'" onblur="this.style.borderColor='#1e1e2e'">
            </div>

            <button type="submit"
                style="width:100%; background:#3b82f6; color:#fff; font-weight:600; padding:14px; border-radius:8px; border:none; cursor:pointer; font-size:15px; font-family:'Inter',sans-serif;"
                onmouseover="this.style.background='#2563eb'" onmouseout="this.style.background='#3b82f6'">
                Create Account
            </button>

            <p style="color:#475569; font-size:12px; text-align:center; margin-top:16px;">
                By registering, you agree to our
                <a href="#" style="color:#94a3b8; text-decoration:none;">Terms & Conditions</a> and
                <a href="#" style="color:#94a3b8; text-decoration:none;">Privacy Policy</a>
            </p>
        </form>
    </div>

    {{-- RIGHT SIDE --}}
    <div style="flex:1; background:#0d0d14; border-left:1px solid #1e1e2e; flex-direction:column; justify-content:center; padding:48px 56px; position:relative; overflow:hidden; display:none;"
         id="rightPanel">

        <div style="position:absolute; top:-100px; right:-100px; width:400px; height:400px; background:#3b82f6; opacity:0.04; border-radius:50%; filter:blur(80px);"></div>

        <div style="position:relative; z-index:1;">

            {{-- TOP BANNER --}}
            <div style="background:#111118; border:1px solid #1e1e2e; border-radius:16px; overflow:hidden; margin-bottom:20px; height:220px; display:flex; align-items:center; justify-content:center;">
                <div style="text-align:center; padding:24px;">
                    <img src="{{ asset('images/cu.png') }}" alt=""
                        style="max-height:80px; object-fit:contain; margin-bottom:12px;"
                        onerror="this.style.display='none'">
                    <h3 style="color:#fff; font-weight:700; font-size:20px; margin:0 0 8px;">Start Investing Today</h3>
                    <p style="color:#64748b; font-size:13px; margin:0;">Join 24,500+ investors already growing their wealth</p>
                </div>
            </div>

            {{-- TWO CARDS --}}
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">

                <div style="background:#111118; border:1px solid #1e1e2e; border-radius:16px; padding:24px;">
                    <img src="{{ asset('images/lee.png') }}" alt=""
                        style="width:100%; height:80px; object-fit:contain; margin-bottom:12px; border-radius:8px;"
                        onerror="this.style.display='none'">
                    <p style="color:#fff; font-weight:700; font-size:16px; margin:0 0 6px;">Leader</p>
                    <p style="color:#64748b; font-size:12px; margin:0; line-height:1.5;">InvestPro is a leading investment platform founded in 2020</p>
                </div>

                <div style="background:#111118; border:1px solid #1e1e2e; border-radius:16px; padding:24px;">
                    <img src="{{ asset('images/card-platforms.png') }}" alt=""
                        style="width:100%; height:80px; object-fit:contain; margin-bottom:12px; border-radius:8px;"
                        onerror="this.style.display='none'">
                    <p style="color:#fff; font-weight:700; font-size:16px; margin:0 0 6px;">Trading Platforms</p>
                    <p style="color:#64748b; font-size:12px; margin:0; line-height:1.5;">All the top trading platforms available</p>
                </div>

            </div>
        </div>
    </div>

</div>

<style>
@media(max-width: 500px) {
    .grid-2 { grid-template-columns: 1fr !important; }
}
</style>
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