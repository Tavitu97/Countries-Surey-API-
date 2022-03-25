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
        $url = 'http://127.0.0.1:5000/population';
        
        curl_setopt($population,CURLOPT_URL,$url);
        
        $headers = array(
            "Accept: text/xml",//defines to accept only xml response
        );
        
        curl_setopt($population, CURLOPT_URL,$url);
        curl_setopt($population, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($population, CURLOPT_TIMEOUT, 10);
        curl_setopt($population, CURLOPT_HTTPHEADER, $headers);

        $information = curl_exec($population);//string of xml result
        $informationReceived = simplexml_load_string(curl_exec($population));
        echo $informationReceived;
        if(curl_errno($population))
            print curl_error($population);
        else
            curl_close($population);
       



        ?>

        <h1>Country Happiness</h1>
        <p>click on header to sort(asc/desc)</p>
        <div class="table">
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

                    foreach ($informationReceived->countryOverview as $information) {
                         echo '<div class="table-row">';
                        echo '<div class="table-data">'.$information->country.'</div>';
                        echo '<div class="table-data">'.$information->population_value.'</div>';        
                        echo '<div class="table-data">'.$information->yearly_change.'</div>'; 
                        echo '<div class="table-data">'.$information->land_area.'</div>'; 
                        echo '<div class="table-data">'.$information->migrants.'</div>'; 
                        echo '<div class="table-data">'.$information->med_age.'</div>'; 

                         echo '<div class="table-data"><form action="" method="POST"><a href="editXmlAction.php?country=happiness/'.$information->country.'">Edit</a>
                        <input type="hidden" name="country_delete" value="'.$information->country.'"/><input type="submit" name="delete" value="Delete"></form> </div>';
                        echo '</div>';
                    }
       
                    
                
     ?>
     </div>
    </div>
<script src="../../vendor/jq/jquery-3.2.0.min.js"></script>
<script src="../../javascript/map.js"></script>
</body>
</html>