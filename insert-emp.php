 <?php
   $empno =$_POST["empno"];
   $ename = $_POST["ename"];
   $job = $_POST["job"];
   $mgr = $_POST["mgr"];
   $hiredate = $_POST["hiredate"];
   $comm = $_POST["comm"];
   $sal = $_POST["sal"];
   $deptno = $_POST["deptno"];

   include_once("connect.php");

//    echo $empno;
//    echo $ename;
//    echo $job;
//    echo $mgr;
//    echo $hiredate;
//    echo $comm;
//    echo $sal;
//    echo $deptno;
   
//    $hostname = "localhost";
//    $username = "root";
//    $password = "";
//    $dbname = "practice";
   
//    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username,$password);
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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

$sql = "insert into emp (EMPNO,ENAME,JOB,MGR,HIREDATE,SAL,COMM,DEPTNO) 
values (:empno,:ename,:job,:mgr,:hiredate,:sal,:comm,:deptno)";


 
$stmt = $conn->prepare($sql);
$stmt->execute($data);




if($stmt){
    header("Location:insrt-form.php");
}else{
    echo"nooo";
}
 
 
 
 ?>

