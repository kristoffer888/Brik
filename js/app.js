function get(){
    $.ajax({
        url: "/Backend/public/timestamps",
        type: "GET",
        headers: {"Authorization": "bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMiIsImV4cCI6MTU4MDk4MDc4Mn0.mWli3UWZNufs76iOY_yJj2lrifQ2FxrDC-PF4_Hc4hw"}
    },
    function(data){
        alert(data);
    });
}
//id,placedat,removetat,user_id,firstname,lastname,iconpath,name