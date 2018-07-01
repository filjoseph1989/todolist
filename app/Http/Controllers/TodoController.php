<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Todo;
use App\Models\User;
use App\Traits\ValidationTrait;
use Illuminate\Http\Request;

/**
 * Generated todo controller class
 *
 * @author Fil <filjoseph22@gmail.com>
 * @version 1.0.0
 * @date July 1, 2018
 */
class TodoController extends Controller
{
    use ValidationTrait;

    /**
     * Initiate instance
     */
    public function __construct()
    {
      return $this->middleware('auth');
    }

    /**
     * Display the list of task.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $tasks = Todo::with('user')
        ->get();

      return view('todo/index')->with([
        'tasks' => $tasks,
      ]);
    }

    /**
     * Show the form for creating new task
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $users = User::all();

      return view('todo/create')->with([
        'users' => $users,
      ]);
    }

    /**
     * Store a new task
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        self::check($this, $request);

        $data = $request->only(['user_id', 'title', 'description']);

        if ( $data['user_id'] == 0 ) {
          unset( $data['user_id'] );
        }

        $result = Todo::create($data);

        if ( $result->wasRecentlyCreated ) {
          $status = "status";
          $message = "Successfully created a new task";
        } else {
          $status = "status_warning";
          $message = "Unsuccessfully created a new task";
        }

        return back()->withInput()->with($status, $message);
    }

    /**
     * Display task detail
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $task = Todo::find($id);

      return view('todo/show')->with(
        ['task' => $task,]
      );
    }

    /**
     * Show the form for editing todo list.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $task = Todo::with('user')
        ->whereId($id)
        ->get()
        ->first();

      $users = User::all();

      return view('todo/edit')->with([
        'task'  => $task,
        'users' => $users
      ]);
    }

    /**
     * Update task in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      self::check($this, $request);

      $data = $request->only(['user_id', 'title', 'description', 'status']);

      if ( $data['user_id'] == 0 ) {
        unset( $data['user_id'] );
      }

      $task              = Todo::find($id);
      $task->title       = $data['title'];
      $task->description = $data['description'];
      $task->status      = $data['status'];

      if ( $data['user_id'] != 0 ) {
        $task->user_id = $data['user_id'];
      }

      if ( $task->save() ) {
        $status = "status";
        $message = "Successfully updated a new task";
      } else {
        $status = "status_warning";
        $message = "Unsuccessfully updated a new task";
      }

      return back()->withInput()->with($status, $message);
    }

    /**
     * Remove task in the database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $task = Todo::find($id);
      $task->delete();

      return back()
        ->with([
          'status' => 'Successfully deleted task'
        ]);
    }
}
