<?php include ( "inc/connect.inc.php" ); ?>
<?php 
ob_start();
$mysqli=new mysqli($mysql_server,$mysql_username,$mysql_password,$mysql_db);
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
}
else {
	$user = $_SESSION['user_login'];
        $query="SELECT * FROM user WHERE id='$user'";
        $result=$mysqli->query($query);
	
        $get_user_email=$result->fetch_assoc();
	$uname_db = $get_user_email['firstName'];
}

if (isset($_REQUEST['keywords'])) {

	$epid = $mysqli->real_escape_string($_REQUEST['keywords']);
               
	if($epid != "" && ctype_alnum($epid)){
		
	}else {
		header('location: index.php');
	}
}else {
	header('location: index.php');
}

$search_value = "";
$search_value = trim($_GET['keywords']);

?>

<!DOCTYPE html>
<html>
<head>
	<title>SEARCH</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
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
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
			if (isset($_GET['keywords']) && $_GET['keywords'] != ""){
				$search_value = trim($_GET['keywords']);
                                $query=("SELECT * FROM products WHERE pName like '%$search_value%'  ORDER BY id DESC") or die(mysql_error());
                                $getposts=$mysqli->query($query);
                                    $total=$getposts->num_rows;
                                    if ( $total>0) {
                                        
					echo '<ul id="recs">';
					echo '<div style="text-align: center;"> '.$total.' Products Found... </div><br>';
                                        
					while ($row = $getposts->fetch_assoc()) {
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="women/view_product.php?pid='.$id.'">
										<img src="image/products/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' Php</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}else {
				echo "Nothing Found!";
			}
			}else {
				echo "Input Someting...";
			}
			
		?>
			
		</div>
	</div>
</body>
</html>