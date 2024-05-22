<?php
    include 'db.php';
    session_start();
    if(count($_POST)>0){
        $genre = implode(",", $_POST['m_genre']);
        mysqli_query($connection,"UPDATE tbl_232_movies set m_title = '". $_POST['m_title'] ."',m_directors = '". $_POST['m_directors'] ."',
        m_discreption = '". $_POST['m_discreption'] ."',m_genre = '". $genre ."' 
        where m_id='". $_POST['m_id'] ."'");
        header("Location: moviepage.php?movieId=" . $_POST['m_id']);
         exit;
    }
    $result = mysqli_query($connection, "SELECT * FROM tbl_232_movies WHERE m_id='" . $_GET['movieId'] . "'");
    $row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Movie</title>
        <meta name="viewport" content="width=device-width" initial-scale="1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@500&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
            <form action="" method="POST">
                <?php if(isset($message)){ echo $message;} ?>
                    <input type="hidden" name="m_id" value="<?php echo $row['m_id']; ?>">
                    Title:
                    <input class="form-control" name="m_title" id="box-color" value="<?php echo $row['m_title']; ?>">
                    <br>
                    Directors:        
                    <input class="form-control" name="m_directors" id="box-color" value="<?php echo $row['m_directors']; ?>">
                    <br>
                    Description:
                    <textarea name="m_discreption" id="box-color" class="form-control" rows="5"><?php echo $row['m_discreption']; ?></textarea>                    <br>
                    Genres:
                    <br>
                    <div class="row">
                    <div class="form-group col-md-4">
                       <input type="checkbox" class="form-check-input" name="m_genre[]" value="Adventure" <?php if (in_array('Adventure', explode(',', $row['m_genre']))) echo 'checked'; ?>> Adventure</div>     
                        <div class="form-group col-md-4">
                        <input type="checkbox" class="form-check-input" name="m_genre[]" value="Action" <?php if (in_array('Action', explode(',', $row['m_genre']))) echo 'checked'; ?>> Action</div>       
                    <div class="form-group col-md-4">
                    <input type="checkbox" class="form-check-input" name="m_genre[]" value="Animation" <?php if (in_array('Animation', explode(',', $row['m_genre']))) echo 'checked'; ?>> Animation</div>       
                    </div>
                    <div class="row">
                    <div class="form-group col-md-4">
                       <input type="checkbox" class="form-check-input" name="m_genre[]" value="Comedy" <?php if (in_array('Comedy', explode(',', $row['m_genre']))) echo 'checked'; ?>> Comedy</div>       
                    <div class="form-group col-md-4">
                        <input type="checkbox" class="form-check-input" name="m_genre[]" value="Crime and Mystery" <?php if (in_array('Crime and Mystery', explode(',', $row['m_genre']))) echo 'checked'; ?>> Crime and Mystery</div>       
                    <div class="form-group col-md-4">
                            <input type="checkbox" class="form-check-input" name="m_genre[]" value="Drama" <?php if (in_array('Drama', explode(',', $row['m_genre']))) echo 'checked'; ?>> Drama</div>       
                    </div>
                    <div class="row">
                    <div class="form-group col-md-4">
                        <input type="checkbox" class="form-check-input" name="m_genre[]" value="Fantasy" <?php if (in_array('Fantasy', explode(',', $row['m_genre']))) echo 'checked'; ?>> Fantasy</div>       
                    <div class="form-group col-md-4">
                           <input type="checkbox" class="form-check-input" name="m_genre[]" value="Historical" <?php if (in_array('Historical', explode(',', $row['m_genre']))) echo 'checked'; ?>> Historical</div>       
                    <div class="form-group col-md-4">
                          <input type="checkbox" class="form-check-input" name="m_genre[]" value="Horror" <?php if (in_array('Horror', explode(',', $row['m_genre']))) echo 'checked'; ?>> Horror</div>       

                    </div>
                    <div class="row">
                    <div class="form-group col-md-4">
                        <input type="checkbox" class="form-check-input" name="m_genre[]" value="Romance" <?php if (in_array('Romance', explode(',', $row['m_genre']))) echo 'checked'; ?>> Romance</div>       
                    <div class="form-group col-md-4">
                          <input type="checkbox" class="form-check-input" name="m_genre[]" value="Sci-fi" <?php if (in_array('Sci-fi', explode(',', $row['m_genre']))) echo 'checked'; ?>> Sci-fi</div>       
                    </div>
                    <br>
                    Trailer URL
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <!-- <input type="url" class="form-control" id="box-color" name="website" <?php echo $row['website']; ?>></div><br><br> -->
                            <span>Movie Image: <input type="file" id="myFile" name="filename"></span>
                            <div class="form-group col-md-3"></div>
                            <div class="form-group col-md-3">
                            <input type="submit" class="btn btn-primary"  value="update"></div>
                    </div>
            </form >
      </body>
</html>