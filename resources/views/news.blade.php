@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>News</h2>
    </div>

    <div class="card-body">
      @foreach($articles as $article)
        <h3>{{ $article->title }}</h3>

        {{ $article->content }}
      @endforeach
      @include('components.share')
    </div>
  </div>
</div>
@endsection
