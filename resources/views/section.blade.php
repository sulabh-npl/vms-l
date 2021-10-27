@extends("vendor")
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>

<style>.fe{
    display: none;
   }
   .custom{
       margin: 15px;
       width: 30%;
   }
   #dialog{
       display: none;
   }
   .dataTables_filter {
       display: none;
   }
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
   <h1>{{$_GET['name']}}</h1>
    @if(Session::get('per')==0)
   <form action="/rename?name={{$_GET['name']}}" id="f" method="post">
    @csrf
    <input type="text" id="act" name="act" style="display: none">
    <label for="">To Rename Section</label>
    <input type="text" name="re_name" id="r" placeholder="Enter New Name for section" class="form-control" style="margin-left: auto; margin-right:auto;width:50%" />
    <button type="button" class="btn btn-primary" id="re" onclick="rename()">Rename</button><button type="button" onclick="del()" class="btn btn-secondary">Delete</button>
</form>
@endif
<div id="dialog" title="Basic dialog">
    <p>Do you want to make changes in Previos Data Also?</p>
    <button class="btn btn-primary" id="sub" data="1">Yes</button>
    <button class="btn btn-secondary" id="sub" data="0">No</button>
  </div>
<div class="section-2-container section-container" id="table">
	<div class="container">
	  <div class="row">
			<div class="col section-1 section-description wow fadeIn">
			  <h2>Visitors Record</h2>
			  <div class="divider-1 wow fadeInUp"><span></span></div>
              <div class="input-group">
                <div class="form-outline custom">
                  <input type="search" id="form0" data="0" placeholder="Search By Name" class="form-control column-filter" />
                </div>
                <div class="form-outline custom">
                  <input type="search" id="form1" data="1" placeholder="Search By Gender" class="form-control column-filter" />
                </div>
                <div class="form-outline custom">
                  <input type="search" id="form3" data="3" placeholder="Search By Addresser" class="form-control column-filter" />
                </div>
                <div class="form-outline custom">
                  <input type="search" id="form4" data="4" placeholder="Search By Document Type" class="column-filter form-control" />
                </div>
                <div class="form-outline custom">
                  <input type="search" id="form5" data="5" placeholder="Search By Document Id" class="form-control column-filter" />
                </div>
                <div class="form-outline custom">
                  <input type="search" id="form6" data="6" placeholder="Search By Visited Date time" class="form-control column-filter" />
                </div>
              </div>
			</div>
	  </div>
      <div class="row">
          <table id="tab" style="width: 110%;margin-left:-5%">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    {{-- @if (Session::get('section_id')==0) --}}
                    <th>Visited Area</th>
                    {{-- @endif --}}
                    <th width="50">Addressed By</th>
                    <th>Document Type</th>
                    <th>Document Id</th>
                    {{-- <th>Document Issue Date</th>
                    <th>Document Expiry Date</th> --}}
                    {{-- <th>Father's Name</th> --}}
                    <th>Visited At</th>
                    <th>View in detail</th>
                    @if (Session::get('per')!=2)
                    {{-- <th>Edit/Delete</th> --}}
                    @endif
                </tr>
            </thead>
            <tbody>
                @foreach($visitors as $vi)
                <tr>
                    <td>{{$vi->name}}</td>
                    <td>{{$vi->sex}}</td>
                    {{-- @if (Session::get('section_id')==0) --}}
                    <td>{{$vi->section_name}}</td>
                    {{-- @endif --}}
                    <td width="50px">{{$vi->addresser}}</td>
                    <td>{{$vi->doc_type}}</td>
                    <td>{{$vi->doc_id}}</td>
                    {{-- <td>{{$vi->issue_date}}</td>
                    <td>@if ($vi->exp_date == null)
                        Not Applicable
                    @endif
                    {{$vi->exp_date}}</td> --}}
                    {{-- <td>{{$vi->father_name }}</td> --}}
                    <td>{{$vi->date}} {{$vi->time}}</td>
                    <td><button onclick="View({{$vi->id}})" class="btn btn-primary" style="background-color:#FC7034;border:none">View</button></td>
                    {{-- @if (Session::get('per')!=2)
                    <td><button onclick="edit({{$vi->id}})" class="btn btn-primary" style="background-color:#FC7034;border:none">Edit</button>
                        <a href="/delete_visitor/{{$vi->id}}"><button class="btn btn-secondary" style="border: none">Delete</button></a>
                        </td>
                    @endif --}}
                </tr>
                @endforeach
            </tbody>
        </table>
      </div>
    <div id="v2">
        <div id="myModal" class="modal">

            <!-- Modal content -->
            <div class="modal-content">
              <span class="close">&times;</span>
              <p>
                  <b>Name: </b><span id="Name"></span><br>
                  <b>Name in Chinese: </b><span id="Name_ch"></span><br>
                  <b>Gender: </b><span id="Sex"></span><br>
                  <b>Father's Name: </b><span id="Fname"></span><br>
                  <b>Document Type: </b><span id="Doc_type"></span><br>
                  <b>Document Id: </b><span id="Doc_id"></span><br>
                  <b>Expiry Date: </b><span id="Exp_date"></span><br>
                  <b>Issued Date: </b><span id="Issue_date"></span><br>
                  <b>Date Of Birth: </b><span id="DOB"></span><br>
                  <br>
                  <b>Phone: </b><span id="Phone"></span><br>
                  <b>Address: </b><span id="Address"></span><br>
                  <br>
                  <b>Addressed By: </b><span id="Addresser"></span><br>
                  <b>Visited Area: </b><span id="Section_name"></span><br>
                  <b>Visited at: </b><span id="Date_time"></span><br>
                  <br>
                  <b>Purpose of visit</b><br>
                  <span id="Purpose"></span>
                  {{-- <form action="/update/visitor" method="POST">
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
            </form> --}}
            </p>
            </div>

          </div>
            <script>
                // Get the modal
                var modal = document.getElementById("myModal");

                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];

                // function View(id){
                //     alert(id);

                //     modal.style.display = "block";
                // }
                // When the user clicks the button, open the modal
                function View(id) {
                    $.get("/visitors/"+id, function(data, status){
                        var d = JSON.parse(data)[0];
                        document.getElementById("Name").innerHTML = d.name;
                        document.getElementById("Name_ch").innerHTML = d.name_ch;
                        document.getElementById("Sex").innerHTML = d.sex;
                        document.getElementById("Fname").innerHTML = d.father_name;
                        document.getElementById("Doc_type").innerHTML = d.doc_type;
                        document.getElementById("Doc_id").innerHTML = d.doc_id;
                        document.getElementById("Issue_date").innerHTML = d.issue_date;
                        if(d.doc_type != "Citizenship"){
                            document.getElementById("Exp_date").innerHTML=d.exp_date;
                        }else{
                            document.getElementById("Exp_date").innerHTML="Not Applicable";
                        }
                        document.getElementById("DOB").innerHTML = d.dob;

                        document.getElementById("Phone").innerHTML = d.phone;
                        document.getElementById("Address").innerHTML = d.address;

                        document.getElementById("Addresser").innerHTML = d.addresser;
                        document.getElementById("Section_name").innerHTML = d.section_name;
                        document.getElementById("Date_time").innerHTML = d.date+" "+d.time;

                        document.getElementById("Purpose").innerHTML = d.purpose;
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



                var yourDate = new Date()
yourDate = yourDate.toISOString().split('T')[0];
    // DataTable
    function filterColumn ( i ) {
        $('#tab').DataTable().column( i ).search(
            $('#form'+i).val()
        ).draw();
    }
    function defaultColumn () {
        $('#tab').DataTable({order: [6,"desc"]});
        // $('#tab').DataTable({order: [6,"desc"]}).column(6).search(
        //     yourDate
        // ).draw();
    }
    defaultColumn();
    filterColumn(0);
    window.onload = function() {
        $('input.column-filter').on( 'keyup click', function () {
            // alert($('#form'+ $(this).attr('data')).val() )
            filterColumn( $(this).attr('data') );
        } );

    }
function del() {
    var re = confirm("Are you sure that you want to delete this section");
    if(re == true){
        window.location.replace("/delete_sec/{{$_GET['name']}}");
    }
}
$("#re").attr('disabled','true')
$("#r").keyup(function () {
    if($(this).val !=""){
        $("#re").removeAttr('disabled')
    }else{
        $("#re").attr('disabled','true')
    }
})
$('#dialog button').click(function(){
    $('#act').val($(this).attr('data'))
    $("#f").submit();
})
function rename() {
    $( "#dialog" ).attr("title", "What's Next?").dialog();
}
                </script>
    </div>
</div>
</div>

@endsection
