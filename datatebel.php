<!DOCTYPE html>
<html>
<head>
  <title>haris</title>
    <meta charset="utf-8">  
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
  
  <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
  




  
  <body>
  <div ALIGN="CENTER">
    <?php include_once 'head.php';?>
    
    
</div>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
  <a class="navbar-brand" href="datatebel.php">Home</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="insrt-form.php">INSERT</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search.php">search</a>
      </li>  
    </ul>
  </div>  
</nav>
<br>


<?php
        include_once("connect.php");
        isset( $_POST['ename'] ) ?  $ename = $_POST['ename'] :  $ename = "";
        // $ename = $_POST["ename"];
        $stmt = $conn->prepare("select e.*, d.DNAME from emp e , dept d where ename like :ename and e.DEPTNO = d.DEPTNO");
        $stmt ->execute(["ename" => $ename.'%']);
        $data = $stmt->fetchAll();
        ?>


<div class="container"> 
<table id="example"class="table table-hover" style="width:100%">
        <thead>
        <tr>
                <th>รหัสพนักงาน</th>
                <th>ชื่อ</th>
                <th>ตำเเหน่ง</th>
                <th>หัวหน้า</th>
                <th>วันเริ่ม</th>
                <th>เงินเดือน</th>
                <th>คอมมิสชัน</th>
                <th>แผนก</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
           

        </tr>    
        </thead>
        <tbody>
        <?php foreach ($data as $row){ ?>
        <tr>
            <td><?=$row ['EMPNO']?></td>
            <td><?=$row["ENAME"]?></td>
            <td><?=$row ["JOB"]?> </td>
            <td><?=$row["MGR"]?></td>
            <td><?=$row ["HIREDATE"]?></td>
            <td><?=$row["SAL"]?></td>
            <td><?=$row ["COMM"]?> </td>
            <td><?=$row["DNAME"]?></td>
            <td><a href="edit-emp-form.php?empno=<?=$row["EMPNO"]?>"><button type="button" class="btn btn-success">แก้ไข</button></a></td>
            <td><a href="delete-emp-form.php?empno=<?=$row["EMPNO"]?>"onclick="return confirm ('Are you sure to delete ?')"><button type="button" class="btn btn-danger">ลบ</button></a></td>
 

        </tr>
        <?php  }  ?>
        </tbody>
<!--         
        <tfoot>
            
            <tr>
            <th>รหัสพนักงาน</th>
                <th>ชื่อ</th>
                <th>ตำเเหน่ง</th>
                <th>หัวหน้า</th>
                <th>วันเริ่ม</th>
                <th>เงินเดือน</th>
                <th>คอมมิสชัน</th>
                <th>แผนก</th>
                <th>แก้ไข</th>
                <th>ลบ</th>
            </tr>
        </tfoot> -->
    </table>
    
    </body>
    <script>    $(document).ready(function() {
    $('#example').DataTable();
} );</script>

      

</html>

