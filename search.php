<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">  
   
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    </head>
    
<style>
    body{
        text-align: center;
        /* background-color: steelblue; */
    }
    
</style>


<body>
<?php include_once 'head.php';?>
 <?php include_once 'nev.php';?>



<div class="container">
    <div class="form-group" >
     <form name="form1"  id="my_form" action="" method="post" ><br>
      <h1> SEARCH NAME:</h1>
       <input type="text" name="txt_search" placeholder="search"  class="form-control" >
        <input type="submit" value="search"class="btn btn-primary btn-sm"> <br>   
    </div>

        <!-- <form name="login" action="connect.php" method="post"> -->
      
        </form>

        <?php
        include_once("connect.php");
        isset( $_POST['txt_search'] ) ?  $txt_search = $_POST['txt_search'] :  $txt_search = "";
        // $ename = $_POST["ename"];
        $stmt = $conn->prepare("select e1.*,e2.ENAME AS MGR, d.DNAME from emp e1 
        inner join dept d 
        on e1.DEPTNO = d.DEPTNO
        LEFT OUTER JOIN emp e2 
        on e2.EMPNO = e1.MGR
        where (e1.ENAME like :txt_search 
        or e1.EMPNO like :txt_search
        or e1.JOB like :txt_search
        or d.DNAME like :txt_search)");
        $stmt ->execute(["txt_search" => $txt_search.'%']);
        $data = $stmt->fetchAll();
        ?>
        <div>

        <div class="container">
        <table  class="table table-hover" >
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
    <?php foreach ($data as $row){ ?>
        <tr>
            <td><?=$row ['EMPNO']?></td>
            <td><?=$row["ENAME"]?></td>
            <td><?=$row ["JOB"]?> </td>
            <td><?=$row["MGR"]?></td>
            <td><?=$row ["HIREDATE"]?></td>
            <td><?=number_format($row["SAL"],2)?></td>
            <td><?=number_format($row ["COMM"])?> </td>
            <td><?=$row["DNAME"]?></td>
            <td><a href="edit-emp-form.php?empno=<?=$row["EMPNO"]?>">แก้ไข</a></td>
            <td><a href="delete-emp-form.php?empno=<?=$row["EMPNO"]?>"onclick="return confirm ('Are you sure to delete ?')">ลบ</a></td>

        </tr>
        <?php  }  ?>
</table>
</div> 
</div>   
        </body>

</html>

