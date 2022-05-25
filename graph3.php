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
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
          <?php foreach ($data as $row){ ?>
            ['<?=$row["department_name"]?>', <?=$row ["amount"]?>],
        <?php  }   ?>  
        ]);

     
        var options = {
          width: 800, height: 240,
          redFrom: 9, redTo: 10,
          yellowFrom:7, yellowTo: 9,
          greenFrom:5 ,greenTo:7,
          minorTicks: 10,
          max :10 
        };
       
        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        // setInterval(function() {
        //   data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
        //   chart.draw(data, options);
        // }, 13000);
        // setInterval(function() {
        //   data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
        //   chart.draw(data, options);
        // }, 5000);
        // setInterval(function() {
        //   data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
        //   chart.draw(data, options);
        // }, 26000);
      }
    </script>
  </head>
  <body>
    <div id="chart_div" style="width: 800px; height: 240px;"></div>
  </body>
</html>