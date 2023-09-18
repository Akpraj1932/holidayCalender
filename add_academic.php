<?php
include 'conn.php';
if (!isset($_SESSION['username'])) {
    header("location:index.php");
    return false;
    exit();
}
$type = '1';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Academic Calender </title>
    <?php include 'include-css.php'; ?>
    <style>
        div.list{
            background-color: #ebebeb;
  
  height: 400px;
  overflow-x: auto;
  overflow-y: auto;
  text-align: center;
  padding: 20px;
        }
        th{
            text-align:center;
        }
    </style>
</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <?php include 'sidebar.php'; ?>
            <!-- page content -->
            <div class="right_col" role="main">
                <!-- top tiles -->
                <br />
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <div class="x_title">
                                <h2>Add Academic Calender</h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class='row'>
                                    <div class='col-md-12 col-sm-12'>
                                        <form action="add_academic_code.php" method="post"
                                            enctype="multipart/form-data">
                                            <input type="hidden" value="academic_calender" name="academic_calender" />
                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="name">Date</label>
                                                    <input type="date" id="datepicker" name="date" required
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="image">Title</label>
                                                    <input type='text' name="title" id="title" class="form-control">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <br>
                                                    <label for="name">State</label>
                                                    <select name="state" required class="form-control">
                                                        <option>Select State</option>
                                                        <?php
                                                    $sql="SELECT * FROM state";
                                                    $result= mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                        while($row=mysqli_fetch_assoc($result)){
                                                            
                                                            
                                                        ?>
                                                        <option><?php echo $row['state_name'];?></option>
                                                        <?php     }?>
                                                        <?php }?>

                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <br>
                                                    <label for="Month">Month</label>
                                                    <select name="month" required class="form-control">
                                                        <option>Select Month</option>
                                                        <?php
                                                    $sql="SELECT * FROM month";
                                                    $result= mysqli_query($conn,$sql);
                                                    if(mysqli_num_rows($result)>0){
                                                        while($row=mysqli_fetch_assoc($result)){
                                                            
                                                            
                                                        ?>
                                                        <option><?php echo $row['month_name'];?></option>
                                                        <?php     }?>
                                                        <?php }?>

                                                    </select>
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <br>
                                                    <label for="name">Description</label>
                                                    <input type="text" id="date" name="description" class="form-control">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <br>
                                                    <label for="image">Image</label>
                                                    <input type='file' name="image" id="image" class="form-control">
                                                </div>
                                                <hr>
                                                
                                                <div class="form-group mx-5">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        <br>
                                                        <button type="submit" id="submit_btn"
                                                            class="btn btn-success">Add
                                                        </button>
                                                    </div>
                                                </div>
                                        </form>
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class='col-sm-12'>
                                        <h2>List Of Academic Calender</h2>
                                    </div>
                                    <div class='col-md-12 col-sm-12 list table table-striped'>
                                        <table class="table table-bordered" >
                                            <thead>
                                                <tr>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">State</th>
                                                    <th scope="col">Month</th>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Operation</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql="SELECT * FROM academic";
                                                $result = mysqli_query($conn,$sql);
                                                if(mysqli_num_rows($result)>0){
                                                    while($row=mysqli_fetch_assoc($result)){
                                                        ?>
                                                <tr>
                                                    <td><?php echo $row['title'];?></td>
                                                    <td><?php echo $row['state'];?></td>
                                                    <td><?php echo $row['month'];?></td>
                                                    <td><?php echo $row['date'];?></td>
                                                    <td><?php echo $row['description'];?></td>
                                                    <td><img src="academic_image/<?php echo $row['image'];?>" height="50px" width="50px"></td>
                                                    <td><a href="delete.php?action=delete&id=<?php echo $row['id'];?>"><span style="color:red;"><b>Delete</b></span></td>
                                                </tr>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <?php include 'footer.php'; ?>
        <!-- /footer content -->
    </div>

    <?php
      if(isset($_SESSION['status']) && $_SESSION['status']!=''){
        ?>
    <script>
    swal({
        title: "<?php echo $_SESSION['status'];?>",
        icon: "<?php echo $_SESSION['status_code'];?>",
    });
    </script>
    <?php
        unset($_SESSION['status']);
      }
      ?>

    <script>
    $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    </script>
     <script>
            $('#filter_btn').on('click', function (e) {
                $('#category_list').bootstrapTable('refresh');
            });
            $('#delete_multiple_categories').on('click', function (e) {
                sec = 'category';
                is_image = 1;
                table = $('#category_list');
                delete_button = $('#delete_multiple_categories');
                selected = table.bootstrapTable('getAllSelections');

                ids = "";
                $.each(selected, function (i, e) {
                    ids += e.id + ",";
                });
                ids = ids.slice(0, -1); // removes last comma character

                if (ids == "") {
                    alert("Please select some categories to delete!");
                } else {
                    if (confirm("Are you sure you want to delete all selected categories?")) {
                        $.ajax({
                            type: 'GET',
                            url: "db_operations.php",
                            data: 'delete_multiple=1&ids=' + ids + '&sec=' + sec + '&is_image=' + is_image,
                            beforeSend: function () {
                                delete_button.html('<i class="fa fa-spinner fa-pulse"></i>');
                            },
                            success: function (result) {
                                if (result == 1) {
                                    alert("Categories deleted successfully");
                                } else {

                                    alert("Could not delete Categories. Try again!");
                                }
                                delete_button.html('<i class="fa fa-trash"></i>');
                                table.bootstrapTable('refresh');
                            }
                        });
                    }
                }
            });
        </script>
        <script>
            var $table = $('#category_list');
            $('#toolbar').find('select').change(function () {
                $table.bootstrapTable('refreshOptions', {
                    exportDataType: $(this).val()
                });
            });
        </script>

        <script>
            window.actionEvents = {
                'click .edit-category': function (e, value, row, index) {
                    // alert('You click remove icon, row: ' + JSON.stringify(row));
                    var regex = /<img.*?src="(.*?)"/;
                    var src = regex.exec(row.image)[1];
<?php if ($fn->is_language_mode_enabled()) { ?>
                        $('#update_language_id').val(row.language_id);
<?php } ?>
                    $('#category_id').val(row.id);
                    $('#update_name').val(row.category_name);
                    $('#image_url').val(src);
                }
            };
        </script>
        <script>
            $('#update_form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                if ($("#update_form").validate().form()) {
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        beforeSend: function () {
                            $('#update_btn').html('Please wait..');
                        },
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function (result) {
                            $('#update_result').html(result);
                            $('#update_result').show().delay(3000).fadeOut();
                            $('#update_btn').html('Update');
                            $('#update_image').val('');
                            // $('#update_form')[0].reset();
                            $('#category_list').bootstrapTable('refresh');
                            setTimeout(function () {
                                $('#editCategoryModal').modal('hide');
                            }, 4000);
                        }
                    });
                }
            });
        </script>
        <script>
            function queryParams(p) {
                return {
                    "language": $('#filter_language').val(),
                    type:<?= $type ?>,
                    limit: p.limit,
                    sort: p.sort,
                    order: p.order,
                    offset: p.offset,
                    search: p.search
                };
            }
        </script>
        <script>
            $('#category_form').validate({
                rules: {
                    name: "required"
                }
            });
        </script>
        <script>
            $('#category_form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                if ($("#category_form").validate().form()) {
                    if (confirm('Are you sure? Want to create Category')) {
                        $.ajax({
                            type: 'POST',
                            url: $(this).attr('action'),
                            data: formData,
                            beforeSend: function () {
                                $('#submit_btn').html('Please wait..');
                            },
                            cache: false,
                            contentType: false,
                            processData: false,
                            success: function (result) {
                                $('#result').html(result);
                                $('#result').show().delay(4000).fadeOut();
                                $('#submit_btn').html('Submit');
                                $('#category_form')[0].reset();
                                $('#category_list').bootstrapTable('refresh');
                            }
                        });
                    }
                }
            });
        </script>
        <script>
            $(document).on('click', '.delete-category', function () {
                if (confirm('Are you sure? Want to delete category? All related questions and sub categories will also be deleted')) {
                    id = $(this).data("id");
                    image = $(this).data("image");
                    $.ajax({
                        url: 'db_operations.php',
                        type: "get",
                        data: 'id=' + id + '&image=' + image + '&delete_category=1',
                        success: function (result) {
                            if (result == 1) {
                                $('#category_list').bootstrapTable('refresh');
                            } else
                                alert('Error! Category could not be deleted');
                        }
                    });
                }
            });
        </script>
</body>

</html>