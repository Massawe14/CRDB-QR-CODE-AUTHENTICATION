<?php 
  date_default_timezone_set("Africa/Dar_es_Salaam");
  include('config/db.php');

  $qrcode = $_POST['code']; 

  // $query = "SELECT first_name, last_name FROM qrcodes WHERE qrImage='$qrcode' LIMIT 1";
  $query = "SELECT * FROM qr_codes WHERE qrImage='$qrcode' LIMIT 1";
  $result = mysqli_query($conn, $query);

  // if ($result) {
  // 	$first_name = "";
  //   $last_name = "";
  // 	while ($row = mysqli_fetch_object($result)) {
  // 		$first_name = $row->first_name;
  // 		$last_ame = $row->last_name;
  // 	}
  // 	if ($first_name != "" && $last_name != "") {
  // 		echo "{first_name: '$first_name', last_name: '$last_name'}";
  // 	}
  //   else {
  //   	echo "Not Found";
  //   }
  // }
  // else {
  // 	echo "Not Authorized";
  // }
  if (mysqli_num_rows($result) > 0) {
  	// $first_name = "";
   //  $last_name = "";
    $full_name = "";
    $phone_number = "";
    $company_name = "";
    $position = "";
    $table_number = "";
    foreach ($result as $row) {
    	// $first_name = $row['first_name'];
    	// $last_name = $row['last_name'];
      $full_name = $row['full_name'];
      $phone_number = $row['phone_number'];
      $company_name = $row['company_name'];
      $position = $row['position'];
      $table_number = $row['table_number'];
    }
  	// if ($first_name != "" && $last_name != "") {
  	// 	echo '{"first_name": "' . $first_name . '", "last_name": "' .$last_name . '"}';
  	// }
    if ($full_name != "" && $phone_number != "" && $company_name != "" && $position != "" && $table_number != "") {
      // echo '{"first_name": "' . $first_name . '", "last_name": "' .$last_name . '"}';
      // echo '{"full_name": "' .$full_name . '"}'; 
      if (date("d-m-Y") === "25-03-2022") {
        $query = "INSERT INTO `eventlist`(`full_name`, `phone_number`, `company_name`, `position`, `table_number`) VALUES ('$full_name', '$phone_number', '$company_name', '$position', '$table_number')";
        $result = mysqli_query($conn, $query);
        if ($result) {
          // echo "Attended";
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
          // echo "Attended";
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

  // if(date("d-m-Y") === "11-12-2021") {
  //   echo "Today is 11-12-2021";

  // }

?>