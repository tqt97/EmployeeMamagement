@extends('layouts.admin')

@section('content')
    <div id="app">
        <router-view></router-view>
    </div>
@endsection
@push('scripts')
    <script src="{{ mix('js/app.js') }}" defer></script>
@endpush
