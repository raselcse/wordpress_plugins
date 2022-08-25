
        <div id="opl-advertisement">
		
			<h2> All Advertisement type list </h2>
			<a href="admin.php?page=add_advertisement_type" class="button button-primary"> Add New Type</a>
			 <?php 
				if(isset($success_msg)){
					echo '<h3 style="color:green">'.$success_msg ."</h3>";
				}
				else{
					echo '<h3 style="color:red">'.$error_msg."</h3>";
				}
			?>

			<table>
				<thead>
					<tr>
					  <th scope="col">Sl No.</th>
					  <th scope="col">Title</th>
					  <th scope="col">Width</th>
					  <th scope="col">Height</th>
					  <th scope="col">Description</th>
					  <th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$html = null;
					$sl_no = 0;
					foreach( $types as $type ) {
					    $sl_no =$sl_no+1; 
						$html .= "<tr>
						  <td>$sl_no</td>
						  <td>$type->title</td>
						  <td>$type->width</td>
						  <td>$type->height</td>
						  <td>$type->description</td>
						  <td><a href='admin.php?page=getForUpdateType&id=$type->id'>Edit</a></td>
						  <td><a href='admin.php?page=deleteType&id=$type->id'>Delete</a></td>
						</tr>";
					}
					echo  $html;
					?>

				</tbody>

			</table>

		
		</div>
        
        