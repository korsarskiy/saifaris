@extends('layouts.app')

@section('content')
    <div class="admin-panel">


        <!-- Раздел для добавления товара -->
        <section class="add-product">
            <h2>Добавление Цвета</h2>
            <form action="{{route('color.store', $id)}}" method="post" id="product-form" enctype="multipart/form-data">
                @csrf

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
                <button type="submit">Добавить цвет</button>
            </form>
        </section>
    </div>
    <script src="/public/assets/js/imgcount.js"></script>
@endsection
