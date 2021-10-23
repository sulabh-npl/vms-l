@extends('vendor')
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
<table id="tab" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Permission</th>
                @if (Session::get('section_id')==0)
                    <th>Section</th>
                @endif
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
                @if (Session::get('section_id')==0)
                <td>{{$user->sec_name}}</td>
                @endif
                <td><button onclick="User({{$user->id}})" class="btn btn-primary">Edit</button>
                    <button type="button" onclick="del({{$user->id}})" class="btn btn-secondary">Delete</button>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Permission</th>
                @if (Session::get('section_id')==0)
                    <th>Section</th>
                @endif
                <th>Edit</th>
            </tr>
        </tfoot>
    </table>
    <!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p><form action="/update/staff" method="POST">
        <b>Staff Detail</b><br>
        @csrf
        <input type="number" name="id" id="id" hidden>
        <label for="Name">Name: </label>
        <input type="text" name="name" id="Name"><br>
        <label for="Name">Email: </label>
        <input type="text" name="email" id="Email"><br>
        <label for="Name">Phone: </label>
        <input type="text" name="phone" id="Phone"><br>
        <label for="Name">Password: </label>
        <input type="text" name="password" placeholder="Enter new password to update " id="Password"><br>
        <label for="Permission">Permission: </label>
        <select name="per" id="Per">
            <option value="0">Admin</option>
            <option value="1">Editor</option>
            <option value="2">Viewer</option>
        </select><br>
        <button class="btn btn-primary">Save</button>
    </form></p>
    </div>

  </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        function User(id) {
            $.get("/users/"+id, function(data, status){
                var d = JSON.parse(data)[0];
                document.getElementById("Name").value = d.name;
                document.getElementById("Email").value = d.email;
                document.getElementById("Phone").value = d.phone;
                document.getElementById("Per").value = d.permission;
                document.getElementById("id").value = d.id;
            });
            // console.log(data);
          modal.style.display = "block";

        }
        function del(id){
                $.get("delete_users/"+id);
                document.getElementById(id).style.display= "none";
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
<script>
$(document).ready( function () {
    $('#tab').DataTable();
} );

</script>
@endsection
