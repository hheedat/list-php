<div class="hd cf">
    <div class="user-status">
        @if($islogin)
            <a href="/">{{ $userinfo['username'] }}</a>
            <a class="logout-btn" href="/index/logout">退出</a>
        @else
            <a href="/">首页-欢迎来到List，请您登录或注册</a>
        @endif
        <a class="site-name" href="/">
            <span id="last-update"></span>
            <span>List 测试版</span>
        </a>
    </div>
</div>