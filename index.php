<?php
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
$env = parse_ini_file('questions.env');
$cathis = explode(',',$env['CATEGORIES']);
unset($env['CATEGORIES']);

$questis = array();
foreach ($env as $key=>$val){
    $questis[$key] = $val;
}
#print_r($questis);

echo '<!DOCTYPE html>
<html lang=""><head>
  <meta charset="UTF-8" />
  <title>Hello, world!</title>
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <meta name="description" content="" />
  <style>/* DivTable.com */
.divTable{display: table;width: 100%;height: 90vh;}
.divTableRow {display: table-row;}
.divTableCell {border: 1px solid #999999;display: table-cell;padding: 3px 10px;}
.divTableHead {border: 1px solid #999999;display: table-cell;padding: 3px 10px;
                background-color: #EEE;font-weight: bold;}
.divTableFoot {background-color: #EEE;display: table-footer-group;font-weight: bold;}
.divTableBody { display: table-row-group;}
#content{display: flex;padding: 10px;}
.custom-alert {display: none;position: fixed;z-index: 1000;left: 0;top: 0;width: 100%;height: 100%;overflow: auto;background-color: rgba(0, 0, 0, 0.4);}
.custom-alert-content {background-color: #fefefe;padding: 20px;border: 1px solid #888;width: 80vw;height: 60vh;margin: 9vw;border-radius: 8px;position: relative;}
.close {color: #aaa;float: right;font-size: 28px;font-weight: bold;}
#alertMessage {color: #45a049;font-size: 5vw;}
</style></head>
<body>
  <h2>TABS-UCC Workshop Quizzi 🎃</h2>
<div id="content">
<div class="divTable">
<div class="divTableBody">
<div class="divTableRow">';
foreach ($cathis as $cat) {
    echo '<div class="divTableHead">'.$cat.'</div>';
}

for ($i=1;$i<=5;$i++) {
    echo '</div><div class="divTableRow">';
    foreach ($questis as $key=>$val) {
        if (preg_match('/Q'.$i.'00/',$key,$matches,PREG_UNMATCHED_AS_NULL)){
        #echo '<div class="divTableCell"><button onclick="alert(`'.$val.'`)">'.$matches[0].'</button></div>';
        $ansi = preg_replace('/Q/','A',$key);
        echo '<div class="divTableCell"><button onclick="alerterdan(`';
        echo $val.'`,`'.$questis[$ansi].'`)">'.substr($matches[0],1).'</button></div>';
        }
    }   
}

echo '<div id="customAlertBox" class="custom-alert">
    <div class="custom-alert-content"> <span class="close">&times;</span>
    <p id="alertMessage"></p></div></div>';
echo ' <script>
        let alertBox =
            document.getElementById("customAlertBox");
        let alert_Message_container =
            document.getElementById("alertMessage");
        let custom_button =
            document.querySelector(".custom-button");
        let close_img =
            document.querySelector(".close");
        let body =
            document.querySelector("body");

        function alerterdan (messageda,ansada) {
                alert_Message_container.innerHTML =
                    messageda+"<button onclick=\"alert(`"+ansada+"`)\">L&ouml;sung</button>" ;
                alertBox.style.display = "block";
            };

        close_img.addEventListener
            (`click`, function () {
                alertBox.style.display = "none";
            });
    </script>';

echo '</div>
</div>
</div>
<!-- DivTable.com -->
</div></body>
</html>';
