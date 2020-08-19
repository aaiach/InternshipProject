
<?php 
include_once '../api/core.php';
if(isset($_COOKIE["jwt"])){
  $token = json_decode(validate_token($_COOKIE["jwt"], $key));
	if($token->isValid == "true" AND $token->data->accountType == "user"){  
?> 

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./include/js/cookies.js"></script>
</head>

<body>
	<form action="" method="post" name="form">
		<button type="submit" class="button">Logout</button>
    <span class="desc"></span>
	</form>
</body>

<?php 
    }else{?>
        <script> window.location.href = '/web/login.php'; </script>
    <?php }
  } else{ ?>
	<script> window.location.href = '/web/login.php'; </script>
<?php } ?>

 <script>
      $(function () {
        $('form').on('submit', function (e) {
         	setCookie("jwt", "j", -1);
        });
      });
      $.ajax({
            url: '../api/user.php?id=' + getCookie("id"),
            dataType: 'json',
            beforeSend: function(request){
                request.setRequestHeader('Authorization', 'Bearer ' + getCookie("jwt"));
            },
            type: 'GET',
            success: function(data) {
              $('.desc').text(data.data);
            },
            error: function(data) {
                alert(':(');
            }
        });
</script>	