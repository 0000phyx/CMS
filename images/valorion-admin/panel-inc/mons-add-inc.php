<?php 
	if(!(include "session.php")){
		die("<center>FATAL ERROR</center>");
	}
?>
<?php if(!(empty($passon)) && ($access < 40)){ ?>
		<div class="block">
		<?php if(!(isset($_GET['edit']))){ ?>
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Insert new monster</h6>
								</ul>
        	</div>
				<?php
					if(isset($_POST['add'])){
						$id = addslashes($_POST['id']);
						$nome = addslashes($_POST['add-term']);
						$Level = addslashes($_POST['Level']);
						$HP = addslashes($_POST['HP']);
						$DPS = addslashes($_POST['DPS']);
						$Exp = addslashes($_POST['Exp']);
						$Gold = addslashes($_POST['Gold']);
						$Drops = addslashes($_POST['Drops']);
						$Rep = addslashes($_POST['Rep']);
						$FileName = addslashes($_POST['FileName']);
						$Linkage = addslashes($_POST['Linkage']);
						
						$busca_it_add = mysql_query("SELECT Name FROM meh_monsters WHERE id='$id'");
						$conta_it_add = mysql_num_rows($busca_it_add);
						
						if(empty($nome) || empty($nome) || ($HP <= 0)){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Fill out all fields!
		            </div>";						}else if($conta_it_add > 0){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> ID in use!
		            </div>";
						}else{
	if(mysql_query("INSERT INTO meh_monsters (`id`, `Name`, `Level`, `HP`, `MP`, `DPS`, `Exp`, `Coins`, `Gold`, `Drops`, `Rep`, `FileName`, `Linkage`) VALUES ('$id', '$nome', '$Level', '$HP', '100', '$DPS', '$Exp', '10', '$Gold', '$Drops', '$Rep', '$FileName', '$Linkage')")){
								
								mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Created the monster: $nome', NOW( ))");
								
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! Monster name: $nome - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'monsters.php';
}, 5000);
</script>		            </div>";							}else{
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ID: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="id" value="<?php echo $_POST['id']; ?>"></td>
					</tr>

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="add-term" value="<?php echo $_POST['add-term']; ?>"></td>
					</tr>


					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Level <font color="red" style="font-size: 10px;">(only numbers)</font>:</td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="Level" value="<?php echo $_POST['Level']; ?>"></td>
					</tr>
	

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">HP <font color="red" style="font-size: 10px;">(only numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="HP" value="<?php echo $_POST['HP']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">DPS <font color="red" style="font-size: 10px;">(only numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="DPS" value="<?php echo $_POST['DPS']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Exp <font color="red" style="font-size: 10px;">(only numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="Exp" value="<?php echo $_POST['Exp']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Gold <font color="red" style="font-size: 10px;">(only numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="Gold" value="<?php echo $_POST['Gold']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Drops:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="Drops" value="<?php echo $_POST['Drops']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Rep <font color="red" style="font-size: 10px;">(only numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="Rep" value="<?php echo $_POST['Rep']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">File Name:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="FileName" value="<?php echo $_POST['FileName']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Linkage:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="Linkage" value="<?php echo $_POST['Linkage']; ?>"></td>
					</tr>
					<tr id="upload">
						<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF file</td><td><a href="#" onclick="window.open('upload-monster.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
					</tr>
					<td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="submit" name="add" value="Insert monster"></td></tr>
				</table>
			</form>
		<?php }else{ ?>
						<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Edit monster</h6>
				<?php
					if(isset($_POST['edd'])){
						$ed_id = addslashes($_POST['ed_id']);
						$ed_name = addslashes($_POST['ed_name']);
						$ed_Level = addslashes($_POST['ed_Level']);
						$ed_HP = addslashes($_POST['ed_HP']);
						$ed_DPS = addslashes($_POST['ed_DPS']);
						$ed_Exp = addslashes($_POST['ed_Exp']);
						$ed_Gold = addslashes($_POST['ed_Gold']);
						$ed_Drops = addslashes($_POST['ed_Drops']);
						$ed_Rep = addslashes($_POST['ed_Rep']);
						$ed_FileName = addslashes($_POST['ed_FileName']);
						$ed_Linkage = addslashes($_POST['ed_Linkage']);

						if(empty($ed_name) || empty($ed_FileName)){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Fill out all fields!
		            </div>";
						}else{
							if(mysql_query("UPDATE meh_monsters SET Name='$ed_name', Level='$ed_Level', HP='$ed_HP', DPS='$ed_DPS', Exp='$ed_Exp', Gold='$ed_Gold', Drops='$ed_Drops', Rep='$ed_Rep', FileName='$ed_FileName', Linkage='$ed_Linkage' WHERE id='$ed_id'")){
								
								mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Edited the monster: $ed_id', NOW( ))");
								
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'monsters.php';
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
					$busca_edit = mysql_query("SELECT * FROM meh_monsters WHERE id=$edit");
					$conta_edit = mysql_num_rows($busca_edit);
					if($conta_edit > 0){
						$fetch_edit = mysql_fetch_array($busca_edit);
						$edit_id = $fetch_edit['id'];
						$edit_name = $fetch_edit['Name'];
						$edit_Level = $fetch_edit['Level'];
						$edit_HP = $fetch_edit['HP'];
						$edit_DPS = $fetch_edit['DPS'];
						$edit_Exp = $fetch_edit['Exp'];
						$edit_Gold = $fetch_edit['Gold'];
						$edit_Drops = $fetch_edit['Drops'];
						$edit_Rep = $fetch_edit['Rep'];
						$edit_FileName = $fetch_edit['FileName'];
						$edit_Linkage = $fetch_edit['Linkage'];
				?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster ID: </td><td><?php echo $edit_id; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_name" value="<?php echo $edit_name; ?>"></td>
							</tr>

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Level: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_Level" value="<?php echo $edit_Level; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">HP: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_HP" value="<?php echo $edit_HP; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">DPS: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_DPS" value="<?php echo $edit_DPS; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Exp: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_Exp" value="<?php echo $edit_Exp; ?>"></td>
					</tr>
	

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Gold:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_Gold" value="<?php echo $edit_Gold; ?>"></td>
					</tr>
					
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Drops:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_Drops" value="<?php echo $edit_Drops; ?>"></td>
					</tr>					
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Rep:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_Rep" value="<?php echo $edit_Rep; ?>"></td>
					</tr>					
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">FileName:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_FileName" value="<?php echo $edit_FileName; ?>"></td>
					</tr>					
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Linkage:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_Linkage" value="<?php echo $edit_Linkage; ?>"></td>
					</tr>
					
							<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="hidden" name="ed_id" value="<?php echo $edit_id; ?>"><input type="submit" name="edd" value="Update monster"></td></tr>
						</table>
					</form>
			<?php
				}else{
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Monster not found!
		            </div>";				}
			?>
		
		<?php } ?>
<?php }else{ ?>
	<?php include "login.php"; ?>
<?php } ?>