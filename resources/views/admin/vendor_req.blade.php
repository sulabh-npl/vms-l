@extends('admin.layout')
@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <table id="tab" style="width: 99%;margin-left:1%">
      <thead>
          <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Requested Date</th>
              <th style="width: 30%">Message</th>
              @if (Session::get('admin-per')==0)
              <th>Edit/Delete</th>
              @endif
          </tr>
      </thead>
      <tbody>
          @foreach($vendors as $vendor)
          <tr>
              <td>{{$vendor->name}}</td>
              <td>{{$vendor->email}}</td>
              <td>{{$vendor->phone}}</td>
              <td>{{$vendor->address}}</td>
              <td>{{$vendor->date}}</td>
              <td>{{$vendor->message}}</td>
              {{--<td>@if ($vi->exp_date == null)
                  Not Applicable
              @endif
              {{$vi->exp_date}}</td> --}}
              {{-- <td>{{$vi->father_name }}</td> --}}
              @if (Session::get('admin-per')==0)
              <td><button onclick="add({{$vendor->id}})" class="btn btn-primary">Add</button>
                <form action="/admin/delete_vendor_req/{{$vendor->id}}" id="frm" method="post">
                    @csrf
                    <button type="button" onclick="ap()" class="btn btn-secondary">Delete</button>
                </form>
                  {{-- <a href="/admin/delete_vendor/{{$vendor->id}}"><button class="btn btn-secondary">Delete</button></a> --}}
                  </td>
              @endif
          </tr>
          @endforeach
      </tbody>
  </table>
<div id="v2">
  <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <p><form action="/admin/addVendor" enctype="multipart/form-data" method="POST">
          <h2>Add Vendor</h2><br>
          @csrf
          <input type="text" name="rid" id="ID" hidden>
          <label for="Name">Name: </label>
          <input type="text" name="name" id="Name" required><br>
          <label for="Name">Email: </label>
          <input type="text" name="email" id="Email" required><br>
          <label for="Name">Phone: </label>
          <input type="text" name="phone" id="Phone" required><br>
          <label for="Name">Address: </label>
          <input type="text" name="address" id="Address" required><br>
          <label for="Name">Expiry Date: </label>
          <input required type="date" name="exp_date" id="Date"><br>
          <label for="Name">Background Image: </label>
          <input required type="file" name="bg_img" id=""><br>
          <h2>For Primary User</h2>
             <div class="form-group">
                <label>Password</label>
                <div class="input-group" id="show_hide_password">
                <input id="pass" type="password" name="upassword" class="form-control" onkeyup="check()" placeholder="Password"><div class="input-group-addon">
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
    </p>
      </div>

    </div>
      <script>

          $("#btnSubmit").attr("disabled", true);
              function check(){
                  if(document.getElementById('pass').value == document.getElementById('repass').value){
                    $("#btnSubmit").attr("disabled", false);
                  }else{
                    $("#btnSubmit").attr("disabled", true);
                  }

              }
          // Get the modal
          var modal = document.getElementById("myModal");

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];

          // When the user clicks the button, open the modal
          function add(id) {
              $.get("/admin/vendor_reqs/"+id, function(data, status){
                  var d = JSON.parse(data)[0];
                  document.getElementById("Name").value = d.name;
                  document.getElementById("Email").value = d.email;
                  document.getElementById("Phone").value = d.phone;
                  document.getElementById("Address").value = d.address;
                  document.getElementById("ID").value = d.id;
              });
              // console.log(data);
            modal.style.display = "block";

          }
          // When the user clicks on <span> (x), close the modal
          span.onclick = function() {
            modal.style.display = "none";
          }

          // When the user clicks anywhere outside of the modal, close it
          window.onclick = function(event) {
            if (event.target == modal) {
              modal.style.display = "none";
            }
          }
          </script>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/moment/moment.js"></script>
      <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/pickday/pickday.js"></script>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css" />
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/pikaday/css/pikaday.css">
      <style>
          .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1; /* Sit on top */
        padding-top: 100px; /* Location of the box */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0,0,0); /* Fallback color */
        background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
      }

      /* Modal Content */
      .modal-content {
        background-color: #fefefe;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 40%;
      }

      /* The Close Button */
      .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
      }

      .close:hover,
      .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
      }
      </style>



</div>
</div>
</div>

<script>

function ap(){
    var r = confirm("Delete this Vendor Request");
    if(r){
        $("#frm").submit();
    }else{
        alert("Operation Cancled")
    }
}
$(document).ready( function () {
$('#tab').DataTable({
    order:[[4, "asc"], [0, "asc"]]
});
} );
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
