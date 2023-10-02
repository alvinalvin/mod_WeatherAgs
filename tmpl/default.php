<?php
// linea de seguridad
defined('_JEXEC') or die;
// objecto document
$doc = JFactory::getDocument();
// validando medidas de unidad

if ($units==0) {
  $celcius = "metric";
  $celcius_unidad = "C";
}
else {
  $celcius = "";
  $celcius_unidad = "";

}

if ($units==1) {
  $fahrenheits = "imperial";
  $fahrenheits_unidad = "F";
}

else {
  $fahrenheits = "";
  $fahrenheits_unidad = "";
}
// agregando esilos
$style = '
.report-container  {
    border: #E0E0E0 1px solid;
    padding: 20px 40px 40px 40px;
    border-radius: 2px;
    width: 250px;
    margin: 0 auto;
		}
.report-container .h2 {
	font-size: 23px;
}

.weather-icon {
    vertical-align: middle;
    margin-right: 20px;
}

.weather-forecast {
    font-size: 1.2em;
    font-weight: bold;
    margin: 20px 0px;
}

span.min-temperature {
    margin-left: 15px;
}

.time {
    line-height: 25px;
}';
$doc->addStyleDeclaration($style);
$googleApiUrl = "http://api.openweathermap.org/data/2.5/weather?id=" .$id_city
. "&lang=en&units=$celcius$fahrenheits&APPID=" .$api_key ;

$ch = curl_init();

curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $googleApiUrl);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);

curl_close($ch);
$data = json_decode($response);
$currentTime = time();
?>




    <div class="report-container" style="background:<?php echo $color; ?>;color:<?php echo $font_color; ?>;">
        <h2 class="h2"><?php echo $data->name; ?></h2>
        <div class="time">
            <div><?php echo date("l g:i a", $currentTime); ?></div>
            <div><?php echo date("jS F, Y",$currentTime); ?></div>
            <div><?php echo ucwords($data->weather[0]->description); ?></div>
        </div>
        <div class="weather-forecast" style="color:<?php echo $font_color ; ?>;">
            <img
                src="http://openweathermap.org/img/w/<?php echo $data->weather[0]->icon; ?>.png"
                class="weather-icon" /><br> <?php echo $data->main->temp_max; ?>&deg;
                <?php echo $celcius_unidad ; ?><?php echo $fahrenheits_unidad; ?><span
                class="min-temperature" style="color:<?php echo $font_color ; ?>;" >
                <?php echo $data->main->temp_min; ?>&deg;<?php echo $celcius_unidad ; ?>
                <?php echo $fahrenheits_unidad; ?></span>
        </div>
        <div class="time">
            <div>Humidity: <?php echo $data->main->humidity; ?> %</div>
            <div>Wind: <?php echo $data->wind->speed; ?> km/h</div>
        </div>
    </div>
