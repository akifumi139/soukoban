<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>アカウント一覧</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/alpine.js'])

</head>

<body class="bg-gray-100">
  <div class="mx-auto mt-10 max-w-lg rounded-lg bg-white pt-4 shadow-md">
    <a class="ms-4 flex w-16 items-center justify-center rounded border text-lg hover:bg-gray-300"
      href="{{ route('settings.index') }}">
      <i class="fa-solid fa-caret-left text-3xl"></i><span class="ms-1">戻る</span>
    </a>
    <h1 class="mb-6 text-center text-xl font-bold">アカウント一覧</h1>
    @if (session('message'))
      <div class="my-2 rounded border border-green-200 bg-green-100 p-2 text-green-700">
        {{ session('message') }}
      </div>
    @endif
    <div class="my-2 text-right">
      <a class="me-2 rounded-lg bg-blue-600 px-4 py-2 font-semibold text-white shadow transition duration-200 hover:bg-blue-700"
        href="{{ route('settings.accounts.create') }}">
        新規作成
      </a>
    </div>
    <table class="min-w-full overflow-hidden rounded-lg border border-gray-300 bg-white">
      <thead class="bg-gray-100">
        <tr>
          <th class="border-b border-gray-300 px-4 py-3 text-left font-semibold text-gray-600">ログインID</th>
          <th class="border-b border-gray-300 px-4 py-3 text-left font-semibold text-gray-600">ユーザー名</th>
          <th class="border-b border-gray-300 px-4 py-3 text-left font-semibold text-gray-600">権限</th>
          <th class="border-b border-gray-300 px-4 py-3 text-left font-semibold text-gray-600"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($accounts as $account)
          <tr class="transition duration-200 hover:bg-gray-200">
            <td class="border-b border-gray-300 px-4 py-3 text-gray-800">{{ $account->login_id }}</td>
            <td class="border-b border-gray-300 px-4 py-3 text-gray-800">{{ $account->name }}</td>
            <td class="border-b border-gray-300 px-4 py-3 text-gray-800">{{ $account->role }}</td>
            <td class="border-b border-gray-300 px-4 py-3 text-right text-gray-800">
              <a class="rounded-lg bg-green-500 px-4 py-2 font-semibold text-white shadow transition duration-200 hover:bg-yellow-500"
                href="{{ route('settings.accounts.edit', $account->id) }}">
                編集
              </a>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
</body>

</html>
