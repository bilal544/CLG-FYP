@extends('layout.layout')

@section('title', 'Ai Story Generator')

@section('section')
<main class="max-w-6xl py-7 px-4 mx-auto">
  <div class="container mx-auto">

  </div>
</main>
@endsection

@push('scripts')
<script src="{{ asset('assets/js/ai-story-generator.js') . '?v=' . config('constants.version') }}" type="module">
</script>
@endpush