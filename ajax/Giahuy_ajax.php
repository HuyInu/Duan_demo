<?php
    include_once("../maininclude.php");
    $act = (isset($_POST['act']))? $_POST['act'] : '';
    
    switch($act) {
        case 'conponent':
            $inputString = $_POST['inputString'];
            $sql = "select * from $GLOBALS[db_sp].component where name like '%$inputString%' limit 30";
            $componentList = $GLOBALS['sp']->getAll($sql);
            $html = '';
            foreach($componentList as $component) {
                $id = $component['id'];
                $name = $component['name'];
                $html .= '<a href="javascript:void(0)" onclick="insertComponent('.$id.',`'.$name.'`)">'.$name.'</a>';
            }
            echo $html;
        break;
        default:
            echo 'notyhin';
    }
?>