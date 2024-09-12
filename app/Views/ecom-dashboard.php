<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('main-content') ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Date', 'Sales', 'Orders'],
          <?php foreach($graph as $record) : ?>
          ['<?= $record['day_date']?>', <?= $record['main_total'] ?>, <?= $record['total_orders']?>],
          <?php endforeach; ?>
        ]);

        var options = {
          title: 'Company Performance',
          curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
<div class="container">
    <div class="row mt-5">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>Sales Amount Today</h6>
                    <h3>RM <?= number_format($today_data[0]['main_total'],2)?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>Sales Count Today</h6>
                    <h3><?= $today_data[0]['total_orders']?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>Sales Amount This Month</h6>
                    <h3>RM <?= number_format($month_data[0]['main_total'],2)?></h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h6>Sales Count This Month</h6>
                    <h3><?= $month_data[0]['total_orders']?></h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-12">
        
        <div class="card">
                <div class="card-body">
                    <div id="curve_chart" style="width: 900px; height: 500px"></div>

                </div>
            </div>
        
        </div>
    </div>
</div>

<?= $this->endSection() ?>