<html>
    <body>
        <h2>障害報告内容の確認</h2>
        <h3>
            以下の内容で障害報告を受け付けました。<br>
            お手すきの担当者は確認をお願いします
        </h3>
        <p>送信内容</p>
        <table style="border-collapse:collapse;border:1px solid #ccc;width:100%">
            <tr>
                <th style="text-align:left;padding:20px;border:1px solid #ccc">機能</th>
                <td style="padding:20px;border:1px solid #ccc">{{ config('const.trouble.function')[$input['function']] }}</td>
            </tr>
            <tr>
                <th style="text-align:left;padding:20px;border:1px solid #ccc">発生日時</th>
                <td style="padding:20px;border:1px solid #ccc">{{ \Carbon\Carbon::parse($input['occurred_at'])->format('Y年m月d日 H時i分') }}</td>
            </tr>
            <tr>
                <th style="text-align:left;padding:20px;border:1px solid #ccc">現象</th>
                <td style="padding:20px;border:1px solid #ccc">{!! nl2br(e($input['phenomenon'])) !!}</td>
            </tr>
            <tr>
                <th style="text-align:left;padding:20px;border:1px solid #ccc">再現手順</th>
                <td style="padding:20px;border:1px solid #ccc">{!! nl2br(e($input['reproduction_steps'])) !!}</td>
            </tr>
        </table>
        <p style="line-height:3">
            ※このメールは自動送信です。返信はできませんので予めご了承ください。<br>
        </p>
    </body>
</html>
