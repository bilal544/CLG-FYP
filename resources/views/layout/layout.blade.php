<!DOCTYPE html>
<html lang="en" class="antialiased scroll-smooth p-0 m-0 box-border">

<head>
  @include('layout.head')
</head>

<body class="h-full max-w-full w-full overflow-x-hidden font-nunito relative">
  {{-- popup start --}}
  <div
    class="js-popup absolute inset-0 px-3 py-2 hidden items-center justify-center w-full min-h-screen bg-gray-300/40 z-[999]">
    <div class="popup-inner bg-white h-auto w-auto shadow rounded-md relative">
      <button type="button" class="flex justify-end w-full cursor-pointer group py-2 px-3">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
          class="size-6 text-gray-600 group-hover:text-gray-800 transition-all ease-in duration-200">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
      </button>
      <div class="flex items-center flex-col gap-2.5 py-5 px-4">
        <img src="{{asset('assets/images/not-found.jpg')}}" alt="img-not-found"
          class="h-[200px] w-[200px] object-cover mix-blend-multiply">
        <h2 class="text-red-600 text-4xl/7 font-semibold text-center">
          No Text Found!
        </h2>
        <p class="text-gray-600 text-lg/6 font-normal text-center">
          At least Enter 15 words to summarize text.
        </p>
      </div>
    </div>
  </div>
  {{-- popup end--}}
  @include('layout.navbar')
  @yield('section')
  @include('layout.footer')
</body>

</html>