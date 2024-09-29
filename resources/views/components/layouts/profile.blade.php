<div class="flex justify-between">
  <a class="flex h-14 w-14 flex-col items-center justify-center rounded-br-lg bg-stone-800"
    href="{{ route('settings.index') }}">
    <i class="fa-solid fa-gear text-xl"></i>
    <div class="text-xs">設定</div>
  </a>

  <form class="flex h-14 w-14 flex-col items-center justify-center rounded-bl-lg bg-stone-800"
    action="{{ route('logout') }}" method="POST">
    <button type="submit">
      <i class="fa-solid fa-arrow-right-from-bracket text-xl"></i>
      <div class="text-xs">ログアウト</div>
    </button>
  </form>
</div>
