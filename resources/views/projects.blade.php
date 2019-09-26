@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
    <div class="card-header">
      <h2>Projects</h2>
    </div>

    <div class="card-body">
      <h3>Project 1</h3>

      <p>Project details go here.</p>
      @include('components.share')
    </div>
  </div>
</div>
