function get() {
    $.ajax({
        url: "/Brik/Backend/public/timestamps",
        method: "GET",
        headers: {"Authorization": "bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsImV4cCI6MTU4MTA4MTY4Mn0.QfbTtMam4buyx_gpkxR2VwzIn-7bNAl2vQUBLosV-jU"},
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);

            insertZone(1, 6, data);
        }
    });
}

function insertZone(startZone, endZone, data) {
    var color = "";
    var htmlString = "";

    for(var i = startZone; i <= endZone; i++) {
        if(color != "whitesmoke" || i == startZone)
            color = "whitesmoke";
        else
            color = "lightgrey";

        htmlString +=   "<div class=\"col-lg-2\" style=\"padding: 0; background-color: " + color + ";\">\n";

        htmlString +=       "<div id=\"overskrift\">\n";
        htmlString +=           "<h2>"+ "(zoneNavn)" + "</h2>\n";
        htmlString +=       "</div>";

        //For hver person der er i zonen vi er i gang med, tilføj et billede
        //htmlString +=       "<div class=\"img-container\">\n";
        //htmlString +=           "<img src=\"../images/" + "(billedeNavn)" + "\" class=\"img\" style=\"width:100%\"/>\n";
        //htmlString +=       "</div>\n";

        htmlString +=   "</div>\n";
    }
}