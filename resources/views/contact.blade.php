@extends('layout.layout')

@section('title', 'Contact us')

@section('section')
<main class="max-w-6xl py-7 px-4 mx-auto">
  <div class="container mx-auto">
    <h2 class="text-center text-3xl/8 font-semibold text-white mb-5">
      Contact Us
    </h2>
    <form action="{{route('contact-store')}}" method="POST"
      class="max-w-xl bg-white rounded border border-gray-50 mx-auto w-full py-3.5 px-4 flex flex-col gap-2.5">
      @if ($errors->any())
      <div class="mb-2 p-3 bg-red-100 text-red-700 rounded">
        <ul class="list-disc pl-5">
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      @if (session('success'))
      <div class="mb-1 p-3 bg-green-100 text-green-700 rounded" id="status-message">
        {{ session('success') }}
      </div>
      @endif
      
      @csrf
      <input type="text" name="name" id="name" placeholder="Name"
        class="border-gray-300 rounded py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
      <input type="email" name="email" id="email" placeholder="Email"
        class="border-gray-300 rounded py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
      <textarea name="message" id="message" placeholder="Type your message..."
        class="border-gray-300 rounded py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full overflow-y-auto h-[200px] resize-none"></textarea>
      <input type="submit" value="Send Message"
        class="bg-[#007aff] hover:bg-[#007aff]/90 transition-all ease-in duration-75 w-full py-2 text-center rounded cursor-pointer text-white text-lg/6 font-medium">
    </form>
  </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/ai-story-generator.js') . '?v=' . config('constants.version') }}" type="module">
</script>
@endpush