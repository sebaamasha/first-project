<?php
  session_start();
  include 'db.php';
  // print_r($_SESSION);
  if ((!isset($_SESSION['user_name'])) || (!isset($_SESSION['user_password'])))
  {
    
    if (isset($_POST['username']) && isset($_POST['password'])) {
      
      function validate($data)
      {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);
          return $data;
      }

      $uname = validate($_POST['username']);
      $pass =  validate($_POST['password']);

      if (empty($uname)) {
          header("Location: login.php?error=user name is required");
          exit();
      } else if (empty($pass)) {
          header("Location: login.php?error=password is required");
          exit();
      } else {
          $sql = "SELECT * FROM tbl_232_users where user_name = '$uname' and user_password = '$pass'";
          $result = mysqli_query($connection , $sql);
          if($result)
          {
            $row = mysqli_fetch_assoc($result);
            if($row['user_name'] === $uname && $row['user_password'] === $pass)
            {
              $_SESSION['user_name'] = $row['user_name'];
              $_SESSION['user_password'] = $row['user_password'];
              $_SESSION['user_type']=$row['user_type'];
              // echo "user_type".$row['user_type'] ;
            }
            else{
              header("Location: login.php?error=Incorrect user name or password");
              exit();
            }
          
          }
        }
      
      } else {
      header("Location: login.php");
      exit();
      }
  }
?>

<?php
include 'db.php';

if(isset($_GET["genre"])){
 $cat = $_GET["genre"];
  if($cat==="All"){
    $query 	= "SELECT * FROM tbl_232_movies ";
  }else
  {
    $query  = "SELECT * FROM tbl_232_movies where m_genre = '$cat'";

  }
    }else{
    $query  = "SELECT * FROM tbl_232_movies ";

    }

$result = mysqli_query($connection , $query);

if(!$result)
{
    die("DB query failed !");
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <title>PopcornBuster</title>
  </head>
  <body>
    
        <header>
            <a href="index.php" id="logo"><img src="./images/logo.png"></a>
            <form action="#" method="POST">
            <input class="form-control me-2" type="search" name="search" placeholder="Search.." aria-label="Search">
            <input type="submit" name="submit" value="Search" class="searchbutton">
            </form>
            <div id="logout"><a href="login.php">logout</a></div> 
        </header>
        <div id="wrapper">
        <div class="main-content">
            <div id="carousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="./images/gotg2.jpeg" class="d-block w-100" alt="Guardians">
                    <a href="moviepage.php?movieId=10" class="btn btn-outline-primary" role="button" aria-disabled="true">Expand</a>
                  </div>
                  <div class="carousel-item">
                    <img src="./images/fb.jpeg" class="d-block w-100" alt="Another Image">
                    <a href="moviepage.php?movieId=1" class="btn btn-outline-primary" role="button" aria-disabled="true">Expand</a>
                  </div>
                  <div class="carousel-item">
                    <img src="./images/Titanic2.jpg" class="d-block w-100" alt="Another Image">
                    <a href="moviepage.php?movieId=9" class="btn btn-outline-primary" role="button" aria-disabled="true">Expand</a>
                  </div>
                  <div class="carousel-item">
                    <img src="./images/deadpool.jpeg" class="d-block w-100" alt="Another Image">
                    <a href="#" class="btn btn-outline-primary" role="button" aria-disabled="true">Expand</a>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carousel" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carousel" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <!-- <span class="visually-hidden">Next</span> -->
                </button>
              </div>
        </div>


        <div  class="btn btn-outline" id="filter-buttons">
        </div>
        <div id="search_section">
        <?php
        if (isset($_POST['submit'])) {
          $str=$_POST['search'];
            $search = "SELECT * FROM tbl_232_movies WHERE m_title LIKE '%$str%'";
            $result = mysqli_query($connection, $search);
            if ($result) {
              echo '<div class="row">';
              while($row = mysqli_fetch_assoc($result))
              {
                  
                  $img = $row["m_image1"];
              
              echo '<div class="movies">
                  <div><a href="moviepage.php?movieId='.$row["m_id"].'"> <img class="movie_img" src="'. $img .'" alt="'. $row["m_title"] . '"> </a> </div>
                  <h5><b>'. $row["m_title"] . '</b></h5>
                  <h6>'. $row["m_year"] . '</h6>
              
              </div>';
              }
            } else {
                echo "No results found.";
            }
        }
        ?>
        </div>
        <div id="container">
             <?php
            echo '<div class="row">';
            while($row = mysqli_fetch_assoc($result))
            {
                
                $img = $row["m_image1"];
            
            echo '<div class="movies">
                <div><a href="moviepage.php?movieId='.$row["m_id"].'"> <img class="movie_img" src="'. $img .'" alt="'. $row["m_title"] . '"> </a> </div>
                <h5><b>'. $row["m_title"] . '</b></h5>
                <h6>'. $row["m_year"] . '</h6>
            
            </div>';
            }

            ?>
            <a href="addmovie.php">Add Recommend a Movie</a>
          
            <!-- <?php
            // if(isset($_SESSION['user_type'])){
            //   $user_type = $_SESSION['user_type'];
            //   if($user_type == '1')
            //  {
            //  echo '<a href="addmovie.php">Add Recommend a Movie</a>';
            //  }
            // } 
            ?>-->
             </div>
        <script src="js/javascript.js"></script>
  </body>
</html>

