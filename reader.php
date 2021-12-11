<?php 
  date_default_timezone_set("Africa/Dar_es_Salaam");
  include('config/db.php');

  $qrcode = $_POST['code']; 

  // $query = "SELECT first_name, last_name FROM qrcodes WHERE qrImage='$qrcode' LIMIT 1";
  $query = "SELECT * FROM barcodes WHERE qrImage='$qrcode' LIMIT 1";
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
    $branch_name = "";
    $zone = "";
    foreach ($result as $row) {
    	// $first_name = $row['first_name'];
    	// $last_name = $row['last_name'];
      $full_name = $row['full_name'];
      $branch_name = $row['branch_name'];
      $zone = $row['zone'];
    }
  	// if ($first_name != "" && $last_name != "") {
  	// 	echo '{"first_name": "' . $first_name . '", "last_name": "' .$last_name . '"}';
  	// }
    if ($full_name != "" && $branch_name != "" && $zone != "") {
      // echo '{"first_name": "' . $first_name . '", "last_name": "' .$last_name . '"}';
      // echo '{"full_name": "' .$full_name . '"}'; 
      if (date("d-m-Y") === "13-12-2021") {
        $query = "INSERT INTO `monday`(`full_name`, `branch_name`, `zone`) VALUES ('$full_name', '$branch_name', '$zone')";
        $result = mysqli_query($conn, $query);
        if ($result) {
          // echo "Attended";
          echo '{"full_name": "' .$full_name . '"}';
        }
        else{
          echo "Not attend";
        }
      }else if (date("d-m-Y") === "14-12-2021") {
        $query = "INSERT INTO `eventlist`(`full_name`, `branch_name`, `zone`) VALUES ('$full_name', '$branch_name', '$zone')";
        $result = mysqli_query($conn, $query);
        if ($result) {
          // echo "Attended";
          echo '{"full_name": "' .$full_name . '"}';
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