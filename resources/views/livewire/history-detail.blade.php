<x-dialog wire:model="showModal">
  <x-dialog.open>
    <button class="relative items-center inline-clock text-green-700 ms-4" type="button">
      <i class="fa-solid fa-list"></i>
      <span class="text-right -ms-2   py-1 px-2 rounded-sm">詳細</span>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <div class="text-2xl font-bold text-slate-900">
      <div>{{ $action . ' ' . $createAt }}</div>
      <div>{{ $userName }}</div>
    </div>
    @foreach ($details as $log)
      <div class="grid grid-cols-2 border-b border-gray-300 bg-white p-4 rounded-md shadow-sm">
        <div class="text-gray-800 font-medium">
          {{ $log->product->name }}
        </div>
        <div class="text-gray-600 text-right">
          {{ $log->count }}個
        </div>
      </div>
    @endforeach
  </x-dialog.panel>
</x-dialog>
