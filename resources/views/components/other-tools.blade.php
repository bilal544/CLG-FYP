@php
$tools = [
[
'slug'=> 'index',
'tool_name'=> 'Text Summarizer'
],
[
'slug'=> 'ai-essay-writer',
'tool_name'=> 'Ai Essay Writer'
],
[
'slug'=> 'ai-story-generator',
'tool_name'=> 'Ai Story Generator'
],
[
'slug'=> 'resume-maker',
'tool_name'=> 'Resume Maker'
]
];
@endphp

<section class="max-w-4xl mx-auto px-4 mb-4" id="other-tools">
    <div class="container mx-auto">
        <h2 class="text-center text-3xl/8 text-[#f4f4f4] my-6 font-semibold">Our Other Tools</h2>
        <div class="grid sm:grid-cols-2 grid-cols-1 w-full gap-3">
            @foreach ($tools as $tool )
            @php
            $slug = $tool['slug'];
            @endphp
            <a href="{{route($slug)}}"
                class="w-full {{Route::is($tool['slug']) ? 'hidden': ''}} hover:bg-gray-50 bg-white h-[50px] rounded-md flex items-center justify-center group transition-all ease-in duration-100">
                <p
                    class="text-center text-lg/7 font-medium group-hover:text-[#007aff] transition-all ease-in duration-100">
                    {{$tool['tool_name']}}
                </p>
            </a>
            @endforeach
        </div>
    </div>
</section>