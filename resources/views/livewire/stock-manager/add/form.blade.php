<div class="flex min-h-screen w-full max-w-[600px] items-center justify-center p-2">
  <div class="z-20 mx-auto w-full rounded-lg bg-white p-4 md:top-44" x-data="{ name: '', modelNumber: '', quantity: 0 }">
    <div class="mb-4 flex items-center justify-between">
      <div class="text-xl font-bold">道具・資材の追加</div>
      <button class="text-3xl font-bold text-slate-900" @click="closeCreateForm()">
        <i class="fa-regular fa-circle-xmark"></i>
      </button>
    </div>
    <form @submit.prevent="addNewItem">
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="name">名前</label>
        <input class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="name" name="name" type="text" placeholder="資材の名前" x-model="name" required>
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="modelNumber">型番</label>
        <input class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="modelNumber" name="modelNumber" type="text" placeholder="資材の型番" x-model="modelNumber" required>
      </div>
      <div class="mb-4">
        <label class="mb-2 block text-sm font-medium text-gray-700" for="quantity">個数</label>
        <input class="w-full rounded-lg border border-gray-300 p-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
          id="quantity" name="quantity" type="number" placeholder="個数" min="1" x-model.number="quantity"
          required>
      </div>
      <div class="flex justify-center">
        <button
          class="rounded-lg bg-blue-500 px-4 py-2 text-white shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 md:text-xl"
          type="submit">
          追加する
        </button>
      </div>
    </form>
  </div>
</div>
