/**
 * Calls when the HTML and CSS has been fully loaded in the browser.
 */
$("document").ready(function () {
    $.ajax({
        url: "FetchData.php",
        type: "GET",
        dataType: "JSON",
        success: function (data) {
            clear();
            appendBrik(data);
            updateText();
            //console.log(data);
        }
    });
    setInterval(function () {
        $.ajax({
            url: "FetchData.php",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                clear();
                appendBrik(data);
                updateText();
            }
        });
    }, 10 * 1000);
});

/**
 * Appends ->ALL<- briks of a specific zone.
 * @param {type} dataArray The array containing the briks.
 * @returns {undefined}
 */
function appendBrik(dataArray) {
    for (var i = 0; i < dataArray.length; i++) {
        var data = dataArray[i];
        var id = switchSwatch(data.student_location_id);

        if (id != "check ud") {
            $("#" + id).append("<div class=\"img-container\"><img title=/" + data.student_id + " src=https://itd-skp.sde.dk/images/" + data.student_id + ".png onerror=\"javascript:this.src='https://itd-skp.sde.dk/images/na.png'\" class=\"img\"/></div>");
            var size = 85;

            while (findAmount(document.getElementById(id), size) - 1 < document.getElementById(id).childElementCount) {
                size = size - 1;
            }
            //sæt height og width på billeder i element x til size
            $("#" + id + ">.img-container").css("height", size);
            //console.log("Size: " + size + ", " + findAmount(document.getElementById(id), size)+" < "+document.getElementById(id).childElementCount+data.student_id);
            $("#" + id + ">.img-container").css("width", size);
        }
    }
}

/**
 * Returns the id of the zone from the zonedata.
 * @param zoneString The zonedata.
 * @returns {string} The HTML id.
 */
function switchSwatch(zoneString) {
    switch (zoneString) {
        case "1":
            return "zone5";
        case "2":
            return "zone6";
        case "3":
            return "prog";
        case "4":
            return "serverrum";
        case "5":
            return "eksternud_";
        case "6":
            return "eksternind_";
        case "7":
            return "helpdesk";
        case "8":
            return "check ud";
    }
}

/**
 * Finds the areal of the box and calculates how many images can fit inside.
 * @param {type} elem The box to calculate images for.
 * @param {type} size The size of the image.
 * @returns {Number} The number of images that fits.
 */
function findAmount(elem, size) {
    let rows = Math.floor(elem.clientHeight / (size + 2));
    let columns = Math.floor(elem.clientWidth / (size - 16));
    return rows * columns;
}

/**
 * Updates the HTML count of current images, per box.
 * @returns {undefined}
 */
function updateText() {
    $("#oprog").html("MU7-Zone 8 (" + document.getElementById("prog").childElementCount + "/56)");
    $("#ozon6").html("MU7-Zone 6 (" + document.getElementById("zone6").childElementCount + "/59)");
    $("#ozon5").html("MU7-Zone 5 (" + document.getElementById("zone5").childElementCount + "/40)");
    $("#oekst").html("Ekstern (" + (document.getElementById("eksternind_").childElementCount + document.getElementById("eksternud_").childElementCount) + ")");
    $("#oeksti").html("Inde (" + document.getElementById("eksternind_").childElementCount + ")");
    $("#oekstu").html("Ude (" + document.getElementById("eksternud_").childElementCount + ")");
    $("#ohelp").html("MU8-Zone 37A (" + document.getElementById("helpdesk").childElementCount + "/4)");
    $("#oserv").html("MU7-Zone 9 (" + document.getElementById("serverrum").childElementCount + "/18)");
}

/**
 * Clears the zones.
 * @returns {undefined}
 */
function clear() {
    //Per
    $("#zone6").html("");
    //Boris/Søren
    $("#zone5").html("");
    //Zbiegniew
    $("#prog").html("");
    //Kenny
    $("#serverrum").html("");
    //Ekstern
    $("#eksternud_").html("");
    $("#eksternind_").html("");
    //Helpdesk
    $("#helpdesk").html("");
}


//console.log("If a elephant dies and becomes a ghost is it still heavy?");