document.addEventListener('DOMContentLoaded', () => {
    const selectOption = document.getElementById('selectOption');
    const input1 = document.getElementById('input1');
    const input2 = document.getElementById('input2');
    const input3 = document.getElementById('input3');
    const submitButton = document.getElementById('submitButton');

    function showLoading() {
        document.getElementById('loadingContainer').style.display = 'flex';
    }

    // Функция для скрытия блока "loading"
    function hideLoading() {
        document.getElementById('loadingContainer').style.display = 'none';
    }

    // Обработчик клика на кнопку "Go"
    submitButton.addEventListener('click', () => {
        showLoading();
        const type = selectOption.value;

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

        // Выполняем запрос к серверу, замените URL на свой серверный скрипт или API
        fetch(window.location.href, {
            method: 'POST', // Используем метод POST для отправки значения селекта
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken, // Добавляем CSRF-токен в заголовки
            },
            body: JSON.stringify({ type }), // Преобразуем значение селекта в формат JSON
        })
            .then(response => response.json())
            .then(data => {
                // Заполняем инпуты значениями из ответа сервера
                input1.value = data.value1 !== undefined ? data.value1 : '';
                input2.value = data.value2 !== undefined ? data.value2 : '';
                input3.value = data.value3 !== undefined ? data.value3 : '';
                hideLoading();
            })
            .catch(error => {
                hideLoading();
                console.error('Ошибка:', error);
            });
    });
});
