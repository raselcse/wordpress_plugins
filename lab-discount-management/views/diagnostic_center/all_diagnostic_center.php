
        <div id="opl-advertisement">
		    <div>
			<a href="admin.php?page=lab_test" class="button button-primary"> All Test</a>
			<a href="admin.php?page=diagnostic_center" class="button button-primary"> All Diagnostic Center</a>
			<a href="admin.php?page=allLabDiscount" class="button button-primary"> All Discount</a>
			</div>
			<h2> All Advertisement type list </h2>
			<a href="admin.php?page=add_diagnostic_center" class="button button-primary"> Add New Diagnostic Center</a>
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
					  <th scope="col">Diagnostic Center Name</th>
					   <th scope="col">Address</th>
					  <th scope="col">Description</th>
					  
					  <th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$html = null;
					$sl_no = 0;
					foreach( $diagnostic_centeres as $diagnostic_center ) {
					    $sl_no =$sl_no+1; 
						$html .= "<tr>
						  <td>$sl_no</td>
						  <td>$diagnostic_center->dc_name</td>
						  <td>$diagnostic_center->dc_address</td>
						  <td>$diagnostic_center->dc_description</td>
						  <td><a href='admin.php?page=getDiagnosticCenterById&id=$diagnostic_center->id'>Edit</a></td>
						  <td><a href='admin.php?page=delete_diagnostic_center&id=$diagnostic_center->id'>Delete</a></td>
						</tr>";
					}
					echo  $html;
					?>

				</tbody>

				<thead>
					<tr>
					  <th scope="col">Sl No.</th>
					  <th scope="col">Diagnostic Center Name</th>
					   <th scope="col">Address</th>
					  <th scope="col">Description</th>
					  
					  <th scope="col" colspan="2">Action</th>
					</tr>
				</thead>

			</table>

		
		</div>
        
        