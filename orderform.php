<?php include ( "inc/connect.inc.php" ); ?>
<?php 
$mysqli=new mysqli($mysql_server,$mysql_username,$mysql_password,$mysql_db);
if (isset($_REQUEST['poid'])) {
	$poid=$mysqli->real_escape_string($_REQUEST['poid']);
	
}else {
	header('location: index.php');
}
ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
	header("location: login.php?ono=".$poid."");
}
else {
	$user = $_SESSION['user_login'];
        $query="SELECT * FROM user WHERE id='$user'";
        $result=$mysqli->query($query);
	
                $get_user_email=$result->fetch_assoc();
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}


$query=("SELECT * FROM products WHERE id ='$poid'") or die(mysql_error());
$getposts=$mysqli->query($query);
                                        if($getposts->num_rows){
                                                $row=$getposts->fetch_assoc();
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						$category = $row['category'];
						$available =$row['available'];
					}	

//order

if (isset($_POST['order'])) {
//declere veriable
$mbl = $_POST['mobile'];
$addr = $_POST['address'];
$quan = $_POST['quantity'];
//triming name
	try {
		if(empty($_POST['mobile'])) {
			throw new Exception('Mobile can not be empty');
			
		}
		if(empty($_POST['address'])) {
			throw new Exception('Address can not be empty');
			
		}
		if(empty($_POST['quantity'])) {
			throw new Exception('Address can not be empty');
			
		}

		
		// Check if email already exists
		
		
						$d = date("Y-m-d"); //Year - Month - Day
						$timestamp = time();
						$date = strtotime("+7 day", $timestamp);
						$date = date('Y-m-d', $date);
						
						// send email
						$msg = "
						Hi...
						Your Order successfull. Very soon we will send you a verification call.
						
						";
						//if (@mail($uemail_db,"eBuyBD Product Order",$msg, "From:eBuyBD <no-reply@ebuybd.xyz>")) {
						$query=("INSERT INTO orders (uid,pid,quantity,oplace,mobile,odate,ddate) VALUES ('$user','$poid',$quan,'$_POST[address]','$_POST[mobile]','$d','$date')");
                                                //$mysqli->query($query);	
						//if(mysql_query("INSERT INTO orders (uid,pid,quantity,oplace,mobile,odate,ddate) VALUES ('$user','$poid',$quan,'$_POST[address]','$_POST[mobile]','$d','$date')")){
                                                if($mysqli->query($query)) {   
							//success message
						$success_message = '
						<div class="signupform_content"><h2 style="color: white;"><font face="bookman">Your order successfull!</font></h2>
						<div class="signupform_text" style="font-size: 18px; text-align: center;">
						<font face="bookman" style="color: yellowgreen;">
							We send you a verification <br> call very soon.
						</font></div></div>';
						}else{
							$error_message = 'Something goes wrong!';
						}
						//}

	}
	catch(Exception $e) {
		$error_message = $e->getMessage();
	}
}


?>

<!DOCTYPE html>
<html>
<head>
	<title>OrderForm</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="home-welcome-text" style="background-image: url(image/republic-of-gamers-8-bit-3n-1400x1050.jpg);">
	<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: white;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: white;" href="signin.php">SIGN IN</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: white;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: white;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 100px; width: 140px;" src="image/312659745_818194616153661_187248421034604952_n-removebg-preview.png">
				</a>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>
	<div class="categolis">
	<table>
			<tr>
				<th>
					<a href="women/IdLace.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">IdLace</a>
				</th>
				<th><a href="women/Computers.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">Computers</a></th>
				<th><a href="women/MobilePhones.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">MobilePhones</a></th>
				<th><a href="women/Tablets.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">Tablets</a></th>
				<th><a href="women/PCs.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">PCs</a></th>
			</tr>
		</table>
	</div>
	<div class="holecontainer" style=" padding-top: 20px; padding: 0 20%">
		<div class="container signupform_content ">
			<div>

				<h2 style="padding-bottom: 20px; color: white;">Order Form</h2>
				<div style="float: right;">
				<?php 
					if(isset($success_message)) {echo $success_message;}
					else {
					echo '
						<div class="">
						<div class="signupform_text"></div>
						<div>
							<form action="" method="POST" class="registration">
								<div class="signup_form" style="margin-top: 38px;">
									<div>
										<td>
											<input name="mobile" placeholder="Your mobile number" required="required" class="email signupbox" type="text" size="30" value="'.$umob_db.'">
										</td>
									</div>
									<div>
										<td>
											<input name="address" id="password-1" required="required"  placeholder="Write your full address" class="password signupbox " type="text" size="30" value="'.$uadd_db.'">
										</td>
									</div>
									<div>
										<td>
											<select onchange="changeAmount()" name="quantity" required="required" id="productAmount" style=" font-size: 20px;
										font-style: italic; margin-bottom: 3px;margin-top: 0px;padding: 14px;line-height: 25px;border-radius: 4px;border: 1px solid #169E8F;color: #169E8F;margin-left: 0;width: 300px;background-color: transparent;" class="">';

					

				 ?><?php
												for ($i=1; $i<=$available; $i++) { 
													echo '<option  value="'.$i.'">Quantity: '.$i.'</option>';
												}
											?>
											<?php echo '
											</select>
										</td>
									</div>
									<div>
										<input style="color: white; background-color: green;" name="order" class="uisignupbutton signupbutton" type="submit" value="Confirm Order">
									</div>
									<div class="signup_error_msg"> '; ?>
										<?php 
											if (isset($error_message)) {echo $error_message;}
											
										?>
									<?php echo '</div>
								</div>
							</form>
							
						</div>
					</div>

					';

					}

				 ?>
					
				</div>
			</div>
		</div>
		<div style="float: left; font-size: 23px;">
			<div>
				<?php
					echo '
						<ul style="float: left;">
							<li style="float: left; padding: 0px 25px 25px 25px;">
								<div class="home-prodlist-img"><a href="'.$category.'/view_product.php?pid='.$id.'">
									<img src="image/products/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
									</a>
									<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: <span id="amountText">'.$price.'</span> Php <span id="aHiddenText" style="display:none">'.$price.'</span></div>
								</div>
								
							</li>
						</ul>
					';
                                        $mysqli->close();
				?>
			</div>

		</div>
	</div>
	<script type="text/javascript">
	function changeAmount() {
	    var v = document.getElementById("aHiddenText").innerHTML;
	    document.getElementById("amountText").innerHTML = v;
	    var sBox = document.getElementById("productAmount");
    	var y = sBox.value;
	    var x = document.getElementById("amountText").innerHTML;
	    var y = parseInt(y);
	    var x = parseInt(x);
	    document.getElementById("amountText").innerHTML = x+"x"+y+ " = " + x*y;
	}
	</script>
</body>
</html>
