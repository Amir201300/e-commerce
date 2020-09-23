<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/login/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/login/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/login/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/login/css/util.css">
	<link rel="stylesheet" type="text/css" href="/login/css/main.css">
    <link href="/manage/toast/jquery.toast.css" rel="stylesheet" />

<!--===============================================================================================-->
</head>
<body>
	
	
	<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
		<div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">
			<form class="login100-form validate-form" id="login_form" method="post">
				 @csrf
				 
				<span class="login100-form-title p-b-37">
					Sign In
				</span>

				<div class="wrap-input100  m-b-20" data-validate="Enter username or email">
					<input class="input100" type="text" name="name" placeholder="{{trans('main.username')}}">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input100 validate-input m-b-25" data-validate = "Enter password">
					<input class="input100" type="password" name="password" placeholder="{{trans('main.password')}}">
					<span class="focus-input100"></span>
				</div>

				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						Sign In
					</button>
				</div>


			</form>

			
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="/login/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/login/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/login/vendor/bootstrap/js/popper.js"></script>
	<script src="/login/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/login/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="/login/vendor/daterangepicker/moment.min.js"></script>
	<script src="/login/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/login/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/login/js/main.js"></script>
    <script src="/manage/toast/jquery.toast.js"></script>

	<script>
          $('#login_form').submit(function(e){
              e.preventDefault();
              $("#save").attr("disabled", true);

              $.toast({
                heading: '{{ trans("main.proccess") }}',
                position: 'bottom-right',
                stack: 2,
                icon : 'info',
                hideAfter: 5000,

            })
            var formData = new FormData($('#login_form')[0]);
            $.ajax({
            url : "{{ route('admin.login') }}",
            type : "post",
            data : formData,
            contentType:false,
            processData:false,

            success : function(data)
            {
                $.toast().reset('all');
                $("#save").attr("disabled", false);

               if(data==1)
               {
                $.toast({
                    heading: '{{ trans("main.loginDone") }}',
                    position: 'bottom-right',
                    stack: false,
                    icon : 'success',
                    hideAfter: false,

                })
                 //Redirect to dashboard
                window.setTimeout(function(){
                location.href = "{{ route('admin.dashboard') }}";
                }, 800);
               }
               else if(data==3){
                $.toast({
                    heading: '{{ trans("main.loginDah") }}',
                    position: 'bottom-right',
                    stack: false,
                    showHideTransition: 'fade',
                    icon: 'error',
                    hideAfter: 5000,

                })
               }
               // No user Auth
               else
               {
                $.toast({
                    heading: '{{ trans("main.logininCorrecyt") }}',
                    position: 'bottom-right',
                    stack: false,
                    showHideTransition: 'fade',
                    icon: 'error',
                    hideAfter: 3000,

                })
               }
            }
            });

          })
        </script>

</body>
</html>