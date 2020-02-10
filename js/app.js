var status = 0;

$("document").ready(function () {
    get();

    getZones();
});

function get() {
    $.ajax({
        url: "/Brik/Backend/public/timestamps",
        method: "GET",
        headers: {"Authorization": "bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsImV4cCI6MTU4MTQwNTI1Mn0.-lR3ncvlM-qlKGE0KlGInbP-hUNgSBGZtMmpx3_bcAU"},
        success: function (data) {

            data = JSON.parse(data);
            console.log(data);
            status = data.zone_id;

            insert("location", "Location: " + data.name);

            var input = document.getElementsByName("zzz");
            var inputlist = Array.prototype.slice.call(input);
            inputlist.forEach(showresults);
        }});
}

function insert(id, data) {
    $("#" + id).html(data);
}

function showresults(value) {
    if (value.value === status) {
        value.style.backgroundColor = "#1c993d";
        value.style.color = "whitesmoke";
        value.style.border = "1px solid #484848";
    }
}

function setzone(caller) {
    $.ajax({
        url: "/Brik/Backend/public/register",
        method: "POST",
        headers: {"Authorization": "bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsImV4cCI6MTU4MTQwNTI1Mn0.-lR3ncvlM-qlKGE0KlGInbP-hUNgSBGZtMmpx3_bcAU"},
        data: {"zone_id": caller.value},
        success: function () {
            var input = document.getElementsByName("zzz");
            var inputlist = Array.prototype.slice.call(input);
            inputlist.forEach(buttreset);
            caller.style.backgroundColor = "#1c993d";
            caller.style.color = "whitesmoke";
            caller.style.border = "1px solid #484848";
            get();
        }
    });
}

function buttreset(value) {
    value.style.backgroundColor = "#909090";
    value.style.color = "black";
    value.style.border = "unset";
}

function getZones() {
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"1\" onclick=\"setzone(this)\">Zone 5</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"2\" onclick=\"setzone(this)\">Zone 6</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"3\" onclick=\"setzone(this)\">Programmører</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"4\" onclick=\"setzone(this)\">Serverrum</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"5\" onclick=\"setzone(this)\">Helpdesk</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"6\" onclick=\"setzone(this)\">Ekstern</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"7\" onclick=\"setzone(this)\">Fridag</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"8\" onclick=\"setzone(this)\">Check ud</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"9\" onclick=\"setzone(this)\">HF: Supp/Inf</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"10\" onclick=\"setzone(this)\">HF: Prog</button>");

}