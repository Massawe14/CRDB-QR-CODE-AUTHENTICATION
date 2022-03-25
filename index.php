<?php 
  date_default_timezone_set("Africa/Dar_es_Salaam");
  $host = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $db = "wima_event"; 

  // Connection
  $conn = mysqli_connect("$host","$username","$password","$db");

  // Check connection
  if (!$conn) {
    die(mysqli_connect_error($conn));
  }

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>QR Code Scanner</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style/index.css" type="text/css">
    <link rel="stylesheet" href="style/bubble.css" type="text/css">
    <link rel="stylesheet" href="style/fonts.css" type="text/css">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/ico">
    <meta name="description" content="CRDB QR Code Scanner">
    <meta name="robots" content="noindex,follow" />
</head>
<body id="app-main">
    <div class="btn-container">
        <h3 class="greeting">WELCOME TO WIMA EVENT</h3>
    </div>
    <div id="output_dialog">
        <span id="full_name_text"></span>
        <span id="table_number_text"></span>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        try {  
            let speech = new SpeechSynthesisUtterance();
            speech.lang = "en";
            speech.rate = 1;
            speech.pitch = 1;
            speech.volume = 100;

            let voices = [];
            window.speechSynthesis.onvoiceschanged = () => {
                voices = window.speechSynthesis.getVoices();
                console.log("voices: ",voices);
                if (voices.length > 0) {
                    speech.voice = voices.length > 1 ? voices[1] : voices[0];
                }
                
            };
            var txt = "";
            document.addEventListener("keypress", function(event) {
                var char = event.key;
                if(char == "Enter") {
                    var code = txt;
                    console.log("qr code", txt);
                    txt = "";
                    $.ajax({
                      method: "POST",
                      url: "reader.php",
                      data: { code: code }
                    })
                      .done(function( response ) {
                        try {  
                        console.log(response);
                        var obj = JSON.parse(response);
                        if (obj.error) {
                            console.log('error: ', obj.error);
                            return;
                        }
                        const full_name = obj.full_name;
                        const phone_number = obj.phone_number;
                        const company_name = obj.company_name;
                        const position = obj.position;
                        const table_number = obj.table_number;
                        console.log('fullname: ', full_name);
                        console.log('phone number: ', phone_number);
                        console.log('company name: ', company_name);
                        console.log('position: ', position);
                        console.log('table_number: ', table_number);
                        showOutput(full_name, phone_number, company_name, position, table_number);
                        } catch (e) {
                            console.log(e);
                        }
                      });
                } else {
                    txt += char;
                }
            });

            function showOutput(full_name, phone_number, company_name, position, table_number) {
                speech.text = "Welcome";
                window.speechSynthesis.speak(speech);
                var dialog = document.getElementById("output_dialog");
                var full_name_text = document.getElementById("full_name_text");
                var table_number_text = document.getElementById("table_number_text");
                full_name_text.innerHTML = full_name;
                table_number_text.innerHTML = table_number;
                dialog.style.display = "block";
                setTimeout(() => {
                    full_name_text.innerHTML = "";
                    table_number_text.innerHTML = "";
                    dialog.style.display = "none";
                }, 3000);
            }
        } catch (e) {
        console.log(e);
        }
    </script>
    <script src="routes/bubble.js" type="text/javascript"></script> 
</body>
</html>