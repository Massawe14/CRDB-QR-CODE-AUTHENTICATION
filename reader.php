<?php 
  date_default_timezone_set("Africa/Dar_es_Salaam");
  include('config/db.php');

  $qrcode = $_POST['code'];

  $query = "SELECT * FROM qr_codes WHERE qrImage='$qrcode' LIMIT 1";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
    $full_name = "";
    $phone_number = "";
    $company_name = "";
    $position = "";
    $table_number = "";

    foreach ($result as $row) {
      $full_name = $row['full_name'];
      $phone_number = $row['phone_number'];
      $company_name = $row['company_name'];
      $position = $row['position'];
      $table_number = $row['table_number'];
    }

    if ($full_name != "" && $phone_number != "" && $company_name != "" && $position != "" && $table_number != "") { 
      if (date("d-m-Y") === "25-03-2022") {
        $query = "INSERT INTO `eventlist`(`full_name`, `phone_number`, `company_name`, `position`, `table_number`) VALUES ('$full_name', '$phone_number', '$company_name', '$position', '$table_number')";
        $result = mysqli_query($conn, $query);
        if ($result) {
          echo '{
            "full_name": "' .$full_name . '",
            "phone_number": "' .$phone_number . '",
            "company_name": "' .$company_name . '",
            "position": "' .$position . '",
            "table_number": "' .$table_number . '"
          }';
        }
        else{
          echo "Not attend";
        }
      }else if (date("d-m-Y") === "26-03-2022") {
        $query = "INSERT INTO `eventlist`(`full_name`, `phone_number`, `company_name`, `position`, `table_number`) VALUES ('$full_name', '$phone_number', '$company_name', '$position', '$table_number')";
        $result = mysqli_query($conn, $query);
        if ($result) {
          echo '{
            "full_name": "' .$full_name . '",
            "phone_number": "' .$phone_number . '",
            "company_name": "' .$company_name . '",
            "position": "' .$position . '",
            "table_number": "' .$table_number . '"
          }';
        }
        else{
          echo "Not attend";
        }
      }else{
        echo '{"full_name": "' .$full_name . '"}';
      }
    }
  	else {
    	echo '{"error": "Not Found"}';
    }
  	exit();
  }
  else{
  	echo '{"error": "Not Authorized"}';
  }

?>