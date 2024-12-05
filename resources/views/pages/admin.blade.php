@extends('layouts.app')


@section('content')
    <div class="admin-panel">
        <h1>Админ Панель</h1>
        <form action="{{route('logout')}}" method="post">
            @csrf
            <button class="redbtn" type="submit">Выйти</button>
        </form>

        <!-- Раздел для добавления товара -->
        <section class="add-product">
            <h2>Добавление товара</h2>
            <form action="{{route('product.store')}}" method="post" id="product-form" enctype="multipart/form-data">
                @csrf
                <div class="input-label">
                    <input type="text" name="name" placeholder="Название" value="{{old('name')}}">
                    @error('name') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <textarea name="description" placeholder="Описание">{{old('description')}}</textarea>
                    @error('description') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="text" name="country" placeholder="Страна производителя" value="{{old('country')}}">
                    @error('country') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <label for="category">Категория</label>
                    <select name="category_id" id="category">
                        @foreach($categories as $cat)
                        <option value="{{$cat->id}}">{{$cat->name}}</option>
                      @endforeach
                    </select>
                    @error('category_id') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="text" name="price" placeholder="Цена" value="{{old('price')}}">
                    @error('price') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="number" name="width" placeholder="Ширина (см)" value="{{old('width')}}">
                    @error('width') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="number" name="length" placeholder="Длина (см)" value="{{old('length')}}">
                    @error('length') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="number" name="depth" placeholder="Глубина (см)" value="{{old('depth')}}">
                    @error('depth') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="text" name="material" placeholder="Материал" value="{{old('material')}}">
                    @error('material') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <label for="3d_model">Загрузить 3д модель</label>
                    <input type="file" name="3d_model" id="3d_model">
                    @error('3d_model') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="text" name="color_name" class="colorinput" placeholder="Название цвета" value="{{old('color_name')}}">
                    @error('color_name') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="text" name="hex" placeholder="Код цвета (HEX)" value="{{old('hex')}}">
                    @error('hex') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="div file-inputs" id="file-inputs"></div>
                @error('img')  <label for="" class="errlabel">{{$message}}</label> @enderror
                @error('img.*')  <label for="" class="errlabel">{{$message}}</label> @enderror
                <button class="adm-sub" type="submit">Добавить товар</button>
            </form>
        </section>

        <!-- Раздел для добавления категории -->
        <section class="add-category">
            <h2>Добавление категории</h2>
            <form action="{{route('category.store')}}" method="post" id="category-form">
                @csrf
                <div class="input-label">
                    <input type="text" name="cat_name" placeholder="Название категории" value="{{old('cat_name')}}">
                    @error('cat_name') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>
                <button class="adm-sub" type="submit">Добавить категорию</button>
            </form>
            <div class="all-categories">

                @foreach($categories as $cat)
                <div class="category-item">
                    <p>{{$cat->name}}</p>
                    <form action="{{route('category.destroy', $cat->id)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delcolor" onclick="return confirmSubmit(`удалить категорию {{$cat->name}}? Все товары этой категории также удалятся, вы уверены`);">Удалить</button>
                    </form>
                </div>
                @endforeach
            </div>
        </section>

        <!-- Таблица с заявками -->
        <section class="registered-users">
            <h2>Заявки</h2>

            <div class="tab-head" id="requests">
                <button class="tab tab-active">Заявки на товары</button>
                <button class="tab">Заявки "Сделай сам"</button>
            </div>

            <div class="request-filters">
                <a href="{{route('admin', '#requests')}}" class="request-filter @if(empty($_GET['sort']))request-filter-active @endif">Все</a>
                <a href="?sort=created#requests" class="request-filter @if(isset($_GET['sort']) && $_GET['sort'] == 'created')request-filter-active @endif">Создан</a>
                <a href="?sort=accepted#requests" class="request-filter @if(isset($_GET['sort']) && $_GET['sort'] == 'accepted')request-filter-active @endif">Принят</a>
                <a href="?sort=canceled#requests" class="request-filter @if(isset($_GET['sort']) && $_GET['sort'] == 'canceled')request-filter-active @endif">Отменен</a>
            </div>

            <table class="tabs">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Имя</th>
                        <th>Номер телефона</th>
                        <th>Товар</th>
                        <th>Статус</th>
                    </tr>

                </thead>
                <tbody>
                    @foreach($requests as $request)
                    <tr>
                        <th>{{$request->id}}</th>
                        <th>{{$request->user_name}}</th>
                        <th><a href="tel:{{$request->phone}}">{{$request->phone}}</a></th>
                        <th><a href="{{route('product', $request->product_color_id)}}" target="_blank"  class="orderlink">Перейти</a></th>
                        <th class="status">
                            {{$request->status}}
                            <div class="status-items">
                                @if($request->status == 'Отменен')
                                    <form action="{{route('request.accept',  $request->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="statusbtn" onclick="return confirmSubmit(`подтвердить заявку с id {{$request->id}}`);">✓</button>
                                    </form>
                                @elseif($request->status == 'Принят')
                                    <form action="{{route('request.decline',  $request->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="statusbtncancel" onclick="return confirmSubmit(`отменить заявку с id {{$request->id}}`);">✕</button>
                                    </form>
                                @else
                                    <form action="{{route('request.accept',  $request->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="statusbtn" onclick="return confirmSubmit(`подтвердить заявку с id {{$request->id}}`);">✓</button>
                                    </form>

                                    <form action="{{route('request.decline',  $request->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="statusbtncancel" onclick="return confirmSubmit(`отменить заявку с id {{$request->id}}`);">✕</button>
                                    </form>
                                @endif

                            </div>
                        </th>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <table class="tabs nevidno">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Имя</th>
                    <th>Номер телефона</th>
                    <th>Описание</th>
                    <th>Статус</th>
                </tr>

                </thead>
                <tbody>
                @foreach($diyrequests as $diyrequest)
                    <tr>
                        <th>{{$diyrequest->id}}</th>
                        <th>{{$diyrequest->user_name}}</th>
                        <th><a href="tel:{{$diyrequest->phone}}">{{$diyrequest->phone}}</a></th>
                        <th>{{$diyrequest->description}}</th>
                        <th class="status">
                            {{$diyrequest->status}}
                            <div class="status-items">

                                @if($diyrequest->status == 'Отменен')
                                    <form action="{{route('diyrequest.accept',  $diyrequest->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="statusbtn" onclick="return confirmSubmit(`подтвердить заявку с id {{$diyrequest->id}}`);">✓</button>
                                    </form>
                                @elseif($diyrequest->status == 'Принят')
                                    <form action="{{route('diyrequest.decline',  $diyrequest->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="statusbtncancel" onclick="return confirmSubmit(`отменить заявку с id {{$diyrequest->id}}`);">✕</button>
                                    </form>
                                @else
                                    <form action="{{route('diyrequest.accept',  $diyrequest->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="statusbtn" onclick="return confirmSubmit(`подтвердить заявку с id {{$diyrequest->id}}`);">✓</button>
                                    </form>

                                    <form action="{{route('diyrequest.decline',  $diyrequest->id)}}" method="post">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="statusbtncancel" onclick="return confirmSubmit(`отменить заявку с id {{$diyrequest->id}}`);">✕</button>
                                    </form>
                                @endif

                            </div>
                        </th>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </section>
    </div>

    <script>
        function confirmSubmit(message) {
            if (confirm(`Вы уверены, что хотите ${message}?`)) {
                return true;
            } else {
                return false;
            }
        }
    </script>

    <script src="/public/assets/js/imgcount.js"></script>
@endsection
