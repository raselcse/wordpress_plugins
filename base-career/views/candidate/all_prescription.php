   

    <div id="prescription-section">
		   
		<h2> All Lab Test list </h2>
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
				  <th scope="col">Image</th>
				  <th scope="col">status</th>
				 <th scope="col" colspan="2">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$html = null;
				$sl_no = 0;
				foreach( $allprescription as $prescription ) {
					$sl_no =$sl_no+1; 
					$media_id = $prescription->prescription_media_id;
					$image_attributes = wp_get_attachment_image_src( $media_id, 'full' );
					$image_url =  $image_attributes[0];
					$html .= "<tr>
					  <td> $sl_no </td>
					  <td> $prescription->prescription_title </td>
					  <td> $prescription->prescription_description </td>
					  <td> <img width='120px' id='prescription_order_image' src='$image_url'/> </td>
					  <td> $prescription->prescription_order_status </td>
					  <td class='action_link'> <a href='admin.php?page=getPrescriptionById&id=$prescription->id'>Edit</a> </td>
					  <td class='action_link'> <a href='admin.php?page=deletePrescription&id=$prescription->id'>Delete</a> </td>
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
					  <th scope="col">status</th>
					 <th scope="col" colspan="2">Action</th>
					</tr>
				</thead>
		</table>
		  
	</div>
		
		<!-- The Modal -->
	<div id='myModal' class='modal'>

	  <!-- The Close Button -->
	  <span class='close' onclick="document.getElementById('myModal').style.display='none' ">&times;</span>

	  <!-- Modal Content (The Image) -->
	  <img class='modal-content' id='img01'>

	  <!-- Modal Caption (Image Text) -->
	  <div id='caption'></div>
	</div>
			
		