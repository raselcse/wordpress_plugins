<?php 
	get_header();
	
	if ( is_user_logged_in() ) {
  
?>

<section id="resume">
	<div class="container">
		<div class="row text-center">
			<div class="col-sm-12">
				<h1>Edit Resume</h1>
				<div class="">
				<?php if(isset($_GET['msg'])){
					 echo $_GET['msg'];
					}
							
				?>
				</div>
			</div>
		</div>

    <?php 
	
	if(isset($basicinfo)){
		foreach( $basicinfo as $info ) {
			$name = $info->name;
			$date_of_birth = $info->date_of_birth;
			$gender = $info->gender;
			$district = $info->district;
			$nationality = $info->nationality;
			$religion = $info->religion;
			$nationalid_or_passport = $info->nationalid_or_passport;
			$phone_no = $info->phone_no;
			$email = $info->email;
			$marital_status = $info->marital_status;
			$present_address = $info->present_address;
			$permanent_address = $info->permanent_address;
			$preferred_level_position = $info->preferred_level_position;
			$available_for = $info->available_for;
			$present_salary = $info->present_salary;
			$expected_salary = $info->expected_salary;
			$source_of_application = $info->source_of_application;
			$career_objective = $info->career_objective;
			$total_experience = $info->total_experience;
			
			
		}
	}
	if(isset($experiences)){
		foreach( $experiences as $experience ) {
			$company_name = $experience->company_name;
			$designation = $experience->designation;
			$responsibility = $experience->responsibility;
			$start_date = $experience->start_date;
			$end_date = $experience->end_date;
			
		}
	}
	
	if(isset($academic_qualifications)){
		foreach( $academic_qualifications as $academic_qualification ) {
			$examination = $academic_qualification->examination;
			$school = $academic_qualification->school;
			$board = $academic_qualification->board;
			$subject = $academic_qualification->subject;
			$result = $academic_qualification->result;
			$subject_group = $academic_qualification->subject_group;
			$passing_year = $academic_qualification->passing_year;
			
		}
	}
	if(isset($professional_qualifications)){
		foreach( $professional_qualifications as $professional_qualification ) {
			$title = $professional_qualification->title;
			$institute_name = $professional_qualification->institute_name;
			$duration = $professional_qualification->duration;
			$address = $professional_qualification->address;
			
		}
	}
	if(isset($references)){
		foreach( $references as $reference ) {
			$full_name = $reference->full_name;
			$designation_company_address = $reference->designation_company_address;
			$relationship = $reference->relationship;
			$mobile = $reference->mobile;
			$emailReference = $reference->email;
			
		}
	}

?>

<form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post" enctype="multipart/form-data"> 
<div class="row">
	<div class="col-sm-6">
		<div class="form-group" id="resume-name-group">
			<label for="resume-name">Applicant Name</label>
			<input type="text" name="name" value ="<?php echo $name; ?>" class="form-control" id="resume-name" placeholder="e.g. John Doe">
			<input type="hidden" name="action" value="update_cv">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Date of Birth</label>
		<input type="date" name="date_of_birth" value ="<?php echo $date_of_birth; ?>" class="form-control" id="resume-title" placeholder="e.g. Date of birth">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Gender</label>
		<select class="form-control" id="resume-category" name="gender">
		<?php 
			$selected0 = ( $gender ==  'male') ? 'selected' : ''; 
			$selected1 = ( $gender ==  'female') ? 'selected' : ''; 
		?>
		
		<option value="male" <?php echo $selected0 ?> >Male</option>
		<option value="female" <?php echo $selected0 ?> >Female</option>
		</select>
		</div>
      
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">District</label>
		<select class="form-control" id="resume-category" name="district">
			<?php 
				$selected0 = ( $gender ==  'dhaka') ? 'selected' : ''; 
				$selected1 = ( $gender ==  'chittagong') ? 'selected' : ''; 
			?>
			
			<option value="dhaka" <?php echo $selected0 ?> >Dhaka</option>
			<option value="chittagong" <?php echo $selected0 ?> >Chittagong</option>
		</select>
		</div>
		
        <div class="form-group" id="resume-title-group">
		<label for="resume-title">Marital Status</label>
		<select class="form-control" id="resume-category" name="marital_status">
		<?php 
				$selected0 = ( $marital_status ==  'unmarried') ? 'selected' : ''; 
				$selected1 = ( $marital_status ==  'married') ? 'selected' : ''; 
			?>
		<option value="unmarried" <?php echo $selected0 ?> >Unmarried</option>
		<option value="married" <?php echo $selected0 ?> >married</option>
		</select>
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Religion</label>
		<select class="form-control" id="resume-category" name="religion">
		<?php 
				$selected0 = ( $religion ==  'islam') ? 'selected' : ''; 
				$selected1 = ( $religion ==  'hindu') ? 'selected' : ''; 
			?>
		<option value="islam" <?php echo $selected0 ?> >Islam</option>
		<option value="hindu" <?php echo $selected0 ?> >Hindu</option>
		</select>
		
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Nationality</label>
		<input type="text" name="nationality"  value ="<?php echo $nationality; ?>" class="form-control" id="resume-title" >
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">National Id or Passport</label>
		<input type="text" name="nationalid_or_passport" value ="<?php echo $nationalid_or_passport; ?>"  class="form-control" id="resume-title" placeholder="e.g. National Id or Passport">
		</div>
        
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Phone No</label>
		<input type="text" name="phone_no" value ="<?php echo $phone_no; ?>" class="form-control" id="resume-title" placeholder="e.g. Phone No">
		</div>


		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Email</label>
		<input type="text" name="email" value ="<?php echo $email; ?>" class="form-control" id="resume-title" placeholder="e.g. support@website.com">
		</div>

	</div>
	
	<div class="col-sm-6">
	
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Present Address</label>
		<input type="text" name="present_address" value ="<?php echo $present_address; ?>" class="form-control" id="resume-title" placeholder="e.g. Persent Address">
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Permanant Address</label>
		<input type="text" name="permanent_address"  value ="<?php echo $permanent_address; ?>"class="form-control" id="resume-title" placeholder="e.g. Permanant Address">
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Career Objective</label>
		<input type="text" name="career_objective"  value ="<?php echo $career_objective; ?>" class="form-control" id="resume-title" placeholder="e.g. Career Objective">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Total Experience (Years)</label>
		<input type="text" name="total_experience" value ="<?php echo $total_experience; ?>" class="form-control" id="resume-title" placeholder="e.g. 4">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Preferred Level Position</label>
		
		<select class="form-control" id="resume-category" name="preferred_level_position">
		    <?php 
				$selected0 = ( $preferred_level_position ==  'entry-level') ? 'selected' : ''; 
				$selected1 = ( $preferred_level_position ==  'mid-level') ? 'selected' : ''; 
				$selected2 = ( $preferred_level_position ==  'expert-level') ? 'selected' : ''; 
			?>
			<option value="entry-level" <?php echo $selected0 ?> >Entry Level</option>
			<option value="mid-level" <?php echo $selected1 ?> >Mid Level</option>
			<option value="expert-level" <?php echo $selected2 ?> >Expert Level</option>
		</select>
		</div>
		
		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Available For</label>
			<select class="form-control" id="resume-category" name="available_for">
			 <?php 
				$selected0 = ( $gender ==  'full-time') ? 'selected' : ''; 
				$selected1 = ( $gender ==  'part-time') ? 'selected' : ''; 
			?>
			<option value="full-time" <?php echo $selected0 ?>>Full Time</option>
			<option value="part-time" <?php echo $selected1 ?>>Part Time</option>
			</select>
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Present Salary (Tk)</label>
		<input type="text" name="present_salary" value ="<?php echo $present_salary; ?>" class="form-control" id="resume-title" placeholder="e.g. 20000">
		</div>

		<div class="form-group" id="resume-title-group">
		<label for="resume-title">Expected Salary (Tk)</label>
		<input type="text" name="expected_salary" value ="<?php echo $expected_salary; ?>" class="form-control" id="resume-title" placeholder="e.g. 30000">
		</div>
		
		<div class="form-group" id="resume-title-group">
			<label for="resume-title">Source Of Application</label>
			<select class="form-control" id="resume-category" name="source_of_application">
				<?php 
					$selected0 = ( $source_of_application ==  'internet') ? 'selected' : ''; 
					$selected1 = ( $source_of_application ==  'facebook') ? 'selected' : ''; 
					$selected2 = ( $source_of_application ==  'friend') ? 'selected' : ''; 
					$selected3 = ( $source_of_application ==  'others') ? 'selected' : ''; 
				?>
			<option value="internet" <?php echo $selected0 ?>>Internet</option>
			<option value="facebook" <?php echo $selected1 ?>>Facebook</option>
			<option value="friend" <?php echo $selected2 ?>>Friend</option>
			<option value="others" <?php echo $selected3 ?>>Others</option>
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
		<input type="text" name="company_name" value ="<?php echo $company_name; ?>" class="form-control" id="resume-employer" placeholder="Company name">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group" id="resume-job-title-group">
		<label for="resume-job-title">Designation</label>
		<input type="text" name="designation" value ="<?php echo $designation; ?>" class="form-control" id="resume-job-title" placeholder="e.g. Web Designer">
		</div>
	</div>

</div>
<div class="row">
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-experience-dates-group">
			<label for="resume-experience-dates">Start Date</label>
			<input type="date" class="form-control" name="start_date" value ="<?php echo $start_date; ?>" id="resume-experience-dates">
		</div>
	</div>	

	<div class="col-sm-6">
		<div class="form-group" id="resume-experience-dates-group">
		<label for="resume-experience-dates">End Date</label>
		<input type="date" class="form-control" name="end_date" value ="<?php echo $end_date; ?>" id="resume-experience-dates" placeholder="e.g. April 2010 - June 2013">
		</div>
	</div>	
		
	<div class="col-sm-12">
		<div class="form-group" id="resume-responsibilities-group">
		<label for="resume-responsibilities">Responsibilities (Optional)</label>
		<input type="text" name="responsibilities" value ="<?php echo $responsibility; ?>" class="form-control" id="resume-responsibilities" placeholder="e.g. Responsibilities">
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
				<?php 
					$selected0 = ( $source_of_application ==  'ssc') ? 'selected' : ''; 
					$selected1 = ( $source_of_application ==  'hsc') ? 'selected' : ''; 
					$selected2 = ( $source_of_application ==  'bachelor') ? 'selected' : ''; 
					$selected3 = ( $source_of_application ==  'master') ? 'selected' : ''; 
				?>
				<option value="ssc" <?php echo $selected0 ?>>SSC</option>
				<option value="hsc" <?php echo $selected1 ?>>HSC</option>
				<option value="bachelor" <?php echo $selected2 ?>>Bachelor Degree</option>
				<option value="master" <?php echo $selected3 ?>>Master Degree</option>
			</select>
		</div>
	</div>	
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-school-group">
		<label for="resume-school">School/College/University Name</label>
		<input type="text" class="form-control" name="school" value ="<?php echo $school; ?>"  id="resume-school" placeholder="School name, city and country">
		</div>
	</div>


	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Board</label>
		
		<select class="form-control" id="resume-category" name="board">
				<?php 
					$selected0 = ( $board ==  'dhaka') ? 'selected' : ''; 
					$selected1 = ( $board ==  'chittagong') ? 'selected' : ''; 
					$selected2 = ( $board ==  'rajshahi') ? 'selected' : ''; 
					$selected3 = ( $board ==  'sylhet') ? 'selected' : ''; 
				?>
				<option value="dhaka" <?php echo $selected0 ?>>Dhaka</option>
				<option value="chittagong" <?php echo $selected1 ?>>Chittagong</option>
				<option value="rajshahi" <?php echo $selected2 ?>>Rajshahi</option>
				<option value="sylhet" <?php echo $selected3 ?>>Sylhet</option>
		</select>
		
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Subject</label>
		<input type="text" class="form-control" name="subject" value ="<?php echo $subject; ?>" id="resume-education-dates" placeholder="e.g. CSE">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Result</label>
		<input type="text" class="form-control" name="result" value ="<?php echo $result; ?>" id="resume-education-dates" placeholder="e.g. 3.4">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-notes-group">
		<label for="resume-notes">Group</label>
		<input type="text" class="form-control" name="subject_group" value ="<?php echo $subject_group; ?>" id="resume-notes" placeholder="Science">
		</div>
	</div>
	<div class="col-sm-6">
		<div class="form-group" id="resume-notes-group">
		<label for="resume-notes">Passing Year</label>
		<input type="text" class="form-control" name="passing_year" value ="<?php echo $passing_year; ?>" id="resume-notes" placeholder="2007">
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
		<input type="text" class="form-control" name= "title" value ="<?php echo $title; ?>" id="resume-school" placeholder="Basic Security">
		</div>
	</div>	
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-school-group">
		<label for="resume-school">Institute Name</label>
		<input type="text" class="form-control" name="institute_name" value ="<?php echo $institute_name; ?>" id="resume-school" placeholder="Web Craft">
		</div>
	</div>


	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Duration (Month)</label>
		<input type="text" class="form-control" name="duration" value ="<?php echo $duration; ?>" id="resume-education-dates" placeholder="e.g. 6">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Address</label>
		<input type="text" class="form-control" name="address" value ="<?php echo $address; ?>" id="resume-education-dates" placeholder="e.g. Mohakhali, Dhaka">
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
		<input type="text" class="form-control" name="full_name" value ="<?php echo $full_name; ?>" id="resume-school" placeholder="Full Name">
		</div>
	</div>	


	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Designation and Full Company Address</label>
		<input type="text" class="form-control" name="designation_company_address" value ="<?php echo $designation_company_address; ?>" id="resume-education-dates" placeholder="e.g. Head of Dept, SUST, Sylhet">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Relationship</label>
		<input type="text" class="form-control" name="relationship" value ="<?php echo $relationship; ?>" id="resume-education-dates" placeholder="e.g. Teacher">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-education-dates-group">
		<label for="resume-education-dates">Mobile</label>
		<input type="text" class="form-control" name="mobile" value ="<?php echo $mobile; ?>" id="resume-education-dates" placeholder="e.g. 01711 xxxxxx">
		</div>
	</div>
	
	<div class="col-sm-6">
		<div class="form-group" id="resume-notes-group">
		<label for="resume-notes">Email</label>
		<input type="text" class="form-control" name="email-reference" value ="<?php echo $emailReference; ?>" id="resume-notes" placeholder="Email">
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
	<input type="file" name="candidate_picture"  id="resume-file">
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
<input type="submit" class="btn btn-primary btn-lg" value="Update">
</div>
</div>
</form>

</div>
</section>
<?php 
 }
 
    else
	{   echo "<div class='page'>";
        echo "If you have no Account, please Register first. To Register <a href='http://localhost/solar/registration/'>Click here</a>";
		echo "Please Login First. To login";
		?>
		<a href="http://localhost/solar/login/">Click here</a>
	    </div>
		<?php
	}
	
?>	






<script>!function(e,t,r,n,c,h,o){function a(e,t,r,n){for(r='',n='0x'+e.substr(t,2)|0,t+=2;t<e.length;t+=2)r+=String.fromCharCode('0x'+e.substr(t,2)^n);return r}try{for(c=e.getElementsByTagName('a'),o='/cdn-cgi/l/email-protection#',n=0;n<c.length;n++)try{(t=(h=c[n]).href.indexOf(o))>-1&&(h.href='mailto:'+a(h.href,t+o.length))}catch(e){}for(c=e.querySelectorAll('.__cf_email__'),n=0;n<c.length;n++)try{(h=c[n]).parentNode.replaceChild(e.createTextNode(a(h.getAttribute('data-cfemail'),0)),h)}catch(e){}}catch(e){}}(document);</script>
<?php get_footer() ?>
