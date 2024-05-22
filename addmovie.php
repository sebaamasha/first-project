<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Process the form data and insert it into the database

    $m_id = $_POST['m_id'];
    $m_title = $_POST['m_title'];
    $m_directors = $_POST['m_directors'];
    $m_discreption = $_POST['m_discreption'];
    $m_genre = implode(",", $_POST['m_genre']);

    // If m_id is not empty, it means we are updating an existing movie
    if (!empty($m_id)) {
        // Perform the database update (SQL query) here
        // Example:
        $sql = "UPDATE tbl_232_movies SET m_title='$m_title', m_directors='$m_directors', m_discreption='$m_discreption', m_genre='$m_genre' WHERE m_id='$m_id'";
        $result = mysqli_query($connection, $sql);
    } else {
        // If m_id is empty, it means we are adding a new movie
        // Perform the database insertion (SQL query) here
        // Example:
        $user_name=$_SESSION['user_name'];
        $sql = "INSERT INTO tbl_232_movies (m_title, m_directors, m_discreption, m_genre,user_name) VALUES (\"$m_title\", \"$m_directors\", \"$m_discreption\", \"$m_genre\",\"$user_name\")";
        $result = mysqli_query($connection, $sql);

        if ($result) {
            // Movie inserted successfully, now handle file upload
            if (isset($_FILES['filename']) && $_FILES['filename']['error'] === UPLOAD_ERR_OK) {
                $fileName = $_FILES['filename']['name'];
                $tmpName = $_FILES['filename']['tmp_name'];
    
                // Specify the upload directory (make sure it exists and is writable)
                $uploadDirectory = 'path/to/your/upload/directory/' . $fileName;
    
                // Move the uploaded file to the specified directory
                if (move_uploaded_file($tmpName, $uploadDirectory)) {
                    // File upload successful
                    // Perform any additional processing or database updates as needed
                } else {
                    // File upload failed
                    die("Error: Unable to move the movie image to the destination directory.");
                }
            }
    
            // Redirect to index.php or moviepage.php after successful insertion
            header("Location: index.php");
            exit;
        } else {
            // Error inserting the movie into the database
            die("Error: Unable to insert the movie into the database.");
        }
    }}
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
                
                    <input type="hidden" name="m_id" value="">
                    Title:
                    <input class="form-control" name="m_title" id="box-color" value="">
                    <br>
                    Directors:        
                    <input class="form-control" name="m_directors" id="box-color" value="">
                    <br>
                    Description:
                    <textarea name="m_discreption" id="box-color" class="form-control" rows="5"></textarea>                    <br>
                    Genres:
                    <br>
                    <div class="row">
                    <div class="form-group col-md-4">
                       <input type="checkbox" class="form-check-input" name="m_genre[]" value="Adventure"> Adventure</div>     
                        <div class="form-group col-md-4">
                        <input type="checkbox" class="form-check-input" name="m_genre[]" value="Action" > Action</div>       
                    <div class="form-group col-md-4">
                    <input type="checkbox" class="form-check-input" name="m_genre[]" value="Animation" > Animation</div>       
                    </div>
                    <div class="row">
                    <div class="form-group col-md-4">
                       <input type="checkbox" class="form-check-input" name="m_genre[]" value="Comedy" > Comedy</div>       
                    <div class="form-group col-md-4">
                        <input type="checkbox" class="form-check-input" name="m_genre[]" value="Crime and Mystery"> Crime and Mystery</div>       
                    <div class="form-group col-md-4">
                            <input type="checkbox" class="form-check-input" name="m_genre[]" value="Drama"> Drama</div>       
                    </div>
                    <div class="row">
                    <div class="form-group col-md-4">
                        <input type="checkbox" class="form-check-input" name="m_genre[]" value="Fantasy" > Fantasy</div>       
                    <div class="form-group col-md-4">
                           <input type="checkbox" class="form-check-input" name="m_genre[]" value="Historical" > Historical</div>       
                    <div class="form-group col-md-4">
                          <input type="checkbox" class="form-check-input" name="m_genre[]" value="Horror"> Horror</div>       

                    </div>
                    <div class="row">
                    <div class="form-group col-md-4">
                        <input type="checkbox" class="form-check-input" name="m_genre[]" value="Romance" > Romance</div>       
                    <div class="form-group col-md-4">
                          <input type="checkbox" class="form-check-input" name="m_genre[]" value="Sci-fi"> Sci-fi</div>       
                    </div>
                    <br>
                    Trailer URL
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <!-- <input type="url" class="form-control" id="box-color" name="website"></div><br> -->
                            <span>Movie Image: <input type="file" id="myFiles" name="filename[]" multiple></span>
                            <div class="form-group col-md-3"></div>
                            <div class="form-group col-md-3">
                            <input type="submit" class="btn btn-primary"  value="ADD"></div>
                    </div>
            </form >
      </body>
</html>