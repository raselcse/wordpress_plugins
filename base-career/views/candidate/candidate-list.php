   

    <div id="prescription-section">
		   
		<h2> All Candidate </h2>
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
				  <th scope="col">phone No</th>
				  <th scope="col">Email</th>
				 <th scope="col" colspan="2">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$html = null;
				$sl_no = 0;
				foreach( $allcandidate as $candidate ) {
					$sl_no =$sl_no+1; 
					$html .= "<tr>
					  <td> $sl_no </td>
					  <td> $candidate->name </td>
					  <td> $candidate->phone_no </td>
					  <td> $candidate->email </td>
					  <td class='action_link'> <a href='admin.php?page=getById&id=$candidate->id'>Edit</a> </td>
					  <td class='action_link'> <a href='admin.php?page=deleteCandidate&id=$candidate->id'>Delete</a> </td>
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
					  <th scope="col">Image</th>
					 <th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
		</table>
		  
	</div>