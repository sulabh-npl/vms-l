@extends('vendor')
@section('content')

<style>.fe{
 display: none;
}
.card-title:link{
    color: #898989
}
</style>
<div class="top-content section-container" style="width: 120%;margin-left:-15%;margin-top:-20px" id="img-hh">
    <div class="container-fluid">
            <div class="col col-md-10 offset-md-1 col-lg-8 offset-lg-2">
                <h1 class="wow fadeIn">{{Session::get('utitle')}}@if (Session::get('section')!="")
                    ,{{Session::get('section')}}
                @endif</h1>
                <div class="buttons wow fadeInUp">
                    <a class="btn btn-primary btn-customized" href="/#charts" role="button">
                        <i class="fa fa-area-chart" aria-hidden="true"></i> See Chart of visitors
                    </a>
                    <a class="btn btn-primary btn-customized-2" href="/#table" role="button">
                        <i class="fas fa-table"></i> Visitors Record
                    </a>
                </div>
            </div>
        </div>
</div>

            <!-- Section 1 -->
<div class="section-1-container section-container">
	<div class="container">
		<div class="row">
			<div class="col section-1 section-description wow fadeIn">
			  <h2>Keep The Track</h2>
			  <div class="divider-1 wow fadeInUp"><span></span></div>
			</div>
		</div>
    <div id="v1" class="row">
                  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                  <div class="col-sm-3">
                    <div class="card text-right" style="width: 90%;margin-left:5%">
                        <div class="card-body">
                          <h5 class="card-title">Today Visitors</h5>
                          <button class="btn btn-primary" disabled>{{$v["tV"]}}</button>
                        </div>
                      </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="card text-right" style="width: 90%;margin-left:5%">
                          <div class="card-body">
                            <h5 class="card-title">Last 7 days' visitors</h5>
                            <button class="btn btn-primary" disabled>{{$v["wV"]}}</button>
                          </div>
                        </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="card text-right" style="width: 90%;margin-left:5%">
                          <div class="card-body">
                            <h5 class="card-title">Last 30 days' visitors</h5>
                            <button class="btn btn-primary" disabled>{{$v["mV"]}}</button>
                          </div>
                        </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="card text-right" style="width: 90%;margin-left:5%">
                          <div class="card-body">
                            <h5 class="card-title">Total visitors</h5>
                            <button class="btn btn-primary" disabled>{{$v["V"]}}</button>
                          </div>
                        </div>
                  </div>
                  @if(Session::get('section_id')==0)
                  @foreach($sections as $sec)
                  <div class="col-sm-3" style="margin-top:20px">
                    <a href="/section?name={{$sec->name}}">
                    <div class="card text-right" style="width: 90%;margin-left:5%;color:#898989">
                        <div class="card-body">
                          <h5 class="card-title">Today Visitors in {{$sec->name}}</h5>
                          <button class="btn btn-primary" disabled>{{$sec->tV}}</button>
                        </div>
                      </div>
                    </a>
                  </div>
                  {{-- <div class="col-sm-3">
                      <div class="card text-right" style="width: 90%;margin-left:5%">
                          <div class="card-body">
                            <h5 class="card-title">Last 7 days' visitors in {{$sec->name}}</h5>
                            <button class="btn btn-primary" disabled>50</button>
                          </div>
                        </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="card text-right" style="width: 90%;margin-left:5%">
                          <div class="card-body">
                            <h5 class="card-title">Last 30 days' visitors in {{$sec->name}}</h5>
                            <button class="btn btn-primary" disabled>50</button>
                          </div>
                        </div>
                  </div>
                  <div class="col-sm-3">
                      <div class="card text-right" style="width: 90%;margin-left:5%">
                          <div class="card-body">
                            <h5 class="card-title">Total visitors in {{$sec->name}}</h5>
                            <button class="btn btn-primary" disabled>50</button>
                          </div>
                        </div>
                  </div> --}}
                  @endforeach
                  <div class="col-sm-12" id="charts">
                    <div id="chart_combo" style="width: 120%;margin-left:-15%; height: 500px;"></div>
                  </div>
                  <script>
                    //Charts
                      google.charts.load('current', {'packages':['corechart']});
                          google.charts.setOnLoadCallback(drawChart);

                          function drawChart() {
                            var jsonData = $.ajax({
                                url: "/chart-data",
                                dataType: "array",
                                async: false
                                }).responseText;

                            // Create our data table out of JSON data loaded from server.
                            // var combo = new google.visualization.DataTable(jsonData);
                            var combo = google.visualization.arrayToDataTable([
                                @foreach($data as $dat)
                                [
                                    @foreach($dat as $d)
                                    @if(is_numeric($d))
                                    {{$d}},
                                    @else
                                    "{{$d}}",
                                    @endif
                                    @endforeach
                                ],
                                @endforeach
                            ]
                            );

                            options = {
                              title : 'Area wise visit of Week',
                              vAxis: {title: 'Visitors'},
                              hAxis: {title: 'Date'},
                              seriesType: 'bars',
                            };
                            chart = new google.visualization.ComboChart(document.getElementById('chart_combo'));
                            chart.draw(combo, options);
                          }
                    </script>

                  @endif
    </div>
	</div>
</div>
@include('record_table')
@yield("profile")
@endsection
