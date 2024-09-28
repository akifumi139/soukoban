<x-dialog>
  <x-dialog.open>
    <button
      class="rounded-bl border bg-green-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
      wire:click="setProduct({{ $item->id }})">
      <i class="fa-solid fa-edit text-lg text-white"></i>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <h2 class="mb-4 text-2xl font-semibold text-slate-900">修正</h2>
    <form wire:submit="update()">
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

      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="category">カテゴリー</label>
        <select class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
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
          class="rounded-lg bg-blue-500 px-4 py-2 text-white shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 md:text-xl"
          type="submit">
          修正する
        </button>
      </div>
    </form>
  </x-dialog.panel>
</x-dialog>
