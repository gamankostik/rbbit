document.addEventListener('DOMContentLoaded', () => {
    const formContainer = document.getElementById('formContainer');
    const successMessage = document.getElementById('successMessage');
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
                    error404Message.style.display = 'block';
                    console.error('Error:', error);
                });
        }
    });


    const input2 = document.getElementById('input2');
    input2.addEventListener('keydown', function(event) {
        const key = event.key;

        // Разрешаем ввод цифр и дополнительных клавиш (Backspace, Delete, стрелки и т.д.)
        if (!isNumericInput(key) && !isModifierKey(event)) {
            event.preventDefault();
        }
    });

    function isNumericInput(key) {
        return /^\d*$/.test(key);
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