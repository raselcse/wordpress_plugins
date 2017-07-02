   

    <div id="opl-advertisement">
		    
			<h2> All Lab Test list </h2>
			
			

			<ul class="lab-test-list row">
					<?php
					$html = null;
					$sl_no = 0;
					foreach( $alltest as $test ) {
					    $sl_no =$sl_no+1; 
					    $html .= "<li class='lab_test_list'>
						            <span class='test_image'></span>
						            <div class=''>
									<a href='search-discount/?lab_test_id=$test->id'>
										$test->lab_test_name 
									</a>
									</div>
								</li>";
					}
					echo  $html;
					?>
			</ul>



		
		</div>