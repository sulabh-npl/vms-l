@extends('vendor')
@section('content')
<div class="row">
    <div class="col-sm-4">
      <img src="/assets/ico/favicon-2.png" style="margin-top: 10%;" alt="">
    </div>
    <div class="col-sm-8" style="display: flex;align-items:flex-start; flex-direction: column;">
      <h2>{{Session::get('utitle')}}</h2>
      <h4><strong>Expires At:</strong> {{$d->exp_date}}</h4>
      <p><strong>Email  :</strong> {{$d->email}}</p>
      <p><strong>Phone  :</strong> {{$d->phone}}</p>
      <p><strong>Address:</strong> {{$d->address}}</p>
    </div>
  </div>
    @endsection
