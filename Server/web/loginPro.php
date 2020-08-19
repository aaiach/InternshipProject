<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>User Login</title>
		<!-- CSS FILES -->
		<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
	</head>
	<body class="uk-flex uk-flex-center uk-flex-middle uk-background-muted uk-height-viewport" data-uk-height-viewport>
		<div class="uk-width-large uk-padding-small">

			<!-- register -->
			<div id = "registerContainer">
				<form id = "registerform" method = "post">
					<div class="uk-text-center">Register as a Professional</div><br>
					<div class="alert uk-text-center uk-text-danger"></div><br>
					<fieldset class="uk-fieldset">
						<div class="uk-margin-small">
							<div class="uk-inline uk-width-1-1">
								<input name = "registername" id = "registername" class="uk-input" required placeholder="Name" type="text">
							</div>
						</div>
						<div class="uk-margin-small">
							<div class="uk-inline uk-width-1-1">
								<input name = "registeremail" id = "registeremail" class="uk-input" required placeholder="E-mail" type="text">
							</div>
						</div>
						<div class="uk-margin-small">
							<div class="uk-inline uk-width-1-1">
								<select placeholder = "Profession" name="profession" id = "profession" class="uk-select">
							        <option value="" disabled selected>Select your Profession</option>
							    </select>
							</div>
						</div>
						<div class="uk-margin-small">
							<div class="uk-inline uk-width-1-1">
								<input name = "registerpassword" id = "registerpassword" class="uk-input " required placeholder="Password" minlength="8" type="password">
							</div>
						</div>
						<div class="uk-margin-small">
							<div class="uk-inline uk-width-1-1">
								<input name = "passwordconfirm" id = "passwordconfirm" class="uk-input" required placeholder="Password Confirmation" type="password">
							</div>
						</div>
						<br>
						<div class="uk-margin-bottom">
							<button type="submit" class="uk-button uk-button-primary  uk-width-1-1">Register</button>
						</div>
					</fieldset>
				</form>
			</div>

			<!-- login -->
			<div id = "loginContainer">
				<form id = "loginform" method = "post">
					<div class="uk-text-center">Professional Login</div><br>
					<div class="alert uk-text-center uk-text-danger"></div><br>
					<fieldset class="uk-fieldset">
						<div class="uk-margin-small">
							<div class="uk-inline uk-width-1-1">
								<input name = "loginemail" id = "loginemail" class="uk-input " required placeholder="E-mail" type="text">
							</div>
						</div>
						<div class="uk-margin-small">
							<div class="uk-inline uk-width-1-1">
								<input id = "loginpassword" class="uk-input " required placeholder="Password" type="password">
							</div>
						</div>
						<br>
						<div class="uk-margin-bottom">
							<button type="submit" class="uk-button uk-button-primary  uk-width-1-1">LOG IN</button>
						</div>
					</fieldset>
				</form>
			</div>
			<!-- /login -->

			<!-- recover password -->
			<div id = "forgotContainer">
				<div class="uk-text-center">Forgot Password</div><br>
				<form id = "forgotForm">
					<div class="uk-margin-small">
						<div class="uk-inline uk-width-1-1">
							<input class="uk-input " placeholder="E-mail" required type="text">
						</div>
					</div>
					<div class="uk-margin-bottom">
						<button type="submit" class="uk-button uk-button-primary  uk-width-1-1">SEND PASSWORD</button>
					</div>
				</form>
			</div>
			<!-- /recover password -->
			
			<!-- action buttons -->
			<div>
				<div class="uk-text-center">
					<a id = "forgotText" class="uk-link-reset uk-text-small" >Forgot your password?</a>
					<br><a id="registerText" class="uk-link-reset uk-text-small">Need to register first?</a>
					<a id = "backText1" class="uk-link-reset uk-text-small" ><span data-uk-icon="arrow-left"></span> Back to Login</a>
					<a id = "backText2" class="uk-link-reset uk-text-small" ><span data-uk-icon="arrow-left"></span> Back to Login</a>
				</div>
			</div>
			<!-- action buttons -->
		</div>
		
		<!-- JS FILES -->
		<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		<script src="./include/js/cookies.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
	</body>
</html>


 <script>
 	

  	$(function () {
  		{
	      	$("#forgotContainer").toggle();
	      	$("#registerContainer").toggle();
	      	$("#backText1").toggle();
	      	$("#backText2").toggle();

	      	$("#forgotText").click(function(){
			  $("#loginContainer").fadeToggle('fast', function(){
			  	$("#forgotContainer").fadeToggle('fast');
			  });
			  $("#forgotText").fadeToggle('fast');
			  $("#registerText").fadeToggle('fast', function(){
			  	$("#backText2").fadeToggle('fast');
			  });
			  
			});
	      	$("#registerText").click(function(){
			  $("#loginContainer").fadeToggle('fast', function(){
			  	$("#registerContainer").fadeToggle('fast');
			  });
			  $("#forgotText").fadeToggle('fast');
			  $("#registerText").fadeToggle('fast', function(){
			  	$("#backText1").fadeToggle('fast');
			  });
			  
			});
			$("#backText1").click(function(){
			  $("#registerContainer").fadeOut('fast', function(){
			  	$("#loginContainer").fadeToggle('fast');
			  });
			  $("#backText1").fadeToggle('fast', function(){
			  	$("#forgotText").fadeToggle('fast');
			  	$("#registerText").fadeToggle('fast');
			  });
			});
			$("#backText2").click(function(){
			  $("#forgotContainer").fadeOut('fast', function(){
			  	$("#loginContainer").fadeToggle('fast');
			  });
			  $("#backText2").fadeToggle('fast', function(){
			  	$("#forgotText").fadeToggle('fast');
			  	$("#registerText").fadeToggle('fast');
			  });
			});
		}

		$( "#registerform" ).validate({
		  rules: {
		    registeremail: {
		      email: true
		    },
		    passwordconfirm: {
				equalTo: "#registerpassword"
			}
		  }
		});
		$( "#loginform" ).validate({
		  rules: {
		    loginemail: {
				email: true
		    },
		    

		  }
		});

		$.ajax({
				url: '../api/professions.php',
				dataType: 'json',
				type: 'get',
				processData: false,
				success: function( data, textStatus, jQxhr ){
		   			let dropdown = $('#profession');
					$.each(data.data, function (key, entry) {
						dropdown.append($('<option></option>').attr('value', entry.ID).text(entry.name));
					})
				},
				error: function( jqXhr, textStatus, errorThrown ){
				    $('.alert').text("Cannot reach server");
				}
			});
		

        $('#loginform').on('submit', function (e) {
			e.preventDefault();
			$.ajax({
				url: '../api/loginPro.php',
				dataType: 'json',
				type: 'post',
				contentType: 'application/json',
				data: JSON.stringify({
				      email: $('#loginemail').val(),
				      password: $('#loginpassword').val()
				    }),
				processData: false,
				success: function( data, textStatus, jQxhr ){
				   if(data.jwt != undefined){
				       setCookie("jwt", data.jwt, 1);
					       setCookie("id", data.id, 1);
				       window.location.href = '/web/homePro.php';  
				   }else{
				       $('.alert').text(data.message);
				   }
				},
				error: function( jqXhr, textStatus, errorThrown ){
				    $('.alert').text("Cannot reach server");
				}
			});
    	});

    	$('#registerform').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
		    url: '../api/registerPro.php',
		    dataType: 'json',
		    type: 'post',
		    contentType: 'application/json',
		    data: JSON.stringify({
		    	  name: $('#registername').val(),
			      email: $('#registeremail').val(),
			      profession: $('#profession').val(),
			      password: $('#registerpassword').val()
			    }),
		    processData: false,
		    success: function( data, textStatus, jQxhr ){
	       		alert("200 : " + data.message)
		    }
			});
        });
	});
</script>	