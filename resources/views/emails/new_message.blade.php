<!DOCTYPE html>
<html>
<title>It's Wedding Season</title>
<body style="position:relative;">
	<header class="" style="height:250px;">
		<h1 class="" style="text-align: -webkit-center;text-align: center;">Ashley</h1>
		<img class="" src="http://journey2jackson.com/images/infinity1.png" style="max-height:150px;margin: 0 auto;display: -webkit-box;display: block;">
		<h1 class="" style="text-align: -webkit-center;text-align: center;">Tramaine</h1>
	</header>
	<div class="" style="text-align:-webkit-center;text-align:center;padding: 20px 0px 5px;margin: 0px 100px; border-bottom: double 5px;">
		<h2 class="">Thanks for reaching out to us. Below is the following message that we received. We will respond as soon as we check out email.</h2>
	</div>
	<div class="" style="text-align:-webkit-center;text-align:center; padding-bottom:60px;">
		<h1 class="">From: <span style="font-size: 18px;">{{ $messageEmail->name }}</span> <a href="mailTo:{{ $messageEmail->email }}" class="" style="font-size: 17px;">{{ $messageEmail->email }}</a></h1>
		<h1 class=""><b>Message:</b> <span style="font-size: 18px;">{{ $messageEmail->message }}</span></h1>
	</div>
	<div class="" style="position:absolute; width:100%; bottom:0px; text-align:-webkit-center; text-align:center; background:black; color:white; margin-left:-8px; padding-right:16px;">
		<div class="">
			<h5 class="">&copy;&nbsp; & &reg;&nbsp; by Tramaine</h5>
		</div>
	</div>
</body>
</html>