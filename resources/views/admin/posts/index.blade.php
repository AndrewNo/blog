@extends('layouts.app')
@section('content')
    <CreatePost :languages="{{ $languages }}"/>
@endsection
@section('scripts')
    <script src="{{ mix('js/admin/cratePost.js') }}"></script>
@endsection
