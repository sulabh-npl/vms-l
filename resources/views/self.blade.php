@extends('vendor')
@section('content')
    <style>
        body {
    background: #eee
}

.card {
    border: none;
    position: relative;
    overflow: hidden;
    border-radius: 8px;
    cursor: pointer
}

.card:before {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 100%;
    background-color: #f1531f;
    transform: scaleY(1);
    transition: all 0.5s;
    transform-origin: bottom
}

.card:after {
    content: "";
    position: absolute;
    left: 0;
    top: 0;
    width: 4px;
    height: 100%;
    background-color: #aa5524;
    transform: scaleY(0);
    transition: all 0.5s;
    transform-origin: bottom
}

.card:hover::after {
    transform: scaleY(1)
}

.fonts {
    font-size: 11px
}

.social-list {
    display: flex;
    list-style: none;
    justify-content: center;
    padding: 0
}

.social-list li {
    padding: 10px;
    color: #aa4e24;
    font-size: 19px
}

.buttons button:nth-child(1) {
    border: 1px solid #aa3f24 !important;
    color: #8E24AA;
    height: 40px
}

.buttons button:nth-child(1):hover {
    border: 1px solid #aa4e24 !important;
    color: #fff;
    height: 40px;
    background-color: #aa4e24
}

.buttons button:nth-child(2) {
    border: 1px solid #aa6524 !important;
    background-color: #aa5a24;
    color: #fff;
    height: 40px
}
    </style>
    <div class="container mt-5" id="content">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7">
                <div class="card p-3 py-4">
                    <div class="text-center mt-3"> <span class="bg-secondary p-1 px-4 rounded text-white">{{$d->name}}</span><br>
                        <span>Phone     : {{$d->phone}} </span><br>
                        <span>Email     : {{$d->email}}</span><br>
                        <span>Address   : {{$d->address}}</span><br>
                        <span>Expires at: {{$d->exp_date}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
