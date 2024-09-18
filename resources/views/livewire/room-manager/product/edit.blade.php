<x-dialog>
  <x-dialog.open>
    <button
      class="bg-green-800 text-white text-sm px-2 rounded-bl border hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition ease-in-out duration-150"
      wire:click="setProduct({{ $product->id }})">
      <i class="fa-solid fa-edit text-white text-lg"></i>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <h2 class="text-2xl font-semibold text-slate-900 mb-4">修正</h2>
    <form wire:submit="update()">
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
        <label class="block text-gray-700 text-sm font-medium mb-2" for="category">カテゴリー</label>
        <select class="w-full p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="category" name="category" wire:model="form.category">
          <option value="">選択してください</option>
          @foreach ($categories as $category)
            <option value="{{ $category->label }}">
              {{ $category->label }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="flex justify-center">
        <button
          class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 md:text-xl focus:ring-blue-500"
          type="submit">
          修正する
        </button>
      </div>
    </form>
  </x-dialog.panel>
</x-dialog>
