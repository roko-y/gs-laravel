{{-- resources/views/chat.blade.php --}}
@extends('layouts.app') {{-- 必要に応じてレイアウトを指定 --}}

@section('content')
<div class="container">
    <div class="chat-box">
        <h3>チャットフロー</h3>

        <!-- {{-- デバッグコード: メッセージデータの確認 --}}
        @if(isset($message))
            <h1>デバッグ: メッセージ内容</h1>
            <p>{{ $message->message_text }}</p>
        @else
            <h1>エラー: $messageが設定されていません。</h1>
        @endif -->

        {{-- 最初の質問を表示 --}}
        <div class="message">
            <p>{{ $message->message_text }}</p>
        </div>

        {{-- 選択肢を表示 --}}
        <form action="{{ route('chat.next') }}" method="POST">
            @csrf
            @foreach ($message->options as $option)
                <div class="option">
                    <input type="radio" id="option{{ $option->id }}" name="next_message_id" value="{{ $option->next_message_id }}">
                    <label for="option{{ $option->id }}">{{ $option->option_text }}</label>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">送信</button>
        </form>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat Page</title>
</head>
<body>
    <h1>Welcome to the Chat Page!</h1>
    <p>This is where the chat functionality will go.</p>
    <a href="{{ route('dashboard') }}">Back to Dashboard</a>
</body>
</html>

<!-- <!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>Chat</title>
</head>
<body>
    <h1>初回のメッセージ</h1>
    <p>{{ $message->message_text }}</p>

    <h2>選択肢を表示</h2>
    <form action="{{ route('chat.next') }}" method="POST">
        @csrf
        @foreach ($message->options as $option)
            <div>
                <input type="radio" id="option{{ $option->id }}" name="next_message_id" value="{{ $option->next_message_id }}">
                <label for="option{{ $option->id }}">{{ $option->option_text }}</label>
            </div>
        @endforeach
        <button type="submit">送信</button>
    </form>
</body>
</html> -->
