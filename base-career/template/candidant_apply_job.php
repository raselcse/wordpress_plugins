
<?php get_header() ?>


<header>
<div id="header-background"></div>
<div class="container">
<div class="pull-left">
<div id="logo"><a href="index.html"><img src="images/logo.png" alt="Jobseek - Job Board Responsive HTML Template"/></a></div>
</div>
<div id="menu-open" class="pull-right">
<a class="fm-button"><i class="fa fa-bars fa-lg"></i></a>
</div>
<div id="searchbox" class="pull-right">
<form>
<div class="form-group">
<label class="sr-only" for="searchfield">Searchbox</label>
<input type="text" class="form-control" id="searchfield" placeholder="Type keywords and press enter">
</div>
</form>
</div>
<div id="search" class="pull-right">
<a><i class="fa fa-search fa-lg"></i></a>
</div>
</div>
</header>


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
<p><a href="#" class="btn btn-primary">Sign In</a></p>
</div>
</div>
</div>
<form>

<div class="row">
<div class="col-sm-6">
<h2>Resume details</h2>
</div>

</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group" id="resume-name-group">
<label for="resume-name">Name</label>
<input type="text" class="form-control" id="resume-name" placeholder="e.g. John Doe">
</div>
</div>
<div class="col-sm-6">
<div class="form-group" id="resume-photo-group">
<label for="resume-photo">Photo (Optional)</label>
<input type="file" id="resume-photo">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group" id="resume-title-group">
<label for="resume-title">Title</label>
<input type="text" class="form-control" id="resume-title" placeholder="e.g. Web Designer">
</div>
</div>
<div class="col-sm-6">
<div class="form-group" id="resume-video-group">
<label for="resume-video">Video (Optional)</label>
<input type="text" class="form-control" id="resume-video" placeholder="Video URL">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group" id="resume-email-group">
<label for="resume-email">Email</label>
<input type="email" class="form-control" id="resume-email" placeholder="you@yourdomain.com">
</div>
</div>
<div class="col-sm-6">
<div class="form-group" id="resume-category-group">
<label for="resume-category">Job Category</label>
<select class="form-control" id="resume-category">
<option>Choose a category</option>
<option>Internet Services</option>
<option>Banking</option>
<option>Financial</option>
<option>Marketing</option>
<option>Management</option>
</select>
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group" id="resume-location-group">
<label for="resume-location">Location</label>
<input type="text" class="form-control" id="resume-location" placeholder="e.g. New York City">
</div>
</div>
<div class="col-sm-6">
<div class="form-group" id="resume-skills-group">
<label for="resume-skills">Skills</label>
<input type="text" class="form-control" id="resume-skills" placeholder="e.g. Photoshop, HTML, CSS">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="form-group" id="resume-content-group">
<label>Resume Content</label>
<label for="resume-content">Resume Content</label>
<div class="textarea form-control" id="resume-content"></div>
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
<label for="resume-employer">Employer</label>
<input type="text" class="form-control" id="resume-employer" placeholder="Company name">
</div>
</div>
<div class="col-sm-6">
<div class="form-group" id="resume-experience-dates-group">
<label for="resume-experience-dates">Start/End Date</label>
<input type="text" class="form-control" id="resume-experience-dates" placeholder="e.g. April 2010 - June 2013">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group" id="resume-job-title-group">
<label for="resume-job-title">Job Title</label>
<input type="text" class="form-control" id="resume-job-title" placeholder="e.g. Web Designer">
</div>
</div>
<div class="col-sm-6">
<div class="form-group" id="resume-responsibilities-group">
<label for="resume-responsibilities">Responsibilities (Optional)</label>
<input type="text" class="form-control" id="resume-responsibilities" placeholder="e.g. Developing new websites">
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
<label for="resume-school">School Name</label>
<input type="text" class="form-control" id="resume-school" placeholder="School name, city and country">
</div>
</div>
<div class="col-sm-6">
<div class="form-group" id="resume-education-dates-group">
<label for="resume-education-dates">Start/End Date</label>
<input type="text" class="form-control" id="resume-education-dates" placeholder="e.g. April 2010 - June 2013">
</div>
</div>
</div>
<div class="row">
<div class="col-sm-6">
<div class="form-group" id="resume-qualifications-group">
<label for="resume-qualifications">Qualifications</label>
<input type="text" class="form-control" id="resume-qualifications" placeholder="e.g. Master Engineer">
</div>
</div>
<div class="col-sm-6">
<div class="form-group" id="resume-notes-group">
<label for="resume-notes">Notes (Optional)</label>
<input type="text" class="form-control" id="resume-notes" placeholder="Any achievements">
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
<h2>Resume File</h2>
</div>
</div>
<div class="row">
<div class="col-sm-12">
<div class="form-group" id="resume-file-group">
<label for="resume-file">Upload Your Resume (Optional)</label>
<input type="file" id="resume-file">
<p class="help-block">Optionally upload your resume for employers to view. Max. file size: 64 MB.</p>
</div>
</div>
</div>

<div class="row text-center">
<div class="col-sm-12">
<p>&nbsp;</p>
<input type="submit" class="btn btn-primary btn-lg"> Submit <i class="fa fa-arrow-right"></i>
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
</div>


<script>!function(e,t,r,n,c,h,o){function a(e,t,r,n){for(r='',n='0x'+e.substr(t,2)|0,t+=2;t<e.length;t+=2)r+=String.fromCharCode('0x'+e.substr(t,2)^n);return r}try{for(c=e.getElementsByTagName('a'),o='/cdn-cgi/l/email-protection#',n=0;n<c.length;n++)try{(t=(h=c[n]).href.indexOf(o))>-1&&(h.href='mailto:'+a(h.href,t+o.length))}catch(e){}for(c=e.querySelectorAll('.__cf_email__'),n=0;n<c.length;n++)try{(h=c[n]).parentNode.replaceChild(e.createTextNode(a(h.getAttribute('data-cfemail'),0)),h)}catch(e){}}catch(e){}}(document);</script>
<?php get_footer() ?>
