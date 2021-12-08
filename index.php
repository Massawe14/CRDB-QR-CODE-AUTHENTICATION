<?php 

  $host = "localhost"; 
  $username = "root"; 
  $password = ""; 
  $db = "event_db"; 

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
        <!-- <span id="btn" class="btn .user-select-none">Start Scanner</span> -->
        <h3 class="greeting">Welcome To Branch Managers Conference 2021</h3>
        <!-- <p class="message">We maintain an informal but productive environment that cherishes wisdom, nurtures intellect and celebrates talent. All ideas at CRDB Bank are considered valuable contributions and each employee is encouraged to share any innovative and inspiring ideas.</p> -->
    </div>

    <div id="output_dialog" style="display: none;">
        <span>Welcome</span>
        <span id="full_name_text"></span>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">

        try {  
            let speech = new SpeechSynthesisUtterance();
            speech.lang = "en";
            //speech.text = "Welcome, " + first_name + " " + last_name;
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
                        //console.log("qr response ", response);
                        try {  
                        //console.log(typeof response);
                        var obj = JSON.parse(response);
                        if (obj.error) {
                            console.log('error: ', obj.error);
                            return;
                        }
                        const first_name = obj.first_name;
                        const last_name = obj.last_name;
                        console.log('first_name: ', first_name);
                        console.log('last_name: ', last_name);
                        showOutput(first_name, last_name);
                        } catch (e) {
                            console.log(e);
                        }
                      });
                } else {
                    txt += char;
                }
            });

            function showOutput(first_name, last_name) {
                speech.text = "Welcome, " + first_name + " " + last_name;
                window.speechSynthesis.speak(speech);
                //
                var dialog = document.getElementById("output_dialog");
                var full_name_text = document.getElementById("full_name_text");
                full_name_text.innerHTML = first_name + " " + last_name;
                dialog.style.display = "block";
                setTimeout(() => {
                    full_name_text.innerHTML = "";
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