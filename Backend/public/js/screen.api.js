$(document).ready(function () {
    getUsersFromZoneById()
});

var apiDat = [];

function getUsersFromZoneById() {

    $.ajax({
        url: '/brik/Backend/core/Route/FetchAPI.php',
        type: 'POST',
        dataType: 'json',
        success: function (apiData) {
            apiDat = apiData;
            $.ajax({
                url: "/brik/Backend/public/index.php/users",
                method: "GET",
                headers: {"Authorization": getAuthCookie()},
                success: function (data) {
                    data = JSON.parse(data);
                    console.log(apiDat);
                    for (let j = 0; j < data.length; j++) {
                        for (let i = 0; i < apiDat.result.length; i++) {
                            if (apiDat.result[i].student_id == data[j].user_id) {
                                displayUserIcon(apiDat.result[i], data[j]);
                                console.log(apiDat.result[i].student_id);
                                hasFive(apiDat.result[i], data[j]);
                            }
                        }
                    }
                }
            });
        }
    });
}

function findAmount(elem) {
    var brikSize = 100;
    var rows = Math.floor(elem.clientHeight / (brikSize + 2));
    var columns = Math.floor(elem.clientWidth / (brikSize - 16));
    var brikker = rows * columns;
    return brikker;
}

function displayUserIcon(data, datz) {
//    console.log(data);
//    console.log(datz);
//    console.log(switchSwatch(data));
    $("#" + switchSwatch(data)).append("<div class=\"img-container\"><img src=" + datz.icon_path + " class=\"img\" title=" + datz.first_name + "  style=\"width=100%\"/></div>");
}

function switchSwatch(data) {
    //TODO: In production write '4' instead of '1'.
    if (data.student_presence_id == 1) {
        switch (parseInt(data.progress_id)) {
            case 2:
                return 2;
            case 3:
                return 3;
            case 4:
                return 4;
            case 5:
                return 5;
            case 6:
                return 6;
            case 7:
                return 7;
            default:
                return 0x1337;
        }
    }
}

function hasFive(data, datz) {
    if (data.student_presence_id != 4)
        return;

    $("#tillykke").append("<div class=\"img-container\"><img src=" + datz.icon_path + " class=\"img\" title=" + datz.first_name + "  style=\"width=100%\"/></div>");
}