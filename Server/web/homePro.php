
<?php 
include_once '../api/core.php';
if(isset($_COOKIE["jwt"])){
  $token = json_decode(validate_token($_COOKIE["jwt"], $key));
	if($token->isValid == "true" AND $token->data->accountType == "pro"){
?> 

<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./include/js/cookies.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.js"></script>
</head>

<body>
	<form action="" id="logout" method="post" name="form">
		<button type="submit" class="button">Logout</button>
    <span class="desc"></span>
	</form>
</body>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS FILES -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/uikit@latest/dist/css/uikit.min.css">
    <link rel="stylesheet" type="text/css" href="css/marketing.css">
  </head>
  <body>
   
    <section id="content" class="uk-section uk-section-default">
      <div class="uk-container uk-width-3-4">
        <div class="uk-section uk-section-small uk-padding-remove-top">
          <ul class="uk-subnav uk-subnav-pill uk-flex uk-flex-center" data-uk-switcher="connect: .uk-switcher; animation: uk-animation-fade">
            <li><a class="uk-border-pill" href="#">Menu</a></li>
            <li><a class="uk-border-pill" href="#">Gestion des produit</a></li>
            <li><a class="uk-border-pill" href="#">Gestion du profil</a></li>
          </ul>
        </div>

        <ul class="uk-switcher uk-margin">
          <li>
            <div class="uk-grid uk-flex-middle" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-left-medium">
              
             <h4>Test</h4>
            </div>
          </li>
          <li>
            <div class="uk-grid uk-flex-middle" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-left-medium">

              <div data-uk-scrollspy-class="uk-animation-slide-right-medium" class="uk-align-center uk-width-1-2">

              <!-- login -->
              <div id = "productContainer">

                <div class="uk-margin">
                  <button class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="button" uk-toggle="target: #editProducts">Modifier les produits</button>
                  <div class="editConfirm uk-text-center uk-text-success"></div>
                  <div class="editAlert uk-text-center uk-text-danger"></div><br>
                  <div hidden id="editProducts"></div>
                </div>

                <button class="uk-button uk-button-primary uk-width-1-1" type="button" uk-toggle="target: #productForm">Ajouter un produit</button>

                <form hidden id = "productForm" class="uk-margin " method = "post">
                  <div class="uk-text-center">Add a new Product</div><br>
                  <div class="productConfirm uk-text-center uk-text-success"></div>
                  <div class="productAlert uk-text-center uk-text-danger"></div><br>
                  <fieldset class="uk-fieldset">
                    <div class="uk-margin-small">
                      <div class="uk-inline uk-width-1-1">
                        <input name = "productName" id = "productName" class="uk-input" required placeholder="Name" type="text">
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <div class="uk-inline uk-width-1-1">
                        <input name = "productPrice" id = "productPrice" class="uk-input" required placeholder="Price in €" type="number">
                      </div>
                    </div>
                    <div class="uk-margin-small">
                      <div class="uk-inline uk-width-1-1">
                        <input name = "productDesc" id = "productDesc" class="uk-input" required placeholder="Description" type="text">
                      </div>
                    </div>
                    <br>
                    <div class="uk-margin-bottom uk-text-center">
                      <button class="uk-button uk-button-default" type="submit" tabindex="-1">Ajouter</button>
                    </div>
                  </fieldset>
                </form>
              </div>
              <!-- /login -->
              </div>
            </div>
          </li>
          <li>
            <div class="uk-grid uk-flex-middle" data-uk-grid data-uk-scrollspy="target: > div; cls: uk-animation-slide-left-medium">

              <div data-uk-scrollspy-class="uk-animation-slide-right-medium" class="uk-align-center uk-width-1-2">

                <div id = "profilContainer">
                  <div class="uk-margin">
                    <button class="uk-button uk-button-primary uk-width-1-1 uk-margin" type="button" uk-toggle="target: #profilePicture">Photo de profil</button>
                    <div class="profileConfirm uk-text-center uk-text-success"></div>
                    <div class="profileAlert uk-text-center uk-text-danger"></div><br>
                    <div hidden id="profilePicture" class="uk-flex uk-flex-center">
                    <div class='uk-flex-column'>
                      <img src="" id="img" class="profilepic uk-margin uk-align-center" width="100" height="100">
                      <form>
                        <div uk-form-custom> 
                            <input type="file" id="input_img" class="uk-input" onchange="fileChange()" accept="image/*">
                            <button class="uk-button uk-button-default" type="submit" tabindex="-1">Selectionner</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>              
          </div>
        </li>
      </ul>  
      </div>
    </section>
  
    
    <!-- JS FILES -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@latest/dist/js/uikit-icons.min.js"></script>
  </body>
</html>

 <script>

      

      $(function () {
        $( "#productForm" ).validate();
        $('#logout').on('submit', function (e) {
         	setCookie("jwt", "j", -1);
        });
      });
      $.ajax({
            url: '../api/professional.php?id=' + getCookie("id"),
            dataType: 'json',
            beforeSend: function(request){
                request.setRequestHeader('Authorization', 'Bearer ' + getCookie("jwt"));
            },
            type: 'GET',
            success: function(data) {
              console.log(data)
              $('.desc').text(data.data.name);
              $(".profilepic").attr("src", data.data.profilepic);
            },
            error: function(data) {
              console.log(data)
            }
        });

      $(function () {
        $.ajax({
          url: '../api/getProducts.php?id=' + getCookie('id'),
          dataType: 'json',
          type: 'get',
          processData: false,
          success: function( data, textStatus, jQxhr ){
            let table = $('#editProducts');
            $.each(data.data, function (key, entry) {
              table.append($(`
                <div class="uk-flex">
                  <form class="uk-flex" id = "editProductForm" method = "post"> 
                    <input id = "editID" class="uk-input" required value="`+entry.ID+`" type="hidden">
                    <input id = "editName" class="uk-input" required value="`+entry.name+`" type="text">
                    <input id = "editPrice" class="uk-input" required value="`+entry.price+`" type="number">
                    <input id = "editDesc" class="uk-input" required value="`+entry.description+`" type="text"> 
                    <button type="submit" class="uk-button uk-button-primary uk-width-1-5">✓</button>
                  </form>
                  <button id="deleteProduct" value="`+entry.ID+`" class="uk-height-1-1" uk-icon="icon:trash;ratio: 2">
                </div>
              `));
            })
          },
          error: function( data ){
          }
        });
      })
      $(document).on("click", "#deleteProduct", function(e) {
        e.preventDefault();
        $.ajax({
            url: '../api/deleteProduct.php',
            dataType: 'json',
            beforeSend: function(request){
                request.setRequestHeader('Authorization', 'Bearer ' + getCookie("jwt"));
            },
            type: 'post',
            contentType: 'application/json',
            data: JSON.stringify({
                id: getCookie('id'),
                productID: $(this).val(),
              }),
            processData: false,
            success: function( data, textStatus, jQxhr ){
                if(data.status == "success"){
                  $('.editConfirm').text(data.message);
                }else{
                  $('.editAlert').text(data.message);
                }
            },
            error: function( data ){
                $('.editAlert').text(data.responseJSON.message);
            }
        });
      });


      $(document).on("submit", "#editProductForm", function(e) {

          e.preventDefault();
          $.ajax({
            url: '../api/editProduct.php',
            dataType: 'json',
            beforeSend: function(request){
                request.setRequestHeader('Authorization', 'Bearer ' + getCookie("jwt"));
            },
            type: 'post',
            contentType: 'application/json',
            data: JSON.stringify({
                id: getCookie('id'),
                productID: $(this.elements[0]).val(),
                name: $(this.elements[1]).val(),
                price: $(this.elements[2]).val(),
                description: $(this.elements[3]).val(),
              }),
            processData: false,
            success: function( data, textStatus, jQxhr ){
                if(data.status == "success"){
                  $('.editConfirm').text(data.message);
                }else{
                  $('.editAlert').text(data.message);
                }
            },
            error: function( data ){
                $('.editAlert').text(data.responseJSON.message);
            }
        });
      });

      $('#productForm').on('submit', function (e) {
          e.preventDefault();
          $.ajax({
            url: '../api/addProduct.php',
            dataType: 'json',
            beforeSend: function(request){
                request.setRequestHeader('Authorization', 'Bearer ' + getCookie("jwt"));
            },
            type: 'post',
            contentType: 'application/json',
            data: JSON.stringify({
                id: getCookie('id'),
                name: $('#productName').val(),
                price: $('#productPrice').val(),
                description: $('#productDesc').val(),
              }),
            processData: false,
            success: function( data, textStatus, jQxhr ){
                if(data.status == "success"){
                  $('.productConfirm').text(data.message);
                }else{
                  $('.productAlert').text(data.message);
                }
            },
            error: function( data ){
                $('.productAlert').text(data.responseJSON.message);
            }
          });
      });

      function fileChange(){
        var file = document.getElementById('input_img');
        var form = new FormData();
        form.append("image", file.files[0])

        var settings = {
          "url": "https://api.imgbb.com/1/upload?key=373ef8acef7a1f27213234dca6d1dccb",
          "method": "POST",
          "timeout": 0,
          "processData": false,
          "mimeType": "multipart/form-data",
          "contentType": false,
          "data": form
        };

        $.ajax(settings).done(function (response) {
          console.log(response);
          var jx = JSON.parse(response);
          console.log(jx.data.url);
          if(jx.status == 200){
            $.ajax({
              url: '../api/editProfilePicture.php',
              dataType: 'json',
              beforeSend: function(request){
                  request.setRequestHeader('Authorization', 'Bearer ' + getCookie("jwt"));
              },
              type: 'post',
              contentType: 'application/json',
              data: JSON.stringify({
                  id: getCookie('id'),
                  url: jx.data.url,
                }),
              processData: false,
              success: function( data, textStatus, jQxhr ){
                  if(data.status == "success"){
                    $('.profileConfirm').text(data.message);
                  }else{
                    $('.profileAlert').text(data.message);
                  }
              },
              error: function( data ){
                  $('.profileAlert').text(data.responseJSON.message);
              }
            });   
          }
        });
      }

</script>	

<?php 
    }else{?>
        <script> window.location.href = '/web/login.php'; </script>
    <?php }
  } else{ ?>
  <script> window.location.href = '/web/login.php'; </script>
<?php } ?>