function get() {
    $.ajax({
        url: "/Brik/Backend/public/timestamps",
        method: "GET",
        headers: {"Authorization": "bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMiIsImV4cCI6MTU4MDk4MDc4Mn0.mWli3UWZNufs76iOY_yJj2lrifQ2FxrDC-PF4_Hc4hw"},
        success: function (data) {
            receive(data);
        }});
}

function receive(data) {
    $("#profil").html("Profil: " + data.first_name);
}

//id,placedat,removetat,user_id,firstname,lastname,iconpath,name
