<div class="container mx-auto flex flex-col items-center justify-center p-2 pb-0 md:-mt-10 md:flex-row">
  <input
    class="w-full rounded-full border bg-gray-200 p-2 text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 md:max-w-md"
    type="text" wire:model.change="search" placeholder="検索...">
  <div class="ms-auto mt-2 flex items-center gap-2 md:ms-5 md:mt-0">
    <a class="block px-3 py-2 text-xl font-bold text-gray-600" href="{{ route('history') }}">
      <i class="fa-solid fa-clock-rotate-left me-1"></i>履歴
    </a>
    @if (Auth::user()->role == '管理者')
      <a class="inline-block items-center rounded bg-green-600 px-2 py-1 text-xl font-bold text-white"
        href="{{ route('roomManager') }}">
        <i class="fa-solid fa-bars-progress"></i>
        倉庫管理
      </a>
    @endif
  </div>
</div>
