<!-- success.blade.php -->
@extends('layouts.master')
@section('content')
@if (isset($message) && !empty($message))
    <div class="alert alert-success">
        {{ $message }}
    </div>
@endif

@endsection