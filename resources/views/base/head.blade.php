<div class="hd cf">
    <div class="user-status">
        @if(isset($user))
            <a href="/">{{ $user->name }}</a>
            <a class="logout-btn" href="/auth/logout">退出</a>
        @else
            <a href="/">首页-请登录或注册List</a>
        @endif
        <a class="site-name" href="/">
            <span id="last-update"></span>
            <span>List 测试版</span>
        </a>
    </div>
</div>