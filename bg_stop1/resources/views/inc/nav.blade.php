<nav style="display:none">
    <ul>
        <div class="menuOnMobile">
        </br>
        @auth
            <a href="{{ url('/') }}">Начало</a>
            <a href="{{url('/edit')}}">Редакция</a>
            <a href="{{url('logout')}}">Изход</a>
        @else
            <a href="{{ route('login') }}">Вход</a>
            <a href="{{ route('register') }}">Регистрация</a>
        @endauth
        </div>
        <li><a href="/jobs">Работа</a></li>
        <li><a href="/rents">Квартири</a></li>
        <li><a href="/purchases">Купи/Продай</a></li>
        <li><a href="/dating">Запознанства</a></li>
        <li><a href="/lessons">Уроци</a></li>
        <li><a href="/services">Услуги</a></li>
        <li><a href="/forum">Форум</a></li>
    </ul>
</nav>