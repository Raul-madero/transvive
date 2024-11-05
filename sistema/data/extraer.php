<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "transvive";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Add custom search condition if provided
if (isset($_POST['customSearch'])) {
  $customSearch = $_POST['customSearch'];
  $sql="SELECT * FROM personal WHERE nombres LIKE '%$customSearch%' OR salario LIKE '%$customSearch%' OR id LIKE '%$customSearch%' OR email LIKE '%$customSearch%' ";
}

// Execute the SQL query and fetch the results
$result = $conn->query($sql);

// Prepare the response data for DataTables
$response = array(
  "draw" => intval($_POST['draw']),
  "recordsTotal" => 0,
  "recordsFiltered" => 0,
  "data" => array()
);

if ($result->num_rows > 0) {
  $response['recordsTotal'] = $result->num_rows;
  $response['recordsFiltered'] = $result->num_rows;

  while ($row = $result->fetch_assoc()) {
    // Prepare the row data
    $rowData = array(
      $row['id'],
      $row['nombres'],
      $row['salario'],
      $row['email']
      // Add more fields as needed
    );

    $response['data'][] = $rowData;
  }
}

// Close the database connection
$conn->close();

// Return the response data as JSON
echo json_encode($response);
?>
