<?php
    //include_once("../maininclude.php");
    function Giahuy_getComponentById ($conponentID)
    {
        $sql = "select * from $GLOBALS[db_sp].component where id=$conponentID";
        $component = $GLOBALS['sp']->getRow($sql);

        return $component;
    }

    function Giahuy_Insert ($table, $data) {
        $colSQL = '(';
        $valueSQL = '(';
        $index = 1;
        $dataLenght = count($data);
        foreach($data as $key => $value) {
            if($index !== $dataLenght) {
                $colSQL .= "`".$key."`,";
                $valueSQL .= "'".$value."',";
            } else {
                $colSQL .= "`".$key."`)";
                $valueSQL .= "'".$value."')";
            }
            $index++;
        }
        $sql = "insert into $GLOBALS[db_sp].$table"."$colSQL values $valueSQL";
        $GLOBALS['sp']->execute($sql);
    }

    function Giahuy_update ($table, $data, $where) {
        $valueSQL = '';
        $index = 1;
        $dataLenght = count($data);
        foreach($data as $key => $value) {
            $valueSQL .= "`$key` = '$value'";
            if($index !== $dataLenght) {
                $valueSQL .= ',';
            }
            $index++;
        }
        $sql = "update $GLOBALS[db_sp].$table set $valueSQL where $where";     
        $GLOBALS['sp']->execute($sql);
    }

    function Giahuy_delete ($table, $where) {
        $sql = "delete from $table where $where";
        $GLOBALS['sp']->execute($sql);
    }

?>