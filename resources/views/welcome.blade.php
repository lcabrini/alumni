@extends('layouts.app')

@section('head')

@endsection

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>Welcome!</h2>
    </div>
    <div class="card-body">
      <p>This is a placeholder news item.</p>
      @include('components.share')
    </div>
  </div>
</div>
@endsection
