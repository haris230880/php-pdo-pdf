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
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the corechart package.
      google.charts.load('current', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Topping');
        data.addColumn('number', 'Slices');
        data.addRows([
        <?php foreach ($data as $row){ ?>
            ['<?=$row["department_name"]?>', <?=$row ["amount"]?>],
        <?php  }   ?>         
      
        ]);
        var options = {'title':'จำนวนพนักงานตามเเผนก',
                       'width':800,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
  <h1>จำนวนพนักงานตามเเผนก</h1>
    <div id="chart_div"></div>
  </body>
</html>