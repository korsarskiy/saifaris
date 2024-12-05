@extends('layouts.app')

@section('content')
    <div class="catalog">
        <div class="hh">
            КАТАЛОГ
        </div>
        <div class="container">
            <div class="catalog-cont">
                <form action="{{ route('catalog') }}" method="GET" class="filtr-form">
                    <div class="filtr">
                        <div class="filtr-type">
                            @foreach($categories as $cat)
                                <label class="{{ in_array($cat->id, request('categories', [])) ? 'active' : '' }}">
                                    <input type="checkbox" name="categories[]" value="{{ $cat->id }}" {{ in_array($cat->id, request('categories', [])) ? 'checked' : '' }}>
                                    {{ $cat->name }}
                                </label>
                            @endforeach
                            <label>
                                <h1 class="reset-filter">✕</h1>
                            </label>
                        </div>

                        <div class="filtr-nums">
                            <div class="filtr-nums-price">
                                <h1>Цена:</h1>
                                <div class="filtr-nums-price-top">
                                    <input type="number" name="minPrice" id="minPrice" value="{{ request('minPrice', $minPrice) }}">
                                    <span>-</span>
                                    <input type="number" name="maxPrice" id="maxPrice" value="{{ request('maxPrice', $maxPrice) }}">
                                </div>
                                <div class="slider-container">
                                    <input type="range" name="minPriceRange" id="minPriceRange" min="{{ $minPrice }}" max="{{ $maxPrice }}" step="1" value="{{ request('minPriceRange', $minPrice) }}">
                                    <input type="range" name="maxPriceRange" id="maxPriceRange" min="{{ $minPrice }}" max="{{ $maxPrice }}" step="1" value="{{ request('maxPriceRange', $maxPrice) }}">
                                </div>
                            </div>
                            <div class="accordion-cont">
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <button class="accordion-button">
                                            Длина <span class="accordion-icon">></span>
                                        </button>
                                        <div class="accordion-content">
                                            @foreach($lengths as $length)
                                                <label>
                                                    <input type="checkbox" name="lengths[]" value="{{ $length }}" {{ in_array($length, request('lengths', [])) ? 'checked' : '' }}>
                                                    {{ $length }} см
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <button class="accordion-button">
                                            Ширина <span class="accordion-icon">></span>
                                        </button>
                                        <div class="accordion-content">
                                            @foreach($widths as $width)
                                                <label>
                                                    <input type="checkbox" name="widths[]" value="{{ $width }}" {{ in_array($width, request('widths', [])) ? 'checked' : '' }}>
                                                    {{ $width }} см
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <button class="accordion-button">
                                            Глубина <span class="accordion-icon">></span>
                                        </button>
                                        <div class="accordion-content">
                                            @foreach($depths as $depth)
                                                <label>
                                                    <input type="checkbox" name="depths[]" value="{{ $depth }}" {{ in_array($depth, request('depths', [])) ? 'checked' : '' }}>
                                                    {{ $depth }} см
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion">
                                    <div class="accordion-item">
                                        <button class="accordion-button">
                                            Цвет <span class="accordion-icon">></span>
                                        </button>
                                        <div class="accordion-content">
                                            @foreach($colors as $color)
                                                <label>
                                                    <input type="checkbox" name="colors[]" value="{{ $color }}" {{ in_array($color, request('colors', [])) ? 'checked' : '' }}>
                                                    {{ $color }}
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="filtr-sub">
                        <button type="submit" class="filtr-prim">Применить фильтр</button>
                        <a href="{{ route('catalog') }}" class="reset-filter-button">Сбросить фильтр</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="catalog-tovars">
        <div class="container">
        <div class="top-tovars-cont">
            @if($productcolors->isEmpty())
                <h1>Товары не найдены!</h1>
            @endif
                @foreach($productcolors as $productcolor)

                    <div class="top-item">
                        <a href="{{route('product', $productcolor->id)}}">
                            <img src="{{$productcolor->images->first()->img}}" alt="">
                            <div class="item-txt">
                                <h4>{{$productcolor->product->name}}</h4>
                                <p>{{number_format($productcolor->product->price, 0,  '', ' ')}} ₽</p>
                            </div>
                        </a>
                            <button class="buy open-popup" id="{{$productcolor->id}}">ЗАКАЗАТЬ</button>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

    <div id="wanna-popup" class="popup">
        <div class="popup-content">
            <span class="close">×</span>
            <h2>ОФОРМЛЕНИЕ ЗАКАЗА</h2>
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
            </form>

            <div id="successMessage" class="alert alert-success" style="display:none;"></div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('.reset-filter').click(function() {
                $('input[name="categories[]"]').prop('checked', false);
                $('label').removeClass('active');

                // Отправляем форму
                $('.filtr-form').submit();
            });

            $(document).ready(function() {
                $('#phone').inputmask('+7(995)008-14-96');
            });
        });

    </script>

    <script src="/public/assets/js/requests.js"></script>
@endsection
