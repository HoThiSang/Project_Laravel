<!-- error.blade.php -->
@if (isset($error) && !empty($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
@endif