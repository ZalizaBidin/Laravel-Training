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

<body class="bg-light">
  <div class="container">

    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Records</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal_add_record"><i
                class="bi-plus-circle me-2"></i>Add New Record</button>
          </div>
          <div class="card-body" id="show_all_records">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="modal_add_record" 
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleAddRecord">Add Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <div class="p-4">
        @csrf    
        @open(['id' => 'form_add_record'])
        @text('name','Name','-')
        @text('icno','IC No','-')
        @text('licenseno','License No','-')
        @file('file_license', null, ['id' => 'file_license'])
        <img src=' ' id ='img_licensepict' width='100px' />
        @text('licensepict',null,'-')
        @text('user_id','User Id','-')

        <div class="modal-footer">
        @button('Add',['id' => 'btn_add_record'])
        @close
        </button>
        </div>        
        </div>
    </div>
  </div>
</div>  



<div class="modal fade" id="modal_edit_record" 
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p">
      <div class="modal-header">
        <h5 class="modal-title" id="modalTitleEditRecord">Edit Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <div class="p-4">
        @csrf    
        @open(['id' => 'form_edit_record'])
        @text('edit_id','ID','-', ['id' => 'edit_id'])        
        @text('edit_name','Name','-', ['id' => 'edit_name'])
        @text('edit_icno','IC No','-', ['id' => 'edit_icno'])
        @text('edit_licenseno','License No','-', ['id' => 'edit_licenseno'])
        @file('edit_file_license', null, ['id' => 'edit_file_license'])
        <img src=' ' id ='edit_img_licensepict' width="100px"/>

        @text('edit_licensepict',null,'-', ['id' => 'edit_licensepict'])
        @text('edit_user_id',null,'1', ['id' => 'edit_user_id'])

        <div class="modal-footer">
        @button('Update',['id' => 'btn_update_record'])
        @close
        </button>
        </div>        
        </div>
    </div>
  </div>
</div> 

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
      function fetchAllRecords() {
        $.ajax({
          url: '/api/driver/fetchAll',
          method: 'post',
          success: function(response) {
            console.log(response)
            $("#show_all_records").html(response);
          }
        });
      }
      fetchAllRecords();
</script>

<script>
      $("#btn_add_record").click(function(e) {
          //e.preventDefault();
          var form = document.getElementById('form_add_record');
          //var form =$('#form_add_user');
          var form_data = new FormData(form);           
          console.log(form_data);        
        $.ajax({
          url: '/api/driver/store',
          method: 'post',
          data: form_data,
          cache: false,
          contentType: false,
          processData: false,

          success: function(response) {
            console.log(response);
            if (response.status == 200) {
              Swal.fire(
                'Added!',
                'Added Successfully!',
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
<script>
      $(document).on('click', '.editIcon', function(e) {
        //e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '/api/driver/edit',
          method: 'post',
          data: {
            id: id
          },
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          success: function(response) {
            console.log(response);
            $("#edit_id").val(response.driver.id);
            $("#edit_name").val(response.driver.name);
            $("#edit_icno").val(response.driver.icno);
            $("#edit_licenseno").val(response.driver.licenseno);
            $("#edit_licensepict").val(response.driver.licensepict);
            $('#edit_img_licensepict').attr("src",response.driver.licensepict);
            $("#edit_user_id").val(response.driver.user_id);            
          }
        });
      })



</script>
<script>
      $("#btn_update_record").click(function(e) {
          //e.preventDefault();
          var form = document.getElementById('form_edit_record');
          //var form =$('#form_add_user');
          var form_data = new FormData(form);           
          console.log(form_data);        
        $.ajax({
          url: '/api/driver/update',
          method: 'post',
          data: form_data,
          cache: false,
          contentType: false,
          processData: false,

          success: function(response) {
            console.log(response);
            if (response.status == 200) {
              Swal.fire(
                'Updated!',
                'Updated Successfully!',
                'success'
              )
              fetchAllRecords();
            }
            $("#form_edit_record")[0].reset();
            $("#modal_edit_record").modal('hide');
          }
        });
      });
</script>


<script>
    document.querySelector('#file_license').onchange = function(){
    var reader = new FileReader();
    reader.onloadend = function () {
      document.getElementById('img_licensepict').src=reader.result;
      document.getElementById('licensepict').value=reader.result;
    }
    reader.readAsDataURL(this.files[0]);
  };
</script>  


<script>
    document.querySelector('#edit_file_license').onchange = function(){
    var reader = new FileReader();
    reader.onloadend = function () {
      document.getElementById('edit_img_licensepict').src=reader.result;
      document.getElementById('edit_licensepict').value=reader.result;
    }
    reader.readAsDataURL(this.files[0]);
  };
</script>

<script>
      $(document).on('click', '.deleteIcon', function(e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
        Swal.fire({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: '/api/driver/delete',
              method: 'post',
              data: {
                id: id,
                _token: csrf
              },
              success: function(response) {
                console.log(response);
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
                fetchAllRecords();
              }
            });
          }
        })
      });
</script>