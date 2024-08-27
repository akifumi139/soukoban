<x-dialog wire:model="showAddCountModal">
  <x-dialog.open>
    <button class="p-4 h-24 rounded-r-full bg-indigo-300 shadow-lg items-center relative text-xl font-bold">
      <i class="fa-solid fa-cart-plus text-3xl"></i>
      <div>既存の追加</div>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <h2 class="text-2xl font-semibold text-slate-900 mb-4">追加</h2>
    <form wire:submit="addCountProduct">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2">選択肢</label>
        <select class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          wire:model="selectedProduct">
          <option value="" disabled>選択してください</option>
          @foreach ($stocks as $stock)
            <option value="{{ $stock->id }}">{{ $stock->name }}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="count">追加する個数</label>
        <input class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="count" name="count" type="number" placeholder="個数" min="1" wire:model="form.count" required>
      </div>
      <div class="flex justify-center">
        <button
          class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 md:text-xl focus:ring-blue-500"
          type="submit">
          追加する
        </button>
      </div>
    </form>
  </x-dialog.panel>
</x-dialog>
