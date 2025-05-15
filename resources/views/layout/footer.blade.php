<script>
  const version = {{config('constants.version')}};
  const BASE_URL = document.location.origin;
</script>
<script src="{{ asset('assets/js/general.js') . '?v=' . config('constants.version') }}" type="module"></script>
@stack('scripts')