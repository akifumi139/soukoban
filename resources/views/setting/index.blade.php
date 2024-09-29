<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>設定画面</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/alpine.js'])
</head>

<body class="bg-gray-100">
  <div class="mx-auto mt-10 max-w-md rounded-lg bg-white p-6 pt-4 shadow-md">
    <a class="flex w-32 items-center justify-center rounded border text-lg hover:bg-gray-300"
      href="{{ route('myStuff') }}">
      <i class="fa-solid fa-caret-left text-3xl"></i><span class="ms-1">アプリに戻る</span></a>
    <h1 class="mb-6 text-center text-2xl font-bold">設 定</h1>
    @if (session('message'))
      <div class="my-2 rounded border border-green-200 bg-green-100 p-2 text-green-700">
        {{ session('message') }}
      </div>
    @endif
    <div class="space-y-5">
      <div>
        <h2 class="mb-2 text-xl font-semibold">パスワード変更</h2>
        <a class="block w-full rounded-md bg-blue-500 py-2 text-center text-white shadow-lg transition duration-300 hover:bg-blue-600"
          href="{{ route('settings.password.edit') }}">変更</a>
      </div>
      <div>
        <h2 class="mb-2 text-xl font-semibold">アカウント管理</h2>
        <a class="block w-full rounded-md bg-green-500 py-2 text-center text-white shadow-lg transition duration-300 hover:bg-green-600"
          href="">アカウント一覧へ</a>
      </div>
    </div>
  </div>
</body>

</html>
