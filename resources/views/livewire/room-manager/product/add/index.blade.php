<div class="h-full bg-orange-100">
  <div class="container mx-auto p-4 pt-10">
    <div class="flex justify-between space-x-2">
      <a class="relative flex items-center rounded-md px-3 py-1 text-xl font-bold text-teal-600"
        href="{{ route('roomManager') }}">
        <i class="fa-solid fa-chevron-left me-2 text-xl"></i>
        戻る
      </a>
      <button class="relative flex items-center rounded-md bg-indigo-600 px-3 py-2 text-xl text-white" type="button"
        wire:click="add">
        <i class="fa-solid fa-cart-flatbed me-2 text-xl"></i>
        搬入する
      </button>
    </div>

    <h1 class="mb-4 text-2xl font-bold">追加する製品</h1>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
      <div class="flex justify-center">
        @include('livewire.room-manager.product.add.product')
        @include('livewire.room-manager.product.add.stock')
      </div>
      @foreach ($this->cart as $key => $product)
        <div class="relative rounded-lg bg-white p-4 shadow-md">
          <div class="absolute right-0 top-0">
            <button
              class="rounded-bl border bg-red-600 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
              wire:click="removeCart({{ $key }})">
              <i class="fa-solid fa-xmark text-lg"></i>
            </button>
          </div>
          <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
          <p class="mb-2 text-gray-700">型番: {{ $product->modelNumber }}</p>
          <p class="text-right text-lg font-medium">
            個数:
            <span class="text-xl font-semibold">{{ $product->count }}</span>
          </p>
        </div>
      @endforeach
    </div>
  </div>
</div>
