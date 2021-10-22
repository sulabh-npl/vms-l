<!DOCTYPE html>
<html lang="en">

<head>
  <style>
    table {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    td, th {
      border: 1px solid #dddddd;
      text-align: left;
      height: 18px;
    }
    tr{
      height: 28px;

    }
    tr:nth-child(even) {
      background-color: #dddddd;
    }
    </style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Boostrap Sidebar :: Text + Icon Menu</title>
  <link rel="shortcut icon" href="assets/ico/favicon.png">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
  <!-- bootstrap jquery -->
  <script src="https://code.jquery.com/jquery-latest.min.js"></script>
  <script src="https://cdn.jsdelivr.net/mark.js/8.6.0/jquery.mark.min.js"></script>
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
  <!-- bootstrap sidebar stylesheet -->
  <link href="assets/css/bootstrap-sidebar.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
  <!-- boostrap wrapper -->
  <div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-dark  navbar-fixed-top">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#menu-toggle" id="menu-toggle"> <span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span>  <span class="logo">Sevani Hong Kong Co., Limited</span>
          </a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <!-- <li><a href="#"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</a>
            </li> -->
            <!-- <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> CMS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> Pages</a>
                </li>
                <li><a href="#"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span> Posts</a>
                </li>
                <li><a href="#"><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> Media</a>
                </li>
              </ul>
            </li> -->
            <li class="dropdown"> <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Administrator <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Profile</a>
                </li>
                <li><a href="#"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span> Settings </a>
                </li>
              </ul>
            </li>
            <li><a href="#"><span class="glyphicon glyphicon-off" aria-hidden="true"></span></a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
      </div>
      <!-- /.container-fluid -->
    </nav>
    <!-- Boostrap Sidebar  - Collapsible Menu Items -->
    <!-- Sidebar -->
    <div id="bootstrap-sidebar" class="light-theme text-menu">
      <ul class="sidebar-nav">
        <li class="active"> <a href="#"><span class="glyphicon glyphicon-dashboard" aria-hidden="true"></span> <span class="menu-text">Home</span></a>
        </li>
        <li> <a href="#"><span class="glyphicon glyphicon-signal" aria-hidden="true"></span> <span class="menu-text">Charts</span></a>
        </li>
        <li> <a href="#"><span class="glyphicon glyphicon-file" aria-hidden="true"></span> <span class="menu-text">History</span></a>
        </li>
        <!-- <li> <a href="#"><span class="glyphicon glyphicon-list" aria-hidden="true"></span> <span class="menu-text">Clients</span></a>
        </li>
        <li> <a href="#"><span class="glyphicon glyphicon-inbox" aria-hidden="true"></span> <span class="menu-text">Inbox</span></a>
        </li>
        <li> <a href="#"><span class="glyphicon glyphicon-heart" aria-hidden="true"></span> <span class="menu-text">Favourites</span></a>
        </li>
        <li> <a href="#"><span class="glyphicon glyphicon-folder-open" aria-hidden="true"></span> <span class="menu-text">Assets</span></a>
        </li> -->
        <li> <a href="#"><span class="glyphicon glyphicon-tasks" aria-hidden="true"></span> <span class="menu-text">Data</span></a>
        </li>
        <li style="margin-left: -25px;"> <a href="javascript:;" data-toggle="collapse" data-target="#menu1"><i class="fa fa-fw fa-arrows-v"></i> <span class="glyphicon glyphicon-user" aria-hidden="true"></span> Vendor<b class="caret"></b> </a>
          <ul id="menu1" class="collapse">
            <li><a href="#">Users</a>
            </li>
            <li><a href="list">Company List</a>
            </li>
          </ul>
        </li>
        <li> <a href="#"><span class="glyphicon glyphicon-globe" aria-hidden="true"></span> <span class="menu-text">Add New</span></a>
        </li>
        <li> <a href="#"><span class="glyphicon glyphicon-credit-card" aria-hidden="true"></span> <span class="menu-text">Invoices</span></a>
        </li>
        <!-- <li> <a href="#"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> <span class="menu-text">Training</span></a>
        </li> -->
        <li> <a href="#"><span class="glyphicon glyphicon-scissors" aria-hidden="true"></span> <span class="menu-text">Customization</span></a>
        </li>
        <!-- <li> <a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <span class="menu-text">Users</span></a>
        </li> -->
        <li> <a href="#"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="menu-text">Settings</span></a>
        </li>
      </ul>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    @yield('content')
  <!-- /#wrapper -->
  <!-- Menu Toggle Script -->
  <script src="assets/js/sidebar.js?ver=2"></script>
</body>

</html>
