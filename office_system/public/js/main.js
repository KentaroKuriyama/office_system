document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector(".submit"); // 送信ボタンのクラス名を指定

    submitButton.addEventListener("click", function () {
        submitButton.disabled = true; // ボタンを無効化
        submitButton.form.submit(); // フォームを送信
    });

    // メッセージが表示されている場合
    let successMessages = document.querySelectorAll('.success-message');
    let deleteMessages = document.querySelectorAll('.delete-message');
    let errorMessages = document.querySelectorAll('.error-message');

    successMessages.forEach(function (successMessage) {
        setTimeout(function () {
            // メッセージを非表示にする
            successMessage.style.display = 'none';
        }, parseInt(successMessage.getAttribute('data-timeout')));
    });

    deleteMessages.forEach(function (deleteMessage) {
        setTimeout(function () {
            // メッセージを非表示にする
            deleteMessage.style.display = 'none';
        }, parseInt(deleteMessage.getAttribute('data-timeout')));
    });

    errorMessages.forEach(function (errorMessage) {
        setTimeout(function () {
            // メッセージを非表示にする
            errorMessage.style.display = 'none';
        }, parseInt(errorMessage.getAttribute('data-timeout')));
    });
});
