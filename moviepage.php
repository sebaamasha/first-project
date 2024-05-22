<?php 
session_start();
include 'db.php';

if (isset($_GET['movieId'])) {
    $movieId = $_GET['movieId'];

    $query = "SELECT * FROM tbl_232_movies WHERE m_id = ".$movieId;
    $result = mysqli_query($connection, $query);

    if (!$result) {
        die("DB query failed !");
    } else {
        $row = mysqli_fetch_assoc($result);
    }

    if (isset($_POST['deleteMovie'])) {
        $query = "DELETE FROM tbl_232_movies WHERE m_id = $movieId";
        $result = mysqli_query($connection, $query);

        if ($result) {
            header("Location: index.php");
            exit;
        } else {
            die("Error deleting the movie.");
        }
    }

} else {
    die("Invalid movieId.");
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
    <title>MoviePage</title>
  </head>
  <body>
        <header>
            <a href="index.php" id="logo"></a>
        </header>
        
            
        <div id="movie_container">
        <?php
            echo    ' 
                        
                       <img id="movie_img2" src="'. $row["m_image2"] .'" alt="movie image 2">
                       <img id="movie_img1" src="'. $row["m_image1"] .'" alt="movie image 1"> 
                       <h1 id="moviename"> <b>'. $row["m_title"] .'</b></h1>
                       <h6 id="movietime">'. $row["m_time"] .' m</h6>
                       <h6 id="movieyear"> '. $row["m_year"] .' </h6>
                       <p id="m_desc">'. $row["m_discreption"] .'</p>
                       <h6 id="mainact"> <b>Main Actors :</b> '. $row["m_actors"] .'</h6>
                       <h6 id="maindirect"> <b>Main Director :</b> '. $row["m_directors"] .'</h6>
                       <h6 id="moviegenre"><b>Genre :</b>  '. $row["m_genre"] .'</h6>
                       <br>
                    ';
        ?>
        <form method="POST">
                  <input type="hidden" name="movieId" value="<?php echo $movieId; ?>">
                  <input type="submit"class="btn btn-primary backbtn" name="deleteMovie" value="Delete">
                  </form>
          <a class="btn btn-primary backbtn" href="editrecommovie.php?movieId=<?php echo $row["m_id"];?>" role="button">update</a>
          <a class="btn btn-primary backbtn" href="index.php" role="button">back</a>
          
          <!-- <?php
            // if(isset($_SESSION['user_type'])){
            //   $user_type = $_SESSION['user_type'];
            //   if($user_type == '1')
            //  {
            //         echo '<form method="POST">
            //         <input type="hidden" name="movieId" value="<?php echo $movieId; ?>">
            //         <input type="submit" name="deleteMovie" value="Delete">
            //         </form>';
            //  }
            // }
            ?> -->
           

        <?php 

            mysqli_free_result($result);

         ?>
            
            </div>
  </body>
</html>

