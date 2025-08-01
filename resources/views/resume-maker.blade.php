@extends('layout.layout')

@section('title', 'Resume Maker')

@section('section')
<main class="max-w-7xl py-7 px-4 mx-auto">
  <div class="grid grid-cols-12 gap-3 place-content-start place-items-start">
    <div class="col-span-5 flex flex-col w-full gap-2">
      <div class="flex items-center gap-1.5 w-full">
        <input type="text" placeholder="Full Name" id="js-full-name"
          class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
        <input type="text" placeholder="Position" id="js-position-name"
          class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
      </div>
      <textarea name="summary" id="js-summarry" cols="20" rows="6" placeholder="Summary"
        class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full resize-none overflow-y-auto"></textarea>
      <div class="flex items-center gap-1.5 w-full">
        <input type="email" placeholder="Email" id="email"
          class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
        <input type="tel" placeholder="Cell #" id="mobile-number"
          class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
        <input type="name" placeholder="City" id="city"
          class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
      </div>
      <div class="w-full flex-col flex gap-2 mt-3" id="js-work-experience">
        <div class="flex flex-col gap-2 w-full">
          <div class="flex gap-2 items-center w-full">
            <h3 class="text-white text-3xl font-semibold flex-1">Work Experience</h3>
            <button type="button" id="js-add-work-exp"
              class="w-[28px] h-[28px] text-white hover:text-black text-2xl/6 cursor-pointer hover:bg-gray-100 rounded-full transition-all ease-in duration-100">
              +
            </button>
          </div>
          <div class="flex items-center gap-1.5 w-full">
            <input type="text" placeholder="Company Name"
              class="border-gray-300 rounded text-gray-50 js-company-name py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
            <input type="text" placeholder="Position"
              class="border-gray-300 rounded js-company-position text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
          </div>
          <div class="flex items-center gap-1.5 w-full">
            <input type="name" placeholder="Start Date"
              class="border-gray-300 rounded js-job-start-date text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
            <input type="name" placeholder="End Date"
              class="border-gray-300 rounded js-job-end-date text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
          </div>
          <textarea name="job-summary" cols="20" rows="6" placeholder="Job Summary"
            class="border-gray-300 rounded js-job-summarry text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full resize-none overflow-y-auto"></textarea>
        </div>
      </div>
      <div class="w-full flex-col flex gap-2 mt-3" id="js-education-append-more">
        <div class="flex flex-col gap-2 mt-3 w-full">
          <div class="flex gap-2 items-center w-full">
            <h3 class="text-white text-3xl font-semibold flex-1">Add Education</h3>
          </div>
          <input type="text" placeholder="Degree Name" id="js-degree-name"
            class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
          <div class="flex items-center gap-1.5 w-full">
            <input type="name" placeholder="Start Date" id="js-degree-start-date"
              class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
            <input type="name" placeholder="End Date" id="js-degree-end-date"
              class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
          </div>
        </div>
      </div>
      <div class="flex flex-col gap-2 mt-3 w-full">
        <h3 class="text-white text-3xl font-semibold flex-1">Add Skills</h3>
        <div class="flex gap-1 flex-col">
          <input type="name" placeholder="Add Skill Name" id="skill-name"
            class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
          <span class="text-gray-300 text-xs/5 font-normal">Type your skill and press enter key to add.
            <code>(Enter)</code></span>
        </div>
        {{-- append skills start --}}
        <div class="flex flex-wrap gap-2" id="js-added-skills"></div>
        {{-- append skills end --}}
      </div>
      <div class="flex flex-col gap-2 mt-3 w-full">
        <h3 class="text-white text-3xl font-semibold flex-1">Add Your Hobbies</h3>
        <div class="flex gap-1 flex-col">
          <input type="name" placeholder="Add Your Hobbies" id="hobby-name"
            class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
          <span class="text-gray-300 text-xs/5 font-normal">Type your hobby and press enter key to add.
            <code>(Enter)</code></span>
        </div>
        <div class="flex flex-wrap gap-2" id="js-added-hobbies"></div>
      </div>
      <div class="flex flex-col gap-2 mt-3 w-full">
        <h3 class="text-white text-3xl font-semibold flex-1">Add Your Awards</h3>
        <div class="flex gap-1 flex-col">
          <input type="name" placeholder="Add Your Awards" id="award-name"
            class="border-gray-300 rounded text-gray-50 py-2 px-3 ring-0 focus:border-gray-400 outline-0 border w-full">
          <span class="text-gray-300 text-xs/5 font-normal">Type your award name and press enter key to add.
            <code>(Enter)</code></span>
        </div>
        <div class="flex flex-wrap gap-2" id="js-added-awards"></div>
      </div>
    </div>
    <div class="col-span-7 sticky top-3">
      <div class="flex items-center gap-2 justify-end mb-2 ml-auto">
        <button type="button" id="download"
          class="border border-gray-300 text-white py-1 px-2 cursor-pointer text-sm/5 font-normal">
          Download
        </button>
      </div>
      <div id="resume-content" class="bg-white js-cv-section min-h-[400px] w-full mx-auto max-w-3xl py-10 px-10 col-span-7">
        <div class="flex flex-col gap-3 w-full">
          <div class="flex flex-col w-full gap-2.5">
            <h1 class="text-4xl/8 font-semibold text-black capitalize" id="name" data-placeholder="Your Name">Javad Akmal</h1>
            <h5 class="text-xl/6 font-medium text-gray-600 capitalize" id="designation"
              data-placeholder="Your Designation">
              Laravel Developer</h5>
            <p id="cv-summary" class="text-sm/5 text-gray-600 font-normal">
              Lorem ipsum dolor sit amet consectetur adipisicing elit. Numquam hic consequuntur magni fugiat laudantium
              tempora quia id unde beatae neque vitae vel ratione, labore voluptatum! Tempora incidunt laboriosam
              maiores
              velit.
            </p>
          </div>
          <div class="flex items-center gap-1.5">
            <p class="text-sm/5 text-gray-600 font-normal" id="email-result">
              javadakmal@gmail.com |
            </p>
            <p class="text-sm/5 text-gray-600 font-normal" id="phone-no-result">
              0300-1234567 |
            </p>
            <p class="text-sm/5 text-gray-600 font-normal" id="address-result">
              Faisalabad
            </p>
          </div>
        </div>
        <br>
        <div class="flex flex-col gap-4 w-full">
          <div class="flex flex-col gap-3 w-full" id="js-work-experience-section">
            <h2 id="work-experince" class="text-2xl/8 font-semibold text-black underline">Work Experience</h2>
            <div class="flex flex-col gap-2 w-full" id="js-append-work-experience">
              <div class="flex flex-col gap-3 w-full">
                <div class="flex justify-between gap-3 w-full">
                  <div class="flex items-center gap-1 flex-1">
                    <h3 id="company-name" class="text-xl/6 font-medium text-gray-600">Enzipe |</h3>
                    <h4 id="company-designation" class="text-xl/6 font-medium text-gray-600">Frontend Developer</h4>
                  </div>
                  <div class="job-start-date flex items-center gap-1">
                    <p id="job-start-date" class="text-sm/6 font-medium text-gray-600">18-03-2025 -</p>
                    <p id="job-end-date" class="text-sm/6 font-medium text-gray-600">Present</p>
                  </div>
                </div>
                <p id="role-description" class="text-gray-600 font-normal text-sm/5">
                  Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ullam, odit laborum sequi non iste autem
                  aspernatur aut fugiat voluptatibus neque asperiores doloribus atque ratione saepe! Iure fugiat
                  assumenda
                  facilis unde.
                </p>
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-3 w-full" id="js-education-section">
            <h2 id="education" class="text-2xl/8 font-semibold text-black underline">Education</h2>
            <div class="flex gap-3 w-full">
              <div class="flex items-center gap-1">
                <h4 id="degree-name" class="text-xl/6 font-medium text-gray-600">Software Engineering</h4>
              </div>
              <div class="job-start-date flex items-center gap-1">
                <p id="degree-start-date" class="text-sm/6 font-medium text-gray-600">(18-03-2025 -</p>
                <p id="degree-end-date" class="text-sm/6 font-medium text-gray-600">Present)</p>
              </div>
            </div>
          </div>
          <div class="flex flex-col gap-3 w-full" id="js-skills-section">
            <h2 id="skills" class="text-2xl/8 font-semibold text-black underline">Skills</h2>
            <ul class="list-disc pl-5 marker:text-gray-600 grid grid-cols-2 gap-1" id="js-append-skills">
              <li class="text-sm/5 text-gray-600 font-normal">HTML5</li>
              <li class="text-sm/5 text-gray-600 font-normal">CSS3</li>
              <li class="text-sm/5 text-gray-600 font-normal">HTML5</li>
              <li class="text-sm/5 text-gray-600 font-normal">CSS3</li>
            </ul>
          </div>
          <div class="flex flex-col gap-3 w-full" id="js-interests-section">
            <h2 id="interests" class="text-2xl/8 font-semibold text-black underline">Hobbies</h2>
            <ul class="list-disc pl-5 marker:text-gray-600 grid grid-cols-2 gap-1" id="js-append-hobbies">
              <li class="text-sm/5 text-gray-600 font-normal">HTML5</li>
              <li class="text-sm/5 text-gray-600 font-normal">CSS3</li>
              <li class="text-sm/5 text-gray-600 font-normal">HTML5</li>
              <li class="text-sm/5 text-gray-600 font-normal">CSS3</li>
            </ul>
          </div>
          <div class="flex flex-col gap-3 w-full" id="js-awards-section">
            <h2 id="interests" class="text-2xl/8 font-semibold text-black underline">Awards</h2>
            <ul class="list-disc pl-5 marker:text-gray-600 grid grid-cols-1 gap-1" id="js-append-awards">
              <li class="text-sm/5 text-gray-600 font-normal">HTML5</li>
              <li class="text-sm/5 text-gray-600 font-normal">CSS3</li>
              <li class="text-sm/5 text-gray-600 font-normal">HTML5</li>
              <li class="text-sm/5 text-gray-600 font-normal">CSS3</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<x-other-tools />
@endsection

@push('scripts')
<script src="{{ asset('assets/js/resume-maker.js') . '?v=' . config('constants.version') }}" type="module"></script>
@endpush