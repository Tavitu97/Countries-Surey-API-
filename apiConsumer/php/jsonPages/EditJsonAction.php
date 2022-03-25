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

    <?php
    error_reporting(E_ERROR | E_PARSE); //giving warnings on undefined array keys, even though they are defined and working
        $country = $_GET['country']; //get country through link
        $editcurl = curl_init();
        $url = 'http://127.0.0.1:5000';
        $request_url = $url . '/' . $country;
        echo $request_url;
        curl_setopt($editcurl,CURLOPT_URL,$request_url);
        curl_setopt($editcurl,CURLOPT_HEADER, false);
        curl_setopt($editcurl,CURLOPT_RETURNTRANSFER,true);
        $informationEdit = curl_exec($editcurl);
        $informationReceivedEdit = json_decode($informationEdit,true);


        $dataArr = array();
        curl_close($editcurl);
            $information =  $informationReceivedEdit["response"]['countryOverview'];
            if(preg_match('/\bpopulation\b/', $country)){
                echo '<form action=" ", method="POST">';
                echo '<input type="text" name="country" value="'.$information['country'].'">';
                echo '<input type="text" name="population_value" value="'.$information['population_value'].'">';
                echo '<input type="text" name="yearly_change" value="'.$information['yearly_change'].'">';        
                echo '<input type="text" name="land_area" value="'.$information['land_area'].'">'; 
                echo '<input type="text" name="migrants" value="'.$information['migrants'].'">'; 
                echo '<input type="text" name="med_age" value="'.$information['med_age'].'">';
                echo '<input type="hidden" name="country_edit" value="'.$information["country"].'"/><input type="submit" name="edit" value="Edit"></form>';
                

                        
                    $dataArr = array('country' => $_POST['country'], 'population_value' => $_POST['population_value'], 'yearly_change' => $_POST['yearly_change'], 
                        'land_area' => $_POST['land_area'], 'migrants' => $_POST['migrants'], 'med_age' => $_POST['med_age']);

            }
            else if(preg_match('/\bobesity\b/', $country)){

                echo '<form action=" ", method="POST">';
                echo '<input type="text" name="country" value="'.$information['country'].'">';
                echo '<input type="text" name="both_sexes" value="'.$information['both_sexes'].'">';
                echo '<input type="text" name="male" value="'.$information['male'].'">';        
                echo '<input type="text" name="female" value="'.$information['female'].'">'; 
                echo '<input type="hidden" name="country_edit" value="'.$information["country"].'"/><input type="submit" name="edit" value="Edit"></form>';

                $dataArr = array('country' => $_POST['country'], 'both_sexes' => $_POST['both_sexes'], 'male' => $_POST['male'], 'female' => $_POST['female']);
            }
            else if(preg_match('/\bhappiness\b/', $country)){
                echo '<form action=" ", method="POST">';
                echo '<input type="text" name="rank" value="'.$information['rank'].'">';
                echo '<input type="text" name="country" value="'.$information['country'].'">';
                echo '<input type="text" name="score" value="'.$information['score'].'">';        
                echo '<input type="text" name="gdp" value="'.$information['gdp'].'">'; 
                echo '<input type="text" name="social_support" value="'.$information['social_support'].'">'; 
                echo '<input type="text" name="healthy_life_expectancy" value="'.$information['healthy_life_expectancy'].'">';
                echo '<input type="text" name="life_choices_freedom" value="'.$information['life_choices_freedom'].'">';
                echo '<input type="text" name="generosity" value="'.$information['generosity'].'">';
                echo '<input type="text" name="corruption_perception" value="'.$information['corruption_perception'].'">';
                echo '<input type="hidden" name="country_edit" value="'.$information["country"].'"/><input type="submit" name="edit" value="Edit"></form>';

                $dataArr = array('rank' => $_POST['rank'], 'country' => $_POST['country'], 'score' => $_POST['score'], 'gdp' => $_POST['gdp'], 'social_support' => $_POST['social_support'], 'healthy_life_expectancy' => $_POST['healthy_life_expectancy'], 'life_choices_freedom' => $_POST['life_choices_freedom'], 'generosity' => $_POST['generosity'], 'corruption_perception' => $_POST['corruption_perception']);
            }


            if(isset($_POST['edit'])) {
                $dataJson = json_encode($dataArr);

                print_r($dataJson);
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $request_url);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json','Content-Length: ' . strlen($dataJson)));
                
                // SET Method as a PUT
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                
                // Pass user data in POST command
                curl_setopt($ch, CURLOPT_POSTFIELDS,$dataJson);
                
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                
                // Execute curl and assign returned data
                $response  = curl_exec($ch);

                echo "<h1> Info has been updated!</h1>";
                // Close curl
                curl_close($ch);

            }
            

        ?>
    
	</div>
</body>