<template x-teleport="body">
  <div class="fixed inset-0 overflow-y-auto z-30 text-left pt-[30%] sm:pt-0" style="display: none" x-dialog
    x-model="dialogOpen">
    <!-- Overlay -->
    <div class="fixed inset-0 bg-black/25" x-dialog:overlay x-transition:enter.opacity></div>

    <!-- Panel -->
    <div class="relative min-h-full flex justify-center items-end sm:items-center p-0 sm:p-4">
      <div class="relative max-w-xl w-full bg-white rounded-t-xl sm:rounded-b-xl shadow-lg overflow-hidden"
        x-dialog:panel x-transition.in>
        <!-- Mobile: Top "grab" handle... -->
        <div class="sm:hidden absolute top-[-10px] left-0 right-0 h-[50px]" x-data="{ startY: 0, currentY: 0, moving: false, get distance() { return this.moving ? Math.max(0, this.currentY - this.startY) : 0 } }"
          x-on:touchstart="moving = true; startY = currentY = $event.touches[0].clientY"
          x-on:touchmove="currentY = $event.touches[0].clientY"
          x-on:touchend="if (distance > 100) $dialog.close(); moving = false;"
          x-effect="$el.parentElement.style.transform = 'translateY('+distance+'px)'">
          <div class="flex justify-center pt-[12px]">
            <div class="bg-gray-400 rounded-full w-[10%] h-[5px]"></div>
          </div>
        </div>

        <!-- Close Button -->
        <div class="absolute top-0 right-0 pt-4 pr-4">
          <button
            class="bg-gray-50 rounded-lg p-2 text-gray-600 focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500 focus-visible:ring-offset-2"
            type="button" x-on:click="$dialog.close()">
            <span class="sr-only">Close modal</span>
            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
              <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd" />
            </svg>
          </button>
        </div>

        <!-- Panel -->
        <div class="p-8">
          {{ $slot }}
        </div>
      </div>
    </div>
  </div>
</template>
