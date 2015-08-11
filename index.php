<html>
<head>

<title> Welcome to Gibil Display </title>
</head>

<body> 

<h1> There will be some sort of recent events here </h1>

<frameset cols="15%", *
<h2> tabs for the different areas here </h2>

<h3> All of the info about a particular zone </h3>

<style>
    .eventBox{
        width: 150px;
        border: 5px solid green;
        top:5px;
        left:5px;
        bottom:5px;
        padding:5px;
    }
    .statusBox{
        width: 130px;
        height: 25px;
        position: relative;
    }
    .label{
        position:relative;
    }
</style>

<?php

    function buildContainer($category, $zone, $panel, $date, $status) {
        echo "<div class=\"eventBox\" id=",$zone,"-",$panel,">\n";
        //status box
        echo "  <div class=\"statusBox\" id=",$zone,"-",$panel,"-statusbox style=\"background-color: ";
        if ($category == 0) {
            echo "#FFFFFF";
        } else if ($category == 1){
            echo "#FFFF00";
        } else if ($category == 2){
            echo "#FF9900";
        } else if ($category == 3){
            echo "#FF6600";
        } else {
            echo "#FF0000";
        }
        echo ";\"></div>";
        echo "<div class=label id=",$zone,"-",$panel,"-zone> zone: ",$zone, "</div>";
        echo "<div class=label id=",$zone,"-",$panel,"-panel> panel: ",$panel, "</div>";
        echo "<div class=label id=",$zone,"-",$panel,"-status> status: ",$status, "</div>";
        echo "<div class=label id=",$zone,"-",$panel,"-date> time: ",$date, "</div>";
        echo "</div>\n";
    }
    buildContainer(1,"north",1,"date-time","alive")

?>

<input id="clickMe" type="button" value="clickme" onclick="update(1,'north',2,'new date','asleep');" />
<a href="#" onclick="return getUpdate();"> test </a>
<div id="output">waiting for action</div>

        <script>
        function update(panel, zone, category, date, stat) {
            alert(zone+ "-" + panel)
            document.getElementById( zone + "-" + panel + "-date").innerHTML = "time: "+ date;
            document.getElementById( zone + "-" + panel + "-status").innerHTML = "status: "+ stat;
            var color = "#FFFFFF";
            if ( category == 0 ) {
                color = "#FFFFFF";
            } else if ( category == 1 ) {
                color = "#FFFF00";
            } else if ( category == 2 ) {
                color = "#FF9900";
            } else if ( category == 3 ) {
                color = "#FF6600";
            } else {
                color = "#FF0000";
            }
            document.getElementById( zone + "-" + panel + "-statusbox").style.backgroundColor = color;
        }

        
    function updateListener(){
            getUpdate()
            window.setTimeout(updateListener, 1000)
        }

            
        function getUpdate() {
          getRequest(
              'server.php', // URL for the PHP file
               updatePanels,  // handle successful request
               updateError    // handle error
          );
          return false;
        }  
        // handles drawing an error message
        function updateError() {
            alert("Update Error!")
        }
        // handles the response, adds the html
        function updatePanels(responseText) {
            alert("We got the response "+responseText+"\n")
        }
        // helper function for cross-browser request object
        function getRequest(url, success, error) {
            var req = false;
            try{
                // most browsers
                req = new XMLHttpRequest();
            } catch (e){
                // IE
                try{
                    req = new ActiveXObject("Msxml2.XMLHTTP");
                } catch(e) {
                    // try an older version
                    try{
                        req = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch(e) {
                        return false;
                    }
                }
            }
            if (!req) return false;
            if (typeof success != 'function') success = function () {};
            if (typeof error!= 'function') error = function () {};
            req.onreadystatechange = function(){
                if(req.readyState == 4) {
                    alert(req.status)
                    return req.status === 200 ? 
                        success(req.responseText) : error(req.status);
                }
            }
            req.open("GET", url, true);
            req.send(null);
            return req;
        }

    
        </script>

</body>


</html>


