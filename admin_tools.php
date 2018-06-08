<?php
						if(isset($_SESSION['Privileges'])){
							if($_SESSION['Privileges']==1) {
								echo '<li class="has-submenu">
							<a style="background-color:#dee9fc ;">Admin Tools</a>
							<div class="mainmenu-submenu">
								<div class="mainmenu-submenu-inner">
									<div>
										<h4>Actions</h4>	
										<ul>
											<li><a href="category-edit.php">Category edit <i class="glyphicon glyphicon-pencil"></i></a></li>
											<li><a href="attribute-edit.php">Attribute edit <i class="glyphicon glyphicon-fire"></i></a></li>
											<li><a href="product-details-admin-new.php">Add new item <i class="glyphicon glyphicon-plus"></i></a></li>
											<li><a href="page-admin-cart-manager.php">Manage orders <i class="glyphicon glyphicon-credit-card"></i></a></li>
										</ul>
									</div>	
								</div>
							</div>
						</li>';
							}
							}
						?>