<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>パスワード変更</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/alpine.js'])
</head>

<body class="bg-gray-100">

  <div class="mx-auto mt-10 max-w-md rounded-lg bg-white p-6 shadow-md">
    <a class="flex w-16 items-center justify-center rounded border text-lg hover:bg-gray-300"
      href="{{ route('settings.index') }}">
      <i class="fa-solid fa-caret-left text-3xl"></i><span class="ms-1">戻る</span>
    </a>

    <h1 class="my-2 text-center text-xl font-semibold">パスワード変更</h1>
    <form method="POST" action="{{ route('settings.password.update') }}">
      @csrf

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700" for="current-password">現在のパスワード</label>
        <input class="mt-1 block w-full rounded-md border border-gray-300 p-2" id="current-password"
          name="current_password" type="password" required>
        @error('current_password')
          <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700" for="new-password">新しいパスワード</label>
        <input class="mt-1 block w-full rounded-md border border-gray-300 p-2" id="new-password" name="new_password"
          type="password" required>
        @error('new_password')
          <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700" for="new-password-confirmation">新しいパスワード確認</label>
        <input class="mt-1 block w-full rounded-md border border-gray-300 p-2" id="new-password-confirmation"
          name="new_password_confirmation" type="password" required>
      </div>

      <button class="w-full rounded-md bg-blue-500 py-2 font-bold text-white hover:bg-blue-600"
        type="submit">更新</button>

  </div>

</body>

</html>
