document.addEventListener("DOMContentLoaded", function () {
    const submitButton = document.querySelector(".report"); // 送信ボタンのクラス名を指定

    submitButton.addEventListener("click", function () {
        submitButton.disabled = true; // ボタンを無効化
        submitButton.form.submit(); // フォームを送信
    });
});
