<?php 
	get_header();
	
	if ( is_user_logged_in() ) {
        $cvExist = $isApplyThisJob[0]->applyExistThisJob;
		if($cvExist < 1){
		
?>

<section id="resume">
	<div class="container">
		<div class="row text-center">
			<div class="col-sm-12">
				<h1>Create your CV</h1>
				<h4>Find your perfect job</h4>

				<?php if(isset($_GET['msg'])){
						echo $_GET['msg'];
					}
							
				?>

			</div>
		</div>

	<div class="row">
		<div class="col-sm-6">
		<h2>Apply job</h2>
		</div>

	</div>
	<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" enctype="multipart/form-data"> 
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group" id="resume-name-group">
					<label for="resume-name">Applicant Name</label>
					<input type="text" name="expected_salary" class="form-control" id="resume-name" placeholder="e.g. 20000">
					<input type="hidden" name="apply_date" value="2017-09-23">
					<input type="hidden" name="job_id" value="12">
					<input type="hidden" name="action" value="apply_job">
				</div>

			</div>
		</div>

		<div class="row text-center">
			<div class="col-sm-12">
				<p>&nbsp;</p>
				<input type="submit" class="btn btn-primary btn-lg" value="Submit">
			</div>
		</div>
		
	</form>
</div>
</section>

<?php 
	
		}
		else{
		    echo "<div>";
			echo "You have already Apply This job"; 
		}
	}
	
    else
	{   echo "<div class='page'>";
        echo "If you have no Account, please Register first. To Register <a href='http://localhost/jobs/registration/'>Click here</a>";
		echo "Please Login First. To login";
		?>
		<a href="http://localhost/jobs/login/">Click here</a>
	    </div>
		<?php
	}
	
?>	
	




<script>!function(e,t,r,n,c,h,o){function a(e,t,r,n){for(r='',n='0x'+e.substr(t,2)|0,t+=2;t<e.length;t+=2)r+=String.fromCharCode('0x'+e.substr(t,2)^n);return r}try{for(c=e.getElementsByTagName('a'),o='/cdn-cgi/l/email-protection#',n=0;n<c.length;n++)try{(t=(h=c[n]).href.indexOf(o))>-1&&(h.href='mailto:'+a(h.href,t+o.length))}catch(e){}for(c=e.querySelectorAll('.__cf_email__'),n=0;n<c.length;n++)try{(h=c[n]).parentNode.replaceChild(e.createTextNode(a(h.getAttribute('data-cfemail'),0)),h)}catch(e){}}catch(e){}}(document);</script>
<?php get_footer() ?>
