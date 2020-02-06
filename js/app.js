function get(){
    $.ajax({
        url: "/Backend/public/timestamps",
        method: "GET",
        headers: {"Authorization": "bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyX2lkIjoiMSIsImV4cCI6MTU4MDk5MTE4Nn0.YpZBAuvocOoyFjZ26qlKGRgYlrT5zIcjqIRYJ6n1S3w"},
    success: function(data){
        alert(data);
    }});
}
//id,placedat,removetat,user_id,firstname,lastname,iconpath,name