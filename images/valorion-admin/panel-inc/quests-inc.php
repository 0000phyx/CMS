<?php 
//HAHA?
session_start();
If($_SESSION['login'] != 1 ){ header("location:login.php"); }
?>
		<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Insert new quest</h6>
								</ul>
        	</div>
				<form action="add-quest.php" method="POST">
					<div class="input-group">
						<input type="text" id="search-term" value="<?php echo addslashes($_POST['add-term']); ?>" name="add-term" class="form-control" placeholder="Quest name">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="icon-question"></i></button>
						</span>
					</div>
				</form>
			</div>
		
		<div class="block">
			<div class="block full">
				<div class="block-title">
				<h6 class="heading-hr"><i class="icon-file"></i> Search quest</h6>
								</ul>
        	</div>
				<form action="" method="post">
					<div class="input-group">
						<input type="text" id="search-term" value="<?php echo addslashes($_POST['search-term']); ?>" name="search-term" class="form-control" placeholder="Quest name">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default"><i class="icon-search3"></i></button>
						</span>
					</div>
				</form>
			</div>
		
		<table class="table table-bordered" align="center">
		<tr>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>ID</b></td>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>Name</b></td>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>Req. Items</b></td>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>Rewards</b></td>
			<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align="center"><b>Edit</b></td>
		</tr>
			
		<?php
			if(!(isset($_POST['search-term']))){
				$_BS['bypage'] = 30;

				$sql = "SELECT COUNT(*) AS total FROM `meh_quests`";
				$query = mysql_query($sql);
				$total = mysql_result($query, 0, 'total');

				$paginas =  (($total % $_BS['bypage']) > 0) ? (int)($total / $_BS['bypage']) + 1 : ($total / $_BS['bypage']);

				if (isset($_GET['page'])) {
					$pagina = (int)$_GET['page'];
				} else {
					$pagina = 1;
				}

				$pagina = max(min($paginas, $pagina), 1);
				$inicio = ($pagina - 1) * $_BS['bypage'];
				$sql = "SELECT * FROM `meh_quests` ORDER BY `id` ASC LIMIT ".$inicio.", ".$_BS['bypage'];
				$query = mysql_query($sql);

				while ($resultado = mysql_fetch_assoc($query)) {
					$id = $resultado['id'];
					$name = $resultado['sName'];
					$turnin = $resultado['turnin'];
					$oRewards = $resultado['oRewards'];
					echo "
						<tr>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$id</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$name</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$turnin</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$oRewards</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>
							<a href='add-quest.php?edit=$id'><i class='icon-pencil2'></i></a>
							</td>
						</tr>
					";
				}
				
				echo "</table>";

				if ($total > 0) {
					echo "<br /><br /><center>Other quests: ";
					for($n = 1; $n <= $paginas; $n++) {
						echo '<a href="?page='.$n.'">'.$n.'</a>&nbsp;&nbsp;';
					}
					echo "</center>";
				}

			}else{
				$busca_prot = addslashes($_POST['search-term']);
				$busca_it = mysql_query("SELECT * FROM meh_quests WHERE ((`sName` LIKE '%".$busca_prot."%') OR ('%".$busca_prot."%'))");
				$conta_it = mysql_num_rows($busca_it);
				if($conta_it > 0){
					while($fetch_it = mysql_fetch_array($busca_it)){
						$id = $fetch_it['id'];
						$name = $fetch_it['sName'];
						$turnin = $fetch_it['turnin'];
						$orewards = $fetch_it['oRewards'];
						echo "
						<tr>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$id</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$name</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$turnin</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$orewards</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>
							<a href='add-quest.php?edit=$id'><i class='icon-pencil2'></i></a>
							</td>
						</tr>
						";
					}
				}else{
					echo "
						<tr>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>MAP</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>NOT</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>FOUND!</td>
						</tr>";
				}
				echo "</table>
				<center><a href='quests.php'><br /><br />All quest list</a></center>
				";
			}
		?>
<br>
<?php }else{ ?>
	<?php include "login.php"; ?>
<?php } ?>		