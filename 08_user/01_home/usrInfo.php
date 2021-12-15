<div class="col-lg-10 col-md-8 m-0 h-100 row align-items-center">
	<form id='UsrInfo' class="row col-lg-6 col-md-12 justify-content-center align-items-center h-50 mx-auto" method="post" action="./04_RestAPI/updateUserInfo.php" onsubmit="changePw()">

		<div class="d-flex align-items-center justify-content-center text-white"><p class="pe-2">Login ID:</p><h2 id="userId" class="prime-font">User ID</h2></div>
		<div id="referalId" class="d-flex align-items-center justify-content-center text-white"></div>
		<input id='domain' name='domain' type='hidden' value=''>
		<div id="appendInfo">
			<input id='operatorId' name='operatorId' type='hidden' value=''>
				<input id='classId' name='classId' type='hidden' value=''>
				<input id='Id' name='Id' type='hidden' value=''>
				<input id='email-dis' name='email' type='hidden' value=''>
				<input id='submitTkn' name='currUsrTkn' type='hidden' value=''>

		</div>
		<div class="row m-0 p-0 my-2">
			<input id="fn" class="form-control col m-2" type="text" name="fn" value="" pattern="^[A-Za-z]+$" title="No space allow, Text only" placeholder="First Name" disabled>
			<input id="ln" class="form-control col m-2" type="text" name="ln" value="" pattern="^[A-Za-z]+$" title="No space allow, Text only" placeholder="Last Name" disabled>
		</div>
		<div class="row m-0 p-0 my-2">
			<select id="gender" name="gender" class="col btn btn-light dropdown-toggle m-2" required>
			    <option value="Male">Male</option>
			    <option value="Female">Female</option>
			</select>
			<input id="phone" class="col form-control m-2" type="text" pattern="^[0-9]+$" name="phone" title="No space allow, Number Only" value="" placeholder="Phone Number">

			<div class="d-flex text-white"><p>Status:</p><p id="accStat" class="text-danger ps-2">Disable</p></div>
			<div class="d-flex text-white"><p>Method:</p><p id="accMeth" class="text-danger px-2">Free</p><a id="upgrade-btn" class="ps-5" href="./index.php?page=pricing">Upgrade Now</a></div>
			<div class="d-flex text-white my-2"><p>Registered Email:</p><p class="text-white ps-2 email"></p></div>

		</div>
		<a href="#" class='px-2 py-3 m-1 text-white bg-secondary d-flex justify-content-between align-items-center' onclick="hidePW()">Change Password <i class="fa fa-chevron-right"></i></a>
		<div id="pw-change" class="row m-0 p-0 my-2 d-none animate__animated animate__faster">
			<input id="currPW" class="form-control col m-2" type="password" name="currPW" value="" placeholder="Current Password">
			<input id="newPW" class="form-control col m-2" type="password" name="newPW" value="" placeholder="New Password">
			<input id="ConfirmPassword" class="form-control col m-2" type="password" value="" placeholder="re-type password">
			<p id="validate" class="text-danger"></p>
		</div>
		<div class="d-flex m-2 justify-content-around">
		<button class="btn btn-outline-light prime-font" style="width: 200px;">Save and Update</button>
		<button class="btn btn-danger prime-font" style="width: 200px;" disabled>Delete Account</button>
		</div>
	</form>
</div>
<script>
	var usrDta = JSON.parse(localStorage.getItem('usrDta')).Data;
	var currUsrTkn = localStorage.getItem('currUsrTkn');

	document.getElementById('userId').innerHTML = usrDta.SSOAccountId;
	if (usrDta.Role == 'TEACHER') {

		var p = document.createElement('p');
		var a = document.createElement('a');
		var div = document.createElement('div');
		
		div.appendChild(document.createTextNode('Click to Copy'));
		div.classList.add('tooltip-text');

		p.classList.add('tooltip-cus')
		p.appendChild(document.createTextNode('Referal Code: '));
      	a.appendChild(document.createTextNode(usrDta.DetailUserInfo.Classes[0]._id));
      	a.classList.add('ps-2', 'pointer', 'link-cus');
      	p.onclick = function (){
      		navigator.clipboard.writeText(a.innerHTML);
      		div.innerHTML = 'Copied';
      		setTimeout(function(){ div.innerHTML = 'Click to Copy'; }, 1500);
      	}
      	document.getElementById('referalId').appendChild(p).appendChild(a);
      	document.getElementById('referalId').appendChild(p).appendChild(div);
      	document.getElementById('domain').value = 'classadmin';
      	for (var i = 0; i < document.querySelectorAll(".email").length; i++) {
			document.querySelectorAll(".email")[i].innerHTML = usrDta.DetailUserInfo.Email;
		};
	}else{
		document.getElementById('domain').value = 'testprepadmin';
		for (var i = 0; i < document.querySelectorAll(".email").length; i++) {
			document.querySelectorAll(".email")[i].innerHTML = usrDta.DetailUserInfo.ParentInfo.Email;
		};

	};
	

	document.getElementById('fn').value = usrDta.DetailUserInfo.FirstName;
	document.getElementById('ln').value = usrDta.DetailUserInfo.LastName;
	document.getElementById('gender').value = usrDta.DetailUserInfo.Gender;
	if (usrDta.DetailUserInfo.PhoneNumber !== '000000000') {
		document.getElementById('phone').value = usrDta.DetailUserInfo.PhoneNumber || usrDta.DetailUserInfo.ParentInfo.PhoneNumber;
	}else{
		document.getElementById('phone').value ='';
	}
	if (usrDta.DetailUserInfo.IsActive == true) {
		document.getElementById('accStat').innerHTML = 'Enable';
		document.getElementById('accStat').classList.remove('text-danger');
		document.getElementById('accStat').classList.add('text-success');
	}
	//add 1 more condition to differentiate trial and paid
	if (usrDta.CanUpload == true) {	
		document.getElementById('accMeth').innerHTML = 'Premium';
		document.getElementById('accMeth').classList.remove('text-danger');
		document.getElementById('accMeth').classList.add('text-success');
		document.getElementById('upgrade-btn').style.display = 'none';
	}

	function changePw(){
		if (document.getElementById('newPW').value == document.getElementById('ConfirmPassword').value) {
			document.getElementById('operatorId').value = usrDta.OperatorId;
			document.getElementById('classId').value = usrDta.DetailUserInfo.Classes[0]._id;
			document.getElementById('Id').value = usrDta._id;
			document.getElementById('email-dis').value = usrDta.DetailUserInfo.Email || usrDta.DetailUserInfo.ParentInfo.Email;
			document.getElementById('submitTkn').value = currUsrTkn;
			// document.getElementById('UsrInfo').submit();
		}else{
			document.getElementById('validate').innerHTML = 'Password does not match!';
		}

	}

	function hidePW() {
		document.getElementById('pw-change').classList.toggle('animate__fadeInDown');
		document.getElementById('pw-change').classList.toggle('d-none');
		document.querySelector('.fa-chevron-right').classList.toggle('rotate-90');
	}
</script>