@extends('admin.layout')
@section('content')
        <h1>Dashboard</h1>
        <div class="row" style="margin-top: 30px">
            <div class="col-sm-3">
                <a href="/admin/list">
                  <div class="card text-right" style="width: 95%;margin-left:2.5%">
                    <div class="card-body">
                      <h4 class="card-title">Total Vendors</h4>
                      <button class="btn btn-primary" >{{$t}}</button>
                    </div>
                  </div>
                </a>
              </div>
              <div class="col-sm-3">
                  <div class="card text-right" style="width: 95%;margin-left:2.5%">
                      <div class="card-body" onclick="exp_box()">
                        <h5 class="card-title">Vendors Expiring Soon</h5>
                        <button class="btn btn-primary" >{{$te}}</button>
                      </div>
                    </div>
              </div>
              <div class="col-sm-3">
                  <div class="card text-right" style="width: 95%;margin-left:2.5%">
                      <div class="card-body">
                        <h4 class="card-title">Today visitors</h4>
                        <button class="btn btn-primary" >{{$data->d0}}</button>
                      </div>
                    </div>
              </div>
              <div class="col-sm-3">
                  <div class="card text-right" style="width: 102.5%;margin-left:-2.5%">
                      <div class="card-body">
                        <h4 class="card-title">Total visitors</h4>
                        <button class="btn btn-primary" >{{$data->total}}</button>
                      </div>
                    </div>
              </div>
           </div>
        <div class="row">
                <div class="col-sm-12">
                <div id="piechart" style="width: 130%; margin-left:-15%"></div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        const yourDate = new Date()
        yourDate.toISOString().split('T')[0];
      var data = google.visualization.arrayToDataTable([
        ["Date", "Visitors" ],
        ["{{date('Y-m-d', strtotime('-6 day', strtotime($data->date)))}}", {{$data->d6}}],
        ["{{date('Y-m-d', strtotime('-5 day', strtotime($data->date)))}}", {{$data->d5}}],
        ["{{date('Y-m-d', strtotime('-4 day', strtotime($data->date)))}}", {{$data->d4}}],
        ["{{date('Y-m-d', strtotime('-3 day', strtotime($data->date)))}}", {{$data->d3}}],
        ["{{date('Y-m-d', strtotime('-2 day', strtotime($data->date)))}}", {{$data->d2}}],
        ["{{date('Y-m-d', strtotime('-1 day', strtotime($data->date)))}}", {{$data->d1}}],
        ["{{date('Y-m-d', strtotime('-0 day', strtotime($data->date)))}}", {{$data->d0}}]
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1]);

      var options = {
        title: "Visitor Data Stored in past 7 Days",
        height: 400,
        bar: {groupWidth: "95%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("piechart"));
      chart.draw(view, options);
  }
                </script>
                </div>
                <div class="col-md-12">
<h2>Recently Added Data</h2>
                    <table id="res" class="display">
                        <thead>
                            <tr>
                                <th>Registered Date</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                @if (Session::get('admin-per')==0)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($v as $vd)
                                <tr>
                                    <td>{{$vd->registered_date}}</td>
                                    <td>{{$vd->name}}</td>
                                    <td>{{$vd->email}}</td>
                                    <td>{{$vd->phone}}</td>
                                    <td>{{$vd->address}}</td>
                                    @if (Session::get('admin-per')==0)
                                    <td><button onclick="edit({{$vd->id}})" class="btn btn-primary">Edit</button>
                                    <form action="/admin/delete_vendor/{{$vd->id}}" id="frm" method="post">
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
                </div>

<div id="dialog" title="Basic dialog">
<table id="exp" class="display">
<thead>
    <tr>
        <th>Expiry Date</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Address</th>
        @if (Session::get('admin-per')==0)
        <th>Action</th>
        @endif
    </tr>
</thead>
<tbody>
    @foreach ($e as $ed)
        <tr>
            <td>{{$ed->exp_date}}</td>
            <td>{{$ed->name}}</td>
            <td>{{$ed->email}}</td>
            <td>{{$ed->phone}}</td>
            <td>{{$ed->address}}</td>
            @if (Session::get('admin-per')==0)
            <td><button onclick="edit({{$ed->id}})" class="btn btn-primary">Edit</button>
            <form action="/admin/delete_vendor/{{$ed->id}}" id="frm" method="post">
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
</div>
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
      <span class="close">&times;</span>
      <p><form action="/admin/update_vendor" enctype="multipart/form-data" method="POST">
        <b>Vendor Detail</b><br>
        @csrf
        <input type="number" name="id" id="ID" hidden>
        <label for="Name">Name: </label>
        <input type="text" name="name" id="Name" required><br>
        <label for="Name">Email: </label>
        <input type="text" name="email" id="Email" required><br>
        <label for="Name">Phone: </label>
        <input type="text" name="phone" id="Phone" required><br>
        <label for="Name">Address: </label>
        <input type="text" name="address" id="Address" required><br>
        <label for="Name">Expiry Date: </label>
        <input type="date" name="exp_date" id="Date"><br>
        <img src="" style="width: 40%" id="bg_img" alt="image"><br>
        <label for="Name">Background Image: </label>
        <p>Add image to change</p>
        <input type="file" name="bg_img" id=""><br>
        <button class="btn btn-primary">Save</button>
    </form></p>
    </div>
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

      #dialog{
          display: none;
      }
</style>
      <script>
          // Get the modal
          var modal = document.getElementById("myModal");

          // Get the <span> element that closes the modal
          var span = document.getElementsByClassName("close")[0];

          // When the user clicks the button, open the modal
          function edit(id) {
              $.get("/admin/vendors/"+id, function(data, status){
                  if ($('#dialog').dialog('isOpen') === true) {
                      $("#dialog").dialog('close');
                  }
                  modal.style.display = "block";
                  var d = JSON.parse(data)[0];
                  document.getElementById("Name").value = d.name;
                  document.getElementById("Email").value = d.email;
                  document.getElementById("Phone").value = d.phone;
                  document.getElementById("Address").value = d.address;
                  document.getElementById("Date").value = d.exp_date;
                  document.getElementById("bg_img").src = "/images/"+d.id+".jpg";
                  document.getElementById("ID").value = d.id;
              });
              // console.log(data);

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

          function exp_box(){
            alert("clicked");
            $( "#dialog" ).attr("title", "They Are Expiring Soon").dialog('open');
          }

$(document).ready( function () {
    $('#dialog').dialog({
        autoOpen:false,
        width:1000,
        height:600,
        position:({at: 'right center'}),
    });
    $('#exp').DataTable();
$('#res').DataTable({
    order: [[0, "desc"], [1, "asc"]]
});
} );
      </script>
  @endsection
