<div class="flex min-h-screen flex-col bg-blue-100">
  <header class="fixed left-0 right-0 top-0 z-20 block bg-white text-gray-200 shadow-md">
    @include('components.layouts.profile')
    @include('components.layouts.history-search')
  </header>
  <main class="container mx-auto mt-36 p-4 md:mt-24 md:max-w-[800px]">
    <div class="mx-auto overflow-x-auto">
      <h2 class="mb-2 ms-2 text-xl font-bold">履歴</h2>
      <div class="border border-gray-200 bg-white">
        @foreach ($histories as $history)
          <div class="grid grid-cols-2 border-b md:grid-cols-6">
            <div class="px-3 py-2 md:col-span-4">
              <div @class([
                  'border-2 rounded-full text-center w-24',
                  'border-orange-400 bg-orange-100' => $history->action == '持ち出し',
                  'border-rose-400 bg-rose-100' => $history->action == '撤去',
                  'border-indigo-400 bg-indigo-100' => $history->action == '搬入',
              ])>
                {{ $history->action }}
              </div>
              <div class="mx-2 my-2 break-words">
                {{ $history->details->pluck('product.name')->implode(',') }}
              </div>
              @include('livewire.movement-history.show', [
                  'createAt' => $history->created_at->isoFormat('YYYY/MM/DD(ddd)'),
                  'userName' => $history->user->name,
                  'action' => $history->action,
                  'details' => $history->details,
              ])
            </div>
            <div class="my-auto flex-col items-center p-3 text-right md:col-span-2">
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
