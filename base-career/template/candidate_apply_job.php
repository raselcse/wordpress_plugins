<?php 
	get_header();
?>

<section id="resume">
<div class="container">
<div class="row text-center">
<div class="col-sm-12">
<h1>Post a Resume</h1>
<h4>Find your perfect job</h4>
<div class="jumbotron">
<h3>Have an account?</h3>
<p>If you don’t have an account you can create one below by entering your email address/username.<br>
A password will be automatically emailed to you.</p>
<?php if(isset($_GET['msg'])){
	 echo $_GET['msg'];
	}
        	
?>
<p><a href="#" class="btn btn-primary">Sign In</a></p>
</div>
</div>
</div>

<div class="row">
<div class="col-sm-6">
<h2>Resume details</h2>
</div>

</div>
<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" enctype="multipart/form-data"> 
<div class="row">
	<div class="col-sm-6">
		<div class="form-group" id="resume-name-group">
			<label for="resume-name">Applicant Name</label>
			<input type="text" name="name" class="form-control" id="resume-name" placeholder="e.g. John Doe">
			<input type="hidden" name="action" value="submit_candidate">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Date of Birth</label>
		<input type="date" name="date_of_birth" class="form-control" id="resume-title" placeholder="">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Gender</label>
		<select class="form-control" id="resume-category" name="gender">
		<option value="male" >Male</option>
		<option value="female">Female</option>
		</select>
		</div>
      
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">District</label>
		<select class="form-control" id="resume-category" name="district">
		
			
			<option value="dhaka" >Dhaka</option>
			<option value="chittagong" >Chittagong</option>
		</select>
		</div>
		
        <div class="form-group" id="resume-title-group">
		<label for="resume-title">Marital Status</label>
		<select class="form-control" id="resume-category" name="marital_status">
		<option value="unmerried">Unmerried</option>
		<option value="merried">merried</option>
		</select>
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Religion</label>
		<select class="form-control" id="resume-category" name="religion">
		
			<option value="islam">Islam</option>
			<option value="hindu">Hindu</option>
		</select>
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Nationality</label>
		<input type="text" name="nationality" class="form-control" id="resume-title" placeholder="e.g.Bangladeshi">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">National Id or Passport</label>
		<input type="text" name="nationalid_or_passport" class="form-control" id="resume-title" placeholder="e.g. National Id or Passport">
		</div>
        
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Phone No</label>
		<input type="text" name="phone_no" class="form-control" id="resume-title" placeholder="e.g. Phone No">
		</div>


		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Email</label>
		<input type="text" name="email" class="form-control" id="resume-title" placeholder="e.g. support@website.com">
		</div>

	</div>
	
	<div class="col-sm-6">
	
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Present Address</label>
		<input type="text" name="present_address" class="form-control" id="resume-title" placeholder="e.g. Present address">
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Permanant Address</label>
		<input type="text" name="permanent_address" class="form-control" id="resume-title" placeholder="e.g. Web Designer">
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Career Objective</label>
		<input type="text" name="career_objective" class="form-control" id="resume-title" placeholder="e.g. Web Designer">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Total Experience</label>
		<input type="text" name="total_experience" class="form-control" id="resume-title" placeholder="e.g. Web Designer">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Preferred Level Position</label>
		
			<select class="form-control" id="resume-category" name="preferred_level_position">
			<option value="entry-level">Entry Level</option>
			<option value="mid-level">Mid Level</option>
			<option value="expert-level">Expert Level</option>
			</select>
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Available For</label>
			<select class="form-control" id="resume-category" name="available_for">
			<option value="full-time">Full Time</option>
			<option value="part-time">Part Time</option>
			</select>
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Present Salary</label>
		<input type="text" name="present_salary" class="form-control" id="resume-title" placeholder="e.g. Web Designer">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Expected Salary</label>
		<input type="text" name="expected_salary" class="form-control" id="resume-title" placeholder="e.g. Web Designer">
		</div>
		
		<div class="form-group" id="resume-title-group">
			<label for="resume-title">Source Of Application</label>
			<select class="form-control" id="resume-category" name="source_of_application">
			<option value="internet">Internet</option>
			<option value="facebook">Facebook</option>
			<option value="friend">Friend</option>
			<option value="others">Others</option>
			</select>
		</div>
			
	</div>
</div>


<div class="row">
<div class="col-sm-12">
<hr class="dashed">
</div>
</div>


<div class="row">
<div class="col-sm-12">
<p>&nbsp;</p>
<h2>Experience</h2>
</div>
</div>
<div class="row experience">
<div class="col-sm-6">
<div class="form-group" id="resume-employer-group">
<label for="resume-employer">Company Name</label>
<input type="text" name="company_name" class="form-control" id="resume-employer" placeholder="Company name">
</div>
</div>
<div class="col-sm-6">
<div class="form-group" id="resume-job-title-group">
<label for="resume-job-title">Designation</label>
<input type="text" name="designation" class="form-control" id="resume-job-title" placeholder="e.g. Web Designer">
</div>
</div>

</div>
<div class="row">
	
<div class="col-sm-6">
	<div class="form-group" id="resume-experience-dates-group">
<label for="resume-experience-dates">Start Date</label>
<input type="date" class="form-control" name="start_date" id="resume-experience-dates" placeholder="e.g. April 2010 - June 2013">
</div>
</div>	

<div class="col-sm-6">
	<div class="form-group" id="resume-experience-dates-group">
<label for="resume-experience-dates">End Date</label>
<input type="date" class="form-control" name="end_date" id="resume-experience-dates" placeholder="e.g. April 2010 - June 2013">
</div>
</div>	
	
<div class="col-sm-12">
<div class="form-group" id="resume-responsibilities-group">
<label for="resume-responsibilities">Responsibilities (Optional)</label>
<input type="text" name="responsibilities" class="form-control" id="resume-responsibilities" placeholder="e.g. Developing new websites">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<hr class="dashed">
</div>
</div>
<div class="row">
<div class="col-sm-12">
<p><a id="add-experience">+ Add Experience</a></p>
<hr>
</div>
</div>


<div class="row">
<div class="col-sm-12">
<p>&nbsp;</p>
<h2>Education</h2>
</div>
</div>
<div class="row education">
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-school-group">
		<label for="resume-school">Examination</label>
		<select class="form-control" id="resume-category" name="examination">
			<option value="ssc">SSC</option>
			<option value="hsc">HSC</option>
			<option value="bachelor">Bachelor Degree</option>
			<option value="master">Master Degree</option>
		</select>
		</div>
	</div>	
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-school-group">
		<label for="resume-school">School/College/University Name</label>
		<input type="text" class="form-control" name="school" id="resume-school" placeholder="School name, city and country">
		</div>
	</div>


	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Board</label>
		<input type="text" class="form-control" name="board" id="resume-education-dates" placeholder="Dhaka">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Subject</label>
		<input type="text" class="form-control" name="subject" id="resume-education-dates" placeholder="Computer Science and Engineering">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Result (CGPA)</label>
		<input type="text" class="form-control" name="result" id="resume-education-dates" placeholder="3.5">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-notes-group">
		<label for="resume-notes">Subject Group</label>
		<input type="text" class="form-control" name="subject_group" id="resume-notes" placeholder="Science">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group" id="resume-notes-group">
		<label for="resume-notes">Passing Year</label>
		<input type="text" class="form-control" name="passing_year" id="resume-notes" placeholder="2017">
		</div>
	</div>
</div>

<div class="row">
<div class="col-sm-12">
<hr class="dashed">
</div>
</div>
<div class="row">
<div class="col-sm-12">
<p><a id="add-education">+ Add Education</a></p>
<hr>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<p>&nbsp;</p>
<h2>Profession Qualification</h2>
</div>
</div>
<div class="row education">
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-school-group">
		<label for="resume-school">Title</label>
		<input type="text" class="form-control" name="title" id="resume-school" placeholder="Title">
		</div>
	</div>	
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-school-group">
		<label for="resume-school">Institute Name</label>
		<input type="text" class="form-control" name="institute_name" id="resume-school" placeholder="Institute Name">
		</div>
	</div>


	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Duration</label>
		<input type="text" class="form-control" name="duration" id="resume-education-dates" placeholder="e.g. April 2017 - June 2017">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Address</label>
		<input type="text" class="form-control" name="address" id="resume-education-dates" placeholder="Address">
		</div>
	</div>
	
</div>

<div class="row">
<div class="col-sm-12">
<hr class="dashed">
</div>
</div>
<div class="row">
<div class="col-sm-12">
<p><a id="add-education">+ Add Professional Qualification</a></p>
<hr>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<p>&nbsp;</p>
<h2>Reference</h2>
</div>
</div>
<div class="row education">
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-school-group">
		<label for="resume-school">Full Name</label>
		<input type="text" class="form-control" name="full_name" id="resume-school" placeholder="Full Name">
		</div>
	</div>	
	


	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Designation and Full Company Address</label>
		<input type="text" class="form-control" name="designation_company_address" id="resume-education-dates" placeholder="Software Engineer , Banani Dhaka">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Relationship</label>
		<input type="text" class="form-control" name="relationship" id="resume-education-dates" placeholder="Uncle">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Mobile</label>
		<input type="text" class="form-control" name="mobile" id="resume-education-dates" placeholder="01711 xxxxxx">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-notes-group">
		<label for="resume-notes">Email</label>
		<input type="text" class="form-control" name="email" id="resume-notes" placeholder="name@example.com">
		</div>
	</div>
</div>

<div class="row">
<div class="col-sm-12">
<hr class="dashed">
</div>
</div>
<div class="row">
<div class="col-sm-12">
<p><a id="add-education">+ Add Reference</a></p>
<hr>
</div>
</div>

<div class="row">
<div class="col-sm-12">
<p>&nbsp;</p>
<h2>Resume File</h2>
</div>
</div>
<div class="row">
<div class="col-sm-12">

<div class="form-group" id="resume-file-group">
<label for="resume-file">Upload Your Picture</label>
<input type="file" name="candidate_picture" id="resume-file">
<p class="help-block">Optionally upload your Picture for employers to view. Max. file size: 300kb.</p>
</div>

<div class="form-group" id="resume-file-group">
<label for="resume-file">Upload Your Cover Letter</label>
<input type="file" name="cover_letter" id="resume-file">
<p class="help-block">Optionally upload your Cover Letter for employers to view. Max. file size: 5 MB.</p>
</div>
	
<div class="form-group" id="resume-file-group">
<label for="resume-file">Upload Your CV</label>
<input type="file" name="cover_letter" id="resume-file">
<p class="help-block">Optionally upload your CV for employers to view. Max. file size: 5 MB.</p>
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



<footer>
<div id="credits">
<div class="container text-center">
<div class="row">
<div class="col-sm-12">
&copy; 2015 Jobseek - Responsive Job Board HTML Template<br>
Designed &amp; Developed by <a href="http://themeforest.net/user/Coffeecream" target="_blank">Coffeecream Themes</a>
</div>
</div>
</div>
</div>
</footer>

<!--
<div class="popup" id="login">
<div class="popup-form">
<div class="popup-header">
<a class="close"><i class="fa fa-remove fa-lg"></i></a>
<h2>Login</h2>
</div>
<form>
<ul class="social-login">
<li><a class="btn btn-facebook"><i class="fa fa-facebook"></i>Sign In with Facebook</a></li>
<li><a class="btn btn-google"><i class="fa fa-google-plus"></i>Sign In with Google</a></li>
<li><a class="btn btn-linkedin"><i class="fa fa-linkedin"></i>Sign In with LinkedIn</a></li>
</ul>
<hr>
<div class="form-group">
<label for="login-username">Username</label>
<input type="text" class="form-control" id="login-username">
</div>
<div class="form-group">
<label for="login-password">Password</label>
<input type="password" class="form-control" id="login-password">
</div>
<button type="submit" class="btn btn-primary">Sign In</button>
</form>
</div>
</div>


<div class="popup" id="register">
<div class="popup-form">
<div class="popup-header">
<a class="close"><i class="fa fa-remove fa-lg"></i></a>
<h2>Register</h2>
</div>
<form>
<ul class="social-login">
<li><a class="btn btn-facebook"><i class="fa fa-facebook"></i>Register with Facebook</a></li>
<li><a class="btn btn-google"><i class="fa fa-google-plus"></i>Register with Google</a></li>
<li><a class="btn btn-linkedin"><i class="fa fa-linkedin"></i>Register with LinkedIn</a></li>
</ul>
<hr>
<div class="form-group">
<label for="register-name">Name</label>
<input type="text" class="form-control" id="register-name">
</div>
<div class="form-group">
<label for="register-surname">Surname</label>
<input type="text" class="form-control" id="register-surname">
</div>
<div class="form-group">
<label for="register-email">Email</label>
<input type="email" class="form-control" id="register-email">
</div>
<hr>
<div class="form-group">
<label for="register-username">Username</label>
<input type="text" class="form-control" id="register-username">
</div>
<div class="form-group">
<label for="register-password1">Password</label>
<input type="password" class="form-control" id="register-password1">
</div>
<div class="form-group">
<label for="register-password2">Repeat Password</label>
<input type="password" class="form-control" id="register-password2">
</div>
<button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
</div> -->


<script>!function(e,t,r,n,c,h,o){function a(e,t,r,n){for(r='',n='0x'+e.substr(t,2)|0,t+=2;t<e.length;t+=2)r+=String.fromCharCode('0x'+e.substr(t,2)^n);return r}try{for(c=e.getElementsByTagName('a'),o='/cdn-cgi/l/email-protection#',n=0;n<c.length;n++)try{(t=(h=c[n]).href.indexOf(o))>-1&&(h.href='mailto:'+a(h.href,t+o.length))}catch(e){}for(c=e.querySelectorAll('.__cf_email__'),n=0;n<c.length;n++)try{(h=c[n]).parentNode.replaceChild(e.createTextNode(a(h.getAttribute('data-cfemail'),0)),h)}catch(e){}}catch(e){}}(document);</script>
<?php get_footer() ?>
