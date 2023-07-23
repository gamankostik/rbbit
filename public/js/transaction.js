document.addEventListener('DOMContentLoaded', () => {
    const formContainer = document.getElementById('formContainer');
    const successMessage = document.getElementById('successMessage');
    const notSuccessMessage = document.getElementById('notSuccessMessage');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    const error404Message = document.getElementById('error404Message');

    const submitButton = document.getElementById('submitButton');

    submitButton.addEventListener('click', () => {
        const address_from = document.querySelector('input[name="address_from"]').value;
        const amount = document.querySelector('input[name="amount"]').value;
        const address_to = document.querySelector('input[name="address_to"]').value;

        if (validateInputs(address_from, amount, address_to)) {
            fetch(window.location.href, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    "X-CSRF-TOKEN": csrfToken, // Добавляем CSRF-токен в заголовки
                },
                body: JSON.stringify({
                    address_from,
                    amount,
                    address_to,
                }),
            })
                .then(response => {
                    if (response.status === 419) {
                        throw new Error('Not success');
                    }
                    if (!response.ok) {
                        throw new Error('Page not found');
                    }
                    return response.json();
                })
                .then(data => {
                    // Обработка успешного ответа
                    formContainer.style.display = 'none';
                    successMessage.style.display = 'block';
                })
                .catch(error => {
                    // Обработка ошибки
                    formContainer.style.display = 'none';
                    if (error.message === 'Not success') {
                        notSuccessMessage.style.display = 'block';
                    } else {
                        error404Message.style.display = 'block';
                    }
                });
        }
    });


    const input2 = document.getElementById('input2');
    input2.addEventListener('keydown', function(event) {
        const key = event.key;

        // Разрешаем ввод цифр, точки и дополнительных клавиш (Backspace, Delete, стрелки и т.д.)
        if (!isNumericInput(key) && !isDotInput(key) && !isBackspaceInput(event) && !isModifierKey(event)) {
            event.preventDefault();
        }
    });

    // Обработчик удаления
    input2.addEventListener('keyup', function(event) {
        const key = event.key;

        // Если нажата клавиша Backspace или Delete, разрешаем удаление
        if (isBackspaceInput(event) || key === 'Delete') {
            return;
        }

        // Проверяем, что введено только одна точка
        if (isDotInput(key) && input2.value.indexOf('.') !== input2.value.lastIndexOf('.')) {
            event.preventDefault();
        }
    });
    function isNumericInput(key) {
        return /^\d*$/.test(key);
    }

    function isDotInput(key) {
        return key === '.'; // Проверяем на точку
    }

    function isBackspaceInput(event) {
        return event.key === 'Backspace'; // Проверяем на Backspace
    }

    function isModifierKey(event) {
        return event.ctrlKey || event.altKey || event.metaKey;
    }

    function validateInputs(address_from, amount, address_to) {
        let valid = true;
        if (address_from === '') {
            // Show error message for empty input field
            document.getElementById('input1').classList.add('is-invalid');
            document.getElementById('input1Feedback').style.display = 'block';
            valid = false;
        } else {
            // Input field is filled, remove error classes and hide feedback
            document.getElementById('input1').classList.remove('is-invalid');
            document.getElementById('input1Feedback').style.display = 'none';
        }

        if (amount === '') {
            // Show error message for empty input field
            document.getElementById('input2').classList.add('is-invalid');
            document.getElementById('input2Feedback').style.display = 'block';
            valid = false;
        } else {
            // Input field is filled, remove error classes and hide feedback
            document.getElementById('input2').classList.remove('is-invalid');
            document.getElementById('input2Feedback').style.display = 'none';
        }

        if (address_to === '') {
            // Show error message for empty input field
            document.getElementById('input3').classList.add('is-invalid');
            document.getElementById('input3Feedback').style.display = 'block';
            valid = false;
        } else {
            // Input field is filled, remove error classes and hide feedback
            document.getElementById('input3').classList.remove('is-invalid');
            document.getElementById('input3Feedback').style.display = 'none';
        }

        return valid;
    }


});
