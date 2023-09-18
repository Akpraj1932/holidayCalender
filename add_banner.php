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
                            <div class="x_title">
                                <h2>Add Banner Url </h2>
                                <div class="clearfix"></div>
                            </div>
                            <div class="x_content">
                                <div class='row'>
                                    <div class='col-md-12 col-sm-12'>
                                        <form action="add_academic_code.php" method="post" id="add_banner"
                                            enctype="multipart/form-data">
                                            <input type="hidden" value="add_banner"
                                                name="add_banner" />
                                           
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="image">URL</label>
                                                    <input type="text" name="url" id="url" class="form-control" required>
                                                </div>
                                               
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="image">Banner Image</label>
                                                    <input type='file' name="image" id="image" class="form-control" accept="image/*" required>
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
                                 <!--<div class="row">-->
                                 <!--       <div class='col-sm-12'>-->
                                 <!--           <h2>Categories <small>View / Update / Delete</small></h2>-->
                                            
                                 <!--               <div class='col-md-4'>-->
                                 <!--                   <select id='filter_state' class='form-control' required>-->
                                 <!--                       <option value="">Select State</option>-->
                                 <!--                       // <?php
                                                        // $sql="SELECT * FROM `state`";
                                                        // $res=mysqli_query($conn,$sql);
                                                        // while($row=mysqli_fetch_assoc($res)){
                                                        //     ?>
                                                       
                                 <!--                           <option value='<?= $row['state_name'] ?>'><?= $row['state_name'] ?></option>-->
                                 <!--                   //     <?php
                                                    //   }
                                                    //     ?>
                                 <!--                   </select>-->
                                 <!--               </div>-->
                                               
                                 <!--               <div class='col-md-4'>-->
                                 <!--                   <button class='btn btn-primary btn-block' id='filter_btn'>Filter Calender</button>-->
                                 <!--               </div>-->
                                           
                                            <div class='col-md-12'><hr></div>
                                        </div>
                                <div class='col-md-12 col-sm-12'>
                

                                            <div class='row'>
                                                <!--<div id="toolbar">-->
                                                <!--    <button class="btn btn-danger btn-sm" id="delete_multiple_categories" title="Delete Selected Categories"><em class='fa fa-trash'></em></button>-->
                                                <!--</div> -->

                                                <table aria-describedby="mydesc" class='table-striped' id='category_list'
                                                       data-toggle="table" data-url="get-list.php?table=banner"
                                                       data-click-to-select="true" data-side-pagination="server"
                                                       data-pagination="true" data-page-list="[5, 10, 20, 50, 100, 200]"
                                                       data-search="true" data-show-columns="true"
                                                       data-show-refresh="true" data-trim-on-search="false"
                                                       data-sort-name="row_order" data-sort-order="asc"
                                                       data-toolbar="#toolbar" data-mobile-responsive="true" data-maintain-selected="true"    
                                                       data-show-export="false" data-export-types='["txt","excel"]'
                                                       data-export-options='{
                                                            "fileName": "category-list-<?= date('d-m-y') ?>",
                                                            "ignoreColumn": ["state"]	
                                                       }'
                                                       data-query-params="queryParams">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col" data-field="state" data-checkbox="true"></th>
                                                            <th scope="col" data-field="id" data-sortable="true">ID</th>
                                                            
                                                            <th scope="col" data-field="row_order" data-visible='false' data-sortable="true">Order</th>
                                                             
                                                            <th scope="col" data-field="url" data-sortable="true">URL</th>
                                                            <!--<th scope="col" data-field="url_1">URL_1</th>-->
                                                            <th scope="col" data-field="image" data-sortable="false">IMAGE</th>
                                                            <th scope="col" data-field="view" data-visible='false' data-sortable="false">View</th>
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
                            <h4 class="modal-title" id="myModalLabel">Edit Academic Calender</h4>
                        </div>
                        <div class="modal-body">
                            <form id="update_form"  method="POST" action ="add_academic_code.php" data-parsley-validate class="form-horizontal form-label-left" enctype="multipart/form-data">
                                
                               <input type="hidden" id="id_1" name="id">
                               <input type="hidden" name="update_banner" value="update_banner"/>
                                   
                                                 <div class="col-md-6 col-sm-12">
                                                    <label for="name">URL</label>
                                                    <input type="text" name="url" id="url_1" class="form-control" required">
                                                </div>
                                               
                                                <div class="col-md-6 col-sm-12">
                                                    <label for="image">Banner Image</label>
                                                    <input type='file' name="image" id="image" class="form-control" accept="image/*" required>
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
    $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    </script>
    <script>
    $( document ).ready(function() {
     $('#category_list').bootstrapTable('refresh');
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
                    $("#url_1").val(row.url_1);
                    $("#id_1").val(row.id);
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
                            <!--// $('#update_form')[0].reset();-->
        <!--                    $('#category_list').bootstrapTable('refresh');-->
        <!--                    setTimeout(function () {-->
        <!--                        $('#editCategoryModal').modal('hide');-->
        <!--                    }, 4000);-->
        <!--                }-->
        <!--            });-->
        <!--        }-->
        <!--    });-->
        <!--</script>-->
        <script>
            function queryParams(p) {
                return {
                    "state": $('#filter_state').val(),
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
            $('#add_banner').validate({
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
                        url: 'add_academic_code.php',
                        type: "get",
                        data: 'id=' + id + '&delete_banner=1',
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