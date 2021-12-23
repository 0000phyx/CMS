<?php 
	if(!(include "config.php")){
		die("<center>FATAL ERROR: Arquivo de configuração não encontrado</center>");
	}
?>
<?php if(!(empty($passon)) && ($access < 40)){ ?>
		<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Search player</h6>
				</div>
				<form action="search.php" method="post">
					<div class="input-group">
						<input type="text" id="search-term" value="<?php echo addslashes($_POST['search-term']); ?>" name="search-term" class="form-control" placeholder="Player name">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="icon-search3"></i></button>
						</span>
					</div>
				</form>
			</div>
			
		<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Results for: <?php echo $_POST['search-term']; ?></h6>
				</div>
			<?php
				$busca = addslashes($_POST['search-term']);
				if(!(empty($busca))){
					$busca_busca = mysql_query("SELECT * FROM meh_users WHERE ((`Username` LIKE '%".$busca."%') OR ('%".$busca."%'))");
					$conta_busca = mysql_num_rows($busca_busca);
					
					echo "$conta_busca results for: " . $_POST['search-term'] . "<br /><br />";
					if($conta_busca > 0){
						echo "
						<table align='center'>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'><b>Username</b></td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'><b>Status</b></td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'><b>Gender</b></td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'><b>Level</b></td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'><b>Gold</b></td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'><b>ACs</b></td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'><b>Edit</b></td>
							</tr>
						";
						
						while($fetch_busca = mysql_fetch_array($busca_busca)){
							$B_username = $fetch_busca['Username'];
							$B_access = $fetch_busca['Access'];
							
							if($B_access < 1)
								$B_status = "Banned";
							if($B_access > 0)
								$B_status = "<font color='green'>Player</font>";
							if($B_access > 39)
								$B_status = "<font color='gold'>Moderator</font>";
							if($B_access > 59)
								$B_status = "<font color='red'>Administrator</font>";
							
							$B_gender = $fetch_busca['Gender'];
							if($B_gender == 'M')
								$B_gendern = "Male";
							else if($B_gender == 'F')
								$B_gendern = "Female";
							else
								$B_gendern = "Shemale";
							
							$B_level = $fetch_busca['Level'];
							$B_gold = $fetch_busca['Gold'];
							$B_coins = $fetch_busca['Coins'];
							$B_email = $fetch_busca['Email'];
							
							echo "
								<tr align='center'>
									<td>$B_username</td>
									<td>$B_status</td>
									<td>$B_gendern</td>
									<td>$B_level</td>
									<td>$B_gold</td>
									<td>$B_coins</td>
									<td><a href='users.php?user=$B_username'><i class='icon-pencil2'></i></a></td>
								</tr>
							";
						}
						echo "</table>";
					}else{
									echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Player not FOUND!
		            </div>";
					}
					
				}else{
									echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Nothing has been entered in the search field.
		            </div>";				}
			?>
<?php }else{ ?>
	<?php include "login.php"; ?>
<?php } ?>			