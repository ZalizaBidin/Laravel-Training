<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Driver Records</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />

</head>

<body>
@open(['id' => 'form_login'])
    @text('name','Please enter your name:','-', ['id' => 'name'])
    @email('email','Please enter your email:','-', ['id' => 'email'])
    @password('password','Please enter your password:', ['id' => 'password'])
    @checkbox('remember_me', null, 1, null, ['switch' => true, 'inline' => true])
    @submit('Login',['id' => 'btn_login'])
@close

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
      $("#btn_login").click(function(e) {
          e.preventDefault();
          var form = document.getElementById('form_login');
          //var form =$('#form_login');
          var form_data = new FormData(form);           
          console.log(form_data);        
        $.ajax({
          url: '/api/stafflogin',
          method: 'post',
          data: form_data,
          cache: false,
          contentType: false,
          processData: false,

          success: function(response) {
            console.log(response);
            if (response.status == 200) {
              Swal.fire(
                'Logged in!',
                'Logged in Successfully!',
                'success'
              )
              fetchAllRecords();
            }
            $("#form_add_record")[0].reset();
            $("#modal_add_record").modal('hide');
          }
        });
      });
</script>


</body>
</html>