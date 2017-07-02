   

    <div id="opl-advertisement">
		    <div>
			<a href="admin.php?page=lab_test" class="button button-primary"> All Test</a>
			<a href="admin.php?page=diagnostic_center" class="button button-primary"> All Diagnostic Center</a>
			<a href="admin.php?page=allLabDiscount" class="button button-primary"> All Discount</a>
			</div>
			<h2> All Lab Test list </h2>
			
			<a href="admin.php?page=add_LabTest" class="button button-primary"> Add New Test</a>
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
					  <th scope="col">Name</th>
					  <th scope="col">Description</th>
					 <th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$html = null;
					$sl_no = 0;
					foreach( $alltest as $test ) {
					    $sl_no =$sl_no+1; 
					    $html .= "<tr>
						  <td> $sl_no </td>
						  <td> $test->lab_test_name </td>
						  <td> $test->lab_test_description </td>
						  <td> <a href='admin.php?page=getLabTestById&id=$test->id'>Edit</a> </td>
						  <td> <a href='admin.php?page=deleteLabTest&id=$test->id'>Delete</a> </td>
						</tr>";
					}
					echo  $html;
					?>

				</tbody>
                <thead>
					<tr>
						<th scope="col">Sl No.</th>
						<th scope="col">Name</th>
						<th scope="col">Description</th>
						<th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
			</table>



		
		</div>