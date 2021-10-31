<h2>Visitors Record</h2>
                          <div class="divider-1 wow fadeInUp"><span></span></div>
                          <form id="range-form" class="r">
                          <div class="input-group">
                            <div class="form-outline custom">
                                <label for="">Name:</label>
                              <input type="search" id="form0" data="0" placeholder="Search By Name" class="form-control column-filter" />
                            </div>
                            <div class="form-outline custom">
                                <label for="">Visited Area:</label>
                              <input list="sec_list" id="form2" data="2" placeholder="Search By Area" class="form-control column-filter" />
                              <datalist id="sec_list">
                                @foreach($sections as $sec)
                                <option value="{{$sec->name}}">
                                @endforeach
                            </datalist><br>
                            </div>
                            <div class="form-outline custom">
                                <label for="">Addresser:</label>
                                <select name="addresser" id="form3" data="3" class="form-select form-control column-filter">
                                    <option value="" selected>All Users </option>
                                        @foreach($users as $user)
                                        <option value="{{$user->name}}">{{$user->name}}</option>
                                        @endforeach
                                    <option value="deleted">Deleted User</option>
                                </select>
                            </div>
                            <div class="form-outline custom">
                                <label for="">Document Type:</label>
                              <input type="search" id="form4" data="4" placeholder="Search By Document Type" class="column-filter form-control" />
                            </div>
                            <div class="form-outline custom range-input">
                                <label for="">Start Date:</label>
                              <input type="date" id="form5" data="5" name="min" placeholder="Search By Document Id" class="form-control range-input" />
                            </div>
                            <div class="form-outline custom range-input">
                                <label for="">End Date:</label>
                                <input type="date" name="max" placeholder="Search By Visited Date time" class="form-control range-input" />
                            </div>
                          </div>
                        </form>
<!-- Section 2 -->
            <div class="section-2-container section-container" id="table">
                <div class="container">
                  <div class="row">
                        <div class="col section-1 section-description wow fadeIn">

                    </div>
                  </div>
                  <div class="row" style="margin-left:-10%; width:110% ">
                    <table id="example" style="width: 105%;">
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
                                @if (Session::get('per')!=2)
                                <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                    </table>
                  </div>
                <div id="v2">
                    <div id="myModal2" class="modal">

                        <!-- Modal content -->
                        <div class="modal-content">
                          <span class="close">&times;</span>
                          <p>
                              <form action="/update/visitor" method="POST">
                            <b>Visitor Detail</b><br>
                            @csrf
                            <input type="number" name="id" id="ID" hidden>
                            <label for="Name">Name: </label>
                            <input type="text" disabled name="name" id="Name2"><br>
                            <label for="Name">Document-type: </label>
                            <input type="text" disabled name="doc_type" id="Doc_type2"><br>
                            <label for="Name">Document-Id: </label>
                            <input type="text" disabled name="doc_type" id="Doc_id2"><br>
                            <label for="Name">Visited Date: </label>
                            <input type="date" name="date" id="Date2"><br>
                            <label for="Name">Visited Time: </label>
                            <input type="text" name="time" id="Time2"><br>
                            <label for="Name">Phone Number: </label>
                            <input type="text" name="phone" id="Phone2"><br>
                            <label for="Name">Addressed By: </label>
                            <select name="addresser_id" id="Addresser2" class="form-select" style="width: 20%">
                            @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                            @endforeach
                            </select><br>
                            {{-- <input type="text" name="addresser" id="Addresser2"><br> --}}
                            @if(Session::get('section_id')==0)
                            <label for="Name">Visited Area: </label>
                            <input list="l" id="Area2" name="section_name" class="form-select" style="width:20%" placeholder="Enter Visited Area">
                            <datalist id="l">
                                @foreach($sections as $sec)
                                <option value="{{$sec->name}}">
                                @endforeach
                            </datalist><br>
                            @endif
                            <button class="btn btn-primary">Save</button>
                        </form>
                          </p>
                        </div>
                    </div>
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
                        </p>
                        </div>

                      </div>
                        <script>
                            // Get the modal
                            var modal = document.getElementById("myModal");
                            var modal2 = document.getElementById("myModal2");

                            // Get the <span> element that closes the modal
                            var span = document.getElementsByClassName("close")[1];
                            var span2 = document.getElementsByClassName("close")[0];

                            function edit(id){
                                $.get("/visitors/"+id, function(data, status){
                                    var d = JSON.parse(data)[0];
                                    document.getElementById("ID").value = d.id;
                                    document.getElementById("Name2").value = d.name;
                                    document.getElementById("Doc_type2").value = d.doc_type;
                                    document.getElementById("Doc_id2").value = d.doc_id;
                                    document.getElementById("Date2").value = d.date;
                                    document.getElementById("Time2").value = d.time;
                                    document.getElementById("Phone2").value = d.phone;
                                    document.getElementById("Addresser2").value = d.addresser_id;
                                    document.getElementById("Area2").value = d.section_name;
                                    modal2.style.display = "block";
                                });
                            }
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
                                    modal.style.display = "block";
                                });
                                // console.log(data);

                            }
                            // When the user clicks on <span> (x), close the modal
                            span.onclick = function() {
                              modal.style.display = "none";
                            }
                            span2.onclick = function(){
                              modal2.style.display = "none";
                            }
                            // When the user clicks anywhere outside of the modal, close it
                            window.onclick = function(event) {
                              if (event.target == modal) {
                                modal.style.display = "none";
                                modal2.style.display = "none";
                              }
                            }
                            </script>

                        <style>
                            #range-form{
                                display: none;
                                background-color: coral;
                                padding: 25px;
                            }
                            .custom label{
                                color: #000;
                                float: left !important;
                                margin: 0%;
                                padding: 0%;
                            }

                            .custom{
                                margin-left: 2.5%;
                                margin-right: 2.5%;
                                width: 20%;
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
                </div>
                </div>
            </div>

            <script>

            // Setup - add a text input to each footer cell
            var yourDate = new Date()
            yourDate = yourDate.toISOString().split('T')[0];
                // DataTable
                function filterColumn ( i ) {
                    $('#example').DataTable().column( i ).search(
                        $('#form'+i).val()
                    ).draw();
                }
                $(".range-input").change(function(){
                var formData = "?"+ $('#range-form').serialize();
                @if(isset($_GET['name']))
                formData = formData + "&name="+"{{$_GET['name']}}";
                console.log(formData);
                @endif
                defaultColumn(formData);
                })
                var h=0;
                function defaultColumn (formData) {
                    $('#example').DataTable().destroy();
                    $('#example').DataTable( {
                            "processing": true,
                            order: [6,"desc"],
                            async: false,
                            "ajax": "chart-data"+formData,
                            "createdRow": function( row, data, dataIndex ) {
                                if ( data[4] == "A" ) {
                                $(data[0]).attr("onclick",`View(${data.id})`);
                                }
                            },
                            "columns": [
                                {
                                "render": function(data, type, row){
                                    return `<span onclick="View(${row["id"]})">${row["name"]}</span>`
                                }
                            },
                                { "data": "sex" },
                                { "data": "section_name" },
                                { "data": "addresser" },
                                { "data": "doc_type" },
                                { "data": "doc_id" },
                                { "data": "date_time" },
                                {
                                    "data":"id",
                                    "render": function (data) {
                                    return `<div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      Action
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                      <a class="dropdown-item" onclick="edit(${data})">Edit</a>`+
                                      @if(Session::get('per') == 0)
                                      `
                                      <form action="/delete_visitor/${data}" id="frm" method="post">
                                        @csrf
                                        <button type="button" onclick="ap()" class="dropdown-item">Delete</button>
                                    </form>
`+
                                      @endif
`                                    </div>
                                  </div>`
                                }
                            }
                            ]

                        } );
                    // $('#tab').DataTable({order: [6,"desc"]}).column(6).search(
                    //     yourDate
                    // ).draw();
                    $(".dataTables_filter").append("<button class='btn btn-primary' id='adv_search' style='margin-left:5px;padding:10px'>Advanced Search</button>");
                    $( "<p>Test</p>" ).insertAfter( ".dataTables_filter" );
                    $('#adv_search').click(function(){
                        if(h == 0){
                            $('#range-form').show();
                            h=1;
                        }else{
                            $('#range-form').hide();
                            h=0;
                        }
                    })

                    $(".column-filter").each(function(){
                        if($(this).val()!=""){
                            filterColumn( $(this).attr('data') );
                        }
                    })
                }
                // var today = new Date();
                // var dd = today.getDate();
                // var mm = today.getMonth()+1; //January is 0!

                // var yyyy = today.getFullYear();
                // if(dd<10){dd='0'+dd} if(mm<10){mm='0'+mm} today = +yyyy+'-'+mm+'-'+dd;

                // $('input[name=min]').attr('value', today);

                // $('input[name=min]').val(new Date);
                function ap(){
                    var r = confirm("Delete this Visitor Record");
                    if(r){
                        $("#frm").submit();
                    }else{
                        alert("Operation Cancled")
                    }
                }
                var fa = "";
                @if(isset($_GET['name']))
                fa = "?name="+"{{$_GET['name']}}";
                @endif
                defaultColumn(fa);
                filterColumn(0);
                window.onload = function() {
                    $('.column-filter').on( 'keyup click change', function () {
                        // alert($('#form'+ $(this).attr('data')).val() )
                        filterColumn( $(this).attr('data') );
                    } );
                }
                $('td').hover(function(){
                    $(this).parent('tr').attr('style','background-color:#ddd');
                },function(){
                    $(this).parent('tr').attr('style','background-color:#fff');
                })
            </script>
