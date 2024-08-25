<x-dialog wire:model="showModal">
  <x-dialog.open>
    <button class="relative flex items-center" type="button">
      <i class="fa-solid fa-cart-shopping text-4xl"></i>
      <span
        class="absolute -top-2 -right-2 w-5 h-5 text-xs text-white bg-red-500 rounded-full flex items-center justify-center">
        {{ $this->cartCount }}
      </span>
    </button>
  </x-dialog.open>

  <x-dialog.panel>
    <h2 class="text-2xl font-bold text-slate-900">追加資材</h2>
    <div class="mt-2 text-gray-600">
      @forelse ($cart as $id=> $product)
        <div class="bg-whites p-2 relative border-y ms-2">
          <button
            class="absolute top-2 right-2 bg-rose-600 text-white text-sm px-2 rounded border  hover:bg-rose-800 focus:outline-none focus:ring-2 focus:ring-rose-900"
            wire:click="exceptCart({{ $id }})">
            <i class="fa-solid fa-trash text-white text-lg"></i>
          </button>
          <h2 class="text-xl font-semibold">{{ $product['info']->name }}</h2>
          <p class="text-lg font-medium">
            個数：
            <span class="text-xl font-semibold">{{ number_format($product['count']) }}</span>
          </p>
        </div>

      @empty
        <p class="ms-2 text-lg text-black text-center">カートに資材を追加してください。</p>
      @endforelse

      @if (count($cart) != 0)
        <div class="mt-4 flex justify-end">
          <button class="text-xl font-bold bg-orange-600 py-2 px-4 rounded text-white flex items-center"
            wire:click="bringOut">
            <i class="fa-solid fa-arrow-right me-2"></i>
            持ち出す
          </button>
        </div>
      @endif
  </x-dialog.panel>
</x-dialog>
