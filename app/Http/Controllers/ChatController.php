<?php

namespace App\Http\Controllers; 

use App\Http\Controllers\Controller; 

use Illuminate\Http\Request; // HTTPリクエストを処理するためのクラス
use App\Models\Message; // 'messages'テーブルを扱うモデル
use App\Models\Option;  // 'options'テーブルを扱うモデル


class ChatController extends Controller
{
        /**
     * 初期チャット画面を表示するメソッド
     * - 最初の質問を取得してビューに渡す
     */
    public function index()
    {
        // 'messages'テーブルからorderが1の最初の質問を取得
        $firstMessage = Message::where('order', 1)->first();

        // 'chat.index'ビューに質問データを渡して表示
        // return view('chat.index', ['message' => $firstMessage]);
        return view('chat', ['message' => $firstMessage]);
    }

    /**
     * ユーザーの選択に基づき、次の質問を表示するメソッド
     * - フォームから送信された選択肢のIDを基に次の質問を取得
     */
    public function next(Request $request)
    {
        // フォームから送信された次のメッセージIDを取得
        $nextMessageId = $request->input('next_message_id');

        // 'messages'テーブルから指定されたIDの質問を取得
        $nextMessage = Message::find($nextMessageId);

        // 次の質問データを'chat.index'ビューに渡して表示
        // return view('chat.index', ['message' => $nextMessage]);
        return view('chat', ['message' => $nextMessage]);
    }
}
