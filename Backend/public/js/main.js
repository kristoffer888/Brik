$("document").ready(function () {
    setInterval(function () {
        clearZones();
        for (let i = 1; i < 16; i++) {
            getFromZone(i);
        }
    }, 10000);
});

function getFromZone(zoneId) {
    $.ajax({
        url: "/brik/Backend/public/index.php/zones/timestamps?zone=" + zoneId,
        method: "GET",
        headers: {"Authorization": getAuthCookie()},
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            if(data.length > 0) {
                data.forEach(function (elem) {
                    placeToken(elem);
                });
            }
        }
    });
}

/**
 * Returns the id of the zone from the zonedata.
 * @param data The zonedata.
 * @returns {string} The HTML id.
 */
function switchSwatch(zoneString) {
    switch (zoneString) {
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

function placeToken(tokenData) {
    $("#" + switchSwatch(tokenData.zone)).append("<div class=\"img-container\"><img src=" + tokenData.icon_path + " class=\"img\" title=" + tokenData.first_name + "  style=\"width=100%\"/></div>");
}

function setAuthCookie(token) {
    Cookies.set("Authorization", "bearer " + token);
}

function getAuthCookie() {
    return Cookies.get("Authorization");
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