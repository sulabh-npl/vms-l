@extends('admin.super-admin')
@section('content')
<div class="input-group">
  <div class="form-outline">
      <div class="col-sm-4" style="margin-left: 350px;margin-right:-30px">
    <input type="search" style="width: 100%;" class="form-control" >
    <label class="form-label" style="align-item: center;" for="form1">Search</label>
    </div>
    <div class="col-sm-1">
  <button type="button" class="btn btn-primary">
    <i class="fas fa-search"></i>
  </button>
    </div>
  </div>
</div>
<ul class="list-group list-group-flush">
    @foreach ($vendors as $vendor)
    <a href="/admin/login/{{$vendor->id}}"><li class="list-group-item">{{$vendor->name}}</li></a>
    @endforeach
  <li class="list-group-item">Dummy</li>
  <li class="list-group-item">Dummy</li>
  <li class="list-group-item">Dummy</li>
  <li class="list-group-item">Dummy</li>
  <li class="list-group-item">Dummy</li>
</ul>
@endsection
