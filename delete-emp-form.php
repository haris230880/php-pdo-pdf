<?php
include_once("connect.php");

$empno =$_GET["empno"];






$sql="DELETE FROM emp WHERE EMPNO =:empno";
// "DELETE  emp set 
// where EMPNO =:empno ";

$stmt = $conn->prepare($sql);
$stmt->bindParam(':empno',$empno);
$stmt->execute();




if($stmt){
    header("Location:search.php");
}else{
    echo"nooo";
}




?>