<x-dialog wire:model="showAddModal">
  <x-dialog.open>
    <button class="relative flex items-center text-xl bg-blue-600 px-3 text-white rounded-md py-2" type="button">
      <i class="fa-solid fa-plus text-2xl me-1"></i>
      追加する
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <h2 class="text-2xl font-semibold text-slate-900 mb-4">資材の追加</h2>
    <form wire:submit="add">
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="name">名前</label>
        <input class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="name" name="name" type="text" placeholder="資材の名前" wire:model="form.name" required>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="modelNumber">型番</label>
        <input class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="modelNumber" name="modelNumber" type="text" wire:model="form.modelNumber" placeholder="資材の型番" required>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="count">個数</label>
        <input class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="count" name="count" type="number" placeholder="個数" min="1" wire:model="form.count" required>
      </div>
      <div class="flex justify-center">
        <button
          class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500"
          type="submit">
          登録する
        </button>
      </div>
    </form>
  </x-dialog.panel>
</x-dialog>
