<?php 
include_once("connect.php");
$sql = "select d.dname as department_name, count(e.empno) as amount from
emp e, dept d where e.deptno=d.deptno group by e.deptno";
$stmt =$conn->prepare($sql);
$stmt ->execute();
$data = $stmt->fetchAll();
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
     
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
        <?php foreach ($data as $row){ ?>
            ['<?=$row["department_name"]?>', <?=$row ["amount"]?>],
        <?php  }   ?>         
      
        ]);

        var options = {
          title: 'My Daily Activities',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart_3d" style="width: 900px; height: 500px;"></div>
  </body>
</html>