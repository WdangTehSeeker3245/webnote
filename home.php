<?php
  date_default_timezone_set("Asia/Jakarta");
  session_start();
  include "db_connect.php";
  if( !isset( $_SESSION['user']) ){
    echo "You are not authorized to view this page. Go back <a href= 'index.php'>Login</a>";
  }
  $hidelist = false;
  $search = false;
  if (isset($_GET['search'])){
    $searchkey = $_GET['search'];
    $searchkey = mysqli_real_escape_string($conn, $searchkey);
    $sqlsearch="SELECT * FROM note WHERE judul_note LIKE '%$searchkey%'";
    $querysearch=mysqli_query($conn,$sqlsearch);
    $hidelist = true;
    $search = true;
  }
?>
<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./assets/img/icons/webnote_icon.png">
    <title>Webnote App</title>

    <!-- Required CSS -->
    <!--
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css">
    -->
    <link rel="stylesheet" href="./lib/bootstrap-5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="./lib/fontawesome-free-6.1.2/css/all.min.css">

    <!-- My CSS -->
    <style type="text/css">
    * {
      margin :0;
    }
    .brand-icon {
      width: 25px;
      height: 25px;
    }
    #myBtn {
      width: 60px;
      display: none;
      position: fixed;
      bottom: 20px;
      right: 30px;
      z-index: 99;
      font-size: 18px;
      border: none;
      outline: none;
      background-color: red;
      color: white;
      cursor: pointer;
      padding: 15px;
      border-radius: 4px;
    }

    #myBtn:hover {
      background-color: #555;
    }

    .logout-btn {
      margin-top:5px;
    }
    @media (max-width: 526px) {
      .brand-icon {
        width: 40px;
        height: 40px;
      }
      .logout-btn {
        margin-top:5px;
      }
    }
    </style>
    <!-- Required JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> -->
    <script src="./lib/jquery-3.6.0/jquery-3.6.0.min.js"></script>

  </head>
  <body>
    <!-- Navbar app -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand fw-bold text-uppercase" href="home.php"><img class="brand-icon" src="https://cdn-icons-png.flaticon.com/512/768/768818.png"/> Webnote App</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="home.php">Normal Notes</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="list_draft_story.php">Draft Story</a>
            </li>
          </ul>
          <form action="" id="search-form" class="d-flex">
            <input id="nnsearch-keyword"class="form-control me-2" type="text" name="search" placeholder="Search" aria-label="Search">
            <button id="btnsearch-normalnote" class="btn btn-outline-success me-2" type="submit">Search</button>
          </form>
          <span class="d-flex">
            <button onclick="window.location.href='logout.php'"id="btn-logout" class="btn btn-danger ms-2">Logout</button>
          </span>
        </div>
      </div>
    </nav>

    <!-- Header app -->
    <center>
      <h2 class="fw-bold text-uppercase mt-3 text-decoration-underline">Add Notes</h2>
      <button onclick="window.location.href='addnote.php'" class="btn btn-info text-light fw-bolder fs-5 rounded-circle"><i class="fas fa-plus"></i></button>
    </center>

    <!-- All Note -->
    <div id="nnlist-con" class="container-fluid my-2">
      <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-2">
        <?php
          if ($hidelist===false){
            $sql = "SELECT id_note,judul_note
                  FROM note ORDER BY id_note DESC;";
            $query = mysqli_query($conn,$sql);
            while ($data = mysqli_fetch_assoc($query)){
              echo '
               <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">'.$data["judul_note"].'</h5>
                    <a href="viewnote.php?id_note='.$data["id_note"].'" class="btn btn-primary">View Note</a>
                  </div>
                </div>
               </div>
              ';
            }
          }
        ?>
      </div>
    </div>
    <div id="search-con" class="container-fluid my-2">
      <h2 class="text-decoration-underline text-center">Search Result</h2>
      <div id="normal-note-search" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3 mt-2">
        <?php
          if($search===true){
            while ($datasearch=mysqli_fetch_assoc($querysearch)) {
              echo '
               <div class="col">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">'.$datasearch["judul_note"].'</h5>
                    <a href="viewnote.php?id_note='.$datasearch["id_note"].'" class="btn btn-primary">View Note</a>
                  </div>
                </div>
               </div>
              ';
            }
          }else{
            echo '';
          }
        ?>
      </div>
    </div>
    <!-- Back To Top Button -->
    <button onclick="topFunction()" id="myBtn" title="Go to top"><i class="fas fa-arrow-up"></i></button>


    <!-- Required JS -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
    <script src="./lib/bootstrap-5.1.3/js/bootstrap.bundle.min.js"></script>

    <!-- My Js-->
  <?php
    if ($search===false){
      echo '
      <script type="text/javascript">
        $("#search-con").hide();
      </script>
      ';
    }
  ?>
  <script type="text/javascript">

  //Get the button
  var mybutton = document.getElementById("myBtn");

  // When the user scrolls down 20px from the top of the document, show the button
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
      mybutton.style.display = "block";
    } else {
      mybutton.style.display = "none";
    }
  }

  // When the user clicks on the button, scroll to the top of the document
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
  </script>
  <script type="text/javascript">

    $( document ).ready(function() {
      $(document).on('submit', '#search-form', function() {
        $( "#btnsearch-normalnote" ).click(function() {
          $("#nnlist-con").hide();
          var search = $("#nnsearch-keyword").val();
          var cols = $("#normal-note-search").find(".col");
          var count = 0;
          for(var i = 0; i < cols.length; i++)
          {
             count = count + 1;
          }
          if (count!=0){
            alert("you already search something reloading..");
            var reload = "home.php?search="+search+"";
            window.location.replace(reload);
          } else if (count==0) {
            $.ajax({
              url:"./ajax/search-normalnote.php",
              type:"POST",
              data: {search:search},
              success: function(data){
                var obj = jQuery.parseJSON(data);
                for (var i=0;i<obj.length;++i){
                  $("#normal-note-search").append(
                      '<div id="'+i+'" class="col">'+
                       '<div class="card">'+
                        '<div class="card-body">'+
                         '<h5 class="card-title">'+obj[i].judul_note+'</h5>'+
                         '<a href="viewnote.php?id_note='+obj[i].id_note+'" class="btn btn-primary">View Note</a>'+
                        '</div>'+
                       '</div>'+
                      '</div>'
                  );
                }
              },
              error: function(xhr, status, error) {
              console.error(xhr);
              }
            });
          }

          $("#search-con").show();
        });
      return false;
      });

    });
  </script>
  <script type="text/javascript">
    var width = (window.innerWidth > 0) ? window.innerWidth : screen.width;
    if (width<600){

      var element = document.querySelector("#btn-logout")
      element.classList.add("mt-3","mb-2");
      element.classList.remove("ms-2");
    }
  </script>
  </body>
</html>
