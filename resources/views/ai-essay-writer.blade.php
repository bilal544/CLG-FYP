@extends('layout.layout')

@section('title', 'Ai Essay Writer')

@section('section')
<main class="max-w-6xl py-7 px-4 mx-auto">
  <form action="#" class="js-essay-writer-form container mx-auto border border-gray-300 min-h-[300px] rounded py-2.5 px-4 bg-white">
    <div class="flex items-center justify-between gap-2.5 mb-3">
      <span class="text-base/6 text-gray-900 font-normal">
        Essay Topic:
      </span>
      <button type="button" id="js-sample-text" aria-label="try-sample-text"
        class="py-1 px-2.5 text-sm/6 hover:bg-gray-100 transition-all ease-in duration-150 cursor-pointer border border-gray-300 rounded text-gray-600 font-medium">
        Try Sample Topic
      </button>
    </div>
    <textarea name="input-topic-name" id="input-topic-name"
      class="w-full resize-none border-gray-300 rounded border-[0.5px] ring-0 outline-none h-[180px] py-2 px-3"
      placeholder="Enter your topic..."></textarea>
    <div class="w-full mx-auto flex items-center justify-between">
      <div class="flex flex-col items-start gap-1">
        <p class="text-base/6 text-gray-600 font-normal">Essay Length:</p>
        <div class="flex items-center gap-4">
          <div class="flex items-center gap-1.5">
            <input type="radio" name="essay_length" id="short" value="short" class="cursor-pointer" checked>
            <label for="short" class="text-sm/6 text-gray-600 font-normal cursor-pointer">Short</label>
          </div>
          <div class="flex items-center gap-1.5">
            <input type="radio" name="essay_length" id="medium" value="medium" class="cursor-pointer">
            <label for="medium" class="text-sm/6 text-gray-600 font-normal cursor-pointer">Medium</label>
          </div>
          <div class="flex items-center gap-1.5">
            <input type="radio" name="essay_length" id="long" value="long" class="cursor-pointer">
            <label for="long" class="text-sm/6 text-gray-600 font-normal cursor-pointer">Long</label>
          </div>
        </div>
      </div>
      <input type="submit" id="submit" value="Generate Essay"
        class="max-w-max w-full bg-[#131313] hover:bg-[#131313]/85 transition-all ease-in duration-150 cursor-pointer rounded text-white py-2 px-3 text-sm/5 font-medium">
    </div>
  </form>
</main>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/ai-essay-writer.js') . '?v=' . config('constants.version') }}" type="module"></script>
@endpush