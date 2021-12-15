<div class="cardInput justify-content-center align-items-center">
	<div id="paymentForm" class="h-50 bg-304d73 drop-shadow position-relative text-center" style="width: 480px;">
		<b><span class="close text-304d73 position-absolute w-auto" onclick="document.querySelector('.cardInput').style.display = 'none';">&times;</span></b>
		<div class="d-flex justify-content-center align-items-center bg-light h-50 pt-3 text-304d73">    
	        <h1>Epen</h1>
	        <p id="package-select"></p>
    	</div>
		<form id="frmStripePayment" method="post" action="./10_stripe/paymentProcess.php" class="h-25 mx-auto w-75 mt-4">
		    <div class="row w-100 m-0">
		            <input type="text" id="cardHolderName" class="form-control text-dark border-bottom-0 rounded-0" name="cardHolderName" placeholder="Card Holder Name">
		    </div>
		    <div class="row w-100 m-0">
		            <input type="text" id="card-number" class="form-control text-dark border-bottom-0 rounded-0" name="card-number" maxlength="16" placeholder="Card Number">
		    </div>
		    <div class="row w-100 m-0">
		        <div class="d-flex w-100 p-0">
		            <input name="month" id="month" class="form-control text-dark rounded-0 border-right-0" placeholder="MM" maxlength="2" pattern="[0-1]+[1-2]">
		            <input name="year" id="year" class="form-control text-dark rounded-0" placeholder="YY" maxlength="2" pattern="[0-9]{2}">
		            <input type="text" name="CVC" class="form-control text-dark rounded-0 border-left-0" id="cvc" placeholder="cvc" maxlength="3" pattern="[0-9]{3}">
		        </div>
		    </div>
		    <input class="email" type="hidden" name="email" value="">

		</form>
	    <button class="btn bg-light my-4 text-304d73" onclick="stripePay(event);showPreloader();"><h1 class="f-12pt m-0">Submit</h1></button>
	</div>
</div>

<div id="loginReq" class="d-none w-100 h-100 justify-content-center align-items-center position-fixed" style="	background-color: rgba(0,0,0,0.6);">
	<div class="h-25 bg-304d73 d-flex flex-column justify-content-center rounded shadow" style="width: 480px;">
		<h3 class="text-center text-white prime-font my-4">Plese Login First</h3>
		<div class="d-flex w-75 mx-auto">
			<a class="w-50 mx-2" href="?page=login"><button class="btn btn-light prime-font w-100">Ok</button></a>
			<button class="btn btn-light prime-font w-50 mx-2 text-danger" onclick=" document.getElementById('loginReq').classList.add('d-none'); document.getElementById('loginReq').classList.remove('d-flex');">Cancel</button>
		</div>
	</div>
</div>

<script>
if (localStorage.getItem('usrDta') !== null) {
	var usrDta = JSON.parse(localStorage.getItem('usrDta')).Data;

	document.querySelectorAll('.email').value = usrDta.DetailUserInfo.Email || usrDta.DetailUserInfo.ParentInfo.Email;
}
</script>
