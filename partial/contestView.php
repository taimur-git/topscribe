<!--img id='contestBanner' src='images\banner.png'-->
<?php 
//$id = $_GET['id'];
$scoreString = returnScoreList($conn,$id);

?>
<!--script type="text/javascript" src="scripts/contest.js"></script-->
<div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Title</h1>
    <p class="lead">Description</p>
    <!--p>Host<p-->
    <p>Judges: 
        <span class="badge rounded-pill bg-dark">Taimur (host)</span>
        <span class="badge rounded-pill bg-dark">Tamim</span></p>
  </div>
</div>

<p>Contestants</p>
<p>Results</p>
<div class='container'>
  <canvas id="myChart"></canvas>
</div>
<p>Entries</p>

<script type="text/javascript" src="scripts/chart.js"></script>


<script>
  const ctx = document.getElementById('myChart');

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
          beginAtZero: true
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
</script>
