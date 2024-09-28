<x-dialog wire:model="showModal">
  <x-dialog.open>
    <button class="inline-clock relative ms-4 items-center text-green-700" type="button">
      <i class="fa-solid fa-list"></i>
      <span class="-ms-2 rounded-sm px-2 py-1 text-right">詳細</span>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <div class="text-2xl font-bold text-slate-900">
      <div>{{ $action . ' ' . $createAt }}</div>
      <div>{{ $userName }}</div>
    </div>
    @foreach ($items as $item)
      <div class="grid grid-cols-2 rounded-md border-b border-gray-300 bg-white p-4 shadow-sm">
        <div class="font-medium text-gray-800">
          {{ $item->name }}
        </div>
        <div class="text-right text-gray-600">
          {{ $item->quantity }}個
        </div>
      </div>
    @endforeach
  </x-dialog.panel>
</x-dialog>
