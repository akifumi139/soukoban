<div class="bg-gray-100">
  <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-20">
    <div class="container mx-auto p-4 flex flex-col md:flex-row items-center justify-between">
      <h1 class="text-2xl font-bold md:block hidden">○○倉庫</h1>
      <input
        class="w-full md:max-w-md p-3 border bg-gray-200 rounded-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
        type="text" wire:model.change="search" placeholder="検索...">
      <div class="flex flex-row md:items-center  md:space-y-0 md:space-x-3">
        <a class="text-xl font-bold text-sky-950 py-2 px-4 rounded flex items-center" href="{{ route('stockManager') }}">
          <i class="fa-solid fa-hammer me-2"></i>
          <span class="underline">管理モード</span>
        </a>
        <a class="text-xl font-bold text-teal-600 py-2 px-4 rounded flex items-center"
          href="{{ route('productHistory') }}">
          <i class="fa-solid fa-clock-rotate-left me-2"></i>
          <span class="underline">履歴</span>
        </a>
      </div>
      @include('livewire.stock-cart')
    </div>
  </header>

  <div class="container mx-auto p-4 md:mt-24 mt-40">
    <h1 class="text-2xl font-bold mb-4">在庫</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      @foreach ($this->productList as $product)
        <div class="bg-white p-4 rounded-lg shadow-md relative">
          <div class="absolute top-0 right-0">
            <button
              class="bg-gray-800 text-white text-sm px-2 rounded-bl border border-gray-700 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition ease-in-out duration-150"
              wire:click="subCart({{ $product->id }})">
              <i class="fa-solid fa-minus text-white text-lg"></i>
            </button>
            <button
              class=" bg-cyan-600 text-white text-sm px-2 rounded-bl border  hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition ease-in-out duration-150"
              wire:click="addCart({{ $product->id }})">
              <i class="fa-solid fa-plus text-white text-lg"></i>
            </button>
          </div>

          <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
          <p class="text-gray-700 mb-2">型番: {{ $product->model_number }}</p>
          <p class="text-lg font-medium text-right">
            在庫数:
            <span class="text-xl font-semibold">{{ number_format($product->stock->count) }}</span>
          </p>
          <p class="text-lg font-medium text-right">
            カート内個数:
            <span
              class="text-xl font-semibold">{{ number_format(array_key_exists($product->id, $cart) ? $cart[$product->id]['count'] : 0) }}</span>
          </p>
        </div>
      @endforeach
    </div>
  </div>
</div>
