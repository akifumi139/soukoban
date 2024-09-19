<div class="flex min-h-screen flex-col bg-blue-100" x-data="cartComponent()">
  <header class="fixed left-0 right-0 top-0 z-20 block bg-white text-gray-200 shadow-md">
    @include('components.layouts.profile')
    @include('components.layouts.search')
    @include('components.layouts.tab', ['tab' => '工具箱'])
  </header>
  <div class="h-56 md:h-44"></div>
  @if (session('message'))
    <div class="mt-4 rounded border border-green-200 bg-green-100 p-4 text-green-700">
      {{ session('message') }}
    </div>
  @endif
  <main class="mb-20 px-1 md:mx-20">
    @foreach ($this->productList as $category => $products)
      <div
        class="relative mx-auto mt-2 w-full divide-y divide-gray-200 overflow-hidden rounded-md border-t-4 border-gray-500 bg-gray-200 text-sm font-normal"
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
            <div class="flex items-center">
              <span class="me-6 text-lg">{{ $products->count() }}</span>
              <svg class="h-4 w-4 duration-200 ease-out" :class="{ 'rotate-180': activeAccordion == id }"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </div>
            </svg>
          </button>
          <div class="grid grid-cols-1 gap-4 p-1 md:grid-cols-2 lg:grid-cols-3" x-show="activeAccordion==id" x-collapse
            x-cloak>
            @foreach ($products as $product)
              @if ($product->stuff)
                <div class="relative rounded-lg bg-white p-4 shadow-md">
                  <div class="absolute right-0 top-0">
                    <button
                      class="rounded-bl border bg-cyan-600 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                      @click="addToCart({{ $product->id }}, '{{ $product->name }}', '{{ $product->model_number }}', '{{ number_format($product->stuff->sum('count')) }}')">
                      <i class="fa-solid fa-plus text-lg text-white"></i>
                    </button>
                    <button
                      class="rounded-bl border border-gray-700 bg-gray-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                      @click="removeFromCart({{ $product->id }})">
                      <i class="fa-solid fa-minus text-lg text-white"></i>
                    </button>
                  </div>
                  <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
                  <p class="mb-2 text-gray-700">型番　: {{ $product->model_number }}</p>
                  <p class="text-right text-lg font-medium">
                    所持数:
                    <span class="text-xl font-semibold">{{ number_format($product->stuff->sum('count')) }}</span>
                  </p>
                  <p class="text-right text-lg font-medium">
                    返却数:
                    <span class="text-xl font-semibold"
                      x-text="cart[{{ $product->id }}] ? cart[{{ $product->id }}].count : 0"></span>
                  </p>
                </div>
              @endif
            @endforeach
          </div>
        </div>
      </div>
    @endforeach
  </main>

  <div class="fixed bottom-4 right-2">
    <button class="rounded-full bg-teal-500 p-3 text-4xl text-white shadow-lg hover:bg-teal-600 focus:outline-none"
      @click="open = true">
      <i class="fa-solid fa-dolly"></i>
      <template x-if="totalCount() > 0">
        <span
          class="absolute -top-1 right-0 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white"
          x-text="totalCount()">
        </span>
      </template>
    </button>
    <div class="modal" :class="{ 'active': open }" @click.self="">
      @include('livewire.my-stuff.cart')
    </div>
  </div>

  <script>
    function cartComponent() {
      return {
        open: false,
        cart: {},
        addToCart(productId, productName, modelNumber, stock) {
          if (!this.cart[productId]) {
            this.cart[productId] = {
              product_id: productId,
              name: productName,
              model_number: modelNumber,
              count: 1
            };
          } else {
            if (this.cart[productId].count < stock) {
              this.cart[productId].count++;
            }
          }
        },
        removeFromCart(productId) {
          if (this.cart[productId]) {
            if (this.cart[productId].count > 1) {
              this.cart[productId].count--;
            } else {
              delete this.cart[productId];
            }
          }
        },
        giveBack() {
          window.Livewire.dispatch('give-back', {
            'cart': this.cart
          });
        },
        totalCount() {
          return Object.values(this.cart).reduce((total, item) => total + item.count, 0);
        },
      };
    }
  </script>

</div>
