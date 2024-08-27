<div class="bg-gray-100">
  <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-20">
    <div class="container mx-auto p-4 flex flex-col md:flex-row items-center justify-between">
      <h1 class="text-2xl font-bold md:block hidden">○○倉庫</h1>
      <input
        class="w-full md:max-w-md p-3 border bg-gray-200 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        type="text" wire:model.change="search" placeholder="履歴検索...(はりぼて)">
      <div class="flex flex-row md:items-center  md:space-y-0 md:space-x-3">
        <a class="text-xl font-bold text-indigo-600 py-2 px-4 rounded flex items-center"
          href="{{ route('productBoard') }}">
          <i class="fa-solid fa-boxes-stacked me-2 text-2xl"></i>
          <span class="underline">在庫一覧</span>
        </a>
      </div>
    </div>
  </header>
  <main class="container mx-auto p-4 md:mt-24 mt-36  md:max-w-[800px]">
    <div class="overflow-x-auto mx-auto">
      <h2 class="text-xl font-bold mb-2 ms-2">履歴</h2>
      <div class="bg-white border border-gray-200">
        @foreach ($histories as $history)
          <div class="grid grid-cols-2 md:grid-cols-6 border-b">
            <div class="px-3 py-2 md:col-span-4">
              <div @class([
                  'border-2 rounded-full text-center w-24',
                  'border-orange-400 bg-orange-100' => $history->action == '持ち出し',
                  'border-rose-400 bg-rose-100' => $history->action == '削除',
              ])>
                {{ $history->action }}
              </div>
              <div class="mx-2 my-2 break-words">
                {{ $history->details->pluck('product.name')->implode(',') }}
              </div>
              @include('livewire.history-detail', [
                  'createAt' => $history->created_at->isoFormat('YYYY/MM/DD(ddd)'),
                  'userName' => $history->user->name,
                  'action' => $history->action,
                  'details' => $history->details,
              ])
            </div>
            <div class="p-3 text-right md:col-span-2 items-center my-auto flex-col">
              <div class="md:text-lg">{{ $history->user->name }}</div>
              <div>
                <div>{{ $history->created_at->isoFormat('YYYY/MM/DD(ddd)') }}</div>
                <div class="-mt-1 me-1">{{ $history->created_at->isoFormat('HH:mm') }}</div>
              </div>
            </div>
          </div>
        @endforeach

      </div>
    </div>

    <div class="mt-4">
      {{ $histories->links('livewire.components.tailwind') }}
    </div>
  </main>
</div>
