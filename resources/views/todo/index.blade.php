@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <button type="button" class="btn btn-default">
          <a href="{{ route('todo.create') }}">New Task</a>
        </button>
      </div>
    </div>

    <br>
    
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">Todo List</div>

          <div class="card-body">
              @if (session('status'))
                  <div class="alert alert-success" role="alert">
                      {{ session('status') }}
                  </div>
              @endif

              <table class="table">

                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Assignee</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach ($tasks as $key => $task)
                    <tr>
                      <td>{{ ucwords($task->title) }}</td>
                      <td>{{ ucfirst($task->description) }}</td>
                      <td>{{ ucwords( $task->user->name ) }}</td>
                      <td>{{ $task->status }}</td>
                      <td>
                        <div class="dropdown">
                          <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Action
                          </button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('todo.show', $task->id) }}">View</a>
                            <a class="dropdown-item" href="{{ route('todo.edit', $task->id) }}">Edit</a>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('delete-{{ $key }}').submit();">Delete</a>
                            <form id="delete-{{ $key }}" class="" action="{{ route('todo.destroy', $task->id) }}" method="post" hidden>
                              @csrf
                              @method('DELETE')
                            </form>
                          </div>
                        </div>
                      </td>
                    </tr>
                  @endforeach
                </tbody>

              </table>{{-- /table --}}

          </div>{{-- /card-body --}}
        </div>{{-- /.card --}}

      </div>
    </div>
  </div>
@endsection
