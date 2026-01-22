<?php include ( "inc/supabase.php" ); ?>
<?php 

ob_start();
session_start();
$mysqli=new mysqli($mysql_server,$mysql_username,$mysql_password,$mysql_db);
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
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

if (isset($_REQUEST['uid'])) {
	
          $user2=$mysqli->real_escape_string($_REQUEST['uid']);
	if($user != $user2){
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

$search_value = "";
?>

<!DOCTYPE html>
<html>
<head>
	<title>PROFILE</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body class="home-welcome-text" style="background-image: url(image/republic-of-gamers-8-bit-3n-1400x1050.jpg);">
	<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: #fff;" href="logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="signin.php">SIGN IN</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: white;" href="profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: #fff;" href="login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
				<a href="index.php">
					<img style=" height: 100px; width: 140px;" src="image/312659745_818194616153661_187248421034604952_n-removebg-preview.png">
				</a>
			</div>
			<div id="srcheader">
				<form id="newsearch" method="get" action="search.php">
				        <?php 
				        	echo '<input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..." value="'.$search_value.'"><input type="submit" value="search" class="srcbutton" >';
				         ?>
				</form>
			<div class="srcclear"></div>
			</div>
		</div>
	<div class="categolis">
	<table>
			<tr>
				<th>
					<a href="women/IdLace.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">IdLace</a>
				</th>
				<th><a href="women/Computers.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">Computers</a></th>
				<th><a href="women/MobilePhones.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">MobilePhones</a></th>
				<th><a href="women/Tablets.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">Tablets</a></th>
				<th><a href="women/PCs.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">PCs</a></th>
			</tr>
		</table>
	</div>
	<div style="margin-top: 20px;">
		<div style="width: 900px; margin: 0 auto;">
		
			<ul>
				<li style="float: left;">
					<div class="settingsleftcontent">
						<ul>
							<ul>
							<li><?php echo '<a href="profile.php?uid='.$user.'" style=" background-color: white; border-radius: 4px; color: maroon;" >My Orders</a>'; ?></li>
							<li><?php echo '<a href="settings.php?uid='.$user.'" >Settings</a>'; ?></li>
						</ul>
						</ul>
					</div>
				</li>
				<li style="float: right; background-color: #fff;">
					<div>
						<div>
							<table class="rightsidemenu">
								<tr style="font-weight: bold;" colspan="10" bgcolor="#3A5487">
									<th>Product Name</th>
									<th>Price</th>
									<th>Total Product</th>
									<th>Order Date</th>
									<th>Delevery Date</th>
									<th>Delevery Place</th>
									<th>Delevery Status</th>
									<th>View</th>
								</tr>
								<tr>
									<?php include ( "inc/connect.inc.php");
                                                                        $query="SELECT * FROM orders WHERE uid='$user' ORDER BY id DESC";
                                                                        $run=$mysqli->query($query);
									
									while ($row=mysqli_fetch_assoc($run)) {
										$pid = $row['pid'];
										$quantity = $row['quantity'];
										$oplace = $row['oplace'];
										$mobile = $row['mobile'];
										$odate = $row['odate'];
										$ddate = $row['ddate'];
										$dstatus = $row['dstatus'];
										
										
                                                                                $query1="SELECT * FROM products WHERE id='$pid'";
                                                                                $run1=$mysqli->query($query1);
										$row1=mysqli_fetch_assoc($run1);
										$pId = $row1['id'];
										$pName = substr($row1['pName'], 0,50);
										$price = $row1['price'];
										$picture = $row1['picture'];
										$item = $row1['item'];
										$category = $row1['category'];
									 ?>
									<th><?php echo $pName; ?></th>
									<th><?php echo $price; ?></th>
									<th><?php echo $quantity; ?></th>
									<th><?php echo $odate; ?></th>
									<th><?php echo $ddate; ?></th>
									<th><?php echo $oplace; ?></th>
									<th><?php echo $dstatus; ?></th>
									<th><?php echo '<div class="home-prodlist-img"><a href="'.$category.'/view_product.php?pid='.$pId.'">
													<img src="image/products/'.$item.'/'.$picture.'" class="home-prodlist-imgi" style="height: 75px; width: 75px;">
													</a>
												</div>' ?></th>
								</tr>
								<?php } ?>
							</table>
						</div>
					</div>
				</li>
			</ul>
		</div>
	</div>

	
</body>

</html>
