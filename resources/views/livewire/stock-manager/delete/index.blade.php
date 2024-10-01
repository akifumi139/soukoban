<div class="flex min-h-screen flex-col bg-rose-100" x-data="cartComponent()" x-init="init()">
  <header class="fixed left-0 right-0 top-0 z-20 block bg-white text-gray-200 shadow-md">
    @include('components.layouts.profile')
    @include('components.layouts.search')
  </header>
  <div class="h-28 md:h-24"></div>
  <div class="mb-2 flex justify-end space-x-2 md:mx-20">
    <button class="relative flex items-center rounded-md bg-orange-600 px-3 py-2 text-xl text-white"
      wire:click="switching('追加')">
      <i class="fa-solid fa-trash me-2 text-xl"></i>
      追加モード
    </button>
  </div>
  @if (session('message'))
    <div class="mt-4 rounded border border-green-200 bg-green-100 p-4 text-green-700">
      {{ session('message') }}
    </div>
  @endif
  <div class="mb-4 mt-6 flex flex-row gap-3 ps-4 md:mx-20">
    <div wire:click='clearFilter' @class([
        'cursor-pointer rounded px-3 py-1',
        'bg-blue-600 text-white' => empty($filters),
        'bg-white text-black' => !empty($filters),
    ])>すべて</div>

    @foreach ($categories as $category)
      <div wire:click="toggleFilter('{{ $category->name }}')" @class([
          'cursor-pointer rounded px-3 py-1',
          'bg-blue-600 text-white' => in_array($category->name, $filters, true),
          'bg-white text-black' => !in_array($category->name, $filters, true),
      ])>{{ $category->name }}</div>
    @endforeach
  </div>
  <main class="mb-20 px-1 md:mx-20">
    <div class="grid grid-cols-1 gap-4 p-1 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($this->items as $item)
        <div @class([
            'p-4 rounded-lg shadow-md relative bg-white',
            'bg-gray-400' => $item->status === '削除候補',
        ])>
          <div class="absolute right-0 top-0">
            @if ($item->status === '削除候補')
              <button
                class="rounded-bl border bg-blue-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                wire:click="removeCandidates({{ $item->id }})">
                <i class="fa-solid fa-recycle text-lg text-white"></i>
              </button>
            @else
              <button
                class="rounded-bl border bg-rose-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                wire:click="addCandidates({{ $item->id }})">
                <i class="fa-solid fa-trash text-lg text-white"></i>
              </button>
            @endif
          </div>

          <h2 class="text-xl font-semibold">{{ $item->name }}</h2>
          <p class="text-gray-700">カテゴリ: {{ $item->categories }}</p>
          <p class="mb-2 text-gray-700">型番: {{ $item->model_number }}</p>
          <p class="text-right text-lg font-medium">
            在庫数:
            <span class="text-xl font-semibold">{{ $item->count }}</span>
          </p>
        </div>
      @endforeach
    </div>
  </main>

  <script>
    function cartComponent() {
      return {
        open: false,
        items: {},
        cart: {},
        init() {
          this.items = @json($itemList)
        },
        addToCart(id) {
          const item = this.items.find(item => item.id === id);
          if (item.stock == 0) {
            return;
          }

          if (!this.cart[id]) {
            this.cart[id] = {
              item_id: item.id,
              name: item.name,
              model_number: item.model_number,
              quantity: 1
            };
            return;
          }

          if (this.cart[id].quantity < item.stock) {
            this.cart[id].quantity++;
          }
        },
        removeFromCart(id) {
          if (!this.cart[id]) {
            return;
          }

          this.cart[id].quantity--;

          if (this.cart[id].quantity < 1) {
            delete this.cart[id];
          }
        },
        bringOut() {
          window.Livewire.dispatch('bring-out', {
            'cart': this.cart
          });
        },
        totalItem() {
          return Object.values(this.cart).reduce((total, item) => total + item.quantity, 0);
        },
      };
    }
  </script>

</div>
