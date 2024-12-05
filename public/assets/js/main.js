
//ползунки

document.addEventListener('DOMContentLoaded', function () {
    const minPriceInput = document.getElementById('minPrice');
    const maxPriceInput = document.getElementById('maxPrice');
    const minPriceRange = document.getElementById('minPriceRange');
    const maxPriceRange = document.getElementById('maxPriceRange');
    const sliderTrack = document.createElement('div');
    sliderTrack.classList.add('slider-track');
    const sliderContainer = document.querySelector('.slider-container');
    if(sliderContainer){
        sliderContainer.appendChild(sliderTrack);
    }


    function updateSliderBackground() {
        const minVal = parseInt(minPriceRange.value);
        const maxVal = parseInt(maxPriceRange.value);
        const minPercent = ((minVal - minPriceRange.min) / (minPriceRange.max - minPriceRange.min)) * 100;
        const maxPercent = ((maxVal - minPriceRange.min) / (minPriceRange.max - minPriceRange.min)) * 100;

        // Обновляем фон трека
        sliderTrack.style.background = `linear-gradient(to right, black ${minPercent}%, Olive ${minPercent}%, Olive ${maxPercent}%, black ${maxPercent}%)`;
    }

    function syncInputsWithRanges() {
        minPriceInput.value = minPriceRange.value;
        maxPriceInput.value = maxPriceRange.value;
        updateSliderBackground();
    }

    function syncRangesWithInputs() {
        minPriceRange.value = minPriceInput.value;
        maxPriceRange.value = maxPriceInput.value;
        updateSliderBackground();
    }

    if(minPriceRange) {
        minPriceRange.addEventListener('input', function () {
            if (parseInt(minPriceRange.value) > parseInt(maxPriceRange.value)) {
                minPriceRange.value = maxPriceRange.value;
            }
            syncInputsWithRanges();
        });

        maxPriceRange.addEventListener('input', function () {
            if (parseInt(maxPriceRange.value) < parseInt(minPriceRange.value)) {
                maxPriceRange.value = minPriceRange.value;
            }
            syncInputsWithRanges();
        });

        minPriceInput.addEventListener('input', function () {
            let value = parseInt(minPriceInput.value);
            if (value >= parseInt(minPriceRange.min) && value <= parseInt(maxPriceRange.value)) {
                syncRangesWithInputs();
            } else {
                minPriceInput.value = minPriceRange.value;
            }
        });

        maxPriceInput.addEventListener('input', function () {
            let value = parseInt(maxPriceInput.value);
            if (value <= parseInt(maxPriceRange.max) && value >= parseInt(minPriceRange.value)) {
                syncRangesWithInputs();
            } else {
                maxPriceInput.value = maxPriceRange.value;
            }
        });
    }

    // Инициализация фона слайдеров
    updateSliderBackground();

    // Аккордеон
    const buttons = document.querySelectorAll('.accordion-button');

    buttons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Предотвращаем отправку формы
            const content = this.nextElementSibling;

            // Закрываем другие открытые разделы
            document.querySelectorAll('.accordion-item').forEach(item => {
                if (item !== this.parentElement) {
                    item.classList.remove('open');
                }
            });

            // Переключаем отображение текущего раздела
            this.parentElement.classList.toggle('open');
        });
    });
});


//слайдер


document.addEventListener('DOMContentLoaded', function () {
    new Splide('#image-slider', {
        type: 'loop',        // Зацикленный слайдер
        perPage: 1,          // Показывать по 1 слайду
        perMove: 1,          // Перемещение на 1 слайд за раз
        autoplay: true,      // Автоматическое проигрывание
        interval: 7000,      // Интервал между слайдами в миллисекундах
        pauseOnHover: true,  // Пауза при наведении курсора
        drag: true,          // Включение свайпа
        arrows: true,        // Включение стрелок навигации
        pagination: true,    // Включение пагинации
    }).mount();
});


//pop up
if (document.getElementById('open-popup')) {

    document.getElementById('open-popup').onclick = function () {
        document.getElementById('registration-popup').style.display = 'block';
    }

    // Открытие окна авторизации
    // document.getElementById('open-login').onclick = function(event) {
    //     event.preventDefault();
    //     document.getElementById('registration-popup').style.display = 'none';
    //     document.getElementById('login-popup').style.display = 'block';
    // }
    //
    // // Открытие окна регистрации из окна авторизации
    // document.getElementById('open-registration').onclick = function(event) {
    //     event.preventDefault();
    //     document.getElementById('login-popup').style.display = 'none';
    //     document.getElementById('registration-popup').style.display = 'block';
    // }

    // Закрытие pop-up окна
    var closeButtons = document.querySelectorAll('.close');
    closeButtons.forEach(function (button) {
        button.onclick = function () {
            document.getElementById('registration-popup').style.display = 'none';
            document.getElementById('login-popup').style.display = 'none';
        }
    })

    // Закрытие окна при клике вне его
    window.onclick = function (event) {
        var registrationPopup = document.getElementById('registration-popup');
        var loginPopup = document.getElementById('login-popup');
        if (event.target === registrationPopup || event.target === loginPopup) {
            registrationPopup.style.display = 'none';
            // loginPopup.style.display = 'none';
        }
    }
}




// Обработчик формы добавления товара
if (document.getElementById('product-form')) {


    // Обработчик формы добавления категории
    //document.getElementById('category-form').addEventListener('submit', function(event) {
    //event.preventDefault();
    // Здесь можно добавить код для обработки данных формы и отправки их на сервер
    // alert('Категория добавлена!');
    //  });
}


// Здесь можно добавить код для загрузки данных о пользователях и отображения их в таблице


function toggleMenu() {
    const burgerNav = document.querySelector('.burger-nav');
    const overlay = document.querySelector('.overlay');

    if (burgerNav.style.display === 'block') {
        burgerNav.style.display = 'none';
        burgerNav.style.transform = 'translateY(-100%)';
        overlay.style.display = 'none';
    } else {
        burgerNav.style.display = 'block';
        burgerNav.style.transform = 'translateY(0)';
        overlay.style.display = 'block';
    }
}

function toggleMenuCat() {
    const burgerNavCat = document.querySelector('.burger-nav-cat');
    const overlayCat = document.querySelector('.overlay-cat');

    if (burgerNavCat.style.display === 'block') {
        burgerNavCat.style.display = 'none';
        burgerNavCat.style.transform = 'translateY(-100%)';
        overlayCat.style.display = 'none';
    } else {
        burgerNavCat.style.display = 'block';
        burgerNavCat.style.transform = 'translateY(0)';
        overlayCat.style.display = 'block';
    }
}


const buttons = document.querySelectorAll('.toggle-btn');

// Добавляем к каждому элементу обработчик события клика
buttons.forEach(function(button) {
  button.addEventListener('click', function() {
    // При нажатии добавляем или удаляем класс active
    this.classList.toggle('active');
  });
});


document.addEventListener("DOMContentLoaded", function() {
    const labels = document.querySelectorAll('.filtr-type label');

    if(labels){
        labels.forEach(label => {
            label.addEventListener('click', function(event) {
                // Отключаем стандартное поведение (когда клик по label автоматически кликает по input)
                event.preventDefault();

                // Находим связанный input (чекбокс)
                const checkbox = this.querySelector('input[type="checkbox"]');

                // Меняем состояние чекбокса (выбран или нет)
                checkbox.checked = !checkbox.checked;

                // Добавляем или убираем класс 'active' в зависимости от состояния чекбокса
                if (checkbox.checked) {
                    this.classList.add('active');
                } else {
                    this.classList.remove('active');
                }
            });
        });


    }

});


document.addEventListener("DOMContentLoaded", function() {
    // Получаем элементы
    const popup = document.getElementById('wanna-popup');
    const openBtns = document.querySelectorAll('.open-popup');
    const closeBtn = document.querySelector('.close');
    const productid = document.getElementById('productcolor_id')
    const successMsg = document.getElementById('successMessage')
    const diySuccessMsg = document.getElementById('diySuccessMessage')

    if (openBtns) {
        // Открытие попапа при нажатии на кнопку
        openBtns.forEach((openBtn) => {
            openBtn.addEventListener('click', () => {
                popup.style.display = 'flex';
                productid.value = openBtn.getAttribute('id');
            });
        })


        // Закрытие попапа при нажатии на крестик
        closeBtn.addEventListener('click', () => {
            popup.style.display = 'none';
            productid.removeAttribute('value');
            successMsg.style.display = 'none'
        });

        // Закрытие попапа при клике вне его области
        window.addEventListener('click', (event) => {
            if (event.target == popup) {
                popup.style.display = 'none';
                productid.removeAttribute('value');
                successMsg.style.display = 'none'
            }
        });
    }

    const diyBtn = document.getElementById('diy-btn');
    const diyPopup = document.getElementById('diy-popup');
    const closeDiy = document.querySelector('.diy-close');

    if (diyBtn) {
        diyBtn.addEventListener('click', () => {
            diyPopup.style.display = 'flex';
        });

        closeDiy.addEventListener('click', () => {
            diyPopup.style.display = 'none';
            diySuccessMsg.style.display = 'none'
        });

        window.addEventListener('click', (event) => {
            if (event.target == diyPopup) {
                diyPopup.style.display = 'none';
                diySuccessMsg.style.display = 'none'
            }
        });
    }
});


// tabs
let tabs = document.querySelectorAll('.tabs')
let tab = document.querySelectorAll('.tab')
if (tabs){
    for (let i = 0; i < tab.length; i++) {
        tab[i].addEventListener('click', function() {
            let rem = document.querySelector('.tab-active')
            rem.classList.remove('tab-active');
            tab[i].classList.add('tab-active');
            for (let j = 0; j < tabs.length; j++) {
                if(i == j){
                    tabs[j].classList.remove('nevidno')

                }
                else{
                    tabs[j].classList.add('nevidno')
                }


            }
        })

    }
}

AOS.init();
