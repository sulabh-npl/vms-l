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
<?php phpinfo(); ?>
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
            <tr>
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
                <td><button onclick="User({{$user->id}})" class="btn btn-primary">Edit</button></td>
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
      <p>
        <b>Staff Detail</b><br>
        <label for="Name">Name: </label>
        <input type="text" name="" id="name"><br>
        <label for="Name">Email: </label>
        <input type="text" name="" id="Email"><br>
        <label for="Name">Phone: </label>
        <input type="text" name="" id="Phone"><br>
        <label for="Name">Password: </label>
        <input type="text" name="" id="Password"><br>
        <label for="Permission">Permission: </label>
        <select name="per" id="per">
            <option value="0">Admin</option>
            <option value="1">Editor</option>
            <option value="2">Viewer</option>
        </select><br>
    </p>
    </div>

  </div>
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        function User(id) {
            var data = {{{$staff_json}}}
            console.log(data);
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
<script>
$(document).ready( function () {
    $('#tab').DataTable();
} );

</script>
@endsection
