<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand">Visitor Management System(VMS)</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="/about">About VMS</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" onclick="contact()">Contact {{$company->name}}</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn-primary btn" style="color: white; border:none" href="/register">Apply Now</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn-primary btn" style="background-color: coral; border:none;margin-left:10px" href="/login">Login</a>
        </li>
      </ul>
    </div>
  </nav>
  <div id="v2">
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
          <span class="close">&times;</span>
          <p>

  Phone Number: {{$company->phone}} <br>
  Email Address: {{$company->email}} <br>
  Address: {{$company->address}}

      </p>
        </div>

      </div>
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks the button, open the modal
            function contact(id) {
              modal.style.display = "block";

            }
            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
              modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
              if (event.target == modal) {
                modal.style.display = "none";
              }
            }
            </script>

          <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/moment/moment.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/handsontable/dist/pickday/pickday.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/pikaday/css/pikaday.css">
        <style>
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
          width: 40%;
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



  </div>
