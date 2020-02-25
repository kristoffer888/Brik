var status = 0;

$("document").ready(function () {

    if(getAuthCookie() !== undefined) {
        get();

        getZones();
    }
});

function get() {
    $.ajax({
        url: "/brik/Backend/public/index.php/timestamps",
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
        url: "/brik/Backend/public/index.php/zones/timestamps?zone=" + zoneId,
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
        url: "/brik/Backend/public/index.php/register",
        method: "POST",
        headers: {"Authorization": getAuthCookie()},
        data: {"zone_id": caller.value},
        success: function () {
            var input = document.getElementsByName("zzz");
            var inputlist = Array.prototype.slice.call(input);
            inputlist.forEach(buttreset);
            caller.style.backgroundColor = "#1c993d";
            caller.style.color = "whitesmoke";
            caller.style.border = "1px solid #484848";
            caller.disabled = true;
            get();
        }
    });
}

function buttreset(value) {
    value.style.backgroundColor = "#909090";
    value.style.color = "black";
    value.style.border = "unset";
    value.disabled = false;
}

function getZones() {
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" title=\"Infrastruktur\" value=\"1\" onclick=\"setzone(this)\">MU7-Zone 5</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" title=\"IT-Supporter\" value=\"2\" onclick=\"setzone(this)\">MU7-Zone 6</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" title=\"Programmører\" value=\"3\" onclick=\"setzone(this)\">MU7-Zone 8</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" title=\"Serverrum\" value=\"4\" onclick=\"setzone(this)\">MU7-Zone 9</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" title=\"Helpdesk\" value=\"5\" onclick=\"setzone(this)\">MU8-37A</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"6\" onclick=\"setzone(this)\">Ekstern</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"7\" onclick=\"setzone(this)\">Syg1</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"12\" onclick=\"setzone(this)\">Syg2</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"13\" onclick=\"setzone(this)\">Syg3</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"14\" onclick=\"setzone(this)\">Syg4</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"15\" onclick=\"setzone(this)\">Syg5</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"8\" onclick=\"setzone(this)\">Langtidssyg</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"9\" onclick=\"setzone(this)\">Fri</button>");
    $("#zone-container-button").append("<button class=\"user-button-zone-panel\" name=\"zzz\" value=\"10\" onclick=\"setzone(this)\">Check ud</button>");
}

function setAuthCookie(token) {
    Cookies.set("Authorization", "bearer " + token);
}

function getAuthCookie() {
    return Cookies.get("Authorization");
}

function getToken(userId) {
    $.ajax({
        url: "/brik/Backend/public/index.php/users/token",
        method: "POST",
        data: { "user_id": ($("#" + userId).val()) },
        success: function (data) {
            setAuthCookie(data);
            window.location.href = "dashboard.html";
        }
    })
}

function createUser() {
    $.ajax({
        url: "/brik/Backend/public/index.php/users",
        method: "POST",
        data: { user_id: $("#user-id").val(), first_name: $("#first_name").val(), last_name: $("#last_name").val(), icon: $("#icon_name").val() },
        success: function (data) {
            alert("Tried creating user with response: " + data);
        }
    });
}