<header>
  <nav class="max-w-7xl py-4 px-3 mx-auto">
    <div class="container flex items-center justify-between w-full max-w-full bg-white py-5 px-4 rounded shadow-[0px_1px_3px_0px_#0000001A]">
      <a href="{{route('index')}}">
        <h2 class="text-black text-3xl/6 font-semibold">AI Smart Write</h2>
      </a>
      <ul class="lg:flex hidden items-center justify-end gap-5">
        <li>
          <a href="{{route('index')}}"
            class="{{Route::is('index') ? 'font-semibold text-[#007aff]': 'font-medium hover:text-black/80 text-black'}} text-base/6 transition-all ease-in duration-150">
            Home
          </a>
        </li>
         <li>
          <a href="{{route('index')}}#other-tools"
            class="font-medium hover:text-black/80 text-base/6 text-black transition-all ease-in duration-150">
            Other Tools
          </a>
        </li>
        <li>
          <a href="{{route('contact-us')}}"
            class="{{ Route::is('contact-us') ? 'font-semibold text-[#007aff]': 'font-medium hover:text-black/80 text-black'}}  text-base/6 transition-all ease-in duration-150">
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