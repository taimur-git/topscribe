<!--img id='contestBanner' src='images\banner.png'-->
<?php 
//$id = $_GET['id'];
$scoreString = $obj->returnScoreList2($conn);
$labelString = "['Registered','Submitted','Marked']";
$contestParticipation = $obj->returnPieChart();
$pill=createPill($obj->typeStr[$obj->type]);
$statusStr = createPill($obj->stateStr[$obj->state],false);
$buttons = $obj->createButtons($user,$conn);
?>
<!--script type="text/javascript" src="scripts/contest.js"></script-->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4"><?php echo $obj->title;?></h1>
    <p class="lead"><?php echo $obj->description;?></p>
    <!--p>Host<p-->
    <p>Judges: 
        <span class="badge rounded-pill bg-light"><?php 
        echo "<a href='user.php?id=$obj->hostID'>$obj->hostName</a>";
        ?> (host)</span>
      <?php echo $obj->returnListOfJudges(); ?>
      <p><?php echo $pill.$statusStr;?></p>
      <div><?php echo $buttons;?></div>
  </div>
</div>
<div class='container'>
<h2>Contestants</h2>
<?php echo $obj->returnListOfContestants();?>
<h2>Results</h2>
<?php if($obj->countRegistered!=0){?>
<div class='container'>
<div class='row'>  
<div class='col'><canvas id="myChart2"></canvas></div>
  <div class='col'><canvas id="myChart"></canvas></div>
</div></div>
<?php }else{ 
  echo "<p>Statistics will show when people register.</p>";
  } ?>

<h2>Entries</h2>
<?php $obj->printEntries($conn);?>
</div>
<script type="text/javascript" src="scripts/chart.js"></script>


<script>
  const ctx = document.getElementById('myChart');
const ctx2 = document.getElementById('myChart2');
  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['0', '1', '2', '3', '4', '5','6', '7', '8', '9', '10'],
      datasets: [{
        label: '# of Contestants',
        data: <?php echo $scoreString?>,
        borderWidth: 1
      }]
    },
    options: {
        
        plugins:{
            tooltip:{
                enabled: false
        }
    },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        },
        x: {
            title: {
                color: 'black',
                display: true,
                text: 'Score'
            }
        }
      }
    }
  });
  new Chart(ctx2,{
    type: 'pie',
    data: {
      labels: <?php echo $labelString;?>,
      datasets: [
        {
          data: <?php echo $contestParticipation;?>,
          backgroundColor: [
      'rgb(255, 99, 132)',
      'rgb(54, 162, 235)',
      'rgb(255, 205, 86)'
    ],
        }
      ]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'top',
        },
        title: {
          display: true,
          text: 'Participation'
        }
      }
    },
  });
</script>
