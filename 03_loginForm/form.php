<div id='Student-Form' class='row align-items-center justify-content-center m-0 p-0 shadow-overlay'>
<div class="container position-relative row justify-content-center bg-304d73 h-50 drop-shadow p-0" style="width: 480px;">
<span class="close text-light position-absolute" onclick="getElementById('Student-Form').style.display = 'none';">&times;</span>
	<div class="row justify-content-center align-items-center p-3 h-100">
		<form method="post" action="./04_RestAPI/NewUser.php" class="col-lg-11 col-md-12 h-75 row align-items-center">
			<h1 class="text-center text-white">Create Account</h1>
			<div class="d-flex flex-column">
				<input name="role" type="hidden" value="adminReq" />
				<input name="domain" type="hidden" value="testprepadmin" />
				<div class="d-flex">
					<input type="text" placeholder="First Name" name="fn" class="form-control my-1 me-1 border-0" pattern="[A-Za-z]+" required/>
					<input type="text" placeholder="Last Name" name="ln" class="form-control my-1 ms-1 border-0" pattern="[A-Za-z]+" required/>
				</div>
				<select name="gender" class="col-6 my-1 me-1 btn btn-light dropdown-toggle">
					<option disabled selected hidden>Gender</option>
				    <option value="Male">Male</option>
				    <option value="Female">Female</option>
				</select>

			<input type="hidden" name="grade" value="13" />
			<input type="email" placeholder="Email" name="email" class="form-control my-1 border-0" required/>
			<input type="password" placeholder="Password" name="password" class="form-control my-1 border-0" required />
				<div class="d-flex align-items-center justify-content-center">
					<input type="checkbox" class="me-2 border-0" style="transform: scale(1.2);" required>
					<p class="text-white py-2">I agree to the <a href="#" class="text-light"><u>terms and conditions</u></a></p>
				</div>
			</div>
			<button class="mt-4 btn btn-outline-light mx-auto prime-font" onclick="showPreloader()" style="width: 150px;">Sign Up</button>
		</form>
	</div>
</div>
</div>


<div id='Teacher-Form' class='row align-items-center justify-content-center m-0 p-0 shadow-overlay'>
<div class="container position-relative row justify-content-center bg-304d73 drop-shadow p-0" style="width: 480px;">
<span class="close text-light position-absolute" onclick="getElementById('Teacher-Form').style.display = 'none';">&times;</span>
	<div class="row justify-content-center align-items-center py-5 h-100">
		<form method="post" action="./04_RestAPI/NewUser.php" class="col-lg-11 col-md-12 row align-items-center">
			<h1 class="text-center text-white">Create Account</h1>
			<input name="domain" type="hidden" value="classadmin" />
			<div class="d-flex flex-column">
				<div class="row align-items-center w-50 my-2 mx-0">
				<label class="col-4 seccond-font p-0">I am a</label>
				  <select id="roleOption" name="role" class="col my-1 btn btn-light dropdown-toggle">
				    <option value="adminReq">Teacher</option>
				    <option value="Student">Student</option>
				  </select>
				</div>
				<div class="d-flex">
					<input type="text" placeholder="First Name*" name="fn" class="form-control my-1 me-1 border-0" pattern="[A-Za-z]+" required />
					<input type="text" placeholder="Last Name*" name="ln" class="form-control my-1 ms-1 border-0" pattern="[A-Za-z]+" required/>
				</div>
				<select name="gender" class="col-6 my-1 btn btn-light dropdown-toggle">
					<option disabled selected hidden>Gender</option>
				    <option value="Male">Male</option>
				    <option value="Female">Female</option>
				</select>
		        <select name="grade" class="col my-1 btn btn-light dropdown-toggle student-info" style="display: none;">
					<option disabled selected hidden>Grade</option>
				  	<?php for ($i=1; $i < 13; $i++) { 
				  		echo "<option value='".$i."'>".$i."</option>";
				  	};  ?>
				</select>
		        <input type="classId" name='classId' placeholder="Referal ID*" class="form-control my-1 border-0 student-info" style="display: none;"/>
				<input name="email" placeholder="Email*" class="form-control my-1 border-0" required />
				<input type="password" name="password" placeholder="Password*" class="form-control my-1 border-0" />
				
				<div class="d-flex align-items-center justify-content-center">
					<input type="checkbox" required class="me-2 border-0" style="transform: scale(1.2);">
					<p class="text-white py-2">I agree to the <a href="#" class="text-light"><u>terms and conditions</u></a></p>
				</div>
			</div>
			<button class="mt-4 btn btn-outline-light mx-auto prime-font" onclick="showPreloader()" style="width: 150px;">Sign Up</button>
		</form>
	</div>
</div>
</div>

<script>

$("#roleOption").change(function(){
  $(".student-info").hide();
  $(".student-info").removeAttr("required");
  if($(this).val() == "Student"){
    $(".student-info").show();
  	$(".student-info").attr("required", true);
  }
});

</script>