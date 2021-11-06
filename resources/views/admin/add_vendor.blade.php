@extends('admin.layout');
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<h2>Add Vendor Company</h2>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6">
          <form enctype="multipart/form-data" method="POST">
              @csrf
             <div class="form-group">
                <label>Company Name</label>
                <input required type="text" name="name" class="form-control" placeholder="Company Name">
             </div>
             <div class="form-group">
                <label>Company Phone</label>
                <input required type="text" name="phone" class="form-control" placeholder="Company Phone">
             </div>
             <div class="form-group">
                <label>Company Email</label>
                <input required type="email" name="email" class="form-control" placeholder="Company Email">
             </div>
             <div class="form-group">
                <label>Company Address</label>
                <input required type="text" name="address" class="form-control" placeholder="Company Address">
             </div>
             <div class="form-group">
                <label>Background Image</label>
                <input type="file" name="bg_img" class="form-control" placeholder="Image">
             </div>
             <div class="form-group">
                <label>Expires At</label>
                <input required type="date" name="exp_date" class="form-control" placeholder="expiry date">
             </div>
             <hr>
             <h2>For Primary User</h2>
             <div class="form-group">
                <label>Password</label>
                <div class="input-group" id="show_hide_password">
                <input id="pass" type="password" name="upassword" class="form-control" onkeyup="check() placeholder="Password"><div class="input-group-addon">
                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                  </div>
                </div>
             </div>
             <div class="form-group">
                <label>Repeat Password</label>
                <div class="input-group" id="show_hide_password">
                <input id="repass" type="password" name="upassword" class="form-control" onkeyup="check()" placeholder="Repeat Password"><div class="input-group-addon">
                    <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                  </div>
                </div>
             </div>
             <hr>
             <button type="submit" id="btnSubmit" class="btn btn-black">Add</button>
          </form>
        </div></div>
          <script>
              $("#btnSubmit").attr("disabled", true);
              function check(){
                  if(document.getElementById('pass').value == document.getElementById('repass').value){
                    $("#btnSubmit").attr("disabled", false);
                  }else{
                    $("#btnSubmit").attr("disabled", true);
                  }

              }
              $(document).ready(function() {
                $("#show_hide_password a").on('click', function(event) {
                    event.preventDefault();
                    if($('#show_hide_password input').attr("type") == "text"){
                        $('#show_hide_password input').attr('type', 'password');
                        $('#show_hide_password i').addClass( "fa-eye-slash" );
                        $('#show_hide_password i').removeClass( "fa-eye" );
                    }else if($('#show_hide_password input').attr("type") == "password"){
                        $('#show_hide_password input').attr('type', 'text');
                        $('#show_hide_password i').removeClass( "fa-eye-slash" );
                        $('#show_hide_password i').addClass( "fa-eye" );
                    }
                });
            });
          </script>
@endsection
