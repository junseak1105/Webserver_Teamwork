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
<head><?php include "include/head.php"; ?></head>
<body>
<?php
	include "include/nav_main.php"; 
	include "include/sidenav.php";
  include_once "include/visitor_count.php" //추후 index.php에만 적용
?>
<div>
  <a id="sidenav_1" href="admin_post.php">게시글관리</a>
  <a id="sidenav_2" href="admin_member.php">사용자관리</a>
  <a id="sidenav_3" href="admin_inquiry.php">문의사항관리</a>
  <a id="sidenav_4" href="admin_category.php">카테고리관리</a>
</div>
    <div>
        <canvas id="inquiry_chart" width="400" height="400"></canvas>
        <input type="hidden" id="inquiry_Y" value='<?php inquiry_Y_count(); ?>'/>
        <input type="hidden" id="inquiry_N" value='<?php inquiry_N_count(); ?>'/>
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
  })
  //문의사항 도넛 차트
  var ctx_inquiry = document.getElementById("inquiry_chart");
  var inquiry_chart = new Chart(ctx_inquiry, {
    type: 'doughnut',
    plugins: [{
      afterDraw: function(chart) {
      var width = chart.chart.width,
      height = chart.chart.height,
      ctx = chart.chart.ctx;
      ctx.restore();
      var fontSize = (height / 250).toFixed(2);
      ctx.font = fontSize + "em sans-serif";
      ctx.textBaseline = "middle";
      var percent = Math.ceil(100*($("#inquiry_Y").val()/($("#inquiry_N").val()+$("#inquiry_Y").val())));
      var text = "답변율 "+percent+"%",
        textX = Math.round((width - ctx.measureText(text).width) / 2),
        textY = height / 2;
      ctx.fillText(text, textX, textY);
      ctx.save();    
  }
    }],
    data: {
      labels: ['처리완료', '처리미완료'],
      datasets: [{
      label: 'dataset_inquiry',
      data: [$("#inquiry_Y").val(), $("#inquiry_N").val()],
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
      //cutoutPercentage: 40,
      title: {
        display: true,
        text: '문의사항 처리율'
      },
      responsive: false,
    }
  });

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

</script>