var status = 0;

$("document").ready(function () {

    if(getAuthCookie() !== undefined) {
        get();

        getZones();
    }
});

function get() {
    $.ajax({
        url: "/Backend/public/timestamps",
        method: "GET",
        headers: {"Authorization": getAuthCookie()},
        success: function (data) {

            data = JSON.parse(data);
            console.log(data);

            if(!data.zone_id)
            {
                alert(data);
                return;
            }

            status = data.zone_id;

            insert("location", "Location: " + data.name);

            const input = document.getElementsByName("zzz");
            const inputlist = Array.prototype.slice.call(input);
            inputlist.forEach(showresults);
        }});
}

function getFromZone(zoneId) {
    $.ajax({
        url: "/Backend/public/zones/timestamps?zone=" + zoneId,
        method: "GET",
        headers: {"Authorization": getAuthCookie()},
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);

        }
    });
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
        url: "/Backend/public/register",
        method: "POST",
        headers: {"Authorization": getAuthCookie()},
        data: {"zone_id": caller.value},
        success: function (data) {
            var input = document.getElementsByName("zzz");
            var inputlist = Array.prototype.slice.call(input);
            inputlist.forEach(buttreset);
            caller.style.backgroundColor = "#1c993d";
            caller.style.color = "whitesmoke";
            caller.style.border = "1px solid #484848";
            get();
        }});
}

function buttreset(value, button) {
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

function setAuthCookie(token) {
    Cookies.set("Authorization", "bearer " + token);
}

function getAuthCookie() {
    return Cookies.get("Authorization");
}

function getToken(userId) {
    $.ajax({
        url: "/Backend/public/users/token",
        method: "POST",
        data: { "user_id": ($("#" + userId).val()) },
        success: function (data) {
            setAuthCookie(data);
            window.location.href = "/dashboard.html";
        }
    })
}