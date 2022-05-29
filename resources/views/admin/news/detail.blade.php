@extends('admin.layout.app')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <h3 class="box-title">{{ $news->title }}</h3>
            <div style="padding-top: 0.1em; padding-bottom: 0.1rem" class="text-sm px-3 bg-black-200 text-black-800 rounded-full">{{ $news->category->title }}</div>
            <hr>
            <img src="{{ asset('uploads/'.$news->image) }}" alt="{{ $news->image }}">
            <hr>
            {!! $news->content !!}
        </div>
    </div>
</div>
@endsection
