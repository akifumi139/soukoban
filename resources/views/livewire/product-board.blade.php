<div class="bg-gray-100">
  <header class="fixed left-0 right-0 top-0 z-20 bg-white shadow-md">
    <div class="container mx-auto flex flex-col items-center justify-between p-4 md:flex-row">
      <h1 class="hidden text-2xl font-bold md:block">○○倉庫</h1>
      <input
        class="w-full rounded-full border bg-gray-200 p-3 shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500 md:max-w-md"
        type="text" wire:model.change="search" placeholder="検索...">
      <div class="flex flex-row md:items-center md:space-x-3 md:space-y-0">
        <a class="flex items-center rounded px-4 py-2 text-xl font-bold text-sky-950" href="{{ route('stockManager') }}">
          <i class="fa-solid fa-hammer me-2"></i>
          <span class="underline">管理</span>
        </a>
        <a class="flex items-center rounded px-4 py-2 text-xl font-bold text-teal-600"
          href="{{ route('productHistory') }}">
          <i class="fa-solid fa-clock-rotate-left me-2"></i>
          <span class="underline">履歴</span>
        </a>
      </div>
      @include('livewire.stock-cart')
    </div>
  </header>

  <div class="container mx-auto mt-40 p-4 md:mt-24">
    <h1 class="mb-4 text-2xl font-bold">在庫</h1>
    @if (session()->has('message'))
      <div class="mt-4 rounded border border-green-200 bg-green-100 p-4 text-green-700">
        {{ session('message') }}
      </div>
    @endif
    <div class="space-y-2">
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
                    <button
                      class="rounded-bl border border-gray-700 bg-gray-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                      wire:click="subCart({{ $product->id }})">
                      <i class="fa-solid fa-minus text-lg text-white"></i>
                    </button>
                    <button
                      class="rounded-bl border bg-cyan-600 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                      wire:click="addCart({{ $product->id }})">
                      <i class="fa-solid fa-plus text-lg text-white"></i>
                    </button>
                  </div>
                  <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                  <p class="mb-2 text-gray-700">型番　: {{ $product->model_number }}</p>
                  <p class="text-right text-lg font-medium">
                    在庫数:
                    <span class="text-xl font-semibold">{{ number_format($product->stock->count) }}</span>
                  </p>
                  <p class="text-right text-lg font-medium">
                    カート内個数:
                    <span
                      class="text-xl font-semibold">{{ number_format(array_key_exists($product->id, $cart) ? $cart[$product->id]['count'] : 0) }}</span>
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
