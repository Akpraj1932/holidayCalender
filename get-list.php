<?php
session_start();
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("location:index.php");
    return false;
    exit();
}
header("Content-Type: application/json");
header("Expires: 0");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include 'crud.php';
include 'functions.php';
$db = new Database();
$db->connect();

$fn = new Functions();
$config = $fn->get_configurations();

if (isset($config['system_timezone']) && !empty($config['system_timezone'])) {
    date_default_timezone_set($config['system_timezone']);
} else {
    date_default_timezone_set('Asia/Kolkata');
}
if (isset($config['system_timezone_gmt']) && !empty($config['system_timezone_gmt'])) {
    $db->sql("SET `time_zone` = '" . $config['system_timezone_gmt'] . "'");
} else {
    $db->sql("SET `time_zone` = '+05:30'");
}

$db->sql("SET NAMES 'utf8'");

if(isset($_GET['table'])&& $_GET['table']=='government'){
    $offset = 0;
    $limit = '';
    $sort = 'id';
    $order = 'ASC';
    $where = " WHERE id >= '0' ";
    $table = $_GET['table'];
    

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        // if ($sort == 'row_order')
        //     $sort = '`row_order` + 0 ';
    }
    if (isset($_GET['offset']))
        $offset = $_GET['offset'];
    if (isset($_GET['limit']))
        $limit = $_GET['limit'];
    if (isset($_GET['order']))
        $order = $_GET['order'];

    // if (isset($_GET['type']) && !empty($_GET['type'])) {
    //     $type = $_GET['type'];
    //     $where = ' WHERE `type` = ' . $type;
    //     if ($type == 1 || $type == '1') {
    //         $total_question = ", (SELECT count(id) FROM question WHERE question.category = c.id ) as no_of_que";
    //     }        
    //     if ($type == 2 || $type == '2') {
    //         $total_question = ", (SELECT count(id) FROM tbl_learning WHERE tbl_learning.category = c.id ) as no_of_que";
    //     }
    // }

    // if (isset($_GET['language']) && !empty($_GET['language'])) {
    //     $where .= ' AND `language_id` = ' . $_GET['language'];
    // }
//       if (isset($_GET['state'])  && isset($_GET['month'])) {
//           $state=$_GET['state'];
//           $month = $_GET['month'];
//           $where.="AND `state`='".$state."' AND `month`='".$month."'";
// }
if(isset($_GET['state']) && !empty($_GET['state'])){
    $state = $_GET['state'];
    $where.="AND `state`='".$state."'";
}
if(isset($_GET['month']) && !empty($_GET['month'])){
    $month = $_GET['month'];
    $where.="AND `month`='".$month."'";
}
    // if (isset($_GET['search'])) {
    //     $search = $_GET['search'];
    //     $where .= "OR `state` like '%" . $search . "%' OR `month` like '%" . $search . "%'";
    // }

    // $left_join = " LEFT JOIN languages l on l.id = c.language_id ";

    $sql = "SELECT COUNT(id) as total FROM `government` ";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row) {
        $total = $row['total'];
    }

    $sql = "SELECT *  FROM `government`   " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    // $sql = "SELECT * FROM `government` WHERE `state`='.$search.'";
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    $rows = array();
    $tempRow = array();
// $i = 1;
    foreach ($res as $row) {
        $image = (!empty($row['image'])) ? 'government_image/' . $row['image'] : '';
        $operate = "<a class='btn btn-xs btn-primary edit-category' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editCategoryModal' title='Edit'><i class='fas fa-edit'></i></a>";
        $operate .= "<a class='btn btn-xs btn-danger delete-category' data-id='" . $row['id'] . "' data-image='" . $image . "' title='Delete'><i class='fas fa-trash'></i></a>";

        $tempRow['id'] = $row['id'];
        $tempRow['date'] = $row['date'];
        $tempRow['title'] = $row['title'];
        $tempRow['state_1'] = $row['state'];
        $tempRow['month'] = $row['month'];
        $tempRow['link'] = $row['link'];
        $tempRow['description'] = $row['description'];
        $tempRow['img_url']  = $row['image'];
        $tempRow['image'] = (!empty($row['image'])) ? '<a href="' . $image . '" data-lightbox="Category Images"><img src="' . $image . '" height=30 ></a>' : '<img src="images/pa_icon.png" height=30>';
       
        // $tempRow['row_order'] = $row['row_order'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
        // $i++;
    }

    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
if(isset($_GET['table'])&& $_GET['table']=='pdf_calender'){
    $offset = 0;
    $limit = 10;
    $sort = '`row_order` + 0 ';
    $order = 'ASC';
    $where = '';
    $table = $_GET['table'];

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if ($sort == 'row_order')
            $sort = '`row_order` + 0 ';
    }
    if (isset($_GET['offset']))
        $offset = $_GET['offset'];
    if (isset($_GET['limit']))
        $limit = $_GET['limit'];
    if (isset($_GET['order']))
        $order = $_GET['order'];

    // if (isset($_GET['type']) && !empty($_GET['type'])) {
    //     $type = $_GET['type'];
    //     $where = ' WHERE `type` = ' . $type;
    //     if ($type == 1 || $type == '1') {
    //         $total_question = ", (SELECT count(id) FROM question WHERE question.category = c.id ) as no_of_que";
    //     }        
    //     if ($type == 2 || $type == '2') {
    //         $total_question = ", (SELECT count(id) FROM tbl_learning WHERE tbl_learning.category = c.id ) as no_of_que";
    //     }
    // }

    // if (isset($_GET['language']) && !empty($_GET['language'])) {
    //     $where .= ' AND `language_id` = ' . $_GET['language'];
    // }

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $where .= " WHERE  `state` like '%" . $search . "%'";
    }
    if(isset($_GET['state']) && !empty($_GET['state'])){
    $state = $_GET['state'];
    $where.="WHERE `state`='$state'";
}

    // $left_join = " LEFT JOIN languages l on l.id = c.language_id ";

    $sql = "SELECT COUNT(id) as total FROM `calenderpdf` ";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row) {
        $total = $row['total'];
    }

    $sql = "SELECT *  FROM `calenderpdf`   " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {
        $image = (!empty($row['pdf'])) ? 'pdf/' . $row['pdf'] : '';
        $operate = "<a class='btn btn-xs btn-primary edit-category' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editCategoryModal' title='Edit'><i class='fas fa-edit'></i></a>";
        $operate .= "<a class='btn btn-xs btn-danger delete-category' data-id='" . $row['id'] . "' data-image='" . $image . "' title='Delete'><i class='fas fa-trash'></i></a>";

        $tempRow['id'] = $row['id'];
        
        $tempRow['state_1'] = $row['state'];
        
       
        $tempRow['image'] =$row['pdf'];
        $tempRow['view']="<a class='btn btn-xs btn-primary' href='".$image."' target='_blank' value='VIEW'>VIEW</a>";
        $tempRow['row_order'] = $row['row_order'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }

    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
if(isset($_GET['table'])&& $_GET['table']=='academic_calender'){
    $offset = 0;
    $limit = 10;
    $sort = '`row_order` + 0 ';
    $order = 'ASC';
    $where = '';
    $table = $_GET['table'];

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if ($sort == 'row_order')
            $sort = '`row_order` + 0 ';
    }
    if (isset($_GET['offset']))
        $offset = $_GET['offset'];
    if (isset($_GET['limit']))
        $limit = $_GET['limit'];
    if (isset($_GET['order']))
        $order = $_GET['order'];

    // if (isset($_GET['type']) && !empty($_GET['type'])) {
    //     $type = $_GET['type'];
    //     $where = ' WHERE `type` = ' . $type;
    //     if ($type == 1 || $type == '1') {
    //         $total_question = ", (SELECT count(id) FROM question WHERE question.category = c.id ) as no_of_que";
    //     }        
    //     if ($type == 2 || $type == '2') {
    //         $total_question = ", (SELECT count(id) FROM tbl_learning WHERE tbl_learning.category = c.id ) as no_of_que";
    //     }
    // }

    // if (isset($_GET['language']) && !empty($_GET['language'])) {
    //     $where .= ' AND `language_id` = ' . $_GET['language'];
    // }

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $where .= " WHERE  `state` like '%" . $search . "%'";
    }
if(isset($_GET['state']) && !empty($_GET['state'])){
    $state = $_GET['state'];
    $where.="WHERE `state`='$state'";
}
    // $left_join = " LEFT JOIN languages l on l.id = c.language_id ";

    $sql = "SELECT COUNT(id) as total FROM `academicpdf` ";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row) {
        $total = $row['total'];
    }

    $sql = "SELECT *  FROM `academicpdf`   " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {
        $image = (!empty($row['pdf'])) ? 'academicpdf/' . $row['pdf'] : '';
        $operate = "<a class='btn btn-xs btn-primary edit-category' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editCategoryModal' title='Edit'><i class='fas fa-edit'></i></a>";
        $operate .= "<a class='btn btn-xs btn-danger delete-category' data-id='" . $row['id'] . "' data-image='" . $image . "' title='Delete'><i class='fas fa-trash'></i></a>";

        $tempRow['id'] = $row['id'];
        
        $tempRow['state_1'] = $row['state'];
        
        $tempRow['pdf_url'] = $row['pdf'];
        $tempRow['pdf'] = (!empty($row['pdf'])) ? '<a data-lightbox="Paper-Image" href="' . $image . '" ><embed src="' . $image . '" type="application/pdf" width="80px" height="80px" /></a>' : 'NO PDF';
     
        $tempRow['image'] = $row['pdf'];
        $tempRow['view']="<a class='btn btn-xs btn-primary' href='".$image."' target='_blank' value='VIEW'>VIEW</a>";
        $tempRow['row_order'] = $row['row_order'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }

    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}
// get banner integration
if(isset($_GET['table'])&& $_GET['table']=='banner'){
    $offset = 0;
    $limit = 10;
    $sort = '`row_order` + 0 ';
    $order = 'ASC';
    $where = '';
    $table = $_GET['table'];

    if (isset($_GET['sort'])) {
        $sort = $_GET['sort'];
        if ($sort == 'row_order')
            $sort = '`row_order` + 0 ';
    }
    if (isset($_GET['offset']))
        $offset = $_GET['offset'];
    if (isset($_GET['limit']))
        $limit = $_GET['limit'];
    if (isset($_GET['order']))
        $order = $_GET['order'];

    // if (isset($_GET['type']) && !empty($_GET['type'])) {
    //     $type = $_GET['type'];
    //     $where = ' WHERE `type` = ' . $type;
    //     if ($type == 1 || $type == '1') {
    //         $total_question = ", (SELECT count(id) FROM question WHERE question.category = c.id ) as no_of_que";
    //     }        
    //     if ($type == 2 || $type == '2') {
    //         $total_question = ", (SELECT count(id) FROM tbl_learning WHERE tbl_learning.category = c.id ) as no_of_que";
    //     }
    // }

    // if (isset($_GET['language']) && !empty($_GET['language'])) {
    //     $where .= ' AND `language_id` = ' . $_GET['language'];
    // }

    if (isset($_GET['search'])) {
        $search = $_GET['search'];
        $where .= " WHERE  `state` like '%" . $search . "%'";
    }
if(isset($_GET['state']) && !empty($_GET['state'])){
    $state = $_GET['state'];
    $where.="WHERE `state`='$state'";
}
    // $left_join = " LEFT JOIN languages l on l.id = c.language_id ";

    $sql = "SELECT COUNT(id) as total FROM `banner` ";
    $db->sql($sql);
    $res = $db->getResult();
    foreach ($res as $row) {
        $total = $row['total'];
    }

    $sql = "SELECT *  FROM `banner`   " . $where . " ORDER BY " . $sort . " " . $order . " LIMIT " . $offset . ", " . $limit;
    $db->sql($sql);
    $res = $db->getResult();

    $bulkData = array();
    $bulkData['total'] = $total;
    $rows = array();
    $tempRow = array();

    foreach ($res as $row) {
        $image = (!empty($row['image'])) ? 'banner_image/' . $row['image'] : '';
        $operate = "<a class='btn btn-xs btn-primary edit-category' data-id='" . $row['id'] . "' data-toggle='modal' data-target='#editCategoryModal' title='Edit'><i class='fas fa-edit'></i></a>";
        $operate .= "<a class='btn btn-xs btn-danger delete-category' data-id='" . $row['id'] . "' data-image='" . $image . "' title='Delete'><i class='fas fa-trash'></i></a>";

        $tempRow['id'] = $row['id'];
        
        // $tempRow['url'] = $row['url'];
        
       
        $tempRow['image'] = (!empty($row['image'])) ? '<a href="' . $image . '" data-lightbox="Category Images"><img src="' . $image . '" height=30 ></a>' : '<img src="images/pa_icon.png" height=30>';

        $tempRow['url']="<a class='btn btn-xs btn-success' href='".$row['url']."' target='_blank' value='VIEW'>LINK</a>";
        $tempRow['url_1']=$row['url'];
        $tempRow['row_order'] = $row['row_order'];
        $tempRow['operate'] = $operate;
        $rows[] = $tempRow;
    }

    $bulkData['rows'] = $rows;
    print_r(json_encode($bulkData));
}

?>