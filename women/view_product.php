<?php include ( "../inc/connect.inc.php" ); ?>
<?php 
ob_start();
$mysqli=new mysqli($mysql_server,$mysql_username,$mysql_password,$mysql_db);
session_start();
if (!isset($_SESSION['user_login'])) {
	$user = "";
        $mail_href="../index.php";
}
else {
	$user = $_SESSION['user_login'];
         $query="SELECT * FROM user WHERE id='$user'";
        $result=$mysqli->query($query);
	
        $get_user_email=$result->fetch_assoc();
	$uname_db = $get_user_email['firstName'];
        $mail_temp=$get_user_email['email'];
        $mail_href="../index.php?mail=".$mail_temp."";
}
if (isset($_REQUEST['pid'])) {
	$pid=$mysqli->real_escape_string($_REQUEST['pid']);
}else {
	header('location: index.php');
}


 $query=("SELECT * FROM products WHERE id ='$pid'") or die(mysql_error());
 $getposts=$mysqli->query($query);
                                        if($getposts->num_rows){
                                                $row=$getposts->fetch_assoc();
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						$item = $row['item'];
						$available =$row['available'];
					}	

?>

<!DOCTYPE html>
<html>
<head>
	<title>View Product</title>
	<link rel="stylesheet" type="text/css" href="../css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<?php include ( "../inc/mainheader.inc.php" ); ?>
	<div class="categolis">
	<table>
			<tr>
				<th>
					<a href="IdLace.php" style="text-decoration: none;color: #fff;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">IdLace</a>
				</th>
				<th><a href="Computers.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">Computers</a></th>
				<th><a href="MobilePhones.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">MobilePhones</a></th>
				<th><a href="Tablets.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">Tablets</a></th>
				<th><a href="PCs.php" style="text-decoration: none;color: #ddd;padding: 4px 12px;background-color: Maroon;border-radius: 12px;">PCs</a></th>
			</tr>
		</table>
	</div>
	<div style="margin: 0 97px; padding: 10px">

		<?php 
			echo '
				<div style="float: left;">
				<div>
					<img src="../image/products/'.$item.'/'.$picture.'" style="height: 500px; width: 500px; padding: 2px; border: 2px solid #c7587e;">
				</div>
				</div>
				<div style="float: right;width: 40%;color: #067165;background-color: chocalate;padding: 10px;">
					<div style="">
						<h3 style="font-size: 25px; font-weight: bold; ">'.$pName.'</h3><hr>
						<h3 style="padding: 20px 0 0 0; font-size: 20px;">Price: '.$price.' Php</h3><hr>
						<h3 style="padding: 20px 0 0 0; font-size: 22px; ">Description:</h3>
						<p>
							'.$description.'
						</p>

						<div>
							<h3 style="padding: 20px 0 5px 0; font-size: 20px;">Want to buy this product? </h3>
							<div id="srcheader">
								<form id="" method="post" action="../orderform.php?poid='.$pid.'">
								        <input type="submit" value="Order Now" class="srcbutton" >
								</form>
								<div class="srcclear"></div>
							</div>
						</div>

					</div>
				</div>

			';
		?>

	</div>
	<div style="padding: 30px 95px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<h3 style="padding-bottom: 20px">Recommand Product For You:</h3>
		<div>
		<?php 
                        $query=("SELECT * FROM products WHERE available >='1' AND id != '".$pid."' AND item ='".$item."'  ORDER BY RAND() LIMIT 3") or die(mysql_error());
                        $getposts=$mysqli->query($query);
			
                                        if($getposts->num_rows){
					echo '<ul id="recs">';
                                        while($row=$getposts->fetch_assoc()){
						$id = $row['id'];
						$pName = $row['pName'];
						$price = $row['price'];
						$description = $row['description'];
						$picture = $row['picture'];
						
						echo '
							<ul style="float: left;">
								<li style="float: left; padding: 0px 25px 25px 25px;">
									<div class="home-prodlist-img"><a href="view_product.php?pid='.$id.'">
										<img src="../image/products/'.$item.'/'.$picture.'" class="home-prodlist-imgi">
										</a>
										<div style="text-align: center; padding: 0 0 6px 0;"> <span style="font-size: 15px;">'.$pName.'</span><br> Price: '.$price.' Php</div>
									</div>
									
								</li>
							</ul>
						';

						}
				}
                                $mysqli->close();
		?>
			
		</div>
	</div>
</body>
</html>
