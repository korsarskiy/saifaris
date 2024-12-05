@extends('layouts.app')

@section('content')

    <div class="item">
        <div class="container">
            <div class="item-cont">
                <div class="item-cont-img">
                    <div id="image-slider" class="splide">
                        <div class="splide__track">
                            <ul class="splide__list">
                                @foreach($images as $image)
                                    <li class="splide__slide"><img src="{{$image->img}}" alt="Image {{$image->id}}"></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="item-cont-txt">
                    <h1>{{$productcolor->product->name}}</h1>
                    <p>{{$productcolor->product->description}}</p>
                    <div class="item-cont-txt-colors">
                        <h3>Цвета:</h3>
                        <div class="colors-cont">
                            @foreach($colors as $color)
                                <div class="colors-item">
                                    @if($color->id == $productcolor->id)
                                        <a href="{{route('product', $color->id)}}" class="color-variant color-selected" style="background-color: {{$color->hex}}"></a>
                                    @else
                                        <a href="{{route('product', $color->id)}}" class="color-variant" style="background-color: {{$color->hex}}"></a>
                                    @endif

                                    @auth()
                                        @if(count($colors) == 1)
                                            <form action="{{route('color.destroy', $color->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delcolor" onclick="return confirmSubmit(`{{$color->name}} цвет? При удалении последнего цвета удалится товар, вы уверены`);">Удалить</button>
                                            </form>
                                        @else
                                            <form action="{{route('color.destroy', $color->id)}}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delcolor" onclick="return confirmSubmit(`{{$color->name}} цвет`);">Удалить</button>
                                            </form>
                                        @endif

                                    @endauth
                                </div>
                            @endforeach
                        </div>
                        @auth()
                            <a href="{{route('color.add', $productcolor->product->id)}}" class="addcolor">+ Добавить цвет</a>
                            <a href="" class="addcolor"> + Изменить Цвет</a>
                        @endauth
                    </div>
                    <div class="item-cont-txt-btns">
                        <a href="{{ $productcolor->product->{'3d_model'} }}" download class="dowload">СКАЧАТЬ 3Д МОДЕЛЬ</a>
                        <button id="{{$productcolor->id}}" class="buy open-popup">ЗАКАЗАТЬ</button>
                        @auth()
                            <a href="{{route('product.edit', $productcolor->product->id)}}" class="editbtn">РЕДАКТИРОВАТЬ</a>
                            <form action="{{route('product.destroy', $productcolor->product->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="deletebtn" onclick="return confirmSubmit(`товар {{$productcolor->product->name}}`);">УДАЛИТЬ</button>
                            </form>

                        @endauth
                    </div>
                </div>
                <div class="item-cont-char">
                    <p class="price">{{number_format($productcolor->product->price, 0,  '', ' ')}}  ₽</p>
                    <p>Страна производства: <span> {{$productcolor->product->country}}</span></p>
                    <p>Тип предмета:<span> {{$productcolor->product->category->name}}</span></p>
                    <p>Размеры (ШхДхГ): <span> {{number_format($productcolor->product->width, 0,  '', ' ')}} x {{number_format($productcolor->product->length, 0,  '', ' ')}} x {{number_format($productcolor->product->depth, 0,  '', ' ')}} см</span></p>
                    <p>Материал: <span>{{$productcolor->product->material}}</span></p>
                </div>
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
        function confirmSubmit(message) {
            if (confirm(`Вы уверены, что хотите удалить ${message}?`)) {
                return true;
            } else {
                return false;
            }
        }

        $(document).ready(function() {
            $('#phone').inputmask('+7 (999) 999-99-99');
        });
    </script>

    <script src="/public/assets/js/requests.js"></script>
@endsection
