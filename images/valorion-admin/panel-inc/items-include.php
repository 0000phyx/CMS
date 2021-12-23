            <div class="wraper container-fluid">
                <div class="page-title"> 
                    <h3 class="title">Editable Table</h3> 
                </div>


                <div class="panel">
                            
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="m-b-30">
                                    <button id="addToTable" class="btn btn-primary waves-effect waves-light">Add <i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <table class="table table-bordered table-striped" id="datatable-editable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Item Name</th>
                                    <th>Rarity</th>
                                    <th>Type</th>
									<th>Staff Only</th>
									<th>Upgrade Only</th>
									<th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="gradeX">
		<?php
			if(!(isset($_POST['search-term']))){
				$_BS['bypage'] = 30;

				$sql = "SELECT COUNT(*) AS total FROM `meh_items`";
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
				$sql = "SELECT * FROM `meh_items` ORDER BY `id` DESC LIMIT ".$inicio.", ".$_BS['bypage'];
				$query = mysql_query($sql);

				while ($resultado = mysql_fetch_assoc($query)) {
					$id = $resultado['id'];
					$name = $resultado['Name'];
					$rarity = $resultado['Rty'];
					$type = $resultado['Type'];
					$staff = $resultado['Staff'];
					$upgrade = $resultado['Upg'];

										
					echo "
						<tr>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$id</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$name</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$rarity</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$type</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$staff</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$upgrade</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>
							<a href='add-items.php?edit=$id'><span>Edit</span></a>
							</td>
						</tr>
					";
				}
				
				echo "</table>";
				

				if ($total > 0) {
					echo "<br /><br /><center>Other items: ";
					for($n = 1; $n <= $paginas; $n++) {
						echo '<a href="?page='.$n.'">'.$n.'</a>&nbsp;&nbsp;';
					}
					echo "</center>";
				}
			}else{
				$busca_prot = addslashes($_POST['search-term']);
				$busca_it = mysql_query("SELECT * FROM meh_items WHERE ((`Name` LIKE '%".$busca_prot."%') OR ('%".$busca_prot."%'))");
				$conta_it = mysql_num_rows($busca_it);
				if($conta_it > 0){
					while($fetch_it = mysql_fetch_array($busca_it)){
						$id = $fetch_it['id'];
						$name = $fetch_it['Name'];
						echo "
							<tr>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$id</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$name</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$rarity</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$type</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$staff</td>
							<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>$upgrade</td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>
						    	<a href='add-items.php?edit=$id'><span>Edit</span></a>
								</td>
							</tr>
						";
					}
				}else{
					echo "
						<tr>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>ITEM</td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>NOT</td>
								<td style='border: 1px #000; padding: 10px 50px 10px 50px;' align='center'>FOUND!</td>
						</tr>";
				}
				echo "</table>
				<center><a href='items.php'><br /><br />All items list</a></center>
				";
			}
		?>
                                </tr>

								
                            </tbody>
                        </table>
                    </div>
                    <!-- end: page -->

                </div> <!-- end Panel -->


            </div>