let fileInputCounter = 1; // Счетчик для уникальных идентификаторов

// Функция для создания и добавления нового инпута и label
function addFileInput() {
    const fileInputWrapper = document.createElement('div');
    fileInputWrapper.className = 'file-input-image'; // Добавляем класс

    const fileLabel = document.createElement('label');
    fileLabel.textContent = `Выберите изображение ${fileInputCounter}`;
    fileLabel.setAttribute('for', `file-input-${fileInputCounter}`);
    fileLabel.setAttribute('class', 'addphoto');

    const fileInput = document.createElement('input');
    fileInput.type = 'file';
    fileInput.id = `file-input-${fileInputCounter}`;
    fileInput.name = 'img[]';
    fileInput.className = 'inputtypefile'; // Исправлено на className
    fileInput.addEventListener('change', handleFileChange);

    const previewImage = document.createElement('img');
    previewImage.id = `preview-${fileInputCounter}`;
    previewImage.style.display = 'none'; // Скрываем изображение по умолчанию
    previewImage.style.maxWidth = '100px'; // Устанавливаем максимальную ширину для предпросмотра

    fileInputWrapper.appendChild(fileLabel);
    fileInputWrapper.appendChild(fileInput);
    fileInputWrapper.appendChild(previewImage);
    fileInputWrapper.appendChild(document.createElement('br')); // Добавляем разрыв строки
    document.getElementById('file-inputs').appendChild(fileInputWrapper);

    fileInputCounter++;
}

// Функция-обработчик события change для инпута
function handleFileChange(event) {
    const fileInput = event.target;
    const fileInputWrapper = fileInput.parentElement;
    const previewImage = fileInputWrapper.querySelector('img');

    if (fileInput.files.length > 0) {
        // Если файл выбран, добавляем новый инпут и label
        addFileInput();

        // Отображаем предпросмотр изображения
        const file = fileInput.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImage.src = e.target.result;
            previewImage.style.display = 'block';
        };

        reader.readAsDataURL(file);
    } else {
        // Если файл не выбран, скрываем предпросмотр изображения
        previewImage.style.display = 'none';

        // Проверяем, есть ли следующий инпут и удаляем его, если он существует
        const nextFileInputWrapper = fileInputWrapper.nextElementSibling;
        if (nextFileInputWrapper) {
            nextFileInputWrapper.remove();
            fileInputCounter--; // Уменьшаем счетчик, так как инпут был удален
        }
    }
}

// Создаем первый инпут и label при загрузке страницы
addFileInput();
