@extends('admin.layout')
@section('content')
<style>
    .left{
        float: left;
    }
    .leaft{
        display: flex;
        align-self: flex-start;
        margin-left: 5%;
    }
</style>
<div class="col-sm-2"></div>
<div class="col-sm-8">
    <form action="/admin/about" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="">Heading:</label>
        <input type="text" class="form-control" name="heading" value="{{$data->heading}}">
        <label for="">Content:</label>
        <textarea type="text" name="content" class="form-control" value="" rows="10">{{$data->content}}</textarea>
        <label for="">Background Image:</label><br>
        <img src="/assets/img/about.jpg" style="width: 50%" alt="no image">
        <input type="file" name="img" class="form-control" id=""><br>
        <label for="" class="left">Heading Colour: </label>
        <input type="color" class="leaft" name="heading_colour" value="{{$data->heading_colour}}" id=""><br><br>
        <label for=""  class="left">Content Colour: </label>
        <input type="color" class="leaft" name="content_colour" value="{{$data->content_colour}}" id=""><br><br>
        <label for="" class="left">Register Button Colour: </label>
        <input type="color" class="leaft" name="register_colour" value="{{$data->register_colour}}" id=""><br><br>
        <button class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
