@extends('vendor')
@section('content')

<style>.fe{
 display: none;
}
</style>
            <!-- Section 1 -->
<div class="section-1-container section-container" id="charts">
	<div class="container">
		<div class="row">
			<div class="col section-1 section-description wow fadeIn">
			  <h2>Keep The Track</h2>
			  <div class="divider-1 wow fadeInUp"><span></span></div>
			</div>
		</div>
    <div id="v1" class="row">
                  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                  <div class="col-sm-6">
                      <div id="chart_pie" style="width: 100%; height: 250px;"></div>
                  </div>
                  <div class="col-sm-6">
                      <div id="chart_area" style="width: 100%; height: 250px;"></div>
                  </div>
                  <div class="col-sm-12">
                      <div id="chart_combo" style="width: 100%; height: 500px;"></div>
                  </div>
    </div>
	</div>
</div>
            <!-- Section 2 -->
<div class="section-2-container section-container" id="table">
	<div class="container">
	  <div class="row">
			<div class="col section-1 section-description wow fadeIn">
			  <h2>Visitors Record</h2>
			  <div class="divider-1 wow fadeInUp"><span></span></div>
			</div>
	  </div>
      <div class="row">
          <table id="tab" style="width: 100%">
            <thead>
                <tr>
                    <th>Name</th>
                    @if (Session::get('section_id')==0)
                    <th>Visited Area</th>
                    @endif
                    <th>Addressed By</th>
                    <th>Document Type</th>
                    <th>Document Id</th>
                    {{-- <th>Document Issue Date</th>
                    <th>Document Expiry Date</th> --}}
                    {{-- <th>Father's Name</th> --}}
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
                    @if (Session::get('section_id')==0)
                    <td>{{$vi->area}}</td>
                    @endif
                    <td>{{$vi->stf_name}}</td>
                    <td>{{$vi->doc_type}}</td>
                    <td>{{$vi->doc_id}}</td>
                    {{-- <td>{{$vi->issue_date}}</td>
                    <td>@if ($vi->exp_date == null)
                        Not Applicable
                    @endif
                    {{$vi->exp_date}}</td> --}}
                    {{-- <td>{{$vi->father_name }}</td> --}}
                    <td>{{$vi->date}}-{{$vi->time}}</td>
                    @if (Session::get('per')!=2)
                    <td><button onclick="edit({{$vi->id}})" class="btn btn-primary">Edit</button>
                        <a href="/delete_visitor/{{$vi->id}}"><button class="btn btn-secondary">Delete</button></a>
                        </td>
                    @endif
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>Name</th>
                    @if (Session::get('section_id')==0)
                    <th>Visited Area</th>
                    @endif
                    <th><input type="text" placeholder="Search Addresser" /></th>
                    <th><input type="text" placeholder="Search Document Type" /></th>
                    <th>Document Id</th>
                    {{-- <th>Document Issue Date</th>
                    <th>Document Expiry Date</th> --}}
                    {{-- <th>Father's Name</th> --}}
                    <th>Visited At</th>
                    @if (Session::get('per')!=2)
                    <th>Edit/Delete</th>
                    @endif
                </tr>
            </tfoot>
        </table>
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
                        document.getElementById("Area").value = d.area;
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
// Setup - add a text input to each footer cell

    // DataTable
    var table = $('#tab').DataTable({
        initComplete: function () {
            // Apply the search
            this.api().columns().every( function () {
                var that = this;

                $( 'input', this.footer() ).on( 'keyup change clear', function () {
                    if ( that.search() !== this.value ) {
                        that
                            .search( this.value )
                            .draw();
                    }
                } );
            } );
        }
    });
//Charts
  google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var area = google.visualization.arrayToDataTable([
          ['Days', 'New Visitors', 'Repeated Visitors', 'Total Visitors'],
          ['Jan',  1000,      400, 1400],
          ['Feb',  1170,      460, 1630],
          ['Mar',  660,       1120, 1780],
          ['Apr',  1030,      540, 1570]
        ]);

        var options = {
          title: 'Type of visitors',
          hAxis: {title: 'Days',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_area'));
        chart.draw(area, options);

        var pie = google.visualization.arrayToDataTable([
          ['Staff', 'guest addressed'],
          ['Sulabh',  1000],
          ['Kabindra',  1170],
          ['Mahesh',  660],
          ['Pradip',  1030]
        ]);
        options = {
          title: 'Guest Addressed Today'
        }
        chart = new google.visualization.PieChart(document.getElementById('chart_pie'));
        chart.draw(pie, options)
        var combo = google.visualization.arrayToDataTable([
          ['Date', 'Area-1', 'Area-3', 'Area-5', 'Area-7', 'Area-9', 'Average'],
          ['2021/05/01 Mon',  165,      938,         522,             998,           450,      614.6],
          ['2021/05/02 Tue',  135,      1120,        599,             1268,          288,      682],
          ['2021/05/03 Wed',  157,      1167,        587,             807,           397,      623],
          ['2021/05/04 Thu',  139,      1110,        615,             968,           215,      609.4],
          ['2021/05/05 Fri',  136,      691,         629,             1026,          366,      569.6]
        ]);

        options = {
          title : 'Area wise vvisit of Week',
          vAxis: {title: 'Visitors'},
          hAxis: {title: 'Date'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };
        chart = new google.visualization.ComboChart(document.getElementById('chart_combo'));
        chart.draw(combo, options);
      }
</script>

@endsection
