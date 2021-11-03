@extends('admin.layout')
@section('content')
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
  width: 80%;
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
<h2><b>@if(isset($_GET['error']))<span style="color: red">{{$_GET['error']}}</span>@endif @if(isset($_GET['success']))<span style="color: green">{{$_GET['success']}}</span>@endif</b></h2>
<table id="tab" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Permission</th>
                <th>Edit</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr id="{{$user->id}}">
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->phone}}</td>
                <td>@switch($user->permission)
                    @case(1)
                        Editor
                        @break
                    @case(2)
                        Viewer
                        @break
                    @default
                        Admin
                @endswitch</td>
                <td><div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Action
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item" onclick="edit({{$user->id}})">Edit</a>
                      @if(Session::get('per') == 0)
                      <a class="dropdown-item" onclick="reset({{$user->id}})">Reset Password</a>
                      <form action="/admin/delete_user/{{$user->id}}" id="frm" method="post">
                        @csrf
                        <button type="button" onclick="ap()" class="dropdown-item">Delete</button>
                    </form>

                      @endif
                    </div>
                  </div></td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Permission</th>
                <th>Edit</th>
            </tr>
        </tfoot>
    </table>
    <!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p><form action="/admin/update/staff" method="POST">
        <b>Staff Detail</b><br>
        @csrf
        <input type="number" name="id" id="id" hidden>
        <label for="Name">Name: </label>
        <input type="text" name="name" id="Name"><br>
        <label for="Name">Email: </label>
        <input type="text" name="email" id="Email"><br>
        <label for="Name">Phone: </label>
        <input type="text" name="phone" id="Phone"><br>
        <label for="Permission">Permission: </label>
        <select name="per" id="Per">
            <option value="0">Admin</option>
            <option value="2">Viewer</option>
        </select><br>
        <button class="btn btn-primary">Save</button>
    </form></p>
    </div>

  </div>

<div id="myModal2" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p><form id="res" action="/admin/reset/staff" method="POST">
        <b>Reset Password</b><br>
        @csrf
        <input type="number" name="id" id="id2" hidden>
        <label for="Name">Your Password: </label>
        <input type="password" name="mypass"><br>
        <label for="Name">Password: </label>
        <input type="text" name="pass"><br>
        <label for="Name">Confirm Password: </label>
        <input type="text" name="repass"><br>
        <button id="sub_re" type="button" class="btn btn-primary">Save</button>
    </form></p>
    </div>

  </div>
    <script>
        $("#Area2").change( function (){

            if($("#Area2").val() == 0){
                $('select[name="per"]').show();
                $('option[value="2"]').text("Super Viewer");
                $('label[for="Permission"]').show();
            }else{
                $('select[name="per"]').val(2);
                $('select[name="per"]').hide();
                $('label[for="Permission"]').hide();
            }
        })
        // Get the modal
        var modal = document.getElementById("myModal");
        var modal2 = document.getElementById("myModal2");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];
        var span2 = document.getElementsByClassName("close")[1];

        // When the user clicks the button, open the modal
        function edit(id) {
            $.get("/admin/users/"+id, function(data, status){
                var d = JSON.parse(data)[0];
                document.getElementById("Name").value = d.name;
                document.getElementById("Email").value = d.email;
                document.getElementById("Phone").value = d.phone;
                document.getElementById("Per").value = d.permission;
                document.getElementById("id").value = d.id;
                modal.style.display = "block";
            });
            // console.log(data);


        }
        function reset(id){
            $.get("/admin/users/"+id, function(data, status){
                var d = JSON.parse(data)[0];
                document.getElementById("id2").value = d.id;
            modal2.style.display = "block";

            });
        }
        function del(id){
                $.get("admin/delete_users/"+id);
                document.getElementById(id).style.display= "none";
            }
        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
          modal.style.display = "none";
        }
        span2.onclick = function() {
          modal2.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
          if (event.target == modal) {
            modal.style.display = "none";
            modal2.style.display = "none";
          }
        }
        $('#sub_re').click(function(){
            if($('input[name="pass"]').val() ==""){
                alert("Password Can't be empty")
            }else if($('input[name="pass"]').val() ==$('input[name="repass"]').val() ){
                $('#res').submit();
            }else{
                alert("Passwords Don't Match");
            }
        })
        function ap(){
            var r = confirm("Delete this Visitor Record");
            if(r){
                $("#frm").submit();
            }else{
                alert("Operation Cancled")
            }
        }
        </script>
<script>
$(document).ready( function () {
    $('#tab').DataTable();
} );

</script>
@endsection
