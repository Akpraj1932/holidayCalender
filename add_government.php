<?php
include 'crud.php';
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
    div.list {
        background-color:  #ebebeb;

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
                         
                            <div class="x_content">
                                <div class='row'>
                                    <div class='col-md-12 col-sm-12'>
                                        <form action="add_academic_code.php" method="post" id="category_form"
                                            enctype="multipart/form-data">
                                            <input type="hidden" value="government_calender"
                                                name="government_calender" />
                                            <div class="form-group row">
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="name">Date</label>
                                                    <input type="date" id="datepicker" name="date" required
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="image">Title</label>
                                                    <input type='text' name="title" id="title" class="form-control" required>
                                                </div>
                                                <div class="row">
                                                <div class="col-md-6 col-sm-12">
                                                    <br>
                                                    <label for="name">State</label>
                                                    <select name="state[]" required class="form-control " id="select_multiple" multiple="multiple">
                                                        
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
                                                    <select name="month" required class="form-control" id="select_month">
                                                        <option value=''>Select Month</option>
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
                                                </div>
                                                <hr>
                                               <div class="row">
                                                
                                                <div class="col-md-6 col-sm-12">
                                                    
                                                    <label for="image">Image</label>
                                                    <input type='file' name="image" id="image" class="form-control" accept="image/*">
                                                </div>
                                                  <div class="col-md-6 col-sm-12">
                                                    
                                                    <label for="image">Link</label>
                                                    <input type='text' name="link"  class="form-control" >
                                                </div>
                                                
                                                <div class="col-md-12 col-sm-12">
                                                    
                                                    <label for="name">Description</label>
                                                    <input type="text" id="description" name="description"
                                                        class="form-control" >
                                                </div>
                                                </div>
                                                <hr>
                                                <div class="form-group mx-5">
                                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                                        
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
                                            <h2>Government Calender<small>View / Update / Delete</small></h2>
                                            
                                                <div class='col-md-4'>
                                                    <select id='filter_state' class='form-control' required>
                                                        <option value="">Select State</option>
                                                        <?php
                                                        $sql="SELECT * FROM `state`";
                                                        $res=mysqli_query($conn,$sql);
                                                        while($row=mysqli_fetch_assoc($res)){
                                                            ?>
                                                       
                                                            <option value='<?= $row['state_name'] ?>'><?= $row['state_name'] ?></option>
                                                        <?php
                                                       }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class='col-md-4'>
                                                    <select id='filter_month' class='form-control' required>
                                                        <option value="">Select Month</option>
                                                        <?php
                                                        $sql="SELECT * FROM `month`";
                                                        $res=mysqli_query($conn,$sql);
                                                        while($row=mysqli_fetch_assoc($res)){
                                                            ?>
                                                       
                                                            <option value='<?= $row['month_name'] ?>'><?= $row['month_name'] ?></option>
                                                        <?php
                                                       }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class='col-md-4'>
                                                    <button class='btn btn-primary btn-block' id='filter_btn'>Filter Calender</button>
                                                </div>
                                           
                                            <div class='col-md-12'><hr><a href="add_government.php" class="btn btn-success">Refresh</a></div>
                                        </div>
                                 <div class='col-md-12 col-sm-12'>
                

                                            <div class='row'>
                                                <div id="toolbar">
                                                    <button class="btn btn-danger btn-sm" id="delete_multiple_categories" title="Delete Selected Categories"><em class='fa fa-trash'></em></button>
                                                </div> 
                                               
                                                <table aria-describedby="mydesc" class='table-striped' id='category_list'
                                                       data-toggle="table" data-url="get-list.php?table=government"
                                                       data-click-to-select="true" data-side-pagination="server"
                                                       data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200,400,800,1200,1600]"
                                                       data-search="false" data-show-columns="true"
                                                       data-show-refresh="false" data-trim-on-search="false"
                                                       data-sort-name="id" data-sort-order="asc"
                                                       data-toolbar="#toolbar" data-mobile-responsive="true" data-maintain-selected="true"    
                                                       data-show-export="true" data-export-types='["txt","excel"]'
                                                       data-export-options='{
                                                            "fileName": "category-list-<?= date('d-m-y') ?>",
                                                            "ignoreColumn": ["state"]	
                                                       }'
                                                      data-query-params="queryParams" >
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" data-field="state" data-checkbox="true"></th>
                                                            <th scope="col" data-field="id" data-sortable="false">ID</th>
                                                            
                                                            <!--<th scope="col" data-field="row_order" data-visible='false' data-sortable="true">Order</th>-->
                                                            <th scope="col" data-field="title" data-sortable="true">Title</th> 
                                                            <th scope="col" data-field="state_1" data-sortable="true" >State</th>
                                                            <th scope="col" data-field="month" data-sortable="true">Month</th>
                                                            <th scope="col" data-field="date" data-sortable="yes">Date</th>
                                                            <th scope="col" data-field="description" data-sortable="false">Description</th>
                                                            <th scope="col" data-field="link" >Link</th>
                                                            <th scope="col" data-field="image" data-sortable="false">Image</th>
                                                            <th scope="col" data-field="operate" data-events="actionEvents">Operate</th>
                                                            
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id='editCategoryModal' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                <div class="modal-dialog modal-md" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Government Calender</h4>
                        </div>
                        <div class="modal-body">
                            <form id="update_form"  method="POST" action ="add_academic_code.php" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                <input type="hidden" id="id_1" name="id">
                               <input type="hidden" name="update_government_calender" value="update_government_calender">
                                   
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="name">Date</label>
                                                    <input type="date" id="date_1" name="date" required
                                                        class="form-control">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="image">Title</label>
                                                    <input type='text' name="title" id="title_1" class="form-control">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <br>
                                                    <label for="name">State</label>
                                                    <select name="state" id="state" required class="form-control">
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
                                                    <label for="name">Month</label>
                                                    <select name="month" id="month" required class="form-control">
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
                                                    <label for="image">Image</label>
                                                    <input type="hidden"  name="old_image" id="old_image" >
                                                    <img id="image_2" height="30" width="30">
                                                        
                                                   
                                                    <input type='file' name="image" id="update_image" class="form-control" accept="image/*">
                                                </div>
                                                <div class="col-md-6 col-sm-12">
                                                    <br>
                                                    <label for="link">Link</label>
                                                    <input type="text" name="link" id="update_link" class="form-control">
                                                </div>
                                                <div class="col-md-12 col-sm-12">
                                                    <br>
                                                    <label for="desc">Description</label>
                                                    <textarea name="description" id="description_1"  class="form-control " ></textarea>
                                                </div>
                                  <hr>            
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                        <button type="submit" id="update_btn" class="btn btn-success">Update</button>
                                    </div>
                                </div>
                            </form>
                            <div class="row"><div  class="col-md-offset-3 col-md-8" style ="display:none;" id="update_result"></div></div>
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
    $( document ).ready(function() {
     $('#category_list').bootstrapTable('refresh');
$('#select_multiple').select2();
     
});

</script>
 <script>
            $('#filter_btn').on('click', function (e) {
                $('#category_list').bootstrapTable('refresh');
            });
            $('#delete_multiple_categories').on('click', function (e) {
                sec = 'government';
                
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
                            url: "add_academic_code.php",
                            data: 'delete_multiple=1&ids=' + ids + '&sec=' + sec,
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
        var desc='';
            window.actionEvents = {
                'click .edit-category': function (e, value, row, index) {
                    // alert('You click remove icon, row: ' + JSON.stringify(row));
                    
                    console.log(row);
                    var regex = /<img.*?src="(.*?)"/;
                    var src = regex.exec(row.image)[1];
                    console.log(src);
                   $('#id_1').val(row.id);
                    $('#state').val(row.state_1);
                    $('#month').val(row.month);
                     $('#date_1').val(row.date);
                    $('#title_1').val(row.title);
                    // $('#description_1').val(row.description);
                    tinyMCE.get('description_1').setContent(row.description);
                    $('#update_link').val(row.link);
                    $('#old_image').val(row.img_url);
                    $('#image_2').attr('src','government_image/'+row.img_url);
                   
                     
                    
                }
            };
        </script>
        <!--<script>-->
        <!--    $('#update_form').on('submit', function (e) {-->
        <!--        e.preventDefault();-->
        <!--        var formData = new FormData(this);-->
        <!--        if ($("#update_form").validate().form()) {-->
        <!--            $.ajax({-->
        <!--                type: 'POST',-->
        <!--                url: $(this).attr('action'),-->
        <!--                data: formData,-->
        <!--                beforeSend: function () {-->
        <!--                    $('#update_btn').html('Please wait..');-->
        <!--                },-->
        <!--                cache: false,-->
        <!--                contentType: false,-->
        <!--                processData: false,-->
        <!--                success: function (result) {-->
        <!--                    $('#update_result').html(result);-->
        <!--                    $('#update_result').show().delay(3000).fadeOut();-->
        <!--                    $('#update_btn').html('Update');-->
        <!--                    $('#update_image').val('');-->
                            <!--$('#update_form')[0].reset();-->
        <!--                    $('#category_list').bootstrapTable('refresh');-->
        <!--                    setTimeout(function () {-->
        <!--                        $('#editCategoryModal').modal('hide');-->
        <!--                    }, 4000);-->
        <!--                }-->
        <!--            });-->
        <!--        }-->
        <!--    });-->
        <!--</script>-->
                    <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                selector: '#description_1',
                height: 150,
                menubar: true,
                plugins: [
                    'advlist autolink lists charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime table contextmenu paste code help wordcount'
                ],
                toolbar: 'insert | undo redo |  formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                setup: function (editor) {
                    editor.on("change keyup", function (e) {
                        editor.save();
                        $(editor.getElement()).trigger('change');
                    });
                }
            });
        });
    </script>
       <script type="text/javascript">
        $(document).ready(function () {
            tinymce.init({
                selector: '#description',
                height: 150,
                menubar: true,
                plugins: [
                    'advlist autolink lists charmap print preview anchor textcolor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime table contextmenu paste code help wordcount'
                ],
                toolbar: 'insert | undo redo |  formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
                setup: function (editor) {
                    editor.on("change keyup", function (e) {
                        editor.save();
                        $(editor.getElement()).trigger('change');
                    });
                }
            });
        });
    </script>
        <script>
            function queryParams(p) {
                return {
                    "state": $('#filter_state').val(),
                    "month": $('#filter_month').val(),
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
                    name: "required",
                    select_month:"required"
                }
            });
        </script>
        <script>
            $('#category_form').on('submit', function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                if ($("#category_form").validate().form()) {
                    if (confirm('Are you sure? Want to Add calender')) {
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
                        url: 'add_academic_code.php',
                        type: "get",
                        data: 'id=' + id  + '&delete_government=1',
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