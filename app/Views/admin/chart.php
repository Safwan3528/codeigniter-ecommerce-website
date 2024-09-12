<?= $this->extend('templates/admin_layout') ?>

<?= $this->section('main-content') ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Tarikh', 'Sales', 'Orders'],
<?php foreach($res as $data) :?>
            [ <?=$data['day_date']?>, <?=$data['main_total']?>, <?=$data['total_orders']?>,  ],
<?php endforeach; ?>
        //   ['1/3',  1000, 999],
        //   ['2/3',  1170,777],
        //   ['3/3',  660, 111],
        //   ['4/5',  1030,333]
        ]);

        var options = {
          title: 'Jualan Harian',
          //curveType: 'function',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
<div class="container">
    <div class="row">
        <div class="col-12 mt-4 bg-white">
            <h3>Rekod Jualan</h3>

            <div id="curve_chart" style="width: 900px; height: 500px"></div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
