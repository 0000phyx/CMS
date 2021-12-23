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
				<h6 class="heading-hr"><i class="icon-file"></i> Insert new shop</h6>
								</ul>
        	</div>
				<?php
					if(isset($_POST['add'])){
						$id = addslashes($_POST['id']);
						$nome = addslashes($_POST['add-term']);
						$items = addslashes($_POST['items']);
						$staff = addslashes($_POST['staff']);
						$upgrade = addslashes($_POST['upgrade']);
						$house = addslashes($_POST['house']);
						$level = addslashes($_POST['level']);
						$limited = addslashes($_POST['limited']);
						
						$busca_it_add = mysql_query("SELECT Name FROM meh_items_shops WHERE id='$id'");
						$conta_it_add = mysql_num_rows($busca_it_add);
						
						if(empty($nome) || empty($items) || empty($nome) || empty($items)){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Fill out all fields!
		            </div>";						}else if($conta_it_add > 0){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> ID in use!
		            </div>";
						}else{
							if(mysql_query("INSERT INTO meh_items_shops (`id`, `Name`, `Items`, `Staff`, `Upgrade`, `House`, `Limited`) VALUES ('$id', '$nome', '$items', '$staff', '$upgrade', '$house', '$limited')")){
								
								mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Created the shop: $nome', NOW( ))");
								
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! Shop name: $nome - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'shops.php';
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="add-term" value="<?php echo $_POST['add-term']; ?>"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Staff only: </td>
						<td>
							<select name="staff">
								<?php if(isset($_POST['staff']) && $_POST['staff'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Member: </td>
						<td>
							<select name="upgrade">
								<?php if(isset($_POST['upgrade']) && $_POST['upgrade'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">House: </td>
						<td>
							<select name="house">
								<?php if(isset($_POST['house']) && $_POST['house'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">LQS: </td>
						<td>
							<select name="limited">
								<?php if(isset($_POST['limited']) && $_POST['limited'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Items <font color="red" style="font-size: 10px;">(Example: 1,2,3,4)</font>: </td><td><textarea class="elastic form-control required" name="items" cols="40" rows="5"><?php echo $_POST['items']; ?></textarea></td>
					</tr>
					<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="submit" name="add" value="Insert shop"></td></tr>
				</table>
			</form>
		<?php }else{ ?>
						<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Edit shop</h6>
				<?php
					if(isset($_POST['edd'])){
						$ed_id = addslashes($_POST['ed_id']);
						$ed_name = addslashes($_POST['ed_name']);
						$ed_staff = addslashes($_POST['ed_staff']);
						$ed_upgrade = addslashes($_POST['ed_upgrade']);
						$ed_house = addslashes($_POST['ed_house']);
						$ed_limited = addslashes($_POST['ed_limited']);
						$ed_items = addslashes($_POST['ed_items']);
						
						if(empty($ed_name) || ($ed_preco < 0) || ($ed_level < 0) || ($ed_estoque < 0)){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Fill out all fields!
		            </div>";
						}else{
							if(mysql_query("UPDATE meh_items_shops SET Name='$ed_name', Items='$ed_items', Staff='$ed_staff', Upgrade='$ed_upgrade', House='$ed_house', Limited='$ed_limited' WHERE id='$ed_id'")){
								
								mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Edited the shop: $ed_id', NOW( ))");
								
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'shops.php';
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
					$busca_edit = mysql_query("SELECT * FROM meh_items_shops WHERE id=$edit");
					$conta_edit = mysql_num_rows($busca_edit);
					if($conta_edit > 0){
						$fetch_edit = mysql_fetch_array($busca_edit);
						$edit_id = $fetch_edit['id'];
						$edit_name = $fetch_edit['Name'];
						$edit_item = $fetch_edit['Items'];
						$edit_staff = $fetch_edit['Staff'];
						$edit_upgrade = $fetch_edit['Upgrade'];
						$edit_house = $fetch_edit['House'];
						$edit_limited = $fetch_edit['Limited'];
				?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Shop ID: </td><td><?php echo $edit_id; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Name: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_name" value="<?php echo $edit_name; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Staff only: </td>
								<td>
									<select name="ed_staff">
										<?php if($edit_staff > 0){ ?>
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
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Member: </td>
								<td>
									<select name="ed_upgrade">
										<?php if($edit_upgrade > 0){ ?>
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
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">House: </td>
								<td>
									<select name="ed_house">
										<?php if($edit_house > 0){ ?>
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
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">LQS: </td>
								<td>
									<select name="ed_limited">
										<?php if($edit_limited > 0){ ?>
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
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Items: </td><td><textarea class="elastic form-control required" name="ed_items" cols="40" rows="5"><?php echo $edit_item; ?></textarea></td>
							</tr>
							<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="hidden" name="ed_id" value="<?php echo $edit_id; ?>"><input type="submit" name="edd" value="Update shop"></td></tr>
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