@extends('vendor')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
@if(Session::has('msg'))
<h4>
    {{Session::get('msg')}}
</h4>
@endif
<form action="/change_pass" method="POST">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Old Password</label>
      <input type="password" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter old password" name="old">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">New Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="New Password" name="new">
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Repeat New Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Repeat New Password" name="r_new">
      </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>

        </div>
    </div>
</div>
  @endsection
