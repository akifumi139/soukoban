<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>在庫管理</title>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
  <div class="flex w-full max-w-screen-lg bg-white rounded-lg shadow-lg">
    <div class="w-full md:w-1/3 p-6">
      <h2 class="text-2xl font-bold mb-6 text-gray-800">在庫管理システム</h2>
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-semibold mb-2" for="name">ログインID</label>
          <input
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            id="name" name="name" type="text" required>
        </div>
        <div class="mb-6">
          <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">パスワード</label>
          <input
            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
            id="password" name="password" type="password" required>
        </div>
        @if ($errors->has('error'))
          <div class="mb-4">
            <div class="bg-red-100 border border-red-400 text-red-700 px-3 py-2 rounded relative" role="alert">
              {{ $errors->first('error') }}
            </div>
          </div>
        @endif
        <button
          class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
          type="submit">
          ログイン
        </button>
      </form>
    </div>
    <div class="hidden md:block w-2/3 bg-blue-100 p-6">
      <div class="text-2xl font-bold mb-4">機能一覧</div>
      <ul class="list-disc list-inside space-y-2 text-lg">
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
