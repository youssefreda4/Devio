@if (session()->get('success') !== null)
    <div class="alert alert-success text-center">
        {{ session()->get('success') }}
    </div>
@endif
