<div class="bg-gray-100">
  <header class=" bg-teal-800 text-gray-200 shadow-md fixed top-0 left-0 right-0 z-20">
    <div class="container mx-auto p-4 flex flex-col md:flex-row items-center justify-between">
      <h1 class="text-2xl font-bold md:block hidden">○○倉庫</h1>
      <input
        class="w-full md:max-w-md p-3 border bg-gray-200 text-black rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        type="text" wire:model.change="search" placeholder="検索...">
      <div class="flex flex-row md:items-center  md:space-y-0 md:space-x-3">
        <a class="text-xl font-bold text-indigo-100 py-2 px-4 rounded flex items-center"
          href="{{ route('productBoard') }}">
          <i class="fa-solid fa-boxes-stacked me-2 text-2xl"></i>
          <span class="underline">在庫一覧</span>
        </a>
      </div>
    </div>
  </header>

  <div class="container mx-auto p-4 md:mt-24 mt-40">
    <div class="flex justify-end space-x-3">
      <a class="relative flex items-center text-xl bg-rose-600 px-3 text-white rounded-md py-2"
        href="{{ route('stockManager.delete') }}">
        <i class="fa-solid fa-trash text-xl me-2"></i>
        削除モード
      </a>
      <a class="relative flex items-center text-xl bg-indigo-600 px-3 text-white rounded-md py-2"
        href="{{ route('stockManager.add') }}">
        <i class="fa-solid fa-plus text-2xl me-1"></i>
        追加モード
      </a>
    </div>

    <h1 class="text-2xl font-bold mb-4">在庫</h1>
    <div class="space-y-2">
      @foreach ($this->productList as $category => $products)
        <div
          class="relative w-full mx-auto overflow-hidden text-sm font-normal bg-gray-200 border border-gray-200 divide-y divide-gray-200 rounded-md"
          x-data="{
              activeAccordion: '',
              setActiveAccordion(id) {
                  this.activeAccordion = (this.activeAccordion == id) ? '' : id
              }
          }">
          <div class="cursor-pointer group" x-data="{ id: $id('{{ $category }}') }">
            <button class="flex items-center justify-between w-full p-4 text-left select-none group-hover:underline"
              @click="setActiveAccordion(id)">
              <span class="text-xl font-bold">{{ $category }}</span>
              <svg class="w-4 h-4 duration-200 ease-out" :class="{ 'rotate-180': activeAccordion == id }"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 p-1" x-show="activeAccordion==id"
              x-collapse x-cloak>
              @foreach ($products as $product)
                <div class="bg-white p-4 rounded-lg shadow-md relative">
                  <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                  <p class="text-gray-700 mb-2">型番: {{ $product->model_number }}</p>
                  <p class="text-lg font-medium text-right">
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
