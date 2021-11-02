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
   #dialog2{
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

   <div class="container">
   <h1>{{$_GET['name']}}
    @if(Session::get('per') == 0)
    <div class="dropdown">
    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Action
    </button>
    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
      <a class="dropdown-item" onclick="name_re()">Rename</a>
      <form id="delete" action="/delete_sec/{{$_GET['name']}}" method="post">
        @csrf
        <button type="button" onclick="del()" class="dropdown-item">Delete</button>
        </form>
     </div>
  </div>
@endif

</h1>

   <div class="row" style="margin-top: 30px">
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
          <div class="card text-right" style="width: 102.5%;margin-left:-2.5%">
              <div class="card-body">
                <h5 class="card-title">Total visitors</h5>
                <button class="btn btn-primary" disabled>{{$v["V"]}}</button>
              </div>
            </div>
      </div>
   </div>
</div>
<div id="dialog" title="Basic dialog">
    <p>Do you want to make changes in Previos Data Also?</p>
    <button class="btn btn-primary" id="sub" data="1">Yes</button>
    <button class="btn btn-secondary" id="sub" data="0">No</button>
  </div>
  <div id="dialog2" title="Rename">
    <form action="/rename?name={{$_GET['name']}}" id="f" method="post">
        @csrf
        <input type="text" id="act" name="act" style="display: none">
        <label for="">To Rename Section</label>
        <input type="text" name="re_name" id="r" placeholder="Enter New Name for section" class="form-control" style="margin-left: auto; margin-right:auto;width:50%" />
        <button type="button" class="btn btn-primary" id="re" onclick="rename()">Rename</button>
    </form>
 </div>
  @include('record_table')
<script>
function del() {
    var re = confirm("Are you sure that you want to delete this section");
    if(re == true){
        $('#delete').submit();
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
function name_re() {
    $( "#dialog2" ).dialog();
}
                </script>
    </div>
</div>
</div>

@endsection
