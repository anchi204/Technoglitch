<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass=md5($_POST['password']);
   $cpass=md5($_POST['cpassword']);
   $user_type=$_POST['user_type'];

   $select="SELECT * FROM user_form WHERE email='$email' && password='$pass' ";
   $result=mysqli_query($conn, $select);
   if(mysqli_num_rows($result)>0){

    $row=mysqli_fetch_array($result);
    if($row['user_type']=='admin'){
        $_SESSION['admin_name']=$row['name'];
        header('location:admin_page.php');
    }elseif($row['user_type']=='user'){

        $_SESSION['user_name']=$row['name'];
        header('location:user_page.php');
    }

   }else{
    $error[]='Incorrect email or password!';
   }
};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login form</title>
    <!-- custom css file link -->
    <link rel="stylesheet" href="css/style.css">
    <style>
                @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap');
        * {
            font-family: 'Poppins',cursive;
            margin: 0; padding: 0;
            box-sizing: border-box;
            outline: none; border:none;
            text-decoration: none;
        }
        .container{
            min-height:100vh;
            display:flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            padding-bottom: 60px;
        }
        .container .content{
            text-align:center;
        }
        .container .content h3{
            font-size: 30px;
            color: #333;

        }
        .container .content h3 span{
            background: crimson;
            color:#fff;
            border-radius: 5px;
            padding:0 15px;
        }
        .container .content h3{
            font-size: 30px;
            color: #333;
        }
        .container .content h1 span{
            color: crimson;
        }
        .container .content p{
            font-size: 25px;
            margin-bottom: 20px;
        }
        .container .content .btn{
            display: inline-block;
            padding: 10px 30px;
            font-size: 20px;
            background:#333;
            color:#fff;
            margin:0 5px;
            text-transform: capitalize;
        }
        .container .content .btn:hover{
            background: crimson;
        }
        .form-container{
            min-height:100vh;
            display:flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            padding-bottom: 60px;
            background: #eee;
        }
        .form-container form{
            padding:20px;
            border-radius:5px;
            box-shadow: 0 5px 10px rgba(0,0,0,.1);
            background:#fff;
            text-align:center;
            width:500px
        }
        .form-container form h3{
            font-size:30px;
            text-transform: uppercase;
            margin-bottom:10px;
            color:#333;
        }
        .form-container form input,
        .form-container form select{
            width:100%;
            padding:10px 15px;
            font-size:17px;
            margin:8px 0;
            background: #eee;
            border-radius:5px;
        }
        .form-container form select option{
            background:#fff;
        }
        .form-container form .form-btn{
            background:#fbd0d9;
            color:crimson;
            text-transform:capitalize;
            font-size:20px;
            cursor:pointer;
        }
        .form-container form .form-btn:hover{
            background:crimson;
            color:#fff;
        }
        .form-container form p{
            margin-top:10px;
            font-size:20px;
            color:#333;
        }
        .form-container form p a{
            color:crimson;
        }
    </style>
</head>
<body>


  <div class="form-container">
    <form action="" method="post">
        <h3>Login now</h3>
        <?php
          if(isset($error)){
            foreach($error as $error){
                echo '<span class="error-msg">'.$error.'</span>';
            };
          };
        ?>
        <input type="email" name="email" required placeholder="Email">
        <input type="password" name="password" required placeholder="Password">
       
        <input type="submit" name="submit" value="login now" class="form-btn">
        <p>Don't have an account? <a href="register_form.php"> Register now</a></p>
    </form>
  </div>
<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>