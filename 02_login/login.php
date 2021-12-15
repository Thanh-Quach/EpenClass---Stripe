<div id='login-page' class='h-75 row align-items-center justify-content-center mx-0 p-0 mb-4 mt-5'>
<div class="drop-shadow mt-5 row align justify-content-center col-lg-6 col-11 h-75 rounded bg-light" id="container">
	<div class="col-lg-6 col-md-6 row align-items-center justify-content-center">
		<form id='loginForm' method="post" action="./04_RestAPI/parseAccount.php" style="background-color: rgba(0,0,0,0)" >
			<h1 class="mb-5 text-center forgot-pass">Welcome Back!</h1>
			<h5 class="mb-3 prime-font text-center d-none forgot-pass">We will send you a recovery email</h5>

			<input type="accountId" name="accountId" class="form-control my-2" placeholder="Login ID" />
			<input type="password" name="password" class="form-control my-2 forgot-pass" placeholder="Password" />
			<div class="col-12 d-flex flex-column">
			<a href="#" class="f-10pt mx-2 forgot-pass" onclick="retrievePass()">Forgot my password</a>
			<a href="#" class="f-10pt mx-2 d-none forgot-pass" onclick="login()">Back to Login</a>

				<!-- <a href="#" class="py-2">Forgot your password?</a> -->
				<button class="btn btn-outline-dark my-2 mt-4 mx-auto forgot-pass" onclick="showPreloader()" style="width: 150px;">Sign In</button>
				<button class="btn btn-outline-dark my-2 mt-4 mx-auto d-none forgot-pass" onclick="showPreloader()" style="width: 150px;">Confirm</button>
				<a class="prime-font text-center link-dark forgot-pass" href="./index.php?page=home">or Sign up now</a>
			</div>
		</form>
	</div>
</div>
</div>
<script>
	function retrievePass() {
		for (var i = 0; i < document.querySelectorAll(".forgot-pass").length; i++) {
			document.querySelectorAll(".forgot-pass")[i].classList.toggle('d-none');
		}
		document.getElementById("loginForm").action = './04_RestAPI/forgetPassword.php';
	};
	function login() {
		for (var i = 0; i < document.querySelectorAll(".forgot-pass").length; i++) {
			document.querySelectorAll(".forgot-pass")[i].classList.toggle('d-none');
		}
		document.getElementById("loginForm").action = './04_RestAPI/parseAccount.php';
	};
</script>