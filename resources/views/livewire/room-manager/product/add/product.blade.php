<x-dialog wire:model="showAddModal">
  <x-dialog.open>
    <button class="relative h-24 items-center rounded-l-full bg-green-300 p-4 text-xl font-bold shadow-lg">
      <i class="fa-solid fa-cart-plus text-3xl"></i>
      <div>新規追加</div>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <h2 class="mb-4 text-2xl font-semibold text-slate-900">資材の追加</h2>
    <form wire:submit="addCart">
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="name">名前</label>
        <input class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="name" name="name" type="text" placeholder="資材の名前" wire:model="form.name" required>
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="modelNumber">型番</label>
        <input class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="modelNumber" name="modelNumber" type="text" wire:model="form.modelNumber" placeholder="資材の型番" required>
      </div>
      <div class="relative mb-4" x-data="{ show: false }">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="modelNumber">カテゴリー</label>
        <input class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          type="text" wire:model="form.category" @focus="show = true" @blur="setTimeout(() => show = false, 100)"
          required />
        <div class="scroll max-h-select absolute left-0 mt-1 max-h-40 w-full overflow-y-auto rounded bg-white shadow"
          x-show="show" x-transition>
          <div class="flex w-full flex-col">
            @foreach ($this->filleterCategories as $index => $category)
              <div
                class="relative flex w-full items-center border-l-2 border-transparent p-2 pl-2 hover:border-teal-100"
                wire:click="selectCategory('{{ $category->label }}')">
                <div class="flex w-full items-center">
                  {{ $category->label }}
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="count">個数</label>
        <input class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="count" name="count" type="number" placeholder="個数" min="1" wire:model="form.count" required>
      </div>
      <div class="flex justify-center">
        <button
          class="rounded-lg bg-blue-500 px-4 py-2 text-white shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 md:text-xl"
          type="submit">
          登録する
        </button>
      </div>
    </form>
  </x-dialog.panel>
</x-dialog>
