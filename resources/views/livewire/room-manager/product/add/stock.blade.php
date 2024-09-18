<x-dialog wire:model="showAddCountModal">
  <x-dialog.open>
    <button class="relative h-24 items-center rounded-r-full bg-indigo-300 p-4 text-xl font-bold shadow-lg">
      <i class="fa-solid fa-cart-plus text-3xl"></i>
      <div>既存の追加</div>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <h2 class="mb-4 text-2xl font-semibold text-slate-900">追加</h2>
    <form wire:submit="addCountProduct">
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700">選択肢</label>
        <select class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          wire:model="selectedProduct">
          <option value="" disabled>選択してください</option>
          @foreach ($stocks as $stock)
            <option value="{{ $stock->id }}">{{ $stock->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="count">追加する個数</label>
        <input class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="count" name="count" type="number" placeholder="個数" min="1" wire:model="form.count" required>
      </div>
      <div class="flex justify-center">
        <button
          class="rounded-lg bg-blue-500 px-4 py-2 text-white shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 md:text-xl"
          type="submit">
          追加する
        </button>
      </div>
    </form>
  </x-dialog.panel>
</x-dialog>
