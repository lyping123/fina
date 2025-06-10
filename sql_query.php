<?php 
//$conn=new mysqli("localhost","root","","teaching");
    function select($table,$where,$array){
        $conn=new mysqli("localhost","root","","teaching");
        $qry="select * from ".$table." ".$where;
        $sttr=mysqli_query($conn,$qry);
        $sql="";
        $rows=0;
        $sql.="<thead>";
        $ver_head=array();
        while($fieldinfo=mysqli_fetch_field($sttr))
		{
            
            if(in_array($fieldinfo->name, $array)){
                array_push($ver_head,$rows);
                $rows++;
                continue;
                
            }
            $sql.="<th>".$fieldinfo->name."</th>";
            $rows++;
            //print_r($ver_head);
        }
        //print_r($ver_head);
        $sql.="</thead>";
        $sql.="<tbody>";
        while($result=mysqli_fetch_array($sttr)){
            
            $sql.="<tr>";

			for($i=0;$i<$rows;$i++){
                if(in_array($i, $ver_head)){
                    continue;
                }
				$sql.='<td>'.$result[$i].'</td>';
			}
            $sql.="</tr>";
            
        }
        $sql.="</tbody>";
        echo $sql;
    }
    

    function insert($table,$array){
        $conn=new mysqli("localhost","root","","teaching");
        $select="select * from ".$table;
        $sttr_select=mysqli_query($conn,$select);
        $q="(";
        while($tablehead=mysqli_fetch_field($sttr_select)){
            if($tablehead->name=="id"){
                continue;
            }
            if($q=="("){
                $q.=$tablehead->name;
            }else{
                $q.=",".$tablehead->name;
            }
        
        }
        $q.=")";

        $val="";
        foreach($array as $vals){
            if($val==""){
                $val.="'".$vals."'";
            }else{
                $val.=",'".$vals."'";
            }
        }
        $qry="insert into ".$table.$q." value(".$val.")";
        $sttr=mysqli_query($conn,$qry);

    }
?>