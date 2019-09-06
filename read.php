<?php

// Check existence of id parameter before processing further
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
      // Include config file
      require_once "config.php";
      
// Prepare a select statement
$sql = "SELECT * FROM employees WHERE id = :id";

if($stmt = $pdo->prepare($sql)){
     // Bind variables to the prepared statement as parameters
     $stmt->bindParam(":id", $param_id);
     
     // Set parameters
     $param_id = trim($_GET["id"]);
     
    // Attempt to execute the prepared statement
    if($stmt->execute()){
        if($stmt->rowCount() == 1){
/* Fetch result row as an associative array. Since the result set contains only one row, we don't need to use while loop */
 $row = $stmt->fetch(PDO::FETCH_ASSOC);

// Retrieve individual field value
$nome = $row["nome"];
$endereco = $row["endereco"];
$salario = $row["salario"];
} else{
     // URL doesn't contain valid id parameter. Redirect to error page
     header("location: error.php");
     exit();
 }
} else{
    echo "Oops! Algo deu errado. Por favor, digite novamente";
 }
}

// Close statement
unset($stmt);

   // Close connection
   unset($pdo);
  } else{
     // URL doesn't contain id parameter. Redirect to error page
header("location: error.php");
exit();
}
?>
