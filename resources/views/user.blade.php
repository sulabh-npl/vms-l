@extends('vendor')
@section('content')
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
    <div class="row profile">
        <div class="col-md-3"></div>
		<div class="col-md-6">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
					<img src="/assets/ico/favicon-2.png" class="img-responsive" alt="">
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						{{$v->name}}
					</div>
					<div class="profile-usertitle-job">
						{{Session::get('utitle')}}
					</div>
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
                    @if ($sec_per == "All")
					<button type="button" class="btn btn-success btn-sm"> Super
                        @switch($v->permission)
                            @case(1)
                                Editor
                                @break
                            @case(2)
                                Viewer
                                @break
                            @default
                                Admin
                        @endswitch
                    </button>
                    @else
					<button type="button" class="btn btn-success btn-sm">
                        @switch($v->permission)
                        @case(1)
                            Editor
                            @break
                        @case(2)
                            Viewer
                            @break
                        @default
                            Admin
                    @endswitch</button>
					<button type="button" class="btn btn-danger btn-sm">{{$sec_per}}</button>

                    @endif
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="" style="list-style: none;">
						<p>
							<a href="#">
							<i class="fa fa-phone"></i>
							{{$v->phone}} </a>
                            </p>
						<p>
							<a href="#">
							<i class="fa fa-email"></i>
							{{$v->email}}</a>
                            </p>
						<p>
							<a href="/change_pass" target="_blank">
							<i class="fa fa-lock"></i>
							Change Password</a>
                            </p>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
	</div>
</div>
<br>
<style>
    /***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

body {
  background: #F1F3FA;
}

/* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
  border: #e7822e 2px solid;
}

.profile-userpic img {
  float: none;
  margin: 0 auto;
  width: 25%;
  height: 25%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}

.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: auto;
}
</style>

@endsection
