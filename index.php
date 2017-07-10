<?php
    $file = file_get_contents("test.txt");
    $words = explode(" ",$file);
    $count = array_count_values(str_word_count($file, 1));
?>
<html>
    <head>
        <!--Load the AJAX API-->
        <script src="https://www.gstatic.com/charts/loader.js"></script>
        <script>

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
                    <?php foreach ($count as $k => $v){
                    echo "['".$k."', ".$v."],";
                     }?>

                ]);

                // Set chart options
                var options = {'title':'Count for each word in the text.',
                    'width':700,
                    'height':600};

                // Instantiate and draw our chart, passing in some options.
                var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
                chart.draw(data, options);
            }
        </script>
    </head>

    <body>
        <!--Div that will hold the pie chart-->
        <div id="chart_div"></div>
    </body>
</html>
