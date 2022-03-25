<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../fonts/fonts.css">
    <link rel="stylesheet" href="../css/style.css">
	<title>Map visualisation</title>
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-wrapper  clearfix">
                <div class="header_logo">
                    <h1 class="logo--smtxt"><span class="logo--lgtxt">Countries </span>Overview</h1>
                </div>
                <div class="header_navigator">
                    <ul class="header_menu">
                        <li class="header_menu_li"><a href="../index.php" class="menu_li_links">Index</a></li>
                        <li class="header_menu_li"><a href="#" class="menu_li_links">Json routes</a></li>
                        <li class="header_menu_li"><a href="xmlRoutes.php" class="menu_li_links">Xml routes</a></li>
                    </ul>
                </div>
            </div>  
        </div>
    </header>
    <div class="datasets-nav">
                <div class=" act_hov population_link"><a href="jsonPages/populationJson.php"><div class="hover_overlay"><h1>Population</h1></div></a></div>
                <div class="act_hov obesity_link"><a href="jsonPages/obesityJson.php"><div class="hover_overlay"><h1>Obesity</h1></div></a></div>
                <div class="act_hov happiness_link"><a href="jsonPages/happinessJson.php"><div class="hover_overlay"><h1>Happiness</h1></div></a></div>
            </div>
	</div>
    
	
<script src="../vendor/jq/jquery-3.2.0.min.js"></script>
<script src="../javascript/map.js"></script>
</body>
</html>