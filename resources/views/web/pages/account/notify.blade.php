@if (Auth::user()->acc_bonus > 0 && Auth::user()->acc_expired_at > time())
    <div class="alert-login" style="margin: 20px 0 10px 0;">
        <p>Bạn đang có {!! Currency::display(Auth::user()->acc_bonus) !!} tiền tích lũy,
            hạn sử dụng đến
            ngày {{ Auth::user()->acc_expired_at > 0 ? date('d/m/Y', Auth::user()->acc_expired_at) : '' }}.</p>
    </div>
@endif

