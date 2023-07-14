<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Manager</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css' />
  <link rel='stylesheet'
    href='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css' />
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
</head>
<body class="bg-light">
  <div class="container">
    <div class="row my-5">
      <div class="col-lg-12">
        <div class="card shadow">
          <div class="card-header bg-danger d-flex justify-content-between align-items-center">
            <h3 class="text-light">Manage Report Records</h3>
            <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#modal_add_record"><i
                class="bi-plus-circle me-2"></i>Add New</button>
          </div>
          <div class="card-body" id="show_all_records">
            <h1 class="text-center text-secondary my-5">Loading...</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modal_add_record" tabindex="-1" aria-labelledby="modal_add_record"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_add_record_title">Add Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <div class="p-4">
        @csrf    
        @open(['id' => 'form_add_record'])
        @text('rnumb','Report no','-')        
        @date('rdate','Date','-')
        @time('rtime','Time','-')
        @text('alocn','Location','-')
        @button('Get location',['id' => 'get_location'])

        @file('select_pict1', 'Select picture 1', ['custom' => true])
        <img id='img_pict1' src='' width="100px" />        
        @hidden('apict1')
        @hidden('apict1thum', '-', ['id' => 'apict1thum'])

        @file('select_pict2', 'Select picture 2', ['custom' => true])
        <img id='img_pict2' src='' width="100px" />        
        @hidden('apict2')
        @hidden('apict2thum', '-', ['id' => 'apict2thum'])

        @file('select_pict3', 'Select picture 3', ['custom' => true])
        <img id='img_pict3' src='' width="100px" />        
        @hidden('apict3' )
        @hidden('apict3thum', '-', ['id' => 'apict3thum'])

        @select('afire','Fire?',['y' => 'Yes', 'n' => 'No'],'n', ['id' => 'afire'])
        @select('atrap','Trap?',['y' => 'Yes', 'n' => 'No'],'n', ['id' => 'atrap'])
        @select('ainju','Injured?',['y' => 'Yes', 'n' => 'No'],'n', ['id' => 'ainju'])

        @text('userid','','1')


        <div class="modal-footer">
        @button('Add',['id' => 'btn_add_record'])
        @close

        </div>        
        </div>
    </div>
  </div>
</div>  

<div class="modal fade" id="modal_edit_record" tabindex="-1" aria-labelledby="modal_edit_record"
  data-bs-backdrop="static" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p">
      <div class="modal-header">
        <h5 class="modal-title" id="modal_edit_record_title">Edit Record</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
       <div class="p-4">
        @csrf      
        @open(['id' => 'form_edit_record'])
        @hidden('edit_id', null, null, ['id' => 'edit_id'])
        @text('edit_rnumb','Report no','-')        
        @date('edit_rdate','Date','-')
        @time('edit_rtime','Time','-')
        @text('edit_alocn','Location','-')
        @button('Get location',['id' => 'edit_get_location'])

        @file('edit_select_pict1', 'Select picture 1', ['custom' => true])
        <img id='edit_img_pict1' src='' width="100px" />        
        @hidden('edit_apict1')
        @hidden('edit_apict1thum', '-', ['id' => 'edit_apict1thum'])

        @file('edit_select_pict2', 'Select picture 2', ['custom' => true])
        <img id='edit_img_pict2' src='' width="100px" />        
        @hidden('edit_apict2')
        @hidden('edit_apict2thum', '-', ['id' => 'edit_apict2thum'])

        @file('edit_select_pict3', 'Select picture 3', ['custom' => true])
        <img id='edit_img_pict3' src='' width="100px" />        
        @hidden('edit_apict3' )
        @hidden('edit_apict3thum', '-', ['id' => 'edit_apict3thum'])

        @select('edit_afire','Fire?',['y' => 'Yes', 'n' => 'No'],'n', ['id' => 'edit_afire'])
        @select('edit_atrap','Trap?',['y' => 'Yes', 'n' => 'No'],'n', ['id' => 'edit_atrap'])
        @select('edit_ainju','Injured?',['y' => 'Yes', 'n' => 'No'],'n', ['id' => 'edit_ainju'])

        @hidden('edit_userid','User Id',null,['id' => 'edit_userid'])

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
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
      function fetchAllRecords() {
        $.ajax({
          url: '/api/report/fetchAll',
          method: 'post',
          success: function(response) {
            console.log(response)
            $("#show_all_records").html(response);
          }
        });
      }
      fetchAllRecords();
      $("#btn_add_record").click(function(e) {
          //e.preventDefault();
          let form = document.getElementById('form_add_record');
          let form_data = new FormData(form);           
          console.log(form_data);        
        $.ajax({
          url: '/api/report/store',
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
      $(document).on('click', '.editIcon', function(e) {
        //e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
          url: '/api/report/edit',
          method: 'post',
          data: {
            id: id
          },
          'Accept': 'application/json',
          'Content-Type': 'application/json',
          success: function(response) {
            console.log(response);
            $("#edit_id").val(response.report.id);
            $("#edit_rnumb").val(response.report.rnumb);
            $("#edit_rdate").val(response.report.rdate);
            $("#edit_rtime").val(response.report.rtime);
            $("#edit_alocn").val(response.report.alocn);          
            $("#edit_apict1").val(response.report.apict1);   
            document.getElementById('edit_img_pict1').src=response.report.apict1thum;    
            $("#edit_apict2").val(response.report.apict2);  
            document.getElementById('edit_img_pict2').src=response.report.apict2thum; 
            $("#edit_apict3").val(response.report.apict3);  
            document.getElementById('edit_img_pict3').src=response.report.apict3thum; 
            $("#edit_afire").val(response.report.afire);
            $("#edit_atrap").val(response.report.atrap);
            $("#edit_ainju").val(response.report.ainju);      
            $("#edit_userid").val(response.report.user_id);      
          }
        });
      })

      $("#btn_update_record").click(function(e) {
          //e.preventDefault();
          let form = document.getElementById('form_edit_record');
          let form_data = new FormData(form);  
          //console.log(form_data);         

        $.ajax({
          url: '/api/report/update',
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
              url: '/api/report/delete',
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
<script>
    document.querySelector('#select_pict1').onchange = function(){
    var reader = new FileReader();
    reader.onloadend = function () {
      document.getElementById('img_pict1').src=reader.result;
      document.getElementById('apict1').value=reader.result;
    }
    reader.readAsDataURL(this.files[0]);
  };
  document.querySelector('#select_pict2').onchange = function(){
    var reader = new FileReader();
    reader.onloadend = function () {
      document.getElementById('img_pict2').src=reader.result;
      document.getElementById('apict2').value=reader.result;
    }
    reader.readAsDataURL(this.files[0]);
  };
  document.querySelector('#select_pict3').onchange = function(){
    var reader = new FileReader();
    reader.onloadend = function () {
      document.getElementById('img_pict3').src=reader.result;
      document.getElementById('apict3').value=reader.result;
    }
    reader.readAsDataURL(this.files[0]);
  };     
</script>  
<script>
    document.querySelector('#edit_select_pict1').onchange = function(){
    var reader = new FileReader();
    reader.onloadend = function () {
      document.getElementById('edit_img_pict1').src=reader.result;
      document.getElementById('edit_apict1').value=reader.result;
    }
    reader.readAsDataURL(this.files[0]);
  };
  document.querySelector('#edit_select_pict2').onchange = function(){
    var reader = new FileReader();
    reader.onloadend = function () {
      document.getElementById('edit_img_pict2').src=reader.result;
      document.getElementById('edit_apict2').value=reader.result;
    }
    reader.readAsDataURL(this.files[0]);
  };  
  document.querySelector('#edit_select_pict3').onchange = function(){
    var reader = new FileReader();
    reader.onloadend = function () {
      document.getElementById('edit_img_pict3').src=reader.result;
      document.getElementById('edit_apict3').value=reader.result;
    }
    reader.readAsDataURL(this.files[0]);
  };  
</script> 
<script>
      $("#get_location").click(function(e) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(result){
                $("#alocn").val(result.coords.latitude+','+result.coords.longitude);
            });
        } else {
            console.log(9);
        }
      })
      $("#edit_get_location").click(function(e) {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(result){
                $("#edit_alocn").val(result.coords.latitude+','+result.coords.longitude);
            });
        } else {
            console.log(9);
        }
      })
 
</script>


    </body>
    </html>