<?php 
  include('config/db.php');

  $qrcode = $_POST['code']; 

  // $query = "SELECT first_name, last_name FROM qrcodes WHERE qrImage='$qrcode' LIMIT 1";
  $query = "SELECT full_name FROM barcodes WHERE qrImage='$qrcode' LIMIT 1";
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
    foreach ($result as $row) {
    	// $first_name = $row['first_name'];
    	// $last_name = $row['last_name'];
      $full_name = $row['full_name'];
    }
  	// if ($first_name != "" && $last_name != "") {
  	// 	echo '{"first_name": "' . $first_name . '", "last_name": "' .$last_name . '"}';
  	// }
    if ($full_name != "") {
      // echo '{"first_name": "' . $first_name . '", "last_name": "' .$last_name . '"}';
      echo '{"full_name": "' .$full_name . '"}';
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