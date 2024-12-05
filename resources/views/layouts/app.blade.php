<!DOCTYPE html>
<html lang="en">
<head>
    <title>Saifaris - мебель и текстиль</title>
    <meta name="discription" content="Ищете идеальную мебель для вашего интерьера? Saifaris предлагает широкий выбор мебели для дома и офиса, сочетающей в себе функциональность и стиль. Мы предлагаем качественные мебельные решения по доступным ценам с доставкой по всей России." />
    <meta name="keywords" content="saifaris, сайфарис, saifaris.ru, сайфарис.ру, saifaris ru, мебель казань, купить мебель онлайн, мебель для дома, мебель для офиса, диваны и кресла, мебель для спальни, мебель для кухни, современная мебель, классическая мебель, мебель под заказ, качественная мебель с доставкой"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="request-store-route" content="{{ route('request.store') }}">
    <meta name="diy-request-store-route" content="{{ route('diyrequest.store') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&family=Unbounded:wght@100;200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/css/splide.min.css">
    <link rel="stylesheet" href="/public/assets/css/style.css">
    <link type="Image/x-icon" href="/public/favicon.png" rel="icon">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <title>Saifaris</title>
</head>
<body>
@include('components.header')

@error('success') <div class="success-message">{{$message}}</div> @enderror

@error('success') <script>    let successMessage = document.querySelector('.success-message');
    setTimeout(() => {
        successMessage.style.display = 'none';
    }, 2000)
</script>
@enderror

@yield('content')

@include('components.footer')
<script src="/public/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@latest/dist/js/splide.min.js"></script>
</body>
</html>
