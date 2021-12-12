@extends('layouts.admin')

@section('content')


    <h1> {{$user->name}} Profile</h1>


    <form method="POST" action="{{route('user.profile.update', $user )}}"  enctype="multipart/form-data">
    
        @csrf
        @method('PUT')
        
        <div class="mb-2">  
        <img class="img-profile rounded-circle" hight='100' width='100'src="{{$user->avatar}}">
        </div>
        <div class="form-group">
            
            <input type="file" 
                    name="avatar" 
                    id="avatar" 
                    class="form-control-file">
        </div>
        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" 
                    name="username" 
                    id="user_name"  
                    class="form-control 
                    @error('username') is-invalid @enderror"
                    value = "{{$user->username}}">
                    @error('username')
                    <div class="invalid-feedback">
                    {{$message}}</div>
                    @enderror
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" 
                    name="name" 
                    id="name"  
                    class="form-control
                    @error('name') is-invalid @enderror"
                    value = "{{$user->name}}">
                    @error('name')
                    <div class="invalid-feedback">
                    {{$message}}</div>
                    @enderror
        </div>
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" 
                    name="email" 
                    id="email"  
                    class="form-control
                    @error('email') is-invalid @enderror"
                    value = "{{$user->email}}">
                    @error('email')
                    <div class="invalid-feedback">
                    {{$message}}</div>
                    @enderror
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" 
                    name="password" 
                    id="password"  
                    class="form-control
                    @error('password') is-invalid @enderror">
                    @error('password')
                    <div class="invalid-feedback">
                    {{$message}}</div>
                    @enderror
        </div>
        <div class="form-group">
            <label for="password-confirmation">Confirm Password</label>
            <input type="password" 
                    name="password-confirmation" 
                    id="password-confiramtion "  
                    class="form-control
                    @error('password-confirmation') is-invalid @enderror">
                    @error('password-confirmation')
                    <div class="invalid-feedback">
                    {{$message}}</div>
                    @enderror
        </div>

    
    <button type="submit"  class="btn btn-primary">Submit</button>
    </form>

    <div class="row">
        
        <div class="col-sm-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
                </div>
                <div class="card-body">
                <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                <th>Options</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Attach</th>
                                <th>Detach</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                <th>Options</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Attach</th>
                                <th>Detach</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach($roles as $role)
                                <tr>
                                    <td>
                                        <input type="checkbox" 
                                            @foreach($user->roles as $user_role)
                                                @if($user_role->slug == $role->slug)
                                                    checked
                                                @endif
                                            @endforeach
                                        >
                                    </td>
                                    <td>{{$role->id}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->slug}}</td>
                                    <td>

                                        <form action="{{route('user.role.attach', $user->id)}}" method='post'>
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="role" value="{{$role->id}}">
                                            <button  type="submit" class="btn btn-primary"
                                               @if($user->roles->contains($role)) 
                                                disabled
                                               @endif
                                            >
                                                Attach
                                            </button>
                                        </form>
                                    </td>

                                    <td>
                                        <form action="{{route('user.role.detach', $user)}}" method='post'>
                                            @csrf
                                            @method('PUT')

                                            <input type="hidden" name="role" value="{{$role->id}}">
                                            <button class="btn btn-danger"
                                            @if(!$user->roles->contains($role)) 
                                                disabled
                                               @endif
                                            >
                                                Detach
                                            </button>
                                        </form>
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>





@endsection 