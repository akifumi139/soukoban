<div class="container mx-auto flex flex-col items-center justify-center p-2 md:flex-row">
  <input
    class="w-full rounded-full border bg-gray-200 p-2 text-black shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 md:max-w-md"
    type="text" wire:model.change="search" placeholder="検索...">
  <a class="ms-5 block px-3 py-2 text-2xl font-bold text-teal-600" href="{{ route('stockroom') }}">
    <i class="fas fa-boxes-stacked me-1"></i>戻る
  </a>
</div>
