<?php
    function Giahuy_getComponentById($conponentID)
    {
        $sql = "select * from $GLOBALS[db_sp].component where id=$conponentID";
        $component = $GLOBALS['sp']->getRow($sql);

        return $component;
    }

    function Giahuy_update($alueArray, $table, $where)
    {

        
    }
?>