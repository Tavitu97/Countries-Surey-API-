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
	 	$population = curl_init();
        $url = 'http://127.0.0.1:5000/happiness';
        
        curl_setopt($population,CURLOPT_URL,$url);
        curl_setopt($population,CURLOPT_HEADER, false);
        curl_setopt($population,CURLOPT_RETURNTRANSFER,true);
        $information = curl_exec($population);
        $informationReceived = json_decode($information,true);
        curl_close($population);

        ?>

        <h1>Country Happiness</h1>
        <p>click on header to sort(asc/desc)</p>
        <div class="table">
            <div class="table-header">
                
                <div class="header__item"><a id="item2" class="filter__link filter__link--number" href="#">Rank</a></div>
                <div class="header__item"><a id="item1" class="filter__link" href="#">Country</a></div>
                <div class="header__item"><a id="item3" class="filter__link filter__link--number" href="#">Score</a></div>
                <div class="header__item"><a id="item4" class="filter__link filter__link--number" href="#">gdp</a></div>
                <div class="header__item"><a id="item5" class="filter__link filter__link--number" href="#">Social support</a></div>
                <div class="header__item"><a id="item6" class="filter__link filter__link--number" href="#">healthy life expectancy</a></div>
                <div class="header__item"><a id="item7" class="filter__link filter__link--number" href="#">life_choices_freedom</a></div>
                <div class="header__item"><a id="item8" class="filter__link filter__link--number" href="#">generosity</a></div>
                <div class="header__item"><a id="item9" class="filter__link filter__link--number" href="#">corruption(%)</a></div>
                <div class="header__item"><a class="filter__link filter__link--number" href="#">Actions</a></div>
            </div>
                <div class="table-content"> 
               <?php

               if(isset($_POST['delete'])) {
                        if ($_POST['delete'] == 'Delete') {
                            // edit the post with $_POST['id']
                            $country =str_replace(' ', '',$_POST['country_delete']);
                            $url = 'http://127.0.0.1:5000/happiness';
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


                 //insert data from json
                 echo '<div class="table-row">';
                 echo '<div class="table-data">'.$information['rank'].'</div>';
                 echo '<div class="table-data">'.$information['country'].'</div>';
                 echo '<div class="table-data">'.$information['score'].'</div>';        
                 echo '<div class="table-data">'.$information['gdp'].'</div>'; 
                 echo '<div class="table-data">'.$information['social_support'].'</div>';
                 echo '<div class="table-data">'.$information['healthy_life_expectancy'].'</div>';
                 echo '<div class="table-data">'.$information['life_choices_freedom'].'</div>';
                 echo '<div class="table-data">'.$information['generosity'].'</div>';
                 echo '<div class="table-data">'.$information['corruption_perception'].'</div>';

                 echo '<div class="table-data"><form action="" method="POST"><a href="editJsonAction.php?country=happiness/'.$information['country'].'">Edit</a>
                <input type="hidden" name="country_delete" value="'.$information["country"].'"/><input type="submit" name="delete" value="Delete"></form> </div>';
                 echo '</div>';

        }
                    
                    
                
	 ?>
	 </div>
    </div>
<script src="../../vendor/jq/jquery-3.2.0.min.js"></script>
<script src="../../javascript/map.js"></script>
</body>
</html>