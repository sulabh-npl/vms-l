@extends('vendor')
@section('content')
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<script src="https://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
  <style>
    #dialog{
        display: none;
    }
</style>
<div class="row">
    <div class="col-sm-4">
      <img src="/assets/ico/favicon-2.png" style="margin-top: 10%;" alt="">
    </div>
    <div class="col-sm-8" style="display: flex;align-items:flex-start; flex-direction: column;">
      <h2>{{Session::get('utitle')}} @if(Session::get('per') == 0 && Session::get('section_id')== 0) <button class="btn btn-primary" onclick="edit()">Edit</button>

<div id="dialog" title="Change Details">
    <form action="/update_details" enctype="multipart/form-data" method="POST">
        <b>Vendor Detail</b><br>
        @csrf
        <input type="text" name="id" value="{{Session::get('uid')}}" hidden>
        <label for="Name">Name: </label>
        <input type="text" name="name" id="Name" value="{{Session::get('utitle')}}" required><br>
        <label for="Name">Email: </label>
        <input type="text" name="email" id="Email" value="{{$d->email}}" required><br>
        <label for="Name">Phone: </label>
        <input type="text" name="phone" id="Phone" value="{{$d->phone}}" required><br>
        <label for="Name">Address: </label>
        <input type="text" name="address" value="{{$d->address}}" id="Address" required><br>
        <label for="Name">Expiry Date: </label>
        <input type="date" name="exp_date" value="{{$d->exp_date}}" id="Date" disabled><br>
        <img src="/images/{{Session::get('uid')}}.jpg" style="width: 40%" id="bg_img" alt="image"><br>
        <label for="Name">Background Image: </label>
        <p>Add image to change</p>
        <input type="file" name="bg_img" id=""><br>
        <button class="btn btn-primary">Save</button>
    </form>
  </div>
        @endif </h2>
      <h4><strong>Expires At:</strong> {{$d->exp_date}}</h4>
      <p><strong>Email  :</strong> {{$d->email}}</p>
      <p><strong>Phone  :</strong> {{$d->phone}}</p>
      <p><strong>Address:</strong> {{$d->address}}</p>
    </div>
  </div>
  <script>

function edit() {
    $( "#dialog" ).attr("title", "What's Next?").dialog();
}
  </script>
    @endsection
