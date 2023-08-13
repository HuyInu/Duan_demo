<html>
<head>
    <title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(function(){
            //$('#1').prop('checked');
            // for(var i=1;i<10;i++){
            //     $('#s'+i).attr('checked','checked');
            //     var rs = $('#s'+i).val();
            //     console.log(rs);
            // }
            $(".checkall[type='checkbox']").attr("checked","checked");
        });
    </script>
</head>
<body>
    <form id="myForm" action="">
    <div>
        <input type="checkbox" value="csc" id="s1" class="checkall" />csc<br />
        <input type="checkbox" value="csc" id="s1" class="checkall" />csc<br />
        <input type="checkbox" value="mec" id="s2" class="checkall" />mec<br />
        <input type="checkbox" value="asd" id="s3" class="checkall" />mec<br />
        <input type="checkbox" value="asd" id="s4" class="checkall" />mec<br />
    </div>
    </form>
</body>
</html>

