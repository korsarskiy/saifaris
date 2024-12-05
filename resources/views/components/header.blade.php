<header>
    <div class="container">
        <div class="head">
            <div class="head">
            <a href="{{route('index')}}"><img src="/public/assets/image/logosaif.png" alt=""> </a>
                <div class="head-a">
                    <a href="{{route('index')}}">Главная</a>
                    <a href="{{route('catalog')}}">Каталог</a>
                    <a href="{{route('index', '#about')}}">О нас</a>
                    <a href="{{route('index', '#diy')}}">Собери мебель сам</a>
                    <div class="head-num">
                        <a href="tel:+7(995)008-14-96">+7(995)008-14-96</a>
                    </div>
                    @auth()
                    <a href="{{route('admin')}}" class="admin-link">Админ</a>
                    @endauth
                </div>
                <!-- Бургер-меню -->
                <div class="burger-menu" onclick="toggleMenuCat()">
                    <div class="burger-bar"></div>
                    <div class="burger-bar"></div>
                    <div class="burger-bar"></div>
                </div>
            </div>
            <div class="burger-nav-cat">
                <div class="burger-a">
                    <a href="{{route('index')}}">Главная</a>
                    <a href="{{route('catalog')}}">Каталог</a>
                    <a href="{{route('index', '#about')}}">О нас</a>
                    <a href="{{route('index', '#diy')}}">Собери мебель сам</a>
                    <a href="tel:+7(995)008-14-96">+7(995)008-14-96</a>
                    @auth()
                        <a href="{{route('admin')}}" class="admin-link">Админ</a>
                    @endauth
                </div>
                <div class="burger-nav-close" onclick="toggleMenuCat()">✖</div>
            </div>
        </div>
    </div>
</header>
