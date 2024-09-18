<div class="bg-orange-100">
  <div class="container mx-auto p-4 pt-10">
    <div class="mb-4 flex justify-between space-x-2">
      <a class="relative flex items-center rounded-md px-3 py-1 text-xl font-bold text-teal-600"
        href="{{ route('roomManager') }}">
        <i class="fa-solid fa-chevron-left me-2 text-xl"></i>
        戻る
      </a>
      <button class="relative flex items-center rounded-md bg-rose-600 px-3 py-2 text-xl text-white" type="button"
        wire:click="delete">
        <i class="fa-solid fa-trash me-2 text-xl"></i>
        削除する
      </button>
    </div>

    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
      @foreach ($this->productList as $product)
        <div @class([
            'p-4 rounded-lg shadow-md relative bg-white',
            'bg-gray-400' => $product->status === '削除候補',
        ])>
          <div class="absolute right-0 top-0">
            @if ($product->status === '削除候補')
              <button
                class="rounded-bl border bg-blue-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                wire:click="removeCandidates({{ $product->id }})">
                <i class="fa-solid fa-recycle text-lg text-white"></i>
              </button>
            @else
              <button
                class="rounded-bl border bg-rose-800 px-2 text-sm text-white transition duration-150 ease-in-out hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-gray-500"
                wire:click="addCandidates({{ $product->id }})">
                <i class="fa-solid fa-trash text-lg text-white"></i>
              </button>
            @endif
          </div>

          <h2 class="text-xl font-semibold">{{ $product->name }}</h2>
          <p class="text-gray-700">カテゴリ: {{ $product->categories }}</p>
          <p class="mb-2 text-gray-700">型番: {{ $product->model_number }}</p>
          <p class="text-right text-lg font-medium">
            在庫数:
            <span class="text-xl font-semibold">{{ $product->count }}</span>
          </p>
        </div>
      @endforeach
    </div>
  </div>
</div>
