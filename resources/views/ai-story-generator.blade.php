@extends('layout.layout')

@section('title', 'Ai Story Generator')

@section('section')
<main class="max-w-6xl py-7 px-4 mx-auto">
  <form id="js-ai-essay-writer"
    class="js-essay-writer-form shadow container mx-auto border border-gray-300 min-h-[300px] rounded py-2.5 px-4 bg-white">
    <div class="flex items-center justify-between gap-2.5 mb-3">
      <span class="text-base/6 text-gray-900 font-normal">
        Story Topic:
      </span>
      <button type="button" id="js-sample-text" aria-label="try-sample-text"
        class="py-1 px-2.5 block text-sm/6 hover:bg-gray-100 hover:text-[#007aff] transition-all ease-in duration-150 cursor-pointer border border-gray-300 rounded text-gray-600 font-medium">
        Try Sample Topic
      </button>
    </div>
    <textarea name="input-topic-name" id="input-topic-name"
      class="w-full resize-none border-gray-300 rounded border-[0.5px] ring-0 outline-none h-[180px] py-2 px-3"
      placeholder="Enter your topic..."></textarea>
    <div class="w-full mx-auto flex sm:flex-row flex-col sm:items-center items-start gap-2.5 justify-between">
      <div class="flex flex-col items-start gap-1">
        <p class="text-base/6 text-gray-600 font-normal">Story Length:</p>
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
      <input type="submit" id="submit" value="Generate Story"
        class="max-w-max w-full bg-[#007aff] focus:ring-0 focus:outline-0 focus:border-0 hover:bg-[#007aff]/90 transition-all ease-in duration-150 cursor-pointer rounded text-white py-2 px-3 text-sm/5 font-medium">
    </div>
  </form>

  {{-- output section start --}}
  <div
    class="js-essaywriter-output hidden shadow container mx-auto border border-gray-300 py-3 min-h-[400px] rounded bg-white mt-6">
    <div
      class="output-header border-b-[0.5px] border-gray-300 pb-3.5 px-3 flex flex-wrap items-center justify-between gap-2">
      <p class="text-lg/5 font-semibold text-[#007aff]">
        Story Result
      </p>
      <div class="js-action-btns flex items-center justify-end gap-2">
        <button type="button" data-tooltip="Clear All" aria-label="delete-text" id="js-delete-result-text"
          class="flex cursor-pointer tooltip relative group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor"
            class="size-5 text-gray-600 group-hover:text-[#007aff] transition-all ease-in duration-150">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
          </svg>
        </button>
        <button type="button" data-tooltip="Copy" data-copy="" aria-label="copy-text" id="js-copy-result-text"
          class="flex cursor-pointer tooltip relative group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor"
            class="size-5 text-gray-600 group-hover:text-[#007aff] transition-all ease-in duration-150">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
          </svg>
        </button>
        <button type="button" data-tooltip="Download" data-download="" aria-label="download-text"
          id="js-download-result-text" class="flex cursor-pointer tooltip relative group">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor"
            class="size-5 text-gray-600 group-hover:text-[#007aff] transition-all ease-in duration-150">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
          </svg>
        </button>
        <span class="text-gray-600 text-sm/normal font-normal js-output-words">0 Words</span>
      </div>

    </div>
    <div
      class="js-output-body py-3 thin-scrollbar overflow-y-auto h-[350px] px-3 text-base/6 text-[#131313] font-normal">
    </div>
  </div>
  {{-- output section end --}}
</main>
<x-other-tools />
@endsection

@push('scripts')
<script src="{{ asset('assets/js/ai-story-generator.js') . '?v=' . config('constants.version') }}" type="module"></script>
@endpush