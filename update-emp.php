<?php
include_once("connect.php");
$ename =$_POST["ename"];
$job =$_POST["job"];
$mgr =$_POST["mgr"];
$hiredate =$_POST["hiredate"];
$sal =$_POST["sal"];
$comm =$_POST["comm"];
$deptno =$_POST["deptno"];
$empno =$_POST["empno"];


$data =[
    'empno' =>  $empno,
    'ename' =>  $ename,
    'job' =>  $job,
    'mgr' =>  $mgr,
    'hiredate' =>  $hiredate,
    'sal' =>  $sal,
    'comm' =>  $comm,
    'deptno' =>  $deptno
    ];



$sql="update emp set 
ENAME = :ename,
JOB = :job,
MGR= :mgr,
HIREDATE= :hiredate,
SAL= :sal,
COMM= :comm,
DEPTNO= :deptno
where EMPNO =:empno ";

$stmt = $conn->prepare($sql);
$stmt->execute($data);




if($stmt){
    header("Location:search.php");
}else{
    echo"nooo";
}








?>