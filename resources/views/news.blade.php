@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>News</h2>
    </div>

    <div class="card-body">
      <p>This is a news item.</p>
      @include('components.share')
    </div>
  </div>
</div>
@endsection
