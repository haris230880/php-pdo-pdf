<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>correct form </title>
</head>
<style>
    body{
        text-align: center;
        background-color: steelblue;
    }
     
</style>
<body>
    
<?php include_once 'nev.php';?>

    <h1>แก้ไข</h1>
    <?php
    $empno =$_GET['empno'];
    include_once("connect.php");
$sql ="select *from emp where EMPNO =:empno";
$stmt =$conn->prepare($sql);
$stmt->execute(["empno"=> $empno]);
$data =$stmt->fetch();

    ?>
    <form  name="form1" id="my_form" action="update-emp.php" method="post">
        <div class="form-group"><label for="EMPNO">
                <input type="text" class="form-control"name="empno" id="empno" readonly="1" placeholder="รหัสพนักงาน"value="<?=$empno?>"></label>
        </div>
        <div class="form-group"><label for="ENAME">
                <input type="text" class="form-control"name="ename" id="ename" placeholder="ชื่อ สกุล"value="<?=$data['ENAME']?>"></label>
        </div>
        <div class="form-group"><label for="JOB">
                <input type="text" class="form-control"name="job" id="job" placeholder="ตำเเหน่ง"value="<?=$data['JOB']?>"></label>
        </div>
        <div class="form-group">
            <label for="mgr">หัวหน้า
            <select  class="form-control" name="mgr">
                <?php 
                
                $stmt = $conn ->prepare('SELECT EMPNO,ENAME FROM emp WHERE JOB IN("PRESSIDENT","MANAGER","ANALYST");');
                $stmt -> execute();
                $data1 = $stmt->fetchAll();
                foreach ($data1 as $row) {?>
                    <option value="<?=$row['EMPNO']?>"<?php if($row['EMPNO']==$data['MGR']) echo"selected"?>><?=$row['ENAME']?></option>
               <?php }?>
             
            </select>
           
        </div>

        <div class="form-group"><label for="HIREDATE">
                <input type="date"class="form-control" name="hiredate" id="hiredate" placeholder="วันเริ่ม"value="<?=$data['HIREDATE']?>"></label>
        </div>
        <div class="form-group"><label for="SAL">
                <input type="number" class="form-control"name="sal" id="sal" placeholder="เงินเดือน"value="<?=$data['SAL']?>"></label>
        </div>
        <div class="form-group"><label for="comm">
                <input type="number" class="form-control"name="comm" id="comm" placeholder="คอมมิสชัน"value="<?=$data['COMM']?>"></label>
        </div>
        
        <div class="form-group"><label for="DEPTNO">
        <select  class="form-control" name ="deptno" id="deptno">
            <?php 
                $stmt = $conn ->prepare('SELECT DEPTNO ,DNAME FROM dept;');
                $stmt -> execute();
                $data2 = $stmt->fetchAll();
                foreach ($data2 as $row) {?>
                <option value="<?=$row['DEPTNO']?>" <?php if($row['DEPTNO']==$data['DEPTNO'])echo"selected" ?>><?=$row['DNAME'] ?></option>
                <?php }?>
                <!-- <option value="NULL">---</option> -->
         </select>
        </div>

        <button type="submit" class="btn btn-success">Success</button>

    </form>
</body>

</html>

