<div class="mail-container">
    <div class="hello-user">
        <p>Hello, {{ $user->name }}</p>
    </div>
    <div class="user-data">
        User data for registration in {{ config('app.name') }}:
        <ul>
            <li>Username: {{ $user->name }}</li>
            <li>Email: {{ $user->email }}</li>
        </ul>
        <h6>please scan this qr code to get your id</h6>
        <div class="qr-code">
            {!! $user->qr_code !!}
        </div>
    </div>
</div>
