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
	 	$population = curl_init();
        $url = 'http://127.0.0.1:5000/population';
        
        curl_setopt($population,CURLOPT_URL,$url);
        curl_setopt($population,CURLOPT_HEADER, false);
        curl_setopt($population,CURLOPT_RETURNTRANSFER,true);
        $information = curl_exec($population);
        $informationReceived = json_decode($information,true);
        curl_close($population);

        ?>

        <h1>Country population</h1>
        <p>click on header to sort(asc/desc)</p>
        <?php
           
          if(isset($_POST['edit'])){
                    
                    if($_POST['edit']=='Edit'){
                        $population_edit = curl_init();
                        $country =str_replace(' ', '',$_POST['country_update']);
                        $url = 'http://127.0.0.1:5000/population';   
                        $request_url = $url . '/' . $country;
                        curl_setopt($population_edit,CURLOPT_URL,$request_url);
                        curl_setopt($population_edit,CURLOPT_HEADER, false);
                        curl_setopt($population_edit,CURLOPT_RETURNTRANSFER,true);
                        $informationEdit = curl_exec($population_edit);
                        $informationReceivedEdit = json_decode($informationEdit,true);
                        curl_close($population_edit);
                        
                            $dataArr = array('country'=>1,'population_value'=>1, 'yearly_change'=>1, 'land_area'=>1, 'migrants'=>1, 'med_age'=>1);
                            $informationEdit =  $informationReceivedEdit["response"]['countryOverview'];
                            echo '<form action="" method="POST">';
                            echo '<input type="text"  name="country" value="'.$informationEdit["country"].'"/>';
                            echo '<input type="text"  name="population" value="'.$informationEdit["population_value"].'"/>';
                            echo '<input type="text"  name="yearly_c" value="'.$informationEdit["yearly_change"].'"/>';
                            echo '<input type="text"  name="l_area" value="'.$informationEdit["land_area"].'"/>';
                            echo '<input type="text"  name="migrants" value="'.$informationEdit["migrants"].'"/>';
                            echo '<input type="text"  name="med_age" value="'.$informationEdit["med_age"].'"/>';
                            echo '<input type="submit" name="change" value="change Info">';
                            
                            $GLOBALS['dataJson'] = json_encode($dataArr);
                            
                    }
                    
                }
               
                if(isset($_POST['change'])){

                        $curl = curl_init();
                        $country =str_replace(' ', '',$_POST['country_update']);
                        $url = 'http://127.0.0.1:5000/population';   
                        $request_url = $url . '/' . $country;
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => $request_url,
                          CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => 'PUT',
                          CURLOPT_POSTFIELDS => $dataJson,
                          CURLOPT_HTTPHEADER => array(
                            'Accept: text/xml',
                            'Accept: application/json',
                            'Content-Type: application/json'
                          ),
                        ));
                        
                        $response = curl_exec($curl);
                        
                        curl_close($curl);
                    }
                                        

        ?>
        <div id="chartContainer" style="height: auto; width: 100%; margin-bottom:100px;"></div>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

        <div style="text-align:center; margin-top:480px;"><button><a href="popoulationTopCountriesGraphJson.php">Top Ten Countries with the highest population </a></button></div>
        <div style="text-align:center; margin-top:20px;"><button><a href="populationJson.php">Top youngest countries </a></button></div>


        <div class="table" style="margin-top:100px;">
            <div class="table-header">
                <div class="header__item"><a id="item1" class="filter__link" href="#">Country</a></div>
                <div class="header__item"><a id="item2" class="filter__link filter__link--number" href="#">Population </a></div>
                <div class="header__item"><a id="item3" class="filter__link filter__link--number" href="#">Yearly change(%)</a></div>
                <div class="header__item"><a id="item4" class="filter__link filter__link--number" href="#">Land area(Km²)</a></div>
                <div class="header__item"><a id="item5" class="filter__link filter__link--number" href="#">Migrants</a></div>
                <div class="header__item"><a id="item6" class="filter__link filter__link--number" href="#">Medium age</a></div>
                <div class="header__item"><a class="filter__link filter__link--number" href="#">Actions</a></div>
            </div>
                <div class="table-content"> 
               <?php

               if(isset($_POST['delete'])) {
                        if ($_POST['delete'] == 'Delete') {
                            // edit the post with $_POST['id']
                            $country =str_replace(' ', '',$_POST['country_delete']);
                            $url = 'http://127.0.0.1:5000/population';
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

            if($information['population_value'] != 0 && $information['land_area'] !=0)
            {
            $density = $information['population_value'] / $information['land_area'];
            }
            //echo $density;
           if($density <  10)
            {
               array_push($dataPoints1,array("y" => $density,"label" => $information['country']));
            }


                 //insert data from json
                 echo '<div class="table-row">';
                 echo '<div class="table-data">'.$information['country'].'</div>';
                 echo '<div class="table-data">'.$information['population_value'].'</div>';
                 echo '<div class="table-data">'.$information['yearly_change'].'</div>';        
                 echo '<div class="table-data">'.$information['land_area'].'</div>'; 
                 echo '<div class="table-data">'.$information['migrants'].'</div>'; 
                 echo '<div class="table-data">'.$information['med_age'].'</div>';
                 echo '<div class="table-data"><form action="" method="POST">
                 <a href="editJsonAction.php?country=population/'.$information['country'].'">Edit</a>
                <input type="hidden" name="country_delete" value="'.$information["country"].'"/><input type="submit" name="delete" value="Delete"></form> </div>';
                 echo '</div>';

        }
                    
                 echo json_encode($dataPoints1);   
                
	 ?>
	 </div>
    </div>
<script src="../../vendor/jq/jquery-3.2.0.min.js"></script>
<script src="../../javascript/map.js"></script>
<script>
        window.onload = function()
        {
        
            var chart1 = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                title:{
                    text: "Countries with the highest population density"
                },
                axisY: {
                    title: "Density = Population / Land Area",
                    includeZero: true,
                    prefix: "",
                    suffix:  ""
                },
                data: [{
                    type: "bar",
                    yValueFormatString: "",
                    indexLabel: "{y}",
                    indexLabelPlacement: "inside",
                    indexLabelFontWeight: "bolder",
                    indexLabelFontColor: "white",
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                }]
        });
        chart1.render();
 
       }
</script>
</body>
</html>