<div class="flex min-h-screen flex-col bg-orange-100">
  <header class="fixed left-0 right-0 top-0 z-20 block bg-white text-gray-200 shadow-md">
    @include('components.layouts.profile')
    @include('components.layouts.room-search')
  </header>

  <div class="container mx-auto mt-40 p-4 md:mt-24">
    <div class="mb-2 flex justify-end space-x-2">
      <a class="relative flex items-center rounded-md bg-rose-600 px-3 py-2 text-xl text-white"
        href="{{ route('roomManager.delete') }}">
        <i class="fa-solid fa-trash me-2 text-xl"></i>
        削除モード
      </a>
      <a class="relative flex items-center rounded-md bg-indigo-600 px-3 py-2 text-xl text-white"
        href="{{ route('roomManager.add') }}">
        <i class="fa-solid fa-plus me-1 text-2xl"></i>
        追加モード
      </a>
    </div>
    <div class="flex">
      <a class="relative flex items-center rounded-md bg-teal-200 px-1 text-lg text-gray-800"
        href="{{ route('roomManager.category') }}">
        <i class="fa-solid fa-layer-group text-base"></i>
        <span class="ms-1">カテゴリーの編集</span>
      </a>
    </div>

    <div class="mt-1 space-y-2">
      <div class="grid grid-cols-1 gap-4 p-1 md:grid-cols-2 lg:grid-cols-3">
        @foreach ($this->items as $item)
          <div class="relative rounded-lg bg-white p-4 shadow-md">
            <div class="absolute right-0 top-0">
              @include('livewire.room-manager.product.edit')
            </div>
            <h2 class="text-xl font-semibold">{{ $item->name }}</h2>
            <p class="mb-2 text-gray-700">型番: {{ $item->model_number }}</p>
            <p class="text-right text-lg font-medium">
              在庫数:
              <span class="text-xl font-semibold">{{ $item->quantity }}</span>
            </p>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
