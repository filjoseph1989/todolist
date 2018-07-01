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
          <div class="card-header">New Todo</div>

          <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif

              @if (session('status_warning'))
                  <div class="alert alert-warning" role="alert">
                      {{ session('status_warning') }}
                  </div>
              @endif

              <form class="" action="{{ route('todo.store') }}" method="post">
                @csrf

                <div class="form-group">
                  <label for="title">Title</label>
                  <input type="text" class="form-control" id="title" name="title" placeholder="Enter todo title here" required>
                </div>

                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Enter task description here" required>
                </div>

                <div class="form-group">
                  <label for="assignee">Assignee</label>
                  <select class="form-control" name="user_id">
                    <option value="0">-- Select Assignee --</option>
                    @foreach ($users as $key => $user)
                      <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Submit </button>
                </div>
              </form>

          </div>{{-- /.card-body --}}
        </div>{{-- /.card --}}

      </div>
    </div>
  </div>
@endsection
