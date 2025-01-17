<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // 認証後に表示するダッシュボード
    })->name('dashboard');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// チャット機能のルート設定
use App\Http\Controllers\ChatController;

// 最初の質問を表示
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');

// 次のメッセージを表示
Route::post('/chat/next', [ChatController::class, 'next'])->name('chat.next');

// セッション動作確認用ルート
Route::get('/session-test', function () {
    // セッションに値を保存
    session(['key' => 'value']);
    // セッションから値を取得して返す
    return session('key');
});

require __DIR__.'/auth.php';
