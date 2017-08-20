<?php
if(isset($_POST["command"])){
	$command = $_POST["command"];
	switch ($command) {
		case 'SHUTDOWN':
			$cmd = "sudo shutdown -h -t 0";
			exec($cmd);
			break;
		default:
			# code...
			break;
	}
	echo "If you see this page failed to load, we've successfully shut down";
	die;
} ?>
<!DOCTYPE html>
<html>
<head>
	<title>Printer Server</title>
	<style type="text/css">
		* { box-sizing: border-box; }

		html {
		 	height: 100%; 
		}

		body {
		 	background: #4e5d74; 
		  background: linear-gradient(#54647d, #313946);
		  height: 100%;
		}

		.wrapper {
		 	width: 150px;
		  height: 150px;
		  margin: 60px auto;
		  border-radius: 50%;
		  background: #b25244;
		  background: linear-gradient(#b25244, #5e1912);
		  position: relative;
		  cursor: pointer;
		  padding: 20px;
		  box-shadow:
		    inset 0 2px 3px rgba(255,255,255,0.13),
		    0 5px 8px rgba(0,0,0,0.5),
		    0 10px 10px 4px rgba(0,0,0,0.3);
		}

		.wrapper:after {
		 	content: ""; 
		  position: absolute;
		  left: -20px;
		  right: -20px;
		  top: -20px;
		  bottom: -20px;
		  z-index: -2;
		  border-radius: inherit;
		  box-shadow:
		    inset 0 1px 0 rgba(255,255,255,0.1),
		    0 1px 2px rgba(0,0,0,0.3),
		    0 0 10px rgba(0,0,0,0.15);
		  
		}

		.wrapper:before {
		 	content: ""; 
		  position: absolute;
		  left: -10px;
		  right: -10px;
		  top: -10px;
		  bottom: -10px;
		  z-index: -1;
		  border-radius: inherit;
		  box-shadow: inset 0 10px 10px rgba(0,0,0,0.13); 
		  -webkit-filter:blur(1px);
		  filter: blur(1px); 
		}

		.inner {
		  position: relative;
		  width: 100%;
		  height: 100%;
		  border-radius: inherit;
		  background: linear-gradient(#8a2c20, #9e4235);
		  display: block;
		  box-shadow:
		    0 -2px 5px rgba(255,255,255,0.05),
		    0 2px 5px rgba(255,255,255,0.1);
		}

		.inner:after {
		 	position: absolute;
		  width: 50px;
		  height: 50px;
		  background: white;
		  background: linear-gradient(#eaeceb, #8d8d8d);
		  left: 50%;
		  top: 50%;
		  content: "";
		  border-radius: inherit;
		  margin: -25px 0 0 -25px;
		  box-shadow: 0 3px 5px rgba(0,0,0,0.3);
		} 

		.inner:before {
		 	position: absolute;
		  content: "";
		  width: 40px;
		  height: 40px;
		  left: 50%;
		  top: 50%;
		  border-radius: inherit;
		  background: inherit;
		  margin: -20px 0 0 -20px;
		  z-index: 2;
		  box-shadow: inset 0 3px 5px rgba(0,0,0,0.3), 0 1px 2px rgba(255,255,255,1);
		}

		.inner span {
		 	display: block;
		  width: 20px;
		  height: 20px;
		  background: #8f3327;
		  position: absolute;
		  left: 50%;
		  margin-left: -10px;
		  top: 25px;
		  z-index: 3;
		  position: relative;
		}

		.inner span:before {
		  content: "";
		  position: absolute;
		  width: 6px;
		  height: 25px;
		  background: linear-gradient(#fff, #cbcbcd);
		  border-radius: 10px;
		  box-shadow: 0 3px 5px rgba(0,0,0,0.3);
		  left: 50%;
		  margin-left: -3px;
		}
	</style>
</head>
<body>
<div class="wrapper">
  <div class="inner" id="shutdownBtn">
    <span></span>
    <form method="POST" id="formShutdown">
    	<input type="hidden" name="command" value="SHUTDOWN"/>
    </form>
  </div>
</div>
<script type="text/javascript">
	const shutdownBtn  = document.querySelector('#shutdownBtn');
	const formShutdown = document.querySelector('#formShutdown');
	shutdownBtn.addEventListener("click", function(){
		formShutdown.submit();
	});
</script>
</body>
</html>