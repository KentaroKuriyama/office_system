<html>
    <body>
        <h2>{{$user->name}}様</h2>
        <h2>{{$input['subject']}}</h2>
        <p style="line-height:3">{!!nl2br(e($input['text']))!!}</p>
        <p>
            ※このメールは自動送信です。返信はできませんので予めご了承ください。<br>
            もしお心当たりのない方は恐れ入りますが以下のアドレスにご連絡ください。<br>
            連絡先：support@example.com
        </p>
    </body>
</html>
