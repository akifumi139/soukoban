<div class="flex min-h-screen flex-col bg-orange-100" x-data="cartComponent()">
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
      @foreach ($this->productList as $category => $products)
        <div
          class="relative mx-auto w-full divide-y divide-gray-200 overflow-hidden rounded-md border border-gray-200 bg-gray-200 text-sm font-normal"
          x-data="{
              activeAccordion: '',
              setActiveAccordion(id) {
                  this.activeAccordion = (this.activeAccordion == id) ? '' : id
              }
          }">
          <div class="group cursor-pointer" x-data="{ id: $id('{{ $category }}') }">
            <button class="flex w-full select-none items-center justify-between p-4 text-left group-hover:underline"
              @click="setActiveAccordion(id)">
              <span class="text-xl font-bold">{{ $category }}</span>
              <svg class="h-4 w-4 duration-200 ease-out" :class="{ 'rotate-180': activeAccordion == id }"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            <div class="grid grid-cols-1 gap-4 p-1 md:grid-cols-2 lg:grid-cols-3" x-show="activeAccordion==id"
              x-collapse x-cloak>
              @foreach ($products as $product)
                <div class="relative rounded-lg bg-white p-4 shadow-md">
                  <div class="absolute right-0 top-0">
                    @include('livewire.room-manager.product.edit')
                  </div>
                  <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                  <p class="mb-2 text-gray-700">型番: {{ $product->model_number }}</p>
                  <p class="text-right text-lg font-medium">
                    在庫数:
                    <span class="text-xl font-semibold">{{ number_format($product->stock?->count) }}</span>
                  </p>
                </div>
              @endforeach
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>
