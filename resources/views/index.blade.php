@extends('vendor')
@section('content')

<style>.fe{
 display: none;
}
</style>
            <!-- Section 1 -->
<div class="section-1-container section-container" id="section-1">
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
<div class="section-2-container section-container" id="section-2">
	<div class="container">
	  <div class="row">
			<div class="col section-1 section-description wow fadeIn">
			  <h2>View in detail</h2>
			  <div class="divider-1 wow fadeInUp"><span></span></div>
			</div>
	  </div>
    <div id="v2">
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
            .modal2 {
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
            .modal2-content {
              background-color: #fefefe;
              margin: auto;
              padding: 20px;
              border: 1px solid #888;
              width: 60%;
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
