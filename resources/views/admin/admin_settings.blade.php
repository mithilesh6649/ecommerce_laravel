@extends('layouts.admin_layout.admin_layout')

@section("custom-js")
 <script src="{{ url('js/admin_js/admin_script.js') }}" ></script>
@endsection


@section('content')
  

 
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin settings</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="row">
        <div class="col-md-3" ></div>
        <div class="col-md-6" >
         
         <?php
         
//echo $AdminDetails;
//  $data =  Session::all();
//    echo "<pre>";
//    print_r($data); 


  // $data = Auth::guard('admin')->user();
  // echo "<pre>";
  // print_r($data);
?>

            <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Update Password</h3>
                </div>
               
                <!-- fetch session and show error messsage -->
                 
                @if(Session::has('error_message'))
                  
                <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                  <strong> Warning !</strong> {{ Session()->get('error_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

                @endif

                   
                @if(Session::has('success_message'))
                  
                <div class="alert alert-success alert-dismissible fade show mt-2" role="alert">
                  <strong> Warning !</strong> {{ Session()->get('success_message') }}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>

                @endif

                <!-- /.card-header -->
                <!-- form start -->
                <form role="form" method="post" action="{{route('admin.update-current-pwd')}}" name="updatePasswordForm" id="updatePasswordForm">
                   @csrf
                  <div class="card-body">
                     
                    {{-- <div class="form-group">
                      <label for="exampleInputEmail1">Admin Name</label>
                      <input type="text" class="form-control"   name="admin_name" value="{{$AdminDetails->name}}" placeholder="Enter Admin/Sub Admin Name"  id="admin_name">
                    </div> --}}
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admin Email</label>
                      <input type="email" class="form-control"   name="email" value="{{$AdminDetails->email}}" readonly >
                    </div>
                    
                    <div class="form-group">
                      <label for="exampleInputEmail1">Admin Type</label>
                      <input type="text" class="form-control"   name="admin_type" value="{{$AdminDetails->type}}"  readonly>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1"> Current Password</label>
                      <input type="password" name="current_pwd" class="form-control" id="current_pwd" placeholder="Enter Current Password">
                       <p class="password-notice"></p>
                    </div>
                
                    <div class="form-group">
                      <label for="exampleInputPassword1">New Password</label>
                      <input type="password" name="new_pwd" class="form-control" id="new_pwd" placeholder="Password">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1"> Confirm Password</label>
                      <input type="password" name="confirm_pwd" id="confirm_pwd" class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>

               
                  </div>
                  <!-- /.card-body -->
  
                  <div class="card-footer">
                    <button type="submit" class="btn btn-primary pwd_submit_btn"  >Submit</button>
                  </div>
                </form>
              </div>
        </div>
        <div class="col-md-3" ></div>
    </div>   
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->


@endsection  