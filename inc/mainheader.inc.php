<div class="homepageheader">
			<div class="signinButton loginButton">
				<div class="uiloginbutton signinButton loginButton" style="margin-right: 40px;">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: white;" href="../logout.php">LOG OUT</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: white;" href="../signin.php">SIGN IN</a>';
						}
					 ?>
					
				</div>
				<div class="uiloginbutton signinButton loginButton" style="">
					<?php 
						if ($user!="") {
							echo '<a style="text-decoration: none; color: white;" href="../profile.php?uid='.$user.'">Hi '.$uname_db.'</a>';
						}
						else {
							echo '<a style="text-decoration: none; color: white;" href="../login.php">LOG IN</a>';
						}
					 ?>
				</div>
			</div>
			<div style="float: left; margin: 5px 0px 0px 23px;">
                            <?php
                            echo '
				<a href="'.$mail_href.'">
					<img style=" height: 100px; width: 140px;" src="../image/312659745_818194616153661_187248421034604952_n-removebg-preview.png">
				</a>
                            ';
                            ?>
			</div>
			<div class="">
				<div id="srcheader">
					<form id="newsearch" method="get" action="../search.php">
					        <input type="text" class="srctextinput" name="keywords" size="21" maxlength="120"  placeholder="Search Here..."><input type="submit" value="search" class="srcbutton" >
					</form>
				<div class="srcclear"></div>
				</div>
			</div>
		</div>