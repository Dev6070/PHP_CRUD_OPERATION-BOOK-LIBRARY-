<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library";

$your_database_connection = new mysqli($servername, $username, $password, $dbname);

if (isset($_POST['searchInput'])) {
    $searchInput = $_POST['searchInput'];
    $sortColumn = isset($_POST['sortColumn']) ? $_POST['sortColumn'] : 'Book_name';
    $sortOrder = isset($_POST['sortOrder']) ? $_POST['sortOrder'] : 'ASC';
    
    


    // Perform a search in your database based on the input and sort criteria
    // Replace 'book' with the actual name of your database table
    if($sortColumn == 'Book_name'){
      
        $query = "SELECT * FROM book 
        WHERE Book_name LIKE '%$searchInput%' 
        OR Author LIKE '%$searchInput%' 
        OR Book_price LIKE '%$searchInput%' 
        OR Book_quantity LIKE '%$searchInput%'
        ORDER BY Book_name $sortOrder"; //"select * from book where order by '".$sortColumn."' 

    }
    else if($sortColumn == 'Book_price'){
        $query = "SELECT * FROM book 
        WHERE Book_name LIKE '%$searchInput%' 
        OR Author LIKE '%$searchInput%' 
        OR Book_price LIKE '%$searchInput%' 
        OR Book_quantity LIKE '%$searchInput%'
        ORDER BY Book_price $sortOrder";

    }  else if($sortColumn == 'Book_quantity'){
        $query = "SELECT * FROM book 
        WHERE Book_name LIKE '%$searchInput%' 
        OR Author LIKE '%$searchInput%' 
        OR Book_price LIKE '%$searchInput%' 
        OR Book_quantity LIKE '%$searchInput%'
        ORDER BY Book_quantity  $sortOrder";

    }else if($sortColumn == 'Author'){
        $query = "SELECT * FROM book 
        WHERE Book_name LIKE '%$searchInput%' 
        OR Author LIKE '%$searchInput%' 
        OR Book_price LIKE '%$searchInput%' 
        OR Book_quantity LIKE '%$searchInput%'
        ORDER BY Author $sortOrder";

    }else{

        $query = "SELECT * FROM book 
        WHERE Book_name LIKE '%$searchInput%' 
        OR Author LIKE '%$searchInput%' 
        OR Book_price LIKE '%$searchInput%' 
        OR Book_quantity LIKE '%$searchInput%'
       ";

    }
   


    // Execute the query
    $result = mysqli_query($your_database_connection, $query);

    if (!$result) {
        die('Query Failed: ' . mysqli_error($your_database_connection));
    }

    // Display the search results in a table
    echo '<table border="1">';
    echo '<tr>';
    echo '<th onclick="sortColumn(\'Book_id\')">Book ID ' . getSortIndicator('Book_id', $sortColumn, $sortOrder) . '</th>';
    echo '<th onclick="sortColumn(\'Book_name\')">Book Name ' . getSortIndicator('Book_name', $sortColumn, $sortOrder) . '</th>';
    echo '<th onclick="sortColumn(\'Author\')">Author ' . getSortIndicator('Author', $sortColumn, $sortOrder) . '</th>';
    echo '<th onclick="sortColumn(\'Book_price\')">Book Price ' . getSortIndicator('Book_price', $sortColumn, $sortOrder) . '</th>';
    echo '<th onclick="sortColumn(\'Book_quantity\')">Book Quantity ' . getSortIndicator('Book_quantity', $sortColumn, $sortOrder) . '</th>';
    echo '</tr>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['Book_id'] . '</td>';
        echo '<td>' . $row['Book_name'] . '</td>';
        echo '<td>' . $row['Author'] . '</td>';
        echo '<td>' . $row['Book_price'] . '</td>';
        echo '<td>' . $row['Book_quantity'] . '</td>';
        echo '</tr>';
    }

    echo '</table>';
    // Close the database connection
    mysqli_close($your_database_connection);
}


function getSortIndicator($columnName, $sortColumn, $sortOrder) {
    if ($columnName == $sortColumn) {
        return ($sortOrder =='ASC') ? '▲' : '▼';
        
    }
    
    
    return'';
}

?>
