/**
 * Calls when the HTML and CSS has been fully loaded in the browser.
 */
$("document").ready(function () {
    $.ajax({
        url: "FetchAPI.php",
        type: "POST",
        dataType: "json",
        success: function (data) {
            appendBrik(data);
        }
    });
    setInterval(function () {
        $.ajax({
            url: "FetchAPI.php",
            type: "POST",
            dataType: "json",
            success: function (data) {
                clear();
                appendBrik(data);
            }
        });
    }, 14400 * 1000);
});

/**
 * Appends a ->array<- of briks.
 * @param {type} data The array to be looped through.
 * @returns {undefined}
 */
function appendBrik(data) {
    for (var i = 0; i < data.result.length; i++) {
        switch (data.result[i].student_presence_id) {
            case "1":
                break;
            case "2":
                break;
            case "3":
                afsluttetBrik(data.result[i], "tillykke");
                break;
            case "4":
                break;
            case "5":
                afsluttetBrik(data.result[i], "tillykke");
                break;
            case "6":
                break;
        }
    }
}

/**
 * Resizes the brik to make it fit inside the box.
 * @param {type} data The brik data.
 * @param {type} id The HTML id of the box.
 * @returns {undefined}
 */
function afsluttetBrik(data, id) {
    $("#" + id).append("<div class=\"img-container\"><img title=/" + data.student_id + " src=https://itd-skp.sde.dk/images/" + data.student_id + ".png onerror=\"javascript:this.src='https://itd-skp.sde.dk/images/na.png'\" class=\"img\"/></div>");
    var size = 85;

    while (findAmount(document.getElementById(id), size) - 1 < document.getElementById(id).childElementCount) {
        size = size - 1;
    }
    //sæt height og width på billeder i element x til size
    $("#" + id + ">.img-container").css("height", size);
    $("#" + id + ">.img-container").css("width", size);
}

/**
 * Finds the areal of the box and calculates how many images can fit inside.
 * @param {type} elem The box to calculate images for.
 * @param {type} size The size of the image.
 * @returns {Number} The number of images that fits.
 */
function findAmount(elem, size) {
    var brikSize = size;
    var rows = Math.floor(elem.clientHeight / (brikSize + 2));
    var columns = Math.floor(elem.clientWidth / (brikSize - 16));
    var brikker = rows * columns;
    return brikker;
}

/**
 * Clears the box.
 * @returns {undefined}
 */
function clear() {
    //Tillykke
    $("#tillykke").html("");
}