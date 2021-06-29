<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <title>PHP AJAX & Jquery</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body>

  <body>

    <div class="header">
      <nav class="simple-header-container">
        <a href="index.php" class="back-to-home">PHP AJAX & Jquery</a>
      </nav>
    </div>

    <div class="container form_sec">
      <div class="my-3">
        <h3 class="text-center">Edit Profile Data</h3>
      </div>
      <form class="my-5" id="addForm">
        <div class="row">
          <div class="col">
            <input type="email" id="email" class="form-control" placeholder="abc@gmail.com">
          </div>
          <div class="col">
            <input type="text" id="name" class="form-control" placeholder="Enter Full Name">
          </div>
          <div class="col">
            <input type="text" id="qualification" class="form-control" placeholder="Qualification">
          </div>
        </div>
        <div class="sub-btn my-2 d-flex justify-content-center">
          <button type="button" class="btn btn-outline-success px-5" id="save-button">Save</button>
        </div>
      </form>

    </div>

    <div class="datatable container my-5">
      <div class="my-3">
        <h3 class="text-center">Candidate Records</h3>
      </div>
      <table>
        <thead id="table-data">
      </table>
    </div>


    <div id="error-message"></div>
    <div id="success-message"></div>

    <div id="modal">
    <div id="modal-form">
      <h2>Edit Form</h2>
      <table cellpadding="10px" width="100%">
      </table>
      <div id="close-btn">X</div>
    </div>
  </div>



    <script type="text/javascript">
      $(document).ready(function() {
        // Load Table Records
        function loadTable() {
          $.ajax({
            url: "ajax-load.php",
            type: "POST",
            success: function(data) {
              $("#table-data").html(data);
            }
          });
        }
        loadTable(); // Load Table Records on Page Load
     




      // Insert New Records
      $("#save-button").on("click", function(e) {
        e.preventDefault();
        var email = $("#email").val();
        var  name= $("#name").val();
        var qualification = $("#qualification").val();
        if (email == "" || name == "" || qualification=="") {
          $("#error-message").html("All fields are required.").slideDown();
          $("#success-message").slideUp();
        } else {
          $.ajax({
            url: "ajax-insert.php",
            type: "POST",
            data: {
              email: email,
              name: name,
              qualification:qualification
            },
            success: function(data) {
              if (data == 1) {
                loadTable();
                $("#addForm").trigger("reset");
                $("#success-message").html("Data Inserted Successfully.").slideDown();
                $("#error-message").slideUp();
              } else {
                $("#error-message").html("Can't Save Record.").slideDown();
                $("#success-message").slideUp();
              }

            }
          });
        }

      });


    //Delete Records
    $(document).on("click",".delete-btn", function(){
      if(confirm("Do you really want to delete this record ?")){
        var candidateId = $(this).data("id");
        console.log(candidateId)
        var element = this;

        $.ajax({
          url: "ajax-delete.php",
          type : "POST",
          data : {id : candidateId},
          success : function(data){
              if(data == 1){
                $(element).closest("tr").fadeOut();
              }else{
                $("#error-message").html("Can't Delete Record.").slideDown();
                $("#success-message").slideUp();
              }
          }
        });
      }
    });
   //Show Modal Box
      $(document).on("click",".edit-btn", function(){
          $("#modal").show();
          var candiadateId = $(this).data("eid");

          $.ajax({
            url: "load-update-form.php",
            type: "POST",
            data: {id: candiadateId },
            success: function(data) {
              $("#modal-form table").html(data);
            }
          })
        });

        //Hide Modal Box
        $("#close-btn").on("click",function(){
          $("#modal").hide();
        });
    //Save Update Form
    $(document).on("click","#edit-submit", function(){
        var Id = $("#edit-id").val();
        var email = $("#edit-email").val();
        var name = $("#edit-name").val();
        var qualification = $("#edit-qualification").val();
        $.ajax({
          url: "ajax-update-form.php",
          type : "POST",
          data : {id: Id, email: email, name: name,qualification:qualification},
          success: function(data) {
            if(data == 1){
              $("#modal").hide();
              loadTable();
            }
          }
        })
      });



    });
    </script>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>

</html>