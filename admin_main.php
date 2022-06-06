<?php 
    error_reporting( E_ALL );
    ini_set( "display_errors", 1 );

    include "include/db.php";
    include "include/common_function.php";
    
?>
<style>
    
</style>
<!DOCTYPE html>
<html>
<head>
  <?php 
    include "include/head.php"; 
    include "include/admin_sidemenu.php";
    include "include/db.php"?>;
</head>
<body>

    <div class="admin_main_chart">
        <canvas id="visit_chart" width="400" height="400"></canvas>
        <input type="hidden" id="visit_today" value='<?php visit_today(); ?>'/>
        <input type="hidden" id="visit_total" value='<?php visit_total(); ?>'/>
    </div>
    <?php include "include/footer.php" ?>
</body>
</html>
<?php
mysqli_close($conn);
?>
<script>
  $(document).ready(function(){

  //방문자 수 차트
  var ctx_visit = document.getElementById("visit_chart");
  var visit_chart = new Chart(ctx_visit,{
    type: 'bar',
    data: {
      labels: ['금일 방문자 수', '총 방문자 수'],
      datasets: [{
      data: [$("#visit_today").val(), $("#visit_total").val()],
      backgroundColor: [
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 99, 132, 0.5)'        
      ],
      borderColor: [
        'rgba(54, 162, 235, 1)',
        'rgba(255,99,132,1)'
      ],
      borderWidth: 1
    }]
    },
    options: {
      legend: {
        display: false
      },
      tooltips: {
        callbacks: {
           label: function(tooltipItem) {
              return tooltipItem.yLabel;
           }
        }
      },
      scales: {
        yAxes: [{
            ticks: {
                beginAtZero:true
            }
        }]
      },
      title: {
        display: true,
        text: '방문자 데이터'
      },
      responsive: false,
    }
  });

  })
 

</script>