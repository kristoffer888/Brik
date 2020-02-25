$("document").ready(function () {
    setInterval(function () {
        clearZones();
        getFromZone(1);
        getFromZone(2);
        getFromZone(3);
        getFromZone(4);
        getFromZone(5);
        getFromZone(6);
        getFromZone(7);
        getFromZone(8);
        getFromZone(9);
        getFromZone(10);
        getFromZone(11);
        getFromZone(12);
        getFromZone(13);
        getFromZone(14);
        getFromZone(15);
    }, 5000);
});

/*function get() {
    $.ajax({
        url: "/brik/Backend/public/index.php/timestamps",
        method: "GET",
        headers: {"Authorization": getAuthCookie()},
        success: function (data) {
            data = JSON.parse(data);
            clearZones();
            getFromZone(1);
            getFromZone(2);
            getFromZone(3);
            getFromZone(4);
            getFromZone(5);
            getFromZone(6);
            getFromZone(7);
            getFromZone(9);
            getFromZone(10);
        }
    });
}*/

function setAuthCookie(token) {
    Cookies.set("Authorization", "bearer " + token);
}

function getAuthCookie() {
    return Cookies.get("Authorization");
}


function findAmount(elem){
    var brikSize = 100;
    var rows = Math.floor(elem.clientHeight/(brikSize+2));
    var columns = Math.floor(elem.clientWidth/(brikSize-16));
    var brikker = rows*columns;

    return brikker;
}



function selectB(data) {
//    console.log(data);
    if (!data.length || typeof data === "string") {
        if(data.icon_path === ""){
            data.icon_path = "images/kristoffer.png";
        }
        $("#" + switchSwatch(data)).append("<div class=\"img-container\"><img src=" + data.icon_path + " class=\"img\" title=" + data.first_name + "  style=\"width=100%\"/></div>");
    } else {
        var count = 0;
        data.forEach(function (elem) {
            var amount = findAmount(document.getElementById(switchSwatch(elem)));

            if(count < amount) {
                if (elem.icon_path === "") {
                    elem.icon_path = "images/kristoffer.png";
                }
                $("#" + switchSwatch(elem)).append("<div class=\"img-container\"><img src=" + elem.icon_path + " class=\"img\" title=" + elem.first_name + " style=\"width=100%\"/></div>");
                count++;
            }
        });
    }
}

function switchSwatch(data) {
    switch (data.zone) {
        case "Fri":
            return "fri";
        case "Syg1":
            return "syg1_";
        case "Syg2":
            return "syg2_";
        case "Syg3":
            return "syg3_";
        case "Syg4":
            return "syg4_";
        case "Syg5":
            return "syg5_";
        case "Ulovligt fravær":
            return "ulovligt";
        case "MU7-Zone 5":
            return "zone5";
        case "MU7-Zone 6":
            return "zone6";
        case "MU7-Zone 8":
            return "prog";
        case "MU7-Zone 9":
            return "serverrum";
        case "MU8-37A":
            return "helpdesk";
        case "Ekstern":
            return "ekstern";
        case "Langtidssyg":
            return "langtidssyg";
    }
}

function getFromZone(zoneId) {
    $.ajax({
        url: "/brik/Backend/public/index.php/zones/timestamps?zone=" + zoneId,
        method: "GET",
        headers: {"Authorization": getAuthCookie()},
        success: function (data) {
            data = JSON.parse(data);

            if(data.length > 0) {
                if (!data.length)
                    selectB(data);
                else
                    selectB(data);
            }
        }
    });
}

function clearZones() {
    $("#fri").html("");
    $("#syg1_").html("");
    $("#syg2_").html("");
    $("#syg3_").html("");
    $("#syg4_").html("");
    $("#syg5_").html("");
    $("#langtidssyg").html("");
    $("#ulovligt").html("");
    $("#zone5").html("");
    $("#zone6").html("");
    $("#prog").html("");
    $("#serverrum").html("");
    $("#helpdesk").html("");
    $("#ekstern").html("");
}