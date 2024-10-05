<div class="flex min-h-screen flex-col bg-orange-100" x-data="cartComponent()" x-init="init()">
  <header class="fixed left-0 right-0 top-0 z-20 block bg-white text-gray-200 shadow-md">
    @include('components.layouts.profile')
    @include('components.layouts.search')
  </header>
  <div class="h-28 md:h-24"></div>
  @if (session('message'))
    <div class="mt-4 rounded border border-green-200 bg-green-100 p-4 text-green-700">
      {{ session('message') }}
    </div>
  @endif
  <main class="mx-2 mb-20 px-1 xl:mx-20">
    <div class="mt-4 grid grid-cols-1 gap-4 p-1 md:grid-cols-2 lg:grid-cols-3" id="newItemArea">
      <button
        class="min-h-40 relative flex flex-col items-center justify-center rounded-lg border-4 border-dashed border-green-800 bg-white px-4 py-2 opacity-80 hover:bg-green-400"
        @click="openCreateForm()">
        <i class="fa-solid fa-plus text-5xl"></i>
        <p class="text-2xl">道具・資材の追加</p>
      </button>
      <template x-for="(item, index) in newItems" :key="index">
        <div class="min-h-40 relative rounded-lg bg-white px-4 py-2 shadow-md">
          <h2 class="text-xl font-semibold" x-text="item.name"></h2>
          <div class="text-gray-700" x-text="item.model_number"></div>
          <div class="flex gap-2 text-left text-base font-medium">
            <div class="ms-2 mt-1 text-xl" x-show="item.type === 'tool'">
              <template x-for="borrower in item.borrowers" :key="borrower.id">
                <div class="rounded-md text-base" x-text="borrower.name"></div>
              </template>
            </div>
          </div>
          <div class="absolute bottom-2 left-2">
            <template x-for="category in item.categories" :key="category.id">
              <span class="rounded-md bg-blue-400 px-2 py-1 text-sm text-white" x-text="category.name"></span>
            </template>
          </div>
          <div class="absolute right-0 top-0">
            <button
              class="block h-10 w-16 rounded-t border bg-cyan-600 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
              @click="addToCart(item.id)">
              <i class="fa-solid fa-angle-up text-lg"></i>
            </button>
            <div class="my-2 mb-4 text-left">
              <label class="block text-center text-sm">
                追加カート
              </label>
              <div class="w-18 rounded-md p-1 text-center text-xl font-semibold"
                x-bind:class="{
                    'text-green-600 bg-green-100': cart[item.id]?.quantity > 0,
                    'text-black': cart[item.id]?.quantity === 0
                }">
                <span x-text="cart[item.id]?.quantity ?? 0"></span>
              </div>
            </div>
            <button
              class="mt-2 block h-10 w-16 rounded-b border border-gray-700 bg-gray-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
              @click="removeFromCart(item.id)">
              <i class="fa-solid fa-angle-down text-lg"></i>
            </button>
          </div>
        </div>
      </template>

    </div>
    <hr class="border-3 mb-2 mt-10">
    <div class="mb-4 flex flex-row gap-3 ps-4">
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
        ])>{{ $category->name }}
        </div>
      @endforeach
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($this->items as $item)
        <div class="min-h-40 shadow-mdv relative flex rounded-lg bg-white ps-4">
          <div class="min-w-56 relative h-full w-11/12 pt-2">
            <h2 class="text-xl font-semibold">{{ $item->name }}</h2>
            <div class="text-gray-700">{{ $item->model_number }}</div>
            <div class="flex gap-2 text-left text-base font-medium">
              <div>在庫数:<span class="ms-2 text-xl font-semibold">{{ $item->quantity }}</span></div>
              <div class="ms-2 mt-1 text-xl">
                @if ($item->type === 'tool')
                  @foreach ($item->borrowers as $borrower)
                    <div class="rounded-md text-base">{{ $borrower->name }}</div>
                  @endforeach
                @endif
              </div>
            </div>
            <div class="absolute bottom-2 left-2">
              @foreach ($item->categories as $category)
                <span class="rounded-md bg-blue-400 px-2 py-1 text-sm text-white">{{ $category->name }}</span>
              @endforeach
            </div>
          </div>
          <div class="flex flex-col justify-end text-end">
            <button
              class="block h-10 w-16 rounded-t border bg-cyan-600 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
              @click="addToCart({{ $item->id }})">
              <i class="fa-solid fa-angle-up text-lg"></i>
            </button>
            <div class="my-2 mb-4 text-left">
              <span class="block text-center text-sm">
                追加
              </span>
              <div class="w-18 rounded-md p-1 text-center text-xl font-semibold"
                x-bind:class="{
                    'text-green-600 bg-green-100': cart[{{ $item->id }}]?.quantity > 0,
                    'text-black': cart[{{ $item->id }}]
                        ?.quantity === 0
                }">
                <span x-text="cart[{{ $item->id }}]?.quantity ?? 0"></span>
              </div>
            </div>
            <button
              class="mt-2 block h-10 w-16 rounded-b border border-gray-700 bg-gray-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
              @click="removeFromCart({{ $item->id }})">
              <i class="fa-solid fa-angle-down text-lg"></i>
            </button>
          </div>
        </div>
      @endforeach
    </div>
  </main>
  <div class="fixed bottom-4 right-2">
    <button class="rounded-full bg-teal-500 p-3 text-4xl text-white shadow-lg hover:bg-teal-600 focus:outline-none"
      @click="open = true">
      <i class="fa-solid fa-dolly"></i>
      <template x-if="totalItem()> 0">
        <span
          class="absolute -top-1 right-0 flex h-5 w-5 items-center justify-center rounded-full bg-red-500 text-xs text-white"
          x-text="totalItem()">
        </span>
      </template>
    </button>
    <div class="modal" :class="{ 'active': open }" @click.self="">
      @include('livewire.stock-manager.add.cart')
    </div>
  </div>

  <div class="modal" :class="{ 'active': addModalOpen }" @click.self="">
    @include('livewire.stock-manager.add.form')
  </div>
  <script>
    function cartComponent() {
      return {
        open: false,
        addModalOpen: false,
        items: {},
        newItems: [],
        cart: {},
        init() {
          this.items = @json($itemList);
        },
        addToCart(id) {
          const item = this.items.find(item => item.id === id);

          if (!this.cart[id]) {
            this.cart[id] = {
              item_id: item.id,
              name: item.name,
              model_number: item.model_number,
              quantity: 1
            };
            return;
          }

          this.cart[id].quantity++;
        },
        openCreateForm() {
          this.addModalOpen = true;
        },
        closeCreateForm() {
          this.addModalOpen = false;
          this.resetNewItemForm();
        },
        addNewItem() {
          const newId = 'new-' + (this.newItems.length + 1);
          const newItem = {
            id: newId,
            name: this.name,
            model_number: this.modelNumber,
            quantity: 0,
            type: 'tool',
            borrowers: [],
            categories: [{
              id: 1,
              name: 'カテゴリA'
            }, {
              id: 2,
              name: 'カテゴリB'
            }]
          };
          this.newItems.push(newItem);
          this.items.push(newItem);
          this.addModalOpen = false;


          this.cart[newItem.id] = {
            item_id: newItem.id,
            name: newItem.name,
            model_number: newItem.model_number,
            quantity: this.quantity,
          };

          this.resetNewItemForm();
        },
        resetNewItemForm() {
          this.name = '';
          this.modelNumber = '';
          this.quantity = '';
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
        addStock() {
          window.Livewire.dispatch('add-stock', {
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
