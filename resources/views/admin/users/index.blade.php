@extends ('admin/index')
@section ("content")


<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>All Users</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">DataTables</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
            <div class="card-header">
              <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modal-default">Add User</button>
            </div>          
          <!-- /.card-header -->
          {{-- dd($users_list) --}}
          <div class="card-body">
            <table id="all-users-table" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
                @foreach($users_list as $user)
                <tr>
                  <td>{{$user->first_name}}</td>
                  <td>{{$user->last_name}}</td>
                  <td>{{$user->email}}</td>
                  <td>{{$user->country}}</td>
                  <td>{{$user->status}}</td>
                  <td>

                    <a href="" class="edit_user admin_edit_users" user_id="{{$user->id}}" first_name="{{$user->first_name}}" last_name="{{$user->last_name}}" email="{{$user->email}}" country="{{$user->country}}" user_status="{{$user->status}}">Edit</a> 

                    /                 
                    
                    <form method="get" action="{{route('admin.deleteuser', $user->id)}}">
                        @csrf
                        <input name="_method" type="hidden" value="DELETE">
                        <!-- <button type="submit" class="btn btn-xs btn-danger btn-flat show_confirm" data-toggle="tooltip" title='Delete'>Delete</button> -->
                        <a href="{{route('admin.deleteuser', $user->id)}}" class="delete_user admin_delete_users show_confirm">Delete</a>
                    </form>

                  </td>
                </tr> 
                @endforeach             
              </tbody>
              <tfoot>
              <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Country</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>

<div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add New User</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                  
                    <form id="add_new_user_form" name="add_new_user_form" action="{{route('admin.insertuser')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">                            

                            <div class="form-group">
                                <label for="Inputfirst_name">First Name</label>                                
                                    <input type="text" name="firstname" class="form-control firstname" placeholder="Enter First Name">  
                            </div>

                            <div class="form-group">
                                <label for="Inputlast_name">Last Name</label>                                
                                    <input type="text" name="lastname" class="form-control lastname" placeholder="Enter Last Name">  
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="text" name="email" class="form-control email" placeholder="Enter Email">
                            </div>  

                            <div class="form-group">
                                <label for="">Select Country</label>
                                <select class="form-control country" name="country" id="country">
                                    <option value="">Select Country</option>   
                                    <option value="uk">Uk</option>
                                <option value="india">India</option>
                                <option value="pakistan">Pakistan</option>                                 
                                </select>
                            </div>

                            <div class="form-group">
                            <label for="">Password</label>
                            <input type="Password" name="password" placeholder="Enter Password" class="form-control password">
                        </div>
                            
                            <div class="form-group">
                                <div class="form-check">
                                    <input type="radio" name="user_status" id="user_status_active" class="form-check-input user_status_active" value="active">
                                    <label class="form-check-label" for="user_status_active">Active</label>
                                </div>  
                                <div class="form-check">
                                <input type="radio" name="user_status" id="user_status_inactive" class="form-check-input user_status_inactive" value="inactive">
                                    <label class="form-check-label" for="user_status_inactive">Inactive</label>
                                </div> 
                            </div>                               

                        </div> 

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                    

                </div>            
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop