<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../../css/reset.css">
    <link rel="stylesheet" href="../../fonts/fonts.css">
    <link rel="stylesheet" href="../../css/style.css">
	<title>Map visualisation</title>
</head>
<body>
   <?php include '../../header.php';?>
    <div class="banner"></div>
	</div>
    
	 <?php
     $dataPoints1 = [];
     $dataPoints2 = [];
	 	$population = curl_init();
        $url = 'http://127.0.0.1:5000/obesity';
        
        curl_setopt($population,CURLOPT_URL,$url);
        curl_setopt($population,CURLOPT_HEADER, false);
        curl_setopt($population,CURLOPT_RETURNTRANSFER,true);
        $information = curl_exec($population);
        $informationReceived = json_decode($information,true);
        curl_close($population);

        ?>
         
         <div id="chartContainer" style="height: auto; width: 100%; margin-bottom:100px;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <div style="text-align:center; margin-top:480px;"><button><a href="obesityJson.php">Countries with the biggest obesity</a></button></div>

        <h1>Country Obesity</h1>
        <p>click on header to sort(asc/desc)</p>
        <div class="table">
            <div class="table-header">
                <div class="header__item"><a id="item1" class="filter__link" href="#">Country</a></div>
                <div class="header__item"><a id="item3" class="filter__link filter__link--number" href="#">Both Sexes</a></div>
                <div class="header__item"><a id="item4" class="filter__link filter__link--number" href="#">Male</a></div>
                <div class="header__item"><a id="item5" class="filter__link filter__link--number" href="#">Female</a></div>
                <div class="header__item"><a class="filter__link filter__link--number" href="#">Actions</a></div>
            </div>
                <div class="table-content"> 
               <?php

               if(isset($_POST['delete'])) {
                        if ($_POST['delete'] == 'Delete') {
                            // edit the post with $_POST['id']
                            $country =str_replace(' ', '',$_POST['country_delete']);
                            $url = 'http://127.0.0.1:5000/obesity';
                            $request_url = $url . '/' . $country;

                            $delete = curl_init($request_url);
                            curl_setopt($delete,CURLOPT_RETURNTRANSFER,true);
                            curl_setopt($delete,CURLOPT_URL,$request_url);
                            curl_setopt($delete, CURLOPT_CUSTOMREQUEST, 'DELETE');
                            curl_setopt($delete,CURLOPT_HEADER, false);
                            
                            $response = curl_exec($delete);
                            curl_close($delete);
                            
                            echo $response . PHP_EOL;
                        }
                    }

        for($i = 0; $i < count($informationReceived['response']); $i++){
            $information =  $informationReceived["response"][$i]['countryOverview'];

            if($information['both_sexes'] > 40 && $information['both_sexes'] != NULL)
            {
               array_push($dataPoints1,array("label" => $information['country'],"y" => $information['male']));
               array_push($dataPoints2,array("label" => $information['country'],"y" => $information['female']));
            }

                 //insert data from json
                 echo '<div class="table-row">';
                 echo '<div class="table-data">'.$information['country'].'</div>';
                 echo '<div class="table-data">'.$information['both_sexes'].'</div>';
                 echo '<div class="table-data">'.$information['male'].'</div>';        
                 echo '<div class="table-data">'.$information['female'].'</div>'; 

                 echo '<div class="table-data"><form action="" method="POST"><a href="editJsonAction.php?country=obesity/'.$information['country'].'">Edit</a>
                <input type="hidden" name="country_delete" value="'.$information["country"].'"/><input type="submit" name="delete" value="Delete"></form> </div>';
                 echo '</div>';

        }
                    
                    
                
	 ?>
	 </div>
    </div>
<script src="../../vendor/jq/jquery-3.2.0.min.js"></script>
<script src="../../javascript/map.js"></script>
<script>
            window.onload = function () {
        
        var chart = new CanvasJS.Chart("chartContainer", {
            animationEnabled: true,
            theme: "light2",
            title:{
                text: "Comparasion between male and female obesity in the countries with the biggest obesity among their citizens"
            },
            axisY:{
                includeZero: true
            },
            legend:{
                cursor: "pointer",
                verticalAlign: "center",
                horizontalAlign: "right",
                itemclick: toggleDataSeries
            },
            data: [{
                type: "column",
                name: "Male",
                indexLabel: "{y}",
                yValueFormatString: "#0.##",
                showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints1); ?>
            },{
                type: "column",
                name: "Female",
                indexLabel: "{y}",
                yValueFormatString: "#0.##",
                showInLegend: true,
                dataPoints: <?php echo json_encode($dataPoints2); ?>
            }]
        });
        chart.render();
        
        function toggleDataSeries(e){
            if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                e.dataSeries.visible = false;
            }
            else{
                e.dataSeries.visible = true;
            }
            chart.render();
        }
        
        }
</script>
</body>
</html>