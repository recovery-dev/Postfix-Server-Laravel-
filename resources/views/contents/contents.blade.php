@extends('layouts.blank')

@section('main_container')

    <div class="right_col" role="main">
        @includeIf('contents/table', ['contents' => $contents])        
    </div>

@endsection
