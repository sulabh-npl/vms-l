@extends('admin.super-admin');
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<h2>Add Vendor Page</h2>

          <form enctype="multipart/form-data" method="POST">
              @csrf
             <div class="form-group">
                <label>Vendor Name</label>
                <input type="text" name="name" class="form-control" placeholder="Vendor Name">
             </div>
             <div class="form-group">
                <label>Vendor Phone</label>
                <input type="text" name="phone" class="form-control" placeholder="Vendor Phone">
             </div>
             <div class="form-group">
                <label>Vendor Email</label>
                <input type="email" name="email" class="form-control" placeholder="Vendor Email">
             </div>
             <div class="form-group">
                <label>Vendor Address</label>
                <input type="text" name="address" class="form-control" placeholder="Vendor Address">
             </div>
             <div class="form-group">
                <label>Background Image</label>
                <input type="file" name="bg_img" class="form-control" placeholder="Image">
             </div>
             <div class="form-group">
                <label>Expires At</label>
                <input type="date" name="exp_date" class="form-control" placeholder="expiry date">
             </div>
             <hr><hr>
             <h2>Add User Detail for Vendor</h2>
             <div class="form-group">
                <label>User Name</label>
                <input type="text" name="uname" class="form-control" placeholder="User Name">
             </div>
             <div class="form-group">
                <label>User Phone</label>
                <input type="text" name="uphone" class="form-control" placeholder="User Phone">
             </div>
             <div class="form-group">
                <label>User Email</label>
                <input type="email" name="uemail" class="form-control" placeholder="User Email">
             </div>
             <div class="form-group">
                <label>User Password</label>
                <input type="password" name="upassword" class="form-control" placeholder="User Password">
             </div>
             <button type="submit" class="btn btn-black">Login</button>
          </form>
@endsection
