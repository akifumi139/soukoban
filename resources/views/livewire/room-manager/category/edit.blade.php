<x-dialog wire:model="showEditModal">
  <x-dialog.open>
    <button
      class="rounded-bl border bg-green-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
      wire:click="setCategory({{ $category->id }})">
      <i class="fa-solid fa-edit text-lg text-white"></i>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <h2 class="mb-4 text-2xl font-semibold text-slate-900">カテゴリー名</h2>
    <form wire:submit="update()">
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="label">ラベル名</label>
        <input class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="label" name="label" type="text" placeholder="名称" wire:model="form.label" required>
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
