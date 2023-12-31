{{$user->name}}様

障害報告内容の確認

以下の内容で障害報告を受け付けました。

━━━━━━□■□　お問い合わせ内容　□■□━━━━━━

機能：{{config('const.trouble.function')[$input['function']]}}

発生日時：{{\Carbon\Carbon::parse($input['occurred_at'])->format('Y年m月d日 H時i分')}}

現象：
{{$input['phenomenon']}}

再現手順：
{{$input['reproduction_steps']}}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━

※このメールは自動送信です。返信はできませんので予めご了承ください。
もし心当たりのない方は恐れ入りますが以下のアドレスにご連絡ください。
連絡先：support@example.com
