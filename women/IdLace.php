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
?>

<!DOCTYPE html>
<html>
<head>
	<title>IDLACE</title>
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
	<div style="padding: 30px 120px; font-size: 25px; margin: 0 auto; display: table; width: 98%;">
		<div>
		<?php 
                        $query=("SELECT * FROM products WHERE available >='1' AND item ='IdLace'  ORDER BY id DESC LIMIT 10") or die(mysql_error());
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
										<img src="../image/products/IdLace/'.$picture.'" class="home-prodlist-imgi">
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

