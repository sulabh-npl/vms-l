<!DOCTYPE html>
<html lang="en">
<head>
    <meta author="Sulabh Nepal">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{Session::get('utitle')}}</title>
        <!-- CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500&display=swap">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        <link rel="stylesheet" href="/assets/css/jquery.mCustomScrollbar.min.css">
        <link rel="stylesheet" href="/assets/css/animate.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        <link rel="stylesheet" href="/assets/css/media-queries.css">


        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="/assets/ico/favicon.png">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/assets/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/assets/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/assets/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="/assets/ico/apple-touch-icon-57-precomposed.png">


        <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>

</head>
<body>
<!-- Wrapper -->
    	<div class="wrapper">

			<!-- Sidebar -->
			<nav class="sidebar">

				<!-- close sidebar menu -->
				<div class="dismiss">
					<i class="fas fa-arrow-left"></i>
				</div>


				<ul class="list-unstyled menu-elements">
					<li class="active">
						<a class="" href="/#top-content"><i class="fas fa-home"></i> Home</a>
					</li>
					<li>
						<a class="" href="/#charts"><i class="fas fa-cog"></i> Charts</a>
					</li>
					<li>
						<a class="" href="/#table"><i class="fas fa-user"></i>Visitors Record</a>
					</li>
                    @if(Session::get('section_id')==0)

                    <li class="nav-item has-submenu">
                        <a class="nav-link" href="#"><i class="fa fa-list-alt" aria-hidden="true"></i> Sections  </a>
                        <ul class="submenu collapse">
                            <li id="new">
                                <a class="" href="/addSection"><i class="fas fa-plus"></i>Add New Section</a>
                            </li>
                            @foreach($sections as $sec)
                            <li><a class="nav-link" href="/section?name={{$sec->name}}">{{$sec->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    @endif
                    @if(Session::get('per')==0)
                    <li class="nav-item has-submenu">
                        <a class="nav-link" href="#"><i class="fa fa-user" aria-hidden="true"></i> Users  </a>
                        <ul class="submenu collapse">
                            <li id="new">
                                <a class="" href="/new_user"><i class="fas fa-plus"></i>Add New User</a>
                            </li>
                            <li id="">
                                <a class="" href="/manage_users"><i class="far fa-address-card"></i>Manage Users</a>
                            </li>
                        </ul>
                    </li>
                    @endif
                    @if (Session::has('name'))
					<li id="">
						<a class="" href="/user"><i class="fas fa-user"></i>{{Session::get('name')}}
                            <span style="font-size: 1.5em">||</span><span style="font-size: .75em">User Section: {{$sec_per}}</span></a>
					</li>
                    @endif
					<li id="">
						<a class="" href="/change_pass"><i class="fas fa-lock"></i>Change Password</a>
					</li>
					<li id="">
						<a class="" href="/details#content"><i class="fas fa-info"></i>About</a>
					</li>
					<li>
						<a class="" href="/logout"><i class="fas fa-sign-out-alt"></i>LogOut</a>
					</li>
				</ul>

				<div class="to-top">
					<a class="btn btn-primary btn-customized-3" href="#" role="button">
	                    <i class="fas fa-arrow-up"></i> Top
	                </a>
				</div>

				<div class="dark-light-buttons">
					<a class="btn btn-primary btn-customized-4 btn-customized-dark" href="#" role="button">Dark</a>
					<a class="btn btn-primary btn-customized-4 btn-customized-light" href="#" role="button">Light</a>
				</div>

			</nav>
			<!-- End sidebar -->

			<!-- Dark overlay -->
    		<div class="overlay"></div>

			<!-- Content -->
			<div class="content">

				<!-- open sidebar menu -->
				<a class="btn btn-primary btn-customized open-menu" href="#" role="button">
                    <i class="fas fa-align-left"></i> <span>Menu</span>
                </a>

		        <!-- Top content -->
		        <div class="top-content section-container" id="top-content">
			        <div class="container">
			            <div class="row">
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
		        </div>
                @yield('content')
	        </div>
	        <!-- End content -->

        </div>
<!--End Wrapper -->
</body>
<script>
    document.addEventListener("DOMContentLoaded", function(){
  document.querySelectorAll('.sidebar .nav-link').forEach(function(element){

    element.addEventListener('click', function (e) {

      let nextEl = element.nextElementSibling;
      let parentEl  = element.parentElement;

        if(nextEl) {
            e.preventDefault();
            let mycollapse = new bootstrap.Collapse(nextEl);

            if(nextEl.classList.contains('show')){
              mycollapse.hide();
            } else {
                mycollapse.show();
                // find other submenus with class=show
                var opened_submenu = parentEl.parentElement.querySelector('.submenu.show');
                // if it exists, then close all of them
                if(opened_submenu){
                  new bootstrap.Collapse(opened_submenu);
                }
            }
        }
    }); // addEventListener
  }) // forEach
});
</script>

    <!-- Javascript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="/assets/js/jquery.backstretch.min.js"></script>
    <script src="/assets/js/wow.min.js"></script>
    <script src="/assets/js/jquery.waypoints.min.js"></script>
    <script src="/assets/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="/assets/js/scripts.js"></script>

</html>
