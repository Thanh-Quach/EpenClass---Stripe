<?php
include 'pricingAth.php';

?>

<div class="" style="height: 18%;"></div>
	<div id="price-btn" class="w-100 justify-content-center align-items-center">
		<button id="student-btn" type="button" class="btn btn-304d73 mx-1" onclick="showStudentPrice()"><p>Student</p></button>
		<button id="teacher-btn" type="button" class="btn btn-outline-304d73 mx-1" onclick="showTeacherPrice()"><p>Teacher</p></button>
	</div>
<div id="price-chart-teacher" class="row mx-auto my-5 justify-content-center" style="width: 910px; display:none; ">
	<?php include'./06_pricing/teachers/features-list.php';?>
	<?php include'./06_pricing/teachers/basics-plan.php';?>
	<?php include'./06_pricing/teachers/paid.php';?>
	<?php include'./06_pricing/teachers/schools.php';?>
</div>
<div id="price-chart-student" class="row mx-auto my-5 justify-content-center" style="width: 780px;">
	<?php include'./06_pricing/students/features-list.php';?>
	<?php include'./06_pricing/students/basics-plan.php';?>
	<?php include'./06_pricing/students/paid.php';?>
</div>

<script>
if (localStorage.getItem('usrDta') !== null) {
	var usrDta = JSON.parse(localStorage.getItem('usrDta')).Data;
	var currOprPaymnt = localStorage.getItem('currOprPaymnt');

	if (usrDta !== null) {
		document.getElementById('price-btn').style.display = 'none';
	    if (usrDta.Role[0] == 'STUDENT') {
	    	document.getElementById('price-chart-student').style.display = 'flex';
	    	document.getElementById('price-chart-teacher').style.display = 'none';
	    	var link = 'https://testprep.epenbuk.com/api/Operator/DetailPaymentAccount';
		}else{
			document.getElementById('price-chart-teacher').style.display = 'flex';
	    	document.getElementById('price-chart-student').style.display = 'none';
	    	var link = 'https://classadmin.epenbuk.com/api/Operator/DetailPaymentAccount';
		}
	}
	if (currOprPaymnt !== "" && JSON.parse(currOprPaymnt).Data._id !== null && JSON.parse(currOprPaymnt).Data.ExpYear !== 0) {
		var currOprPaymnt = JSON.parse(localStorage.getItem('currOprPaymnt')).Data;
		var button = document.querySelectorAll('.' + currOprPaymnt.Name + 'ly');
		for ( i = 0, len = button.length; i<len; i++){
		    button[i].disabled = true;
		}
	}
	}else{
		document.getElementById('price-btn').classList.add('d-flex');
	};
</script>