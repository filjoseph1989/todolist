@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <button type="button" class="btn btn-default">
          <a href="{{ route('todo.index') }}">All Task list</a>
        </button>
      </div>
    </div>

    <br>

    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Todo List Detail</div>

          <div class="card-body">

            <p>Title: {{ $task->title }}</p>
            <p>Description: {{ $task->description }}</p>
            <p>Status: {{ $task->status }}</p>

          </div>{{-- /card-body --}}
        </div>{{-- /.card --}}

      </div>
    </div>
  </div>
@endsection
