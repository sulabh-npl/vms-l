@extends('super-admin')
@section('content')
<div id="main-page-content">
      <div class="container-fluid">
        <h1>Dashboard</h1>
        <div class="row">
                <div class="col-sm-12">
                <div id="piechart"></div>
                <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                <script type="text/javascript">
                google.charts.load('current', {'packages':['line']});
                google.charts.setOnLoadCallback(drawChart);

              function drawChart() {

                var data = new google.visualization.DataTable();
                data.addColumn('number', 'Date');
                data.addColumn('number', 'Cmp 1');
                data.addColumn('number', 'Cmp 2');
                data.addColumn('number', 'cmp 3');

                data.addRows([
                  [1,  37.8, 80.8, 41.8],
                  [2,  30.9, 69.5, 32.4],
                  [3,  25.4,   57, 25.7],
                  [4,  11.7, 18.8, 10.5],
                  [5,  11.9, 17.6, 10.4],
                  [6,   8.8, 13.6,  7.7],
                  [7,   7.6, 12.3,  9.6],
                  [8,  12.3, 29.2, 10.6],
                  [9,  16.9, 42.9, 14.8],
                  [10, 12.8, 30.9, 11.6],
                  [11,  5.3,  7.9,  4.7],
                  [12,  6.6,  8.4,  5.2],
                  [13,  4.8,  6.3,  3.6],
                  [14,  4.2,  6.2,  3.4]
                ]);

                var options = {
                  chart: {
                    title: 'Addition of New Users',
                    // subtitle: 'in millions of dollars (USD)'
                  },
                  width: 900,
                  height: 500
                };

                var chart = new google.charts.Line(document.getElementById('piechart'));

                chart.draw(data, google.charts.Line.convertOptions(options));
              }
                </script>
                </div>
                <div class="col-md-8">
                  <label for="table">Recently added Data</label>
                  <table>
                    <tr>
                      <th>Company</th>
                      <th>Name</th>
                      <th>Address</th>
                    </tr>
                    <tr>
                      <td>Cmp 2</td>
                      <!-- <td>Alfreds Futterkiste</td> -->
                      <td>Maria Anders</td>
                      <td>Germany</td>
                    </tr>
                    <tr>
                      <td>Cmp 2</td>
                      <!-- <td>Centro comercial Moctezuma</td> -->
                      <td>Francisco Chang</td>
                      <td>Mexico</td>
                    </tr>
                    <tr>
                      <td>Cmp 3</td>
                      <!-- <td>Ernst Handel</td> -->
                      <td>Roland Mendel</td>
                      <td>Austria</td>
                    </tr>
                    <tr>
                      <td>Cmp 3</td>
                      <!-- <td>Island Trading</td> -->
                      <td>Helen Bennett</td>
                      <td>UK</td>
                    </tr>
                    <tr>
                      <td>Cmp 1</td>
                      <td>Yoshi Tannamuri</td>
                      <td>Canada</td>
                    </tr>
                    <tr>
                      <td>Cmp 2</td>
                      <td>Giovanni Rovelli</td>
                      <td>Italy</td>
                    </tr>
                  </table>
                </div>
                <div class="col-md-4">
                  <table>
                  <label for="table">Active Vendors</label>
                    <tr>
                      <th>Vendors</th>
                    </tr>
                    <tr>
                      <td>Cmp 1</td>
                    </tr>
                    <tr>
                      <td>Cmp 2</td>
                    </tr>
                    <tr>
                      <td>Cmp 3</td>
                    </tr>
                  </table>
                </div>
    </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="panel panel-default">
                      <!-- <div class="panel-heading">Features</div> -->
                      <div class="panel-body" id="feature-content">
                <div class="col-md-4">
                  <div class="panel panel-primary">
                    <div class="panel-body text-center">
                      <span class="glyphicon glyphicon-file icon-big" aria-hidden="true"></span>
                      <h3>History</h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="panel panel-primary">
                    <div class="panel-body text-center">
                      <span class="glyphicon glyphicon-plus icon-big" aria-hidden="true"></span>
                      <h3>Add New Vendor</h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="panel panel-primary">
                    <div class="panel-body text-center">
                      <span class="glyphicon glyphicon-credit-card icon-big" aria-hidden="true"></span>
                      <h3>Payment Invoice</h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="panel panel-primary">
                    <div class="panel-body text-center">
                      <span class="glyphicon glyphicon-scissors icon-big" aria-hidden="true"></span>
                      <h3>Customization</h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="panel panel-primary">
                    <div class="panel-body text-center">
                      <span class="glyphicon glyphicon-tasks icon-big" aria-hidden="true"></span>
                      <h3>Settings</h3>
                    </div>
                  </div>
                </div>
                <!-- <div class="col-md-4">
                  <div class="panel panel-primary">
                    <div class="panel-body text-center">
                      <span class="glyphicon glyphicon-object-align-vertical icon-big" aria-hidden="true"></span>
                      <h3>Submenu</h3>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="panel panel-primary">
                    <div class="panel-body text-center">
                      <span class="glyphicon glyphicon-text-background icon-big" aria-hidden="true"></span>
                      <h3>8 Themes</h3>
                    </div>
                  </div>
                </div> -->
              </div>
            </div>
          </div>
        </div>
        <div style="clear:both"></div>
      </div>
    </div>
  </div>
  @endsection
