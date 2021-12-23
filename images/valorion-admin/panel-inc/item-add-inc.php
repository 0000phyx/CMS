<?php 
	if(!(include "session.php")){
		die("<center>FATAL ERROR</center>");
	}
?>
<?php if(!(empty($passon)) && ($access < 40)){ ?>
 		<?php if(!(isset($_GET['edit']))){ ?>
			<div style='padding: 10px 50px 10px 50px;'>
		<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Insert new Item</h6>
								</ul>				<br />
				<?php
					if(isset($_POST['add'])){
						$id = addslashes($_POST['itid']);
						$nome = addslashes($_POST['add-term']);
						$member = addslashes($_POST['member']);
						$acs = addslashes($_POST['coins']);
						$temp = addslashes($_POST['temp']);
						$level = addslashes($_POST['level']);
						$preco = addslashes($_POST['preco']);
						$estoque = addslashes($_POST['estoque']);
						$ReqItems = addslashes($_POST['ReqItems']);
						$tipo = addslashes($_POST['tipo']);
						$file = addslashes($_POST['file']);
						$link = addslashes($_POST['link']);
						
						if($tipo == "Item" || $tipo == "Enhancement"){
							$file = "none";
							$link = "none";
						}
						$desc = addslashes($_POST['desc']);
						
						if(isset($_POST['acumular'])){
							$acumular = addslashes($_POST['acumular']);
						}else{
							$acumular = 1;
						}
						
						$busca_it_add = mysql_query("SELECT Name FROM meh_items WHERE id='$id'");
						$conta_it_add = mysql_num_rows($busca_it_add);
						
						if(empty($link) || empty($nome) || ($level <= 0) || ($preco < 0) || ($estoque < 0) || empty($nome) || empty($nome) || empty($desc) || ($acumular < 1)){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Fill out all fields!
		            </div>";
						}else if($conta_it_add > 0){
							echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> There is already an item with this ID!
		            </div>";
						}else{
							$continua = true;
							if($tipo == "Class" && $classid <= 0){
								$continua = false;
							}
							
							switch($tipo){
								case "Sword":
									//$destino_file = "items/swords/";
									$es = "Weapon";
									$icon = "iwsword";
								break;
								case "Dagger":
									//$destino_file = "items/daggers/";
									$es = "Weapon";
									$icon = "iwdagger";
								break;
								case "Staff":
									//$destino_file = "items/staves/";
									$es = "Weapon";
									$icon = "iwstaff";
								break;
								case "Polearm":
									//$destino_file = "items/polearms/";
									$es = "Weapon";
									$icon = "iwpolearm";
								break;
								case "Axe":
									//$destino_file = "items/axes/";
									$es = "Weapon";
									$icon = "iwaxe";
								break;
								case "Mace":
									//$destino_file = "items/maces/";
									$es = "Weapon";
									$icon = "iwmace";
								break;
								case "Armor":
									//$destino_file = "classes/";
									$es = "co";
									$icon = "iwarmor";
								break;
								case "Pet":
									//$destino_file = "items/pets/";
									$es = "pe";
									$icon = "iipet";
								break;
								case "Helm":
									//$destino_file = "items/helms/";
									$es = "he";
									$icon = "iihelm";
								break;
								case "Cape":
									//$destino_file = "items/capes/";
									$es = "ba";
									$icon = "iicape";
								break;
								case "Item":
									$es = "None";
									$icon = "iibag";
								break;
								default:
									$continua = false;
								break;
							}
							
							if($continua){
								if(mysql_query("INSERT INTO meh_items (`id`, `Name`, `Upg`, `Coins`, `Temp`, `Cost`, `QtyRemain`, `ReqItems`, `Lvl`, `ES`, `Type`, `Icon`, `File`, `Link`, `Desc`, `Stk`) VALUES ('$id' , '$nome', '$member', '$acs', '$temp', '$preco', '$estoque', '$ReqItems', '$level', '$es', '$tipo', '$icon', '$file', '$link', '$desc', '$acumular')")){
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! Item name: $nome - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'items.php';
}, 5000);
</script>
";
									
									mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Added the item: $nome', NOW( ))");
									
								}else{
									echo "<b style='color: red'>MYSQL ERROR</b>";
								}
							}else{
									echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Error! Check the fields!
		            </div>";
							}
						}
						echo "<br /><br />";
					}
				?>
			</div>
			<form method="POST">
				<table>

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ID: </td><td><input type="text" name="itid" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $_POST['itid']; ?>" maxlength="50"></td>
					</tr>

					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Item name: </td><td><input type="text" name="add-term" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $_POST['add-term']; ?>" maxlength="50"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Member: </td>
						<td>
							<select name="member">
								<?php if(isset($_POST['member']) && $_POST['member'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ACs: </td>
						<td>
							<select name="coins">
								<?php if(isset($_POST['coins']) && $_POST['coins'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Temp Item: </td>
						<td>
							<select name="temp">
								<?php if(isset($_POST['temp']) && $_POST['temp'] > 0){ ?>
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
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Price <font color="red" style="font-size: 10px;">(only numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['preco'])){ echo $_POST['preco']; }else{ echo 0; } ?>" name="preco"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Stock <font color="red" style="font-size: 10px;">(LQS)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['estoque'])){ echo $_POST['estoque']; }else{ echo 0; } ?>" name="estoque"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Req Items: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['ReqItems'])) ?>" name="ReqItems"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Level <font color="red" style="font-size: 10px;">(only numbers)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(isset($_POST['level'])){ echo $_POST['level']; }else{ echo 1; } ?>" name="level"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Type: </td>
						<td>
							<select name="tipo" onchange="exibeMsg(this.value);">
								<option value="Sword">Sword</option>
								<option value="Dagger">Dagger</option>
								<option value="Staff">Staff</option>
								<option value="Polearm">Polearm</option>
								<option value="Axe">Axe</option>
								<option value="Mace">Mace</option>
								<option value="Armor">Armor</option>
								<option value="Pet">Pet</option>
								<option value="Helm">Helm</option>
								<option value="Cape">Cape</option>
								<option value="Item">Bag</option>
							</select>
						</td>
					</tr>
					<tr id="txt">
						<script>
							function exibeMsg(valor){
								switch (valor){
									break;
									case 'Item':
										document.getElementById('txt').innerHTML = '<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">Bag Stock: <font color="red" style="font-size: 10px;">(Example: Bone Dust x50)</font> </td><td><input type="text" value="1" name="acumular" /></td>';
										document.getElementById('sfile').innerHTML = '';
										document.getElementById('slink').innerHTML = '';
									break;
									case 'Enhancement':
										document.getElementById('sfile').innerHTML = '';
										document.getElementById('slink').innerHTML = '';
										document.getElementById('txt').innerHTML = '';
									break;
									default:
										document.getElementById('txt').innerHTML = '';
										document.getElementById('sfile').innerHTML = '<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File: </td><td><input type="text" name="file" value="<?php echo $_POST['file']; ?>" placeholder="Example: items/swords/Caladbolg.swf"></td>';
										document.getElementById('slink').innerHTML = '<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">Linkage: </td><td><input type="text" name="link" value="<?php echo $_POST['link']; ?>" placeholder="Example: Caladbolg"></td>';
									break;
								}
							}
						</script>
					</tr>
					<tr id="upload">
						<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload-items.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
					</tr>
					<tr id="sfile">
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">SWF File: </td><td><input type="text" name="file" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $_POST['file']; ?>" placeholder="Example: items/swords/Caladbolg.swf"></td>
					</tr>
					<tr id="slink">
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Linkage: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="link" value="<?php echo $_POST['link']; ?>" placeholder="Example: Caladbolg"></td>
					</tr>
					<tr>
						<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Description: </td><td><textarea name="desc" class="elastic form-control required"><?php echo $_POST['desc']; ?></textarea></td>
					</tr>
					<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="submit" name="add" value="Insert item!"></td></tr>
				</table>
			</form>
		<?php }else{ ?>
			<div style='padding: 10px 50px 10px 50px;'>
		<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Edit item</h6>
								</ul>				<?php
					if(isset($_POST['edd'])){
						$ed_id = addslashes($_POST['ed_id']);
						$ed_name = addslashes($_POST['ed_name']);
						$ed_coins = addslashes($_POST['ed_coins']);
						$ed_member = addslashes($_POST['ed_member']);
						$ed_temp = addslashes($_POST['ed_temp']);
						$ed_preco = addslashes($_POST['ed_preco']);
						$ed_level = addslashes($_POST['ed_level']);
						$ed_estoque = addslashes($_POST['ed_estoque']);
						$ed_reqitems = addslashes($_POST['ed_reqitems']);
						$ed_file = addslashes($_POST['ed_file']);
						$ed_link = addslashes($_POST['ed_link']);
						$ed_desc = addslashes($_POST['ed_desc']);
						$ed_stk = addslashes($_POST['ed_stk']);
						$ed_tipo = addslashes($_POST['ed_tipo']);
						
						switch($ed_tipo){
								case "Sword":
									$es = "Weapon";
									$icon = "iwsword";
								break;
								case "Dagger":
									$es = "Weapon";
									$icon = "iwdagger";
								break;
								case "Staff":
									$es = "Weapon";
									$icon = "iwstaff";
								break;
								case "Polearm":
									$es = "Weapon";
									$icon = "iwpolearm";
								break;
								case "Axe":
									$es = "Weapon";
									$icon = "iwaxe";
								break;
								case "Mace":
									$es = "Weapon";
									$icon = "iwmace";
								break;
								case "Armor":
									$es = "co";
									$icon = "iwarmor";
								break;
								case "Pet":
									$es = "pe";
									$icon = "iipet";
								break;
								case "Helm":
									$es = "he";
									$icon = "iihelm";
								break;
								case "Cape":
									$es = "ba";
									$icon = "iicape";
								break;
								case "Item":
									$es = "None";
									$icon = "iibag";
								break;
								case "Enhancement":
									$es = "Weapon";
									$icon = "none";
								break;
								case "House":
									$es = "ho";
									$icon = "ihhouse";
								break;
								case "Floor Item":
									$es = "hi";
									$icon = "ihfloor";
								break;
								case "Wall Item":
									$es = "hi";
									$icon = "ihwall";
								break;
								default:
									$continua = false;
								break;
							}
						
						if(empty($ed_name) || ($ed_preco < 0) || ($ed_level < 0) || ($ed_estoque < 0) || ($ed_stk < 0)){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Error! Check the fields!
		            </div>";
		            						}else{
if(mysql_query("UPDATE meh_items SET `Name`='$ed_name', `Coins`='$ed_coins', `Upg`='$ed_member', `Temp`='$ed_temp', `Cost`='$ed_preco', `Lvl`='$ed_level', `QtyRemain`='$ed_estoque', `ReqItems`='$ed_reqitems', `File`='$ed_file', `Link`='$ed_link', `Desc`='$ed_desc', `Stk`='$ed_stk', `Type`='$ed_tipo', `ES`='$es', `Icon`='$icon' WHERE `id`='$ed_id'")){

							
								mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Edited the item: $ed_id', NOW( ))");
							
								echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! - Redirect in 5 seconds...<script type='text/javascript' language='JavaScript'>
setTimeout(function () { location.href = 'items.php';
}, 5000);
</script>
		            </div>";
							}else{
								echo "<b style='color: red'>MYSQL ERROR!</b><br /><br />";
							}
						}
					}
				?>
			</div>
				<?php
					$edit = addslashes($_GET['edit']);
					$busca_edit = mysql_query("SELECT * FROM meh_items WHERE id=$edit");
					$conta_edit = mysql_num_rows($busca_edit);
					if($conta_edit > 0){
						$types = "Sword,Dagger,Staff,Polearm,Axe,Mace,Armor,Pet,Helm,Cape,Item,Enhancement,House,Floor Item,Wall Item";
						$fetch_edit = mysql_fetch_array($busca_edit);
						$edit_id = $fetch_edit['id'];
						$edit_coins = $fetch_edit['Coins'];
						$edit_upg = $fetch_edit['Upg'];
						$edit_temp = $fetch_edit['Temp'];
						$edit_cost = $fetch_edit['Cost'];
						$edit_lvl = $fetch_edit['Lvl'];
						$edit_name = $fetch_edit['Name'];
						$edit_file = $fetch_edit['File'];
						$edit_link = $fetch_edit['Link'];
						$edit_desc = $fetch_edit['Desc'];
						$edit_estoque = $fetch_edit['QtyRemain'];
						$edit_reqitems = $fetch_edit['ReqItems'];
						$edit_es = $fetch_edit['ES'];
						$edit_type = $fetch_edit['Type'];
						$edit_stk = $fetch_edit['Stk'];
				?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ID: </td><td><?php echo $edit_id; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Name: </td><td><input type="text" name="ed_name" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $edit_name; ?>" maxlength="50"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">ACs: </td>
								<td>
									<select name="ed_coins">
										<?php if($edit_coins > 0){ ?>
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
									<select name="ed_member">
										<?php if($edit_upg > 0){ ?>
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
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Temp Item: </td>
								<td>
									<select name="ed_temp">
										<?php if($edit_temp > 0){ ?>
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
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Type: </td>
								<td>
									<select name="ed_tipo">
										<?php
											$tipos = explode(",", $types);
											for ($b = 0; $b < count($tipos); $b++) {
												if($edit_type == $tipos[$b]){
													if($edit_type == 'Item' || $edit_type == 'None')
														echo "<option value='Item'>{$tipos[$b]}</option>";
													else
														echo "<option value='{$tipos[$b]}'>{$tipos[$b]}</option>";
												}
											}
											for ($c = 0; $c < count($tipos); $c++) {
												if($edit_type != $tipos[$c]){
														if($edit_type == 'Item' || $edit_type == 'None')
															echo "<option value='Item'>{$tipos[$c]}</option>";
														else
															echo "<option value='{$tipos[$c]}'>{$tipos[$c]}</option>";
													}
											}
										?>
									</select>
								</td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Price: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_preco" value="<?php echo $edit_cost; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Level: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_level" value="<?php echo $edit_lvl; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">LQS stock <font color="red" style="font-size: 10px;">(Limited Shop)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_estoque" value="<?php echo $edit_estoque; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Req Items: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_reqitems" value="<?php echo $edit_reqitems; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Bag Stock <font color="red" style="font-size: 10px;">(Example: Snow's Token x50)</font>: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_stk" value="<?php echo $edit_stk; ?>"></td>
							</tr>

					<tr id="upload">
						<td style="border: 1px #000; padding: 10px 50px 10px 50px;" align="right">SWF File</td><td><a href="#" onclick="window.open('upload-items.php', 'Pagina', 'STATUS=NO, TOOLBAR=NO, LOCATION=NO, DIRECTORIES=NO, RESISABLE=NO, SCROLLBARS=YES, TOP=10, LEFT=10, WIDTH=770, HEIGHT=400');">Send .swf</a>  </td>
					</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">SWF File: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_file" value="<?php echo $edit_file; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Link: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_link" value="<?php echo $edit_link; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="right">Description: </td><td><input type="text" class="datepicker-trigger form-control hasDatepicker" name="ed_desc" value="<?php echo $edit_desc; ?>"></td>
							</tr>


							<tr><td style="border: 1px #000; padding: 10px 50px 10px 50px;"></td><td><input type="hidden" name="ed_id" value="<?php echo $edit_id; ?>"><input type="submit" name="edd" value="Update"></td></tr>
						</table>
					</form>
			<?php
				}else{
					echo "<b>Item not FOUND!</b>";
				}
			?>
		
		<?php } ?>
							</br>