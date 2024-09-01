<x-dialog wire:model="showAddModal">
  <x-dialog.open>
    <button class="p-4 h-24 rounded-l-full bg-green-300 shadow-lg items-center relative text-xl font-bold">
      <i class="fa-solid fa-cart-plus text-3xl"></i>
      <div>新規追加</div>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <h2 class="text-2xl font-semibold text-slate-900 mb-4">資材の追加</h2>
    <form wire:submit="addCart">
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
      <div class="relative mb-4" x-data="{ show: false }">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="modelNumber">カテゴリー</label>
        <input class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          type="text" wire:model="form.category" @focus="show = true" @blur="setTimeout(() => show = false, 100)"
          required />
        <div class="absolute shadow bg-white overflow-y-auto mt-1 max-h-40 scroll w-full left-0 rounded max-h-select"
          x-show="show" x-transition>
          <div class="flex flex-col w-full">
            @foreach ($this->filleterCategories as $index => $category)
              <div
                class="flex w-full items-center p-2 pl-2 border-transparent border-l-2 relative hover:border-teal-100"
                wire:click="selectCategory('{{ $category->label }}')">
                <div class="w-full items-center flex">
                  {{ $category->label }}
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-medium mb-2" for="count">個数</label>
        <input class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="count" name="count" type="number" placeholder="個数" min="1" wire:model="form.count" required>
      </div>
      <div class="flex justify-center">
        <button
          class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 md:text-xl focus:ring-blue-500"
          type="submit">
          登録する
        </button>
      </div>
    </form>
  </x-dialog.panel>
</x-dialog>
