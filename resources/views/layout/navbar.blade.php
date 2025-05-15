<header>
  <nav class="max-w-7xl py-4 px-3">
    <div class="container flex items-center justify-between w-full max-w-full">
      <a href="{{route('index')}}">
        <h2 class="text-black text-3xl/6 font-semibold">Smart Write</h2>
      </a>
      <ul class="lg:flex hidden items-center justify-end gap-5">
        <li>
          <a href="{{route('index')}}"
            class="{{request()->is('/') ? 'font-semibold': 'font-medium hover:text-black/80'}} text-base/6 text-black transition-all ease-in duration-150">
            Home
          </a>
        </li>
        <li>
          <a href="#"
            class="text-base/6 text-black font-medium hover:text-black/80 transition-all ease-in duration-150">
            Blog
          </a>
        </li>
        <li>
          <a href="#"
            class="text-base/6 text-black font-medium hover:text-black/80 transition-all ease-in duration-150">
            Contact
          </a>
        </li>
      </ul>
      <button type="button" class="lg:hidden flex items-center justify-end cursor-pointer" aria-label="toggler-menu">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-7 text-gray-600">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
      </button>
    </div>
  </nav>
</header>