<div class="h-full bg-orange-100">
  <div class="container mx-auto p-4 pt-10">
    <div class="flex">
      <a class="relative flex items-center rounded-md bg-teal-200 px-1 text-lg text-gray-800"
        href="{{ route('roomManager') }}">
        <i class="fa-solid fa-layer-group text-base"></i>
        <span class="ms-1">在庫一覧に戻る</span>
      </a>
    </div>

    <div class="mt-2 space-y-2">
      @foreach ($categories as $category)
        <div class="relative rounded-lg bg-white px-4 py-2 shadow-md">
          <div class="absolute right-0 top-0">
            @include('livewire.room-manager.category.edit')
          </div>
          <h2 class="text-xl font-semibold">{{ $category->label }}</h2>
          <p class="mb-2 ms-2 text-gray-700">種類: {{ $category->products->count() }}</p>
        </div>
      @endforeach
    </div>
  </div>
</div>
