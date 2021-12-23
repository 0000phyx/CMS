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
				<h6 class="heading-hr"><i class="icon-file"></i> Insert new map</h6>
								</ul>
        	</div>
				<?php
					if(isset($_POST['add'])){
						$id = addslashes($_POST['id']);
						$nome = addslashes($_POST['add-term']);
						$FileName = addslashes($_POST['FileName']);
						$PlayersMax = addslashes($_POST['PlayersMax']);
						$monsters_info = addslashes($_POST['monsters_info']);
						$monsters_tree = addslashes($_POST['monsters_tree']);
						$monsters_frame = addslashes($_POST['monsters_frame']);
						$staffOnly = addslashes($_POST['staffOnly']);
						
						$busca_it_add = mysql_query("SELECT Name FROM meh_maps WHERE id='$id'");
						$conta_it_add = mysql_num_rows($busca_it_add);
						
						if(empty($FileName) || empty($nome) || ($PlayersMax <= 5)){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Fill out all fields!
		            </div>";						}else if($conta_it_add > 0){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> ID in use!
		            </div>";
						}else{
	if(mysql_query("INSERT INTO meh_maps (`id`, `Name`, `FileName`, `PlayersMax`, `monsters_info`, `monsters_tree`, `monsters_frame`, `staffOnly`) VALUES ('$id', '$nome', '$FileName', '$PlayersMax', '$monsters_info', '$monsters_tree', '$monsters_frame', '$staffOnly')")){
								
								mysql_query("INSERT INTO admin_logging (`Staff`, `Info`, `Date`) VALUES ('$user', 'Created the map: $nome', NOW( ))");
								
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! Map name: $nome - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'maps.php';
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ID: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="id" value="<?php echo $_POST['id']; ?>"></td>
					</tr>

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Map Name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="add-term" value="<?php echo $_POST['add-term']; ?>"></td>
					</tr>


					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">File name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="FileName" value="<?php echo $_POST['FileName']; ?>"></td>
					</tr>
	

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Players Max<font color="red" style="font-size: 10px;">(only numbers)</font>:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="PlayersMax" value="<?php echo $_POST['PlayersMax']; ?>"></td>
					</tr>
					

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster info<font color="red" style="font-size: 10px;">(only numbers)</font>:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="monsters_info" value="<?php echo $_POST['monsters_info']; ?>"></td>
					</tr>
					

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monsters Tree<font color="red" style="font-size: 10px;">(only numbers)</font>:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="monsters_tree" value="<?php echo $_POST['monsters_tree']; ?>"></td>
					</tr>

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monsters Frame:  </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="monsters_frame" value="<?php echo $_POST['monsters_frame']; ?>"></td>
					</tr>

					<tr id="upload">
						<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload-maps.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Staff only: </td>
						<td>
							<select name="staffOnly">
								<?php if(isset($_POST['staffOnly']) && $_POST['staffOnly'] > 0){ ?>
									<option value="1">Yes</option>
									<option value="0">No</option>
								<?php }else{ ?>
									<option value="0">No</option>
									<option value="1">Yes</option>
								<?php } ?>
							</select>
						</td>
					</tr>
					<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="submit" name="add" value="Insert MAP"></td></tr>
				</table>
			</form>
		<?php }else{ ?>
						<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Edit Map</h6>
				<?php
					if(isset($_POST['edd'])){
						$ed_id = addslashes($_POST['ed_id']);
						$ed_name = addslashes($_POST['ed_name']);
						$ed_FileName = addslashes($_POST['ed_FileName']);
						$ed_PlayersMax = addslashes($_POST['ed_PlayersMax']);
						$ed_monsters_info = addslashes($_POST['ed_monsters_info']);
						$ed_monsters_tree = addslashes($_POST['ed_monsters_tree']);
						$ed_monsters_frame = addslashes($_POST['ed_monsters_frame']);
						$ed_staffOnly = addslashes($_POST['ed_staffOnly']);

						if(empty($ed_name) || empty($ed_FileName)){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Fill out all fields!
		            </div>";
						}else{
							if(mysql_query("UPDATE meh_maps SET Name='$ed_name', FileName='$ed_FileName', PlayersMax='$ed_PlayersMax', monsters_info='$ed_monsters_info', monsters_tree='$ed_monsters_tree', monsters_frame='$ed_monsters_frame', staffOnly='$ed_staffOnly' WHERE id='$ed_id'")){
								
								mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Edited the map: $ed_id', NOW( ))");
								
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'maps.php';
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
					$busca_edit = mysql_query("SELECT * FROM meh_maps WHERE id=$edit");
					$conta_edit = mysql_num_rows($busca_edit);
					if($conta_edit > 0){
						$fetch_edit = mysql_fetch_array($busca_edit);
						$edit_id = $fetch_edit['id'];
						$edit_name = $fetch_edit['Name'];
						$edit_FileName = $fetch_edit['FileName'];
						$edit_PlayersMax = $fetch_edit['PlayersMax'];
						$edit_monsters_info = $fetch_edit['monsters_info'];
						$edit_monsters_tree = $fetch_edit['monsters_tree'];
						$edit_monsters_frame = $fetch_edit['monsters_frame'];
						$edit_staffOnly = $fetch_edit['staffOnly'];
				?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Map ID: </td><td><?php echo $edit_id; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Map Name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_name" value="<?php echo $edit_name; ?>"></td>
							</tr>

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">File Name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_FileName" value="<?php echo $edit_FileName; ?>"></td>
					</tr>
					<tr id="upload">
						<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload-maps.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Players Max: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_PlayersMax" value="<?php echo $edit_PlayersMax; ?>"></td>
					</tr>
						<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster info: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_monsters_info" value="<?php echo $edit_monsters_info; ?>"></td>
					</tr>
						<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Tree: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_monsters_tree" value="<?php echo $edit_monsters_tree; ?>"></td>
					</tr>
						<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Monster Frame: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_monsters_frame" value="<?php echo $edit_monsters_frame; ?>"></td>
					</tr>
												<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Staff Only: </td>
								<td>
									<select name="ed_staffOnly">
										<?php if($edit_staffOnly > 0){ ?>
									<option value="1">Yes</option>
									<option value="0">No</option>
								<?php }else{ ?>
									<option value="0">No</option>
									<option value="1">Yes</option>
										<?php } ?>
									</select>
								</td>
							</tr>
							<tr>
						
							<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="hidden" name="ed_id" value="<?php echo $edit_id; ?>"><input type="submit" name="edd" value="Update map"></td></tr>
						</table>
					</form>
			<?php
				}else{
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Post not found!
		            </div>";				}
			?>
		
		<?php } ?>
		
		<br /><br /><br />