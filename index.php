<body class="back1"></body>
<?php include('header.php');

include('config.php');

$login_button = '';



if(isset($_GET["code"]))
{
	$code = $_GET['code'];
	$token = $google_client->fetchAccessTokenWithAuthCode($code);
	
	if(!isset($token['error']))
	{
		$google_client->setAccessToken($token['access_token']);
		
		$_SESSION['access_token'] = $token['access_token'];
		
		$google_service = new Google_Service_Oauth2($google_client);
		
		$data = $google_service->userinfo->get();
		
		if(isset($data["email"]))
		{
			include('connect.php');
			$_SESSION["email"] = $data['email'];
			$_SESSION['picture'] = $data['picture'];
			header("location:user/usercheck.php");
			exit();
		}
		
	}
}

?>
   <script>
$(document).ready(function(){
	
	$("#btn_signin").click(function(){
		
		var username = $("#username").val();
		var password = $("#password").val();
		if(username == "" || password == "")
			{
				alert("لطفا مشخصات را درست وارد کنید");
				$("#username").css("border","2px solid red");
				$("#password").css("border","2px solid red");
				return false;
			}
		else
			{
				$("#username").css("border","none");
				$("#password").css("border","none");
				$.post("userchecker_logined.php",{username:username,password:password,btn:true},function(data){
					$("#username").val("");
					$("#password").val("");
					if(data == "signin")
						{
							window.location.replace("user/usercheck.php?username="+username+"&password="+password);
						}
					else
						{
							alert("!! کاربر مورد نظر یافت نشد")
							return false;
						}
					
				});
			}
	});
	$("#btn_signup").click(function(){
		
		window.location.replace("signup.php");
		return false;
	});
});

</script>

<h2>login</h2>
<div id="login">
	<img src="background/lock.png" alt="not image loading">
	<div>
	<?php
		
		if(isset($_SESSION['access_token']))
		{
			echo '<a href='.$google_client->createAuthUrl().'><img style="width:300px;height:70px;border-radius:10px;" src="background/google_login.gif"</a>';
			
			
		}
		else
		{
			echo '<a href='.$google_client->createAuthUrl().'><img style="width:300px;height:70px;border-radius:10px;" src="background/google_login.gif"</a>';
			
			
			
		}
		?>
	</div>
</div>
