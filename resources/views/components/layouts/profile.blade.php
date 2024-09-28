<div class="flex justify-between">
  <div class="rounded-br-lg bg-indigo-200 px-3 py-2 text-xl text-gray-800">
    {{ Auth::user()->name }}
  </div>
  <form class="inline" action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="rounded bg-gray-500 px-2 py-1 text-white hover:bg-red-700" type="submit">
      ログアウト
    </button>
  </form>
</div>
