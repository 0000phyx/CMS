<?php 
	if(!(include "config.php")){
		die("<center>FATAL ERROR: Arquivo de configuração não encontrado</center>");
	}
?>
<?php if(!(empty($passon)) && ($access < 40)){ ?>
          <div class="row">
            	<div class="col-md-6">

                	<!-- Questions -->

					<!-- Questions -->

            	</div>

            	<div class="col-md-6">
            	</div>

            </div>
            <!-- /questions and contact -->
        	<!-- Recent activity -->
		<div class="block">
		<?php if(!(isset($_GET['edit']))){ ?>
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Insert new quest</h6>
								</ul>
        	</div>
				<?php
					if(isset($_POST['add'])){
						$id = addslashes($_POST['id']);
						$nome = addslashes($_POST['add-term']);
						$sDesc = addslashes($_POST['sDesc']);
						$sEndText = addslashes($_POST['sEndText']);
						$iGold = addslashes($_POST['iGold']);
						$iExp = addslashes($_POST['iExp']);
						$iLvl = addslashes($_POST['iLvl']);
						$turnin = addslashes($_POST['turnin']);
						$oRewards = addslashes($_POST['oRewards']);
						
						$busca_it_add = mysql_query("SELECT sName FROM meh_quests WHERE id='$id'");
						$conta_it_add = mysql_num_rows($busca_it_add);
						
						if(empty($id) || empty($nome) || ($id <= 0) || empty($oRewards)){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Fill out all fields!
		            </div>";						}else if($conta_it_add > 0){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> ID in use!
		            </div>";
						}else{
							if(mysql_query("INSERT INTO meh_quests (`id`, `sName`, `sDesc`, `sEndText`, `iGold`, `iExp`, `iLvl`, `turnin`, `oRewards`, `sField`) VALUES ('$id', '$nome', '$sDesc', '$sEndText', '$iGold', '$iExp', '$iLvl', '$turnin', '$oRewards', '')")){
								
								mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Created the quest: $id', NOW( ))");
								
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! Quest id: $id - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'quests.php';
}, 5000);
</script>
		            </div>";							}else{
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> MYSQL ERROR!
		            </div>";
							}
						}
						echo "<br /><br />";
					}
				?>
			</div>
			<form action="" method="POST">
				<table>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Quest ID <font color="red" style="font-size: 10px;">(only numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="id" value="<?php echo $_POST['id']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Quest Name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="add-term" value="<?php echo $_POST['add-term']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Quest Description: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="sDesc" value="<?php echo $_POST['sDesc']; ?>"></td>
					</tr>				
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Quest end text: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="sEndText" value="<?php echo $_POST['sEndText']; ?>"></td>
					</tr>	
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Gold reward <font color="red" style="font-size: 10px;">(only numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="iGold" value="<?php echo $_POST['iGold']; ?>"></td>
					</tr>		
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Exp reward <font color="red" style="font-size: 10px;">(only numbers)</font>:</td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="iExp" value="<?php echo $_POST['iExp']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Level <font color="red" style="font-size: 10px;">(only numbers)</font>:</td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="iLvl" value="<?php echo $_POST['iLvl']; ?>"></td>
					</tr>	
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Req. Items <font color="red" style="font-size: 10px;">(Ex: itemid:amount)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="turnin" value="<?php echo $_POST['turnin']; ?>"></td>
					</tr>	
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Rewards <font color="red" style="font-size: 10px;">(Ex: itemid:itemid:itemid)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="oRewards" value="<?php echo $_POST['oRewards']; ?>"></td>
					</tr>																							
					<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="submit" name="add" value="Insert quest"></td></tr>
				</table>
			</form>
		<?php }else{ ?>
						<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Edit quest</h6>
				<?php
					if(isset($_POST['edd'])){
						$ed_id = addslashes($_POST['ed_id']);
						$ed_name = addslashes($_POST['ed_name']);
						$ed_sDesc = addslashes($_POST['ed_sDesc']);
						$ed_sEndText = addslashes($_POST['ed_sEndText']);
						$ed_iGold = addslashes($_POST['ed_iGold']);
						$ed_iExp = addslashes($_POST['ed_iExp']);
						$ed_iLvl = addslashes($_POST['ed_iLvl']);
						$ed_turnin = addslashes($_POST['ed_turnin']);
						$ed_oRewards = addslashes($_POST['ed_oRewards']);

						if(empty($ed_name) || empty($ed_oRewards)){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Fill out all fields!
		            </div>";
						}else{
							if(mysql_query("UPDATE meh_quests SET sName='$ed_name', sDesc='$ed_sDesc', sEndText='$ed_sEndText', iGold='$ed_iGold', iExp='$ed_iExp', iLvl='$ed_iLvl', turnin='$ed_turnin', oRewards='$ed_oRewards' WHERE id='$ed_id'")){
								
								mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Edited the quest: $ed_id', NOW( ))");
								
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'quests.php';
}, 5000);
</script>
		            </div>";
							}else{
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> MYSQL ERROR!
		            </div>";
							}
						}
					}
				?>
			</div>
				<?php
					$edit = addslashes($_GET['edit']);
					$busca_edit = mysql_query("SELECT * FROM meh_quests WHERE id=$edit");
					$conta_edit = mysql_num_rows($busca_edit);
					if($conta_edit > 0){
						$fetch_edit = mysql_fetch_array($busca_edit);
						$edit_id = $fetch_edit['id'];
						$edit_name = $fetch_edit['sName'];
						$edit_sDesc = $fetch_edit['sDesc'];
						$edit_sEndText = $fetch_edit['sEndText'];
						$edit_iGold = $fetch_edit['iGold'];
						$edit_iExp = $fetch_edit['iExp'];
						$edit_iLvl = $fetch_edit['iLvl'];
						$edit_turnin = $fetch_edit['turnin'];
						$edit_oRewards = $fetch_edit['oRewards'];

				?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Quest ID: </td><td><?php echo $edit_id; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Quest Name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_name" value="<?php echo $edit_name; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Description: </td><td><textarea class="elastic form-control required" name="ed_sDesc" cols="40" rows="5"><?php echo $edit_sDesc; ?></textarea></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Quest end text: </td><td><textarea class="elastic form-control required" name="ed_sEndText" cols="40" rows="5"><?php echo $edit_sEndText; ?></textarea></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Gold: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_iGold" value="<?php echo $edit_iGold; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Exp: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_iExp" value="<?php echo $edit_iExp; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Level: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_iLvl" value="<?php echo $edit_iLvl; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Req. Items: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_turnin" value="<?php echo $edit_turnin; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Rewards: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_oRewards" value="<?php echo $edit_oRewards; ?>"></td>
							</tr>
							<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="hidden" name="ed_id" value="<?php echo $edit_id; ?>"><input type="submit" name="edd" value="Update Quest"></td></tr>
						</table>
					</form>
			<?php
				}else{
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Shop not found!
		            </div>";				}
			?>
		
		<?php } ?>
<?php }else{ ?>
	<?php include "login.php"; ?>
<?php } ?>