@extends('layouts.app')


@section('content')

    <div class="admin-panel">
        <!-- Раздел для редактирования товара -->
        <section class="add-product">
            <h2>Редактирование товара</h2>
            <form action="{{route('product.update', $product->id)}}" method="post" id="product-form" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <div class="input-label">
                    <input type="text" name="name" placeholder="Название" value="{{$product->name}}">
                    @error('name') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <textarea name="description" placeholder="Описание">{{$product->description}}</textarea>
                    @error('description') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="text" name="country" placeholder="Страна производителя" value="{{$product->country}}">
                    @error('country') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <label for="category">Категория</label>
                    <select name="category_id" id="category">
                        @foreach($categories as $cat)
                            <option value="{{$cat->id}}" @selected($cat->id == $product->category_id)>{{$cat->name}}</option>
                        @endforeach
                    </select>
                    @error('category_id') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="text" name="price" placeholder="Цена" value="{{$product->price}}">
                    @error('price') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="number" name="width" placeholder="Ширина (см)" value="{{$product->width}}">
                    @error('width') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="number" name="length" placeholder="Длина (см)" value="{{$product->length}}">
                    @error('length') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="number" name="depth" placeholder="Глубина (см)" value="{{$product->depth}}">
                    @error('depth') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <input type="text" name="material" placeholder="Материал" value="{{$product->material}}">
                    @error('material') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>

                <div class="input-label">
                    <label for="3d_model">Изменить 3д модель</label>
                    <input type="file" name="3d_model" id="3d_model">
                    @error('3d_model') <label class="errlabel" for="">{{$message}}</label> @enderror
                </div>


                <button type="submit">Редактировать товар</button>
            </form>
        </section>
    </div>


@endsection
