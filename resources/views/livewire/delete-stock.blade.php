<div class="bg-gray-100">
  <header class=" bg-rose-800 text-gray-200 shadow-md fixed top-0 left-0 right-0 z-20">
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
    <div class="flex justify-between space-x-2">
      <a class="relative flex items-center text-xl px-3 text-teal-600 font-bold rounded-md py-1"
        href="{{ route('stockManager') }}">
        <i class="fa-solid fa-chevron-left text-xl me-2"></i>
        戻る
      </a>
      <button class="relative flex items-center text-xl bg-rose-600 px-3 text-white rounded-md py-2" type="button"
        wire:click="delete">
        <i class="fa-solid fa-trash text-xl me-2"></i>
        削除する
      </button>
    </div>

    <h1 class="text-2xl font-bold mb-4">在庫</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
      @foreach ($this->productList as $product)
        <div @class([
            'p-4 rounded-lg shadow-md relative',
            'bg-gray-400' => $product->status === '削除候補',
        ])>
          <div class="absolute top-0 right-0">
            @if ($product->status === '削除候補')
              <button
                class="bg-blue-800 text-white text-sm px-2 rounded-bl border hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition ease-in-out duration-150"
                wire:click="removeCandidates({{ $product->id }})">
                <i class="fa-solid fa-recycle text-white text-lg"></i>
              </button>
            @else
              <button
                class="bg-rose-800 text-white text-sm px-2 rounded-bl border hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-gray-500 transition ease-in-out duration-150"
                wire:click="addCandidates({{ $product->id }})">
                <i class="fa-solid fa-trash text-white text-lg"></i>
              </button>
            @endif
          </div>

          <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
          <p class="text-gray-700 mb-2">型番: {{ $product->model_number }}</p>
          <p class="text-lg font-medium text-right">
            現在の在庫数:
            <span class="text-xl font-semibold">{{ $product->count }}</span>
          </p>
        </div>
      @endforeach
    </div>
  </div>
</div>
