<?php
    function isExistRecord ($table, $whereStr) {
        $sqlStr = "select count(*) from $GLOBALS[db_sp].$table where $whereStr";
        return $GLOBALS['sp']->getOne($sqlStr) > 0 ? true : false;
    }
?>