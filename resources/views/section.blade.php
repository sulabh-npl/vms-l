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
  @include('record_table')
<script>
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
