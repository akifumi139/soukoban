<div class="flex min-h-screen items-center justify-center">
  <div class="max-w-96 fixed top-56 z-20 mx-auto w-11/12 rounded-lg bg-white p-1 md:top-44">
    <div class="flex justify-between p-1">
      <div class="text-xl font-bold">追加カート</div>
      <button class="text-3xl font-bold text-slate-900" @click="open = false">
        <i class="fa-regular fa-circle-xmark"></i>
      </button>
    </div>
    <div class="mt-2 max-h-96 overflow-y-auto p-1 text-gray-800">
      <template x-for="(item, id) in cart" :key="id">
        <li class="flex items-center justify-between border-b py-2 pe-3">
          <div>
            <div class="text-lg" x-text="item.name"></div>
            <div class="text-sm">型番: <span x-text="item.model_number"></span></div>
          </div>
          <div class="pt-1 text-xl">
            <span x-text="item.quantity"></span>
          </div>
        </li>
      </template>

      <div class="min-h-20">
        <template x-if="Object.keys(cart).length === 0">
          <p class="ms-2 text-center text-lg text-black">カートに追加してください。</p>
        </template>
      </div>

      <template x-if="Object.keys(cart).length > 0">
        <div class="absolute bottom-2 left-0 right-0 mx-auto mt-4 flex justify-center">
          <button class="flex items-center rounded bg-sky-600 px-4 py-2 text-xl font-bold text-white" @click="addStock">
            追加
          </button>
        </div>
      </template>
    </div>
  </div>
</div>
