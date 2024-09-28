<div class="flex">
  <a tabindex="-1" @if ($tab !== '工具箱') href="{{ route('myStuff') }}" @else tabindex="-1" @endif
    @class([
        'flex-1 border-double px-4 py-2 text-center text-xl font-bold',
        'text-sky-500' => $tab === '工具箱',
        'text-gray-400' => $tab !== '工具箱',
    ])>
    <div>
      {{ Auth::user()->name }}
      <span class="hidden md:inline">
        さんの工具箱
      </span>
      <i class="fas fa-briefcase ml-1"></i>
    </div>
    <hr @class([
        'mx-3 mt-1 rounded-sm border-2 ',
        'border-sky-400' => $tab === '工具箱',
        'border-gray-400' => $tab !== '工具箱',
    ])>
  </a>
  <a @if ($tab !== '倉庫') href="{{ route('stockroom') }}" @else tabindex="-1" @endif
    @class([
        'flex-1 border-double px-4 py-2 text-center text-xl  font-bold',
        'text-teal-500' => $tab === '倉庫',
        'text-gray-400' => $tab !== '倉庫',
    ])>
    <div>
      倉　庫
      <i class="fas fa-boxes-stacked ml-1"></i>
    </div>
    <hr @class([
        'mx-3 mt-1 rounded-sm border-2 ',
        'border-teal-400' => $tab === '倉庫',
        'border-gray-400' => $tab !== '倉庫',
    ])>
  </a>
</div>
