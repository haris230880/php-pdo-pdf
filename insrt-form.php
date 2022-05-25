<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>insert form </title>
</head>
<style>
    body{
        text-align: center;
        background-color: steelblue;
    }
     
</style>

<body>
<div ALIGN="CENTER">
    <?php include_once 'head.php';?>
    <?php include_once 'nev.php';?>
</div>


    <br><br>
    <h1>INSERT</h1>
    <form  name="form1" id="my_form" action="insert-emp.php" method="post">
        <div class="form-group"><label for="EMPNO">
                <input type="text"class="form-control" name="empno" id="empno" placeholder="รหัสพนักงาน"></label>
        </div>
        <div class="form-group"><label for="ENAME">
                <input type="text"class="form-control" name="ename" id="ename" placeholder="ชื่อ สกุล"></label>
        </div>
        <div class="form-group"><label for="JOB">
                <input type="text"class="form-control" name="job" id="job" placeholder="ตำเเหน่ง"></label>
        </div>
        <div class="form-group">
            <label for="mgr" >หัวหน้า</label>
            <select  name="mgr" >
                <?php 
                include_once("connect.php");
                $stmt = $conn ->prepare('SELECT EMPNO,ENAME FROM emp WHERE JOB IN("PRESSIDENT","MANAGER","ANALYST");');
                $stmt -> execute();
                $data = $stmt->fetchAll();
                foreach ($data as $row) {?>
                    <option value="<?=$row['EMPNO']?>>"><?=$row['ENAME'] ?></option>
               <?php }?>
                <option value="NULL">---</option>
            </select>
           
        </div>

        <div class="form-group"><label for="HIREDATE">
                <input type="date" class="form-control"name="hiredate" id="hiredate" placeholder="วันเริ่ม"></label>
        </div>
        <div class="form-group"><label for="SAL">
                <input type="number"class="form-control" name="sal" id="sal" placeholder="เงินเดือน"></label>
        </div>
        <div class="form-group"><label for="COMM">
                <input type="number"class="form-control" name="comm" id="comm" placeholder="คอมมิสชัน"></label>
        </div>
        
        <div class="form-group"><label for="DEPTNO">
        <select name ="deptno" class="form-control" id="deptno">
            <?php 
                $stmt = $conn ->prepare('SELECT DEPTNO ,DNAME FROM dept;');
                $stmt -> execute();
                $data = $stmt->fetchAll();
                foreach ($data as $row) {?>
                <option value="<?=$row['DEPTNO']?>"><?=$row['DNAME'] ?></option>
                <?php }?>
                <!-- <option value="NULL">---</option> -->
         </select>
        </div>

        <div class="form-group"><label for="submit">
                <input type="submit" class="form-control" name="submit" id="submit" placeholder="E-mail"></label>

        </div>


    </form>
   <br>
   
<!-- <input type="redio" name="sez" value="m">man <br>
<input type="redio" name="sez" value="f" >female> -->
</body>

</html>


