<?php 
session_start();
If($_SESSION['admin_log'] != 1 ){ header("location:login"); }	
?>
        			<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Search another player</h6>
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
				<h6 class="heading-hr"><i class="icon-file"></i> Edit player: <?php echo $_GET['user']; ?></h6>
				</div>
			
			<?php
				$player = addslashes($_GET['user']);
				$busca_edit = mysql_query("SELECT * FROM meh_users WHERE Username='$player'");
				$conta_edit = mysql_num_rows($busca_edit);
			?>
			<?php if($conta_edit > 0){ ?>
			
				<?php
					$fetch_edit = mysql_fetch_array($busca_edit);
					
					$busca_max_lvl = mysql_query("SELECT value FROM meh_settings_rates WHERE name='intLevelMax'");
					$fetch_max_lvl = mysql_fetch_array($busca_max_lvl);
					
					$cargo_edit = $fetch_edit['Username'];
					$user_id = $fetch_edit['id'];
				?>
				<div style="float: left; width: 50%">
					<h6>Account info</h6>
					
					<?php
						if(isset($_POST['acao']) && $_POST['acao'] == "Update"){
							if(!(empty($_SESSION['passlog']))){
								$continuar = true;
								
								if(isset($_POST['access'])){
									$cargo = $_POST['access'];
								}else{
									$cargo = $fetch_edit['Access'];
								}
								
								
								$gender = $_POST['gender'];
								
								$gold = $_POST['gold'];
								if($gold > 9999999999999){
									$gold = 9999999999999;
								}
								
								$coins = $_POST['coins'];
								if($coins > 9999999999999){
									$coins = 9999999999999;
								}
								
								$level = $_POST['level'];
								if($level > $fetch_max_lvl[0]){
									$level = $fetch_max_lvl[0];
								}
								
								$bag = $_POST['bag'];
								if($bag > 4000){
									$bag = 4000;
								}
								
								$house = $_POST['house'];
								if($house > 4000){
									$house = 4000;
								}
								
								$bank = $_POST['bank'];
								if($bank > 4000){
									$bank = 4000;
								}
								
								if($continuar){
									mysql_query("UPDATE meh_users SET Access='$cargo',Gender='$gender',Gold='$gold',Coins='$coins',Level='$level',BagSlots='$bag',HouseSlots='$house',BankSlots='$bank' WHERE Username='$player'");
									
									mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Edited the player: $player', NOW( ))");
									
									echo "<div class='alert alert-success fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-checkmark-circle'></i> Sucess! Updating the page...
		            </div>		            <script type='text/javascript'>   
function Redirect() 
{  
window.location='users.php?user=$player'; 
} 
setTimeout('Redirect()', 3000);   
</script>";								}else{
									echo "<b style='color: red;'>Something wrong, fill the fields correctly</b>";
								}
							}else{
								echo "<b style='color: red;'>You can not change ranks</b>";
							}
						}
					?>
					
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>User Id: </td><td><?php echo $fetch_edit['id']; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Username: </td><td><?php echo $fetch_edit['Username']; ?></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Password: </td><td>
								
									<?php 
										if($access < 61){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> You can not see passwords.
		            </div>";										} else if($fetch_edit['Username'] == $user){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> You can not see passwords.
		            </div>";										}else{
									?>
											<?php if($fetch_edit['Access'] >= 61){ ?>
                      <?php echo $fetch_edit['Password']; ?> </td>
											<?php }else{ ?>
											<?php } ?>
									<?php } ?>
								
								</td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Rank: </td><td>
								
									<?php 
										if($access < 61){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> You can not change ranks.
		            </div>";	
		             } else if($fetch_edit['Username'] == $user){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> You can not change your rank.
		            </div>";										
		            	}else{
									?>
											<?php if($fetch_edit['Access'] >= 60){ ?>
												<select name="access">
													<option value="60">Administrator</option>
													<option value="40">Moderator</option>
													<option value="5">Helper</option>
													<option value="2">VIP</option>
													<option value="1">Player</option>
												</select>
											<?php }else if($fetch_edit['Access'] >= 40){ ?>
												<select name="access">
													<option value="60">Administrator</option>
													<option value="40">Moderator</option>
													<option value="5">Helper</option>
													<option value="2">VIP</option>
													<option value="1">Player</option>
												</select>
											<?php }else if($fetch_edit['Access'] >= 1){ ?>
												<select name="access">
													<option value="1">Player</option>
													<option value="40">Moderator</option>
													<option value="60">Administrator</option>
												</select>
											<?php }else{ ?>
												Player banned
											<?php } ?>
									<?php } ?>
								
								</td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Gender: </td><td>
								<select name="gender">
									<?php if($fetch_edit['Gender'] == 'M'){ ?>
										<option value="M">Male</option>
										<option value="F">Female</option>
									<?php }else if($fetch_edit['Gender'] == 'F'){ ?>
										<option value="F">Female</option>
										<option value="M">Male</option>
									<?php } ?>
								</select>
								</td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Gold: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="gold" value="<?php echo $fetch_edit['Gold']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Coins: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="coins" value="<?php echo $fetch_edit['Coins']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Level: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="level" value="<?php echo $fetch_edit['Level']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Bag: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="bag" value="<?php echo $fetch_edit['BagSlots']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Bank: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="bank" value="<?php echo $fetch_edit['BankSlots']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>House: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" name="house" value="<?php echo $fetch_edit['HouseSlots']; ?>"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Server: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php echo $fetch_edit['CurrentServer']; ?>" readonly="true"></td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;'>Map: </td><td> <input type="text" class="datepicker-trigger form-control hasDatepicker" value="<?php if(empty($fetch_edit['LastArea'])){ echo "Nenhum"; }else{ echo $fetch_edit['LastArea']; } ?>" readonly="true"></td>
							</tr>
							<tr>
								<td></td><td><input type="submit" name="acao" value="Update"></td>
							</tr>
						</table>
					</form>
					
				</div>
				<div style="float: right; width: 40%">
				<h6>Add ITEM - <a href="item.php" target="_blank">Item list</a></font></h2>
					<?php
						if(isset($_POST['additem'])){
							if(!(empty($_SESSION['passlog']))){
								$itemid_add = addslashes($_POST['itemid']);
								$quant_add = addslashes($_POST['quantidade']);
								
								$busca_add = mysql_query("SELECT ES FROM meh_items WHERE id='$itemid_add'");
								$conta_add = mysql_num_rows($busca_add);
								
								$busca_play_add = mysql_query("SELECT id FROM meh_users_items WHERE itemid='$itemid_add' AND userid='$user_id'");
								$conta_play_add = mysql_num_rows($busca_play_add);
								
								if(empty($itemid_add) || empty($quant_add)){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> Enter the ID and quantity!
		            </div>";
		            			}else if($conta_add <= 0){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> Item not found!
		            </div>";								}else if($conta_play_add > 0){
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> The player already has this item!
		            </div>";								}else{
									$fetch_add = mysql_fetch_array($busca_add);
									$ES_add = $fetch_add[0];
									$data = "20" . date("y/m/d") . " " . date("H:i:s");
									
									mysql_query("INSERT INTO `meh_users_items` (`id`, `userid`, `itemid`, `equipped`, `equipment`, `level`, `quantity`, `inbank`, `enhid`, `dPurchase`) VALUES (NULL, '$user_id', '$itemid_add', '0', '$ES_add', '1', '$quant_add', '0', '1', '$data')");
									
									mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Added the item: $itemid_add - for the player: $player', NOW( ))");
									
								}
							}else{
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> You are not logged in!
		            </div>";								}
						}
					?>
					<form action="" method="POST">
						<table>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 0px;'>Item ID: </td><td><input class="datepicker-trigger form-control hasDatepicker" type="text" name="itemid"> </td>
							</tr>
							<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 0px;'>Quantity: </td><td><input class="datepicker-trigger form-control hasDatepicker" type="text" name="quantidade" value="1"> </td>
							</tr><tr>
								<td></td><td><input type="submit" name="additem" value="Add item"> </td>
							</tr>
						</table>
					</form>
					
										<h6>Inventory</h6>
					<?php
						if(isset($_POST['deletar'])){
							if(!(empty($_SESSION['passlog']))){
								$id_del = $_POST['deletar'];
								$id_del_it = $_POST['deletar2'];
								if(mysql_query("DELETE FROM meh_users_items WHERE id='$id_del' AND userid='$user_id'")){
								
									mysql_query("INSERT INTO admin_logs (`Staff`, `Info`, `Date`) VALUES ('$user', 'Removed item: $id_del_it - from player: $player', NOW( ))");
								
								}else{
									echo "<div class='alert alert-danger fade in block-inner'>
		                <button type='button' class='close' data-dismiss='alert'>×</button>
		                <i class='icon-cancel-circle'></i> Error while deleting item
		            </div>";								}
							}else{
									echo "<div class='alert alert-danger fade in block-inner'>
		                <i class='icon-cancel-circle'></i> You are not logged in!
		            </div>";								}
						}
					?>
					
					<?php
						$busca_class = mysql_query("SELECT itemid,quantity,id FROM meh_users_items WHERE equipment='ar' AND userid='$user_id' AND inbank=0");
						$conta_class = mysql_num_rows($busca_class);
						if($conta_class > 0){
							while($fetch_class = mysql_fetch_array($busca_class)){
								$class_id = $fetch_class[0];
								$class_quant = $fetch_class[1];
								$class_loc = $fetch_class[2];
								$busca_nomec = mysql_query("SELECT Name FROM meh_items WHERE id=$class_id");
								$fetch_nomec = mysql_fetch_array($busca_nomec);
						
								$rank = 1;
								if($class_quant < 900)
									$rank = 1;
								else if($class_quant < 3600)
									$rank = 2;
								else if($class_quant < 10000)
									$rank = 3;
								else if($class_quant < 22500)
									$rank = 4;
								else if($class_quant < 44100)
									$rank = 5;
								else if($class_quant < 78400)
									$rank = 6;
								else if($class_quant < 129600)
									$rank = 7;
								else if($class_quant < 202500)
									$rank = 8;
								else if($class_quant < 302500)
									$rank = 9;
								else
									$rank = 10;
						
								echo "
									<div style='float: left; width: 300px';>
										<img src='images/items/class.png'> $fetch_nomec[0] (Rank $rank)
									</div>
									<div style='float: left; width: 10px;'>
										<form style='display: inline' action='' method='POST'>
											<input type='hidden' name='deletar' value='$class_loc'>
											<input type='hidden' name='deletar2' value='$class_id'>
											<input type='image' src='images/delete.png' alt='Delet'>
										</form>
									</div>
									</br>
								";
							}
						}
					?>
					
					<?php
						$busca_armor = mysql_query("SELECT itemid,id FROM meh_users_items WHERE equipment='co' AND userid='$user_id' AND inbank=0");
						$conta_armor = mysql_num_rows($busca_armor);
						if($conta_armor > 0){
							while($fetch_armor = mysql_fetch_array($busca_armor)){
								$armor_id = $fetch_armor[0];
								$armor_loc = $fetch_armor[1];
								$busca_nomeam = mysql_query("SELECT Name FROM meh_items WHERE id=$armor_id");
								$fetch_nomeam = mysql_fetch_array($busca_nomeam);
				
								echo "
									<div style='float: left; width: 300px';>
										<img src='images/items/armor.png'> $fetch_nomeam[0]
									</div>
									<div style='float: left; width: 10px;'>
										<form style='display: inline' action='' method='POST'>
											<input type='hidden' name='deletar' value='$armor_loc'>
											<input type='hidden' name='deletar2' value='$armor_id'>
											<input type='image' src='images/delete.png' alt='Delet'>
										</form>
									</div>
									</br>
								";
							}
						}
					?>
					
					<?php
						$busca_bag = mysql_query("SELECT itemid,id FROM meh_users_items WHERE equipment!='ba' AND equipment!='he' AND equipment!='pe' AND equipment!='Weapon' AND equipment!='co' AND equipment!='ar' AND equipment!='ho' AND equipment!='hi' AND userid='$user_id' AND inbank=0");
						$conta_bag = mysql_num_rows($busca_bag);
						if($conta_bag > 0){
							while($fetch_bag = mysql_fetch_array($busca_bag)){
								$bag_id = $fetch_bag[0];
								$bag_loc = $fetch_bag[1];
								$busca_nomeb = mysql_query("SELECT Name FROM meh_items WHERE id=$bag_id");
								$fetch_nomeb = mysql_fetch_array($busca_nomeb);
								
								echo "
									<div style='float: left; width: 300px';>
										<img src='images/items/bag.png'> $fetch_nomeb[0]
									</div>
									<div style='float: left; width: 10px;'>
										<form style='display: inline' action='' method='POST'>
											<input type='hidden' name='deletar' value='$bag_loc'>
											<input type='hidden' name='deletar2' value='$bag_id'>
											<input type='image' src='images/delete.png' alt='Delet Item'>
										</form>
									</div>
									</br>
								";
							}
						}
					?>
					
					<?php
						$busca_cape = mysql_query("SELECT itemid,id FROM meh_users_items WHERE equipment='ba' AND userid='$user_id' AND inbank=0");
						$conta_cape = mysql_num_rows($busca_cape);
						if($conta_cape > 0){
							while($fetch_cape = mysql_fetch_array($busca_cape)){
								$cape_id = $fetch_cape[0];
								$cape_loc = $fetch_cape[1];
								$busca_nomecp = mysql_query("SELECT Name FROM meh_items WHERE id=$cape_id");
								$fetch_nomecp = mysql_fetch_array($busca_nomecp);
								
								echo "
									<div style='float: left; width: 300px';>
										<img src='images/items/cape.png'> $fetch_nomecp[0]
									</div>
									<div style='float: left; width: 10px;'>
										<form style='display: inline' action='' method='POST'>
											<input type='hidden' name='deletar' value='$cape_loc'>
											<input type='hidden' name='deletar2' value='$cape_id'>
											<input type='image' src='images/delete.png' alt='Delet'>
										</form>
									</div>
									</br>
								";
							}
						}
					?>
					
					<?php
						$busca_helm = mysql_query("SELECT itemid,id FROM meh_users_items WHERE equipment='he' AND userid='$user_id' AND inbank=0");
						$conta_helm = mysql_num_rows($busca_helm);
						if($conta_helm > 0){
							while($fetch_helm= mysql_fetch_array($busca_helm)){
								$helm_id = $fetch_helm[0];
								$helm_loc = $fetch_helm[1];
								$busca_nomeh = mysql_query("SELECT Name FROM meh_items WHERE id=$helm_id");
								$fetch_nomeh = mysql_fetch_array($busca_nomeh);
								
								echo "
									<div style='float: left; width: 300px';>
										<img src='images/items/helm.png'> $fetch_nomeh[0]
									</div>
									<div style='float: left; width: 10px;'>
										<form style='display: inline' action='' method='POST'>
											<input type='hidden' name='deletar' value='$helm_loc'>
											<input type='hidden' name='deletar2' value='$helm_id'>
											<input type='image' src='images/delete.png' alt='Delet'>
										</form>
									</div>
									</br>
								";
							}
						}
					?>
					
					<?php
						$busca_pet = mysql_query("SELECT itemid,id FROM meh_users_items WHERE equipment='pe' AND userid='$user_id' AND inbank=0");
						$conta_pet = mysql_num_rows($busca_pet);
						if($conta_pet > 0){
							while($fetch_pet= mysql_fetch_array($busca_pet)){
								$pet_id = $fetch_pet[0];
								$pet_loc = $fetch_pet[1];
								$busca_nomep = mysql_query("SELECT Name FROM meh_items WHERE id=$pet_id");
								$fetch_nomep = mysql_fetch_array($busca_nomep);
								
								echo "
									<div style='float: left; width: 300px';>
										<img src='images/items/pet.png'> $fetch_nomep[0]
									</div>
									<div style='float: left; width: 10px;'>
										<form style='display: inline' action='' method='POST'>
											<input type='hidden' name='deletar' value='$pet_loc'>
											<input type='hidden' name='deletar2' value='$pet_id'>
											<input type='image' src='images/delete.png' alt='Delet'>
										</form>
									</div>
									</br>
								";
							}
						}
					?>
					
					<?php
						$busca_weapon = mysql_query("SELECT itemid,id FROM meh_users_items WHERE equipment='Weapon' AND userid='$user_id' AND inbank=0");
						$conta_weapon = mysql_num_rows($busca_weapon);
						if($conta_weapon > 0){
							while($fetch_weapon = mysql_fetch_array($busca_weapon)){
								$weapon_id = $fetch_weapon[0];
								$weapon_loc = $fetch_weapon[1];
								$busca_nomew = mysql_query("SELECT Name FROM meh_items WHERE id=$weapon_id");
								$fetch_nomew = mysql_fetch_array($busca_nomew);
								
								echo "
									<div style='float: left; width: 300px';>
										<img src='images/items/sword.png'> $fetch_nomew[0]
									</div>
									<div style='float: left; width: 10px;'>
										<form style='display: inline' action='' method='POST'>
											<input type='hidden' name='deletar' value='$weapon_loc'>
											<input type='hidden' name='deletar2' value='$weapon_id'>
											<input type='image' src='images/delete.png' alt='Delet'>
										</form>
									</div>
									</br>
								";
							}
						}
					?>
					
				</div>