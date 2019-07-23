@if (session('message'))
    <div class="text-center mt-3">
        <span class="alert alert-success">{{ session('message') }}</span>
    </div>
@endif