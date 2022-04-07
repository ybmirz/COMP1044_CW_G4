<?php 
    

    $server = "localhost";
     $username = "root";
     $password = "";
     $dbname = 'bookswamp';

     $conn = new mysqli($server, $username, $password, $dbname);
     if ($conn->connect_error) {
        die("Error connecting to database. " . $conn->connect_error);
     }

     // Getting the data
     $result = $conn->query("SELECT * FROM book_information WHERE id_pk = {$_GET["book_id"]} LIMIT 1");
     if ($result->num_rows > 0){
        $bookData = mysqli_fetch_assoc($result);
     } else {
        die('Error: Book Information does not exist. Please check again.');
     }
     


     // Working the data to be called from the html
     $author = $bookData['authors'];
     $isbn = $bookData['isbn_13'];
     $copyrightYR = $bookData['copyright_year'];

     // Publisher needs to connect to db once more
     $query = "SELECT * FROM publisher WHERE id_pk = {$bookData['publisher_fk']}";
     $result = $conn->query($query);
     if ($result->num_rows > 0) {
         $publisherData = mysqli_fetch_assoc($result);
     } else
        die("Error: Publisher information for Book Id {$bookData['id_pk']} was not found, Publisher Id: {$bookData['publisher_fk']}");
     $publisher = $publisherData['name'] . ", ". $publisherData['hq_address'];

     $conn->close();
    include '../html/book_information.html';
    
?>