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
    }, 14400*1000);
});

/**
 * Appends a ->array<- of briks.
 * @param {type} data The array to be looped through.
 * @returns {undefined}
 */
function appendBrik(data) {
    for(var i = 0; i < data.result.length; i++){
        //console.log(data.result[i]);
        //console.log("test")
        switch(data.result[i].student_presence_id){
            case "1":
                break;
            case "2":
                break;
            case "3":
                break;
            case "4":
                school(data.result[i]);
                break;
            case "5":
                break;
            case "6":
                break;
        }
    }
}

/**
 * Finds out whether the student is a programmer or other.
 * @param {type} data The student data.
 * @returns {undefined}
 */
function school(data){
    switch(data.education_id){
        case "1":
            programming(data);
            break;
        case "2":
            infrastructure(data);
            break;
    }
}

/**
 * Places a infrastructure student on the board.
 * @param {type} data The student data.
 * @returns {undefined}
 */
function infrastructure(data){
    switch (data.progress_id)
    {
        case "1":
            skoleBrik(data, "hfit1_");
            break;
        case "2":
            skoleBrik(data, "hfit2_");
            break
        case "3":
            skoleBrik(data, "hfit3_");
            break;
        case "4":
            skoleBrik(data, "hfit4_");
            break;
        case "5":
            skoleBrik(data, "hfit5_");
            break;
        case "6":
            //Svendeprøve ting
            break;
        default:
            console.log("Programming(): Progress id not found. Progress id: " + data.progress_id);
            break;
    }
}

/**
 * Places a programming student on the board.
 * @param {type} data The student data.
 * @returns {undefined}
 */
function programming(data){
    switch (data.progress_id)
    {
        case "1":
            skoleBrik(data, "hfprog1_");
            break;
        case "2":
            skoleBrik(data, "hfprog2_");
            break
        case "3":
            skoleBrik(data, "hfprog3_");
            break;
        case "4":
            skoleBrik(data, "hfprog4_");
            break;
        case "5":
            skoleBrik(data, "hfprog5_");
            break;
        case "6":
            //Svendeprøve ting
            break;
        default:
            console.log("Programming(): Progress id not found. Progress id: " + data.progress_id);
            break;
    }
}

/**
 * Resizes the image to fit the box.
 * @param {type} data The student data.
 * @param {type} id The HTML id.
 * @returns {undefined}
 */
function skoleBrik(data, id){
    $("#"+id).append("<div class=\"img-container\"><img title='/" + data.student_id + "' src='https://infotavle.itd-skp.sde.dk/brik/images/" + data.student_id + ".png' onerror=\"javascript:this.src='https://itd-skp.sde.dk/images/na.png'\" class=\"img\"/></div>");
    var size = 85;

    while(findAmount(document.getElementById(id), size) - 1 < document.getElementById(id).childElementCount){
        size = size - 1;
    }
    //sæt height og width på billeder i element x til size
    $("#"+id+">.img-container").css("height", size);
    $("#"+id+">.img-container").css("width", size);
}

/**
 * Finds the areal of the box and calculates how many images can fit inside.
 * @param {type} elem The box to calculate images for.
 * @param {type} size The size of the image.
 * @returns {Number} The number of images that fits.
 */
function findAmount(elem, size){
    var brikSize = size;
    var rows = Math.floor(elem.clientHeight/(brikSize+2));
    var columns = Math.floor(elem.clientWidth/(brikSize-16));
    var brikker = rows*columns;
    return brikker;
}

/**
 * Clears the boxes.
 * @returns {undefined}
 */
function clear() {
    //Infra
    $("#hfit1_").html("");
    $("#hfit2_").html("");
    $("#hfit3_").html("");
    $("#hfit4_").html("");
    $("#hfit5_").html("");
    //Prog
    $("#hfprog1_").html("");
    $("#hfprog2_").html("");
    $("#hfprog3_").html("");
    $("#hfprog4_").html("");
    $("#hfprog5_").html("");
}