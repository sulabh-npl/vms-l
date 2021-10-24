@extends("vendor")
@section('content')
<div class="section-2-container section-container" id="table">
	<div class="container">
	  <div class="row">
			<div class="col section-1 section-description wow fadeIn">
			  <h2>Visitors Record of {{$sec_name}}</h2>
			  <div class="divider-1 wow fadeInUp"><span></span></div>
			</div>
	  </div>
<div class="row">
    <div class="col-sm-12">
    <table id="tab" style="width: 100%">
      <thead>
          <tr>
              <th>Name</th>
              <th>Addressed By</th>
              <th>Document Type</th>
              <th>Document Id</th>
              {{-- <th>Document Issue Date</th>
              <th>Document Expiry Date</th> --}}
              <th>Father's Name</th>
              <th>Visited At</th>
              @if (Session::get('per')!=2)
              <th>Edit/Delete</th>
              @endif
          </tr>
      </thead>
      <tbody>
          @foreach($visitors as $vi)
          <tr>
              <td>{{$vi->name}}</td>
              <td>{{$vi->stf_name}}</td>
              <td>{{$vi->doc_type}}</td>
              <td>{{$vi->doc_id}}</td>
              {{-- <td>{{$vi->issue_date}}</td>
              <td>@if ($vi->exp_date == null)
                  Not Applicable
              @endif
              {{$vi->exp_date}}</td> --}}
              <td>{{$vi->father_name }}</td>
              <td>{{$vi->date}}-{{$vi->time}}</td>
              @if (Session::get('per')!=2)
              <td><button onclick="edit({{$vi->id}})" class="btn btn-primary">Edit</button>
                  <a href="/delete_visitor/{{$vi->id}}"><button class="btn btn-secondary">Delete</button></a>
                  </td>
              @endif
          </tr>
          @endforeach
      </tbody>
  </table>
</div>
</div>
<div id="v2">
  <div id="myModal" class="modal">

      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
        <p><form action="/update/visitor" method="POST">
          <b>Visitor Detail</b><br>
          @csrf
          <input type="number" name="id" id="ID" hidden>
          <label for="Name">Name: </label>
          <input type="text" name="name" id="Name"><br>
          <label for="Name">Visited Date: </label>
          <input type="date" name="date" id="Date"><br>
          <label for="Name">Visited Time: </label>
          <input type="text" name="time" id="Time"><br>
          <label for="Name">Document-type: </label>
          <input type="text" name="doc_type" id="Doc_type"><br>
          <label for="Name">Document-Id: </label>
          <input type="text" name="doc_id" placeholder="" id="Doc_id"><br>
          <label for="Name">Issue Date: </label>
          <input type="date" name="issue_date" placeholder="" id="Issue_date"><br>
          <div id="exp"></div>
          <label for="Permission">Father's Name: </label>
          <input type="text" name="fname" placeholder="" id="Fname"><br>
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
          function edit(id) {
              $.get("/visitors/"+id, function(data, status){
                  var d = JSON.parse(data)[0];
                  document.getElementById("Name").value = d.name;
                  document.getElementById("Date").value = d.date;
                  document.getElementById("Time").value = d.time;
                  document.getElementById("Doc_type").value = d.doc_type;
                  document.getElementById("Doc_id").value = d.doc_id;
                  document.getElementById("Fname").value = d.father_name;
                  document.getElementById("Issue_date").value = d.issue_date;
                  document.getElementById("ID").value = id;
                  if(d.doc_type != "Citizenship"){
                      document.getElementById("exp").innerHTML=`
                          <label for="Name">Expiry Date: </label>
                          <input type="date" name="exp_date" placeholder="" value="${d.exp_date}"><br>
                      `;
                  }
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



</div>
</div>
</div>

<script>

$(document).ready( function () {
$('#tab').DataTable();
} );
</script>

@endsection
