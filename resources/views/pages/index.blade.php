@extends('layouts.app_no_header')

@section('content')
    <div class="banner">
        <div class="container">
            <div class="banner-cont">
                <div data-aos="fade-left" data-aos-duration="1000" class="head">
                    <div class="head">
                    <a href="{{route('index')}}"><img src="/public/assets/image/logosaif.png" alt=""> </a>
                        <div class="head-a">
                            <a href="{{route('index')}}">Главная</a>
                            <a href="{{route('catalog')}}">Каталог</a>
                            <a href="{{route('index', '#about')}}">О нас</a>
                            <a href="{{route('index', '#diy')}}">Собери мебель сам</a>
                            <div class="head-num">
                                <a href="tel:89950081496">+7(995)008-14-96</a>
                            </div>
                            @auth()
                                <a href="{{route('admin')}}" class="admin-link">Админ</a>
                            @endauth
                        </div>
                        <!-- Бургер-меню -->
                        <div class="burger-menu" onclick="toggleMenu()">
                            <div class="burger-bar"></div>
                            <div class="burger-bar"></div>
                            <div class="burger-bar"></div>
                        </div>
                    </div>
                    <div class="burger-nav">
                        <div class="burger-a">
                            <a href="{{route('index')}}">Главная</a>
                        <a href="{{route('catalog')}}">Каталог</a>
                        <a href="{{route('index', '#about')}}">О нас</a>
                        <a href="{{route('index', '#diy')}}">Собери мебель сам</a>
                        <a href="tel:89950081496">+7(995)008-14-96</a>
                        </div>
                        @auth()
                            <a href="{{route('admin')}}" class="admin-link">Админ</a>
                        @endauth
                        <div class="burger-nav-close" onclick="toggleMenu()">✖</div>
                    </div>
                </div>
                <div  class="banner-zag">
                    <h1>МЕБЕЛЬ ДЛЯ ВАШЕГО ИДЕАЛЬНОГО ДОМА</h1>
                </div>
                <a href="{{route('catalog')}}">
                    <div class="banner-btn">
                        КАТАЛОГ
                    </div>
                </a>
            </div>
        </div>
    </div>

    <div class="top-tovars">
        <h1 class="hh" data-aos="fade-down" data-aos-duration="1500">ТОП ТОВАРОВ</h1>
        <div class="container">
            <div class="top-tovars-cont">
                @foreach($productcolors as $productcolor)

                    <div class="top-item" data-aos="fade-up" data-aos-duration="1500">
                        <a href="{{route('product', $productcolor->id)}}">
                            <img src="{{$productcolor->images->first()->img}}" alt="">
                            <div class="item-txt">
                                <h4>{{$productcolor->product->name}}</h4>
                                <p>{{number_format($productcolor->product->price, 0,  '', ' ')}} ₽</p>
                            </div>
                        </a>
                            <button id="{{$productcolor->id}}" class="buy open-popup">ЗАКАЗАТЬ</button>
                    </div>
                @endforeach

            </div>
            <div class="more">
                <a href="{{route('catalog')}}">Показать больше</a>
            </div>
        </div>
    </div>

    <div class="about" id="about">
        <h1 class="hh" data-aos="fade-down" data-aos-duration="1500">О НАС</h1>
        <div class="container">
            <div class="about-cont" data-aos="fade-up" data-aos-duration="1500">
                <div class="about-txt">
                    <p><span>Наша миссия</span> — помочь каждому клиенту создать интерьер, который отражает его индивидуальность, стиль и стремление к комфорту.</p>
                    <img src="../../../public/assets/image/about/image 11.png" alt="">
                </div>
                <div class="about-txt">
                    <img src="../../../public/assets/image/about/image 12.png" alt="">
                    <p><span> Наша команда</span> — это профессионалы с многолетним опытом, которые всегда готовы помочь вам сделать правильный выбор и превратить ваши идеи в реальность. Мы ценим каждого клиента и стремимся к тому, чтобы сотрудничество с нами приносило вам радость и удовлетворение.</p>
                </div>
                <div class="about-txt">
                    <p> <span>Компания SAIFARIS</span> — это более, чем просто мебель. Мы воплащаем все ваши месты в просторансвто, в котором вам будет уютно жить, работать и отдыхать. </p>
                    <img src="../../../public/assets/image/about/image 13.png" alt="">
                </div>
            </div>
        </div>
    </div>

    <div class="solo" id="diy">
        <div class="container">
            <div class="hh" data-aos="fade-down" data-aos-duration="1500">
                СОБЕРУ МЕБЕЛЬ САМ
            </div>
            <div class="solo-cont" data-aos="fade-up" data-aos-duration="1500">
                <div class="solo-video">
                    <!-- Вставка видео с YouTube -->
                    <iframe
                        width="100%"
                        height="520"
                        src="https://www.youtube.com/embed/VIDEO_ID"
                        frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>
                <div class="solo-txt">
                    <h3>ПРИ ПОМОЩИ НАШИХ МАСТЕРОВ ВЫ МОЖЕТЕ:</h3>
                    <div class="solo-txt-p">
                        <p>- Перетянуть диван </p>
                        <p>- ⁠перетянуть кровать </p>
                        <p>- ⁠перетянуть кресло </p>
                        <p>- ⁠перетянуть стул</p>
                        <p>- ⁠сделать стеновые панели </p>
                        <p>- ⁠сделать диван с нуля </p>
                        <p>- ⁠сделать кровать с нуля </p>
                        <p>- ⁠сделать кресло  </p>
                        <p>- ⁠сделать пуфик </p>
                    </div>
                    <div class="solo-btn">
                        <button class="sub-btn" id="diy-btn" >ХОЧУ СОБРАТЬ CАМ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="wanna-popup" class="popup">
        <div class="popup-content">
            <span class="close">×</span>
            <h2>ОСТАВЬТЕ ЗАЯВКУ</h2>
            <p>Или позвоните нам</p>
            <form id="requestForm">
                @csrf
                <div class="input-label">
                    <input type="text" placeholder="Имя" name="user_name">
                    <label class="errlabel" id="user_name_error"></label>
                </div>

                <div class="input-label">
                    <input type="tel" id="phone" name="phone" placeholder="Номер телефона">
                    <label class="errlabel" id="phone_error"></label>
                </div>

                <div class="input-label">
                    <input type="hidden" id="productcolor_id" name="product_color_id">
                    <label class="errlabel" id="product_color_id_error"></label>
                </div>
                <button type="submit">Оставить заявку</button>
                <a href="tel:89950081496">+7(995)008-14-96</a>
            </form>

            <div id="successMessage" class="alert alert-success" style="display:none;"></div>
        </div>
    </div>

    <div id="diy-popup" class="popup">
        <div class="popup-content">
            <span class="close diy-close">×</span>
            <h2>ОФОРМЛЕНИЕ ЗАКАЗА</h2>
            <form id="diyRequestForm">
                @csrf
                <div class="input-label">
                    <input type="text" placeholder="Имя" name="user_name">
                    <label class="errlabel" id="diy_user_name_error"></label>
                </div>

                <div class="input-label">
                    <input type="tel" id="phone-sec" name="phone" placeholder="Номер телефона">
                    <label class="errlabel" id="diy_phone_error"></label>
                </div>

                <div class="input-label">
                    <textarea name="description" rows="4" cols="30" placeholder="Описание (До 250 символов)"></textarea>
                    <label class="errlabel" id="diy_description_error"></label>
                </div>
                <button type="submit">Оставить заявку</button>

                <div id="diySuccessMessage" class="alert alert-success" style="display:none;"></div>
            </form>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#phone').inputmask('+7(995)008-14-96');
            $('#phone-sec').inputmask('+7(995)008-14-96');
        });
    </script>

    <script src="/public/assets/js/requests.js" defer></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="/public/assets/js/diyrequests.js" defer></script>
@endsection
