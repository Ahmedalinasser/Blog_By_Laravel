

@extends('layouts.admin')

@section('content')
    <h1>Users</h1>
    @if(session('user-deleted'))
    <div class="alert alert-danger">{{session('user-deleted')}} </div>
    @endif

  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Users</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>ID</th>
              <th>Username</th>
              
              <th>Avatar</th>
              <th>Name</th>
              <th>Register Date</th>
              <th>Updated Profile At</th>
              <th>Delete</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>ID</th>
              <th>Username</th>
              
              <th>Avatar</th>
              <th>Name</th>
              <th>Register Date</th>
              <th>Updated Profile At</th>
              <th>Delete</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($users as $user)
            <tr>
              
              <td>{{$user->id}}</td>
              <td>{{$user->username}}</td>
              
              <td>
                  <img src="{{$user->avatar}}" height="38px" width="38"alt="">
                </td>
              <td>{{$user->name}}</td>
              <td>{{$user->created_at->diffForhumans()}}</td>
              <td>{{$user->updated_at->diffForhumans()}}</td>
              <th> 
                <form action="{{route('user.destroy', $user->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger">Delete</button>  
                </form>
              </th>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

@endsection

    @section('script')

    <!-- Page level plugins -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

  <!-- Page level custom scripts -->
  <script src="{{asset('js/demo/datatables-demo.js')}}"></script>

@endsection 