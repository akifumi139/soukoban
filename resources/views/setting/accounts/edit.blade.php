<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アカウント作成</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/alpine.js'])
</head>

<body class="bg-gray-100">
  <div class="mx-auto mt-10 max-w-md rounded-lg bg-white p-4 shadow-md">
    <a class="ms-1 flex w-16 items-center justify-center rounded border text-lg hover:bg-gray-300"
      href="{{ route('settings.accounts.index') }}">
      <i class="fa-solid fa-caret-left text-3xl"></i><span class="ms-1">戻る</span>
    </a>
    <h1 class="mb-6 text-center text-xl font-bold">アカウント編集</h1>

    @if ($errors->any())
      <div class="my-2 rounded border border-red-200 bg-red-100 p-2 text-red-700">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    @if (session('message'))
      <div class="my-2 rounded border border-green-200 bg-green-100 p-2 text-green-700">
        {{ session('message') }}
      </div>
    @endif

    <form class="flex flex-col gap-4" action="{{ route('settings.accounts.update', ['account' => $account]) }}"
      method="POST">
      @csrf
      <div>
        <label class="mb-1 block text-gray-700" for="login_id">ログインID</label>
        <input class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
          id="login_id" name="login_id" type="text" value="{{ old('login_id', $account->login_id) }}" required
          {{ $account->id !== 1 ?: 'readonly' }}>
        @error('login_id')
          <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
      </div>
      <div>
        <label class="mb-1 block text-gray-700" for="name">ユーザー名</label>
        <input class="w-full rounded border border-gray-300 px-3 py-2 focus:border-blue-500 focus:outline-none"
          id="name" name="name" type="text" value="{{ old('name', $account->name) }}" required>
        @error('name')
          <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
      </div>
      <div>
        <span class="mb-1 block text-gray-700">権限</span>
        <div class="flex items-center">
          <label class="ms-4">
            <input name="role" type="radio" value="管理者"
              {{ old('role', $account->role) === '管理者' ? 'checked' : '' }} required>
            管理者
          </label>
          @if ($account->id !== 1)
            <label class="ms-4">
              <input name="role" type="radio" value="一般"
                {{ old('role', $account->role) === '一般' ? 'checked' : '' }} required>
              一般
            </label>
          @endif
        </div>
        @error('role')
          <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
      </div>
      <div>
        <label class="block text-sm font-medium text-gray-700" for="password">パスワード</label>
        <span class="ms-2 text-sm">※変更がない場合は、入力しないでください</span>
        <input class="mt-1 block w-full rounded-md border border-gray-300 p-2" id="password" name="password"
          type="password">
        @error('password')
          <span class="text-sm text-red-600">{{ $message }}</span>
        @enderror
      </div>

      <div class="mb-4">
        <label class="block text-sm font-medium text-gray-700" for="password-confirmation">パスワード確認</label>
        <span class="ms-2 text-sm">※変更がない場合は、入力しないでください</span>
        <input class="mt-1 block w-full rounded-md border border-gray-300 p-2" id="password-confirmation"
          name="password_confirmation" type="password">
      </div>
      <div>
        <button class="w-full rounded-md bg-orange-500 py-2 font-bold text-white hover:bg-orange-600" type="submit">
          更新
        </button>
      </div>
    </form>
  </div>
</body>

</html>
