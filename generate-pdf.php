<?php
// Include the FPDF library
require('fpdf/fpdf.php');
session_start();
if (!isset($_SESSION['uid'])) {
     header("Location: login.php");
     exit();
}
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "craftsmendb";
$conn = new mysqli($servername, $username, $password, $dbname);
$uid = $_SESSION['uid'];
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
}
// Start a new PDF document
$pdf = new FPDF();
$pdf->AddPage();

// Set the font and font size

$pdf->SetFont('Arial', 'B', 25);
$pdf->Cell(0, 10, 'CRAFTMEN HARDWARE SHOPPING', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 23);
// Add a title to the PDF
$pdf->Cell(0, 10, 'Invoice Details', 1, 1, 'C');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 18);

$pdf->Cell(0, 10, 'Customer Details', 0, 1, 'C');
$pdf->Ln();

// Retrieve the data from the database and add it to the PDF
$pdf->SetFont('Arial', 'B', 15);
$sql = "SELECT * FROM users WHERE uid ='$uid'";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $pdf->Cell(80, 10, $row['username']);
          $pdf->Ln();
          $pdf->Cell(30, 10, $row['email']);
          $pdf->Ln();
          $pdf->Cell(40, 10, $row['phoneNumber']);
          $pdf->Ln();
     }
} else {
     $pdf->Cell(0, 10, 'No Results!', 1);
}


// Add a line break
$pdf->Ln();

// Set the font size for the table
$pdf->SetFont('Arial', 'B', 18);

$pdf->Cell(0, 10, 'Order Details', 0, 1, 'C');
$pdf->Ln();
// Add the table headers
$pdf->Cell(80, 10, 'Product Name', 1);
$pdf->Cell(30, 10, 'Quantity', 1);
$pdf->Cell(40, 10, 'Price/Item', 1);
$pdf->Cell(40, 10, 'Total Price', 1);
$pdf->Ln();

// Retrieve the data from the database and add it to the PDF
$sql = "SELECT * FROM cart WHERE uid ='$uid'";
$result = $conn->query($sql);

$pdf->SetFont('Arial', 'B', 15);
if ($result->num_rows > 0) {
     while ($row = $result->fetch_assoc()) {
          $pdf->Cell(80, 10, $row['product_name'], 1);
          $pdf->Cell(30, 10, $row['quantity'], 1);
          $pdf->Cell(40, 10, $row['price'], 1);
          $pdf->Cell(40, 10, $row['total'], 1);
          $pdf->Ln();
     }
} else {
     $pdf->Cell(0, 10, 'No Results!', 1);
}

// Output the PDF document
$pdf->Output();
