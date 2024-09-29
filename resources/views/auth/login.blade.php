<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>在庫管理</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen items-center justify-center bg-gray-100">
  <div class="flex w-full max-w-screen-lg rounded-lg bg-white shadow-lg">
    <div class="w-full p-6 md:w-1/3">
      <h2 class="mb-6 text-2xl font-bold text-gray-800">在庫管理システム</h2>
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label class="mb-2 block text-sm font-semibold text-gray-700" for="login_id">ログインID</label>
          <input
            class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            id="login_id" name="login_id" type="text" value="soukoban" required>
        </div>
        <div class="mb-6">
          <label class="mb-2 block text-sm font-semibold text-gray-700" for="password">パスワード</label>
          <input
            class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
            id="password" name="password" type="password" required>
        </div>
        @if ($errors->has('error'))
          <div class="mb-4">
            <div class="relative rounded border border-red-400 bg-red-100 px-3 py-2 text-red-700" role="alert">
              {{ $errors->first('error') }}
            </div>
          </div>
        @endif
        <button
          class="w-full rounded-lg bg-blue-500 py-2 text-white hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
          type="submit">
          ログイン
        </button>
      </form>
    </div>
    <div class="hidden w-2/3 bg-blue-100 p-6 md:block">
      <div class="mb-4 text-2xl font-bold">機能一覧</div>
      <ul class="list-inside list-disc space-y-2 text-lg">
        <li>在庫一覧と簡易検索</li>
        <li>在庫管理（追加、編集、削除）</li>
        <li>在庫持ち出し登録</li>
        <li>持ち出し在庫の返却</li>
        <li>履歴管理（追加、持ち出し、返却）</li>
      </ul>
    </div>
  </div>

</body>

</html>
