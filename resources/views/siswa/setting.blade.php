@extends('layouts.app')

@section('content')
    @include('components.sidebar')
    <main class="md:ml-64 p-4">
        @include('profile.edit')
    </main>
@endsection
