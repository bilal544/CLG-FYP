@extends('layout.layout')

@section('title', 'Home')

@section('section')
<main class="max-w-6xl py-7 px-4 mx-auto">
    <div class="container mx-auto">
        <div
            class="tool flex lg:flex-row flex-col justify-between min-h-[450px] bg-white custom-shadow w-full rounded-md border border-gray-300">
            {{-- input-box-start --}}
            <div class="input-box w-full border-r flex flex-col border-gray-300 flex-1 min-h-[450px] relative">
                <div class="px-4 py-5 w-full flex-grow">
                    <textarea name="input-text" id="js-input-text"
                        placeholder="To, rewrite text, enter or paste it here and press text summarize."
                        spellcheck="false"
                        class="min-h-[380px] w-full resize-none border-0 ring-0 outline-0 focus:outline-0 focus:border-0 focus:ring-0"></textarea>
                </div>
                {{-- btn group + upload file btn start --}}
                <div id="js-btn-group"
                    class="flex w-full flex-col items-center justify-center gap-2 absolute transform top-[50%] -translate-y-[50%] left-[45%] -translate-x-[45%] z-20">
                    <input type="file" id="file" accept=".txt, .pdf, .docx" hidden>
                    {{-- upload file start --}}
                    <label for="file"
                        class="flex items-center leading-0 gap-1.5 bg-transparent border border-gray-300 hover:bg-gray-100 transition-all ease-in duration-150 rounded-full py-1 px-4 cursor-pointer group">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor"
                            class="size-8 text-gray-600 group-hover:text-gray-700 transition-all ease-in duration-150">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z" />
                        </svg>
                        <h3
                            class="text-base/6 text-gray-600 group-hover:text-gray-700 transition-all ease-in duration-150 font-semibold">
                            Upload File
                        </h3>
                    </label>
                    {{-- upload file end --}}
                    <div class="flex items-center gap-2">
                        <button type="button" id="js-sample-text" aria-label="try-sample-text"
                            class="py-2 px-4 hover:bg-gray-100 transition-all ease-in duration-150 cursor-pointer border border-gray-300 rounded-full text-gray-600 font-medium">
                            Try Sample Text
                        </button>
                        <button type="button" id="js-paste-text" aria-label="paste-text"
                            class="py-2 px-4 hover:bg-gray-100 transition-all ease-in duration-150 cursor-pointer border border-gray-300 rounded-full text-gray-600 font-medium">
                            Paste Text
                        </button>
                    </div>
                </div>
                {{-- btn group + upload file btn end --}}
                <div
                    class="bottom mt-auto lg:mb-3 mb-0 px-4 lg:pt-2 lg:py-0 py-2 flex items-center justify-between border-t lg:border-b-0 border-b border-gray-200">
                    <div class="flex items-center gap-4 flex-1">
                        <div class="word-counter flex items-center relative tooltip" data-tooltip="Words">
                            <span class="text-gray-600 text-sm/normal font-normal js-entered-words">0</span>
                            <span class="total-words text-gray-600 text-sm/normal font-normal">/500</span>
                        </div>
                        <button type="button" data-tooltip="Clear Text" aria-label="delete-text" id="js-delete-text"
                            class="hidden cursor-pointer tooltip relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 text-gray-600 group-hover:text-gray-900 transition-all ease-in duration-150">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                    </div>
                    <button type="button"
                        class="js-text-summarize hover:bg-[#131313]/90 transition-all ease-in duration-150 text-white text-base/5 font-medium cursor-pointer bg-[#131313] py-2 px-4 rounded-full border-0 ring-0 outline-0">
                        Summarize
                    </button>
                </div>
            </div>
            {{-- input-box-end --}}

            {{-- output box start --}}
            <div class="output-box h-full flex-1 lg:block hidden">
                <div class="hidden js-loader flex-col gap-2 items-center justify-center min-h-[435px]">
                    <span class="text-gray-600 text-base/6 font-medium">Please wait...</span>
                    <div class="loader"></div>
                </div>
                <div class="px-4 py-5 w-full flex-grow js-result-show">
                    <textarea name="result-text" id="js-result-text" placeholder="Result will be display here..."
                        spellcheck="false" readonly
                        class="min-h-[380px] w-full resize-none border-0 ring-0 outline-0 focus:outline-0 focus:border-0 focus:ring-0"></textarea>
                </div>
                <div
                    class="js-output-bottom mt-auto mb-3 px-4 pt-2 hidden items-center justify-between border-t border-gray-200">
                    <div class="word-counter flex items-center">
                        <span class="text-gray-600 text-sm/normal font-normal js-output-words">0</span>
                    </div>
                    <div class="flex items-center justify-end gap-2 flex-1">
                        <button type="button" data-tooltip="Clear All" aria-label="delete-text"
                            id="js-delete-result-text" class="flex cursor-pointer tooltip relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 text-gray-600 group-hover:text-gray-900 transition-all ease-in duration-150">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                        </button>
                        <button type="button" data-tooltip="Copy" data-copy="" aria-label="copy-text"
                            id="js-copy-result-text" class="flex cursor-pointer tooltip relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 text-gray-600 group-hover:text-gray-900 transition-all ease-in duration-150">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                            </svg>
                        </button>
                        <button type="button" data-tooltip="Download" data-download="" aria-label="download-text"
                            id="js-download-result-text" class="flex cursor-pointer tooltip relative group">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor"
                                class="size-5 text-gray-600 group-hover:text-gray-900 transition-all ease-in duration-150">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            {{-- output box end --}}
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/index.js') . '?v=' . config('constants.version') }}" type="module"></script>
@endpush