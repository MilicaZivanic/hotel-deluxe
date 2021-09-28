function insertUpdateRoom(){
    var room_number = $("#room_number").val();
    var room_size = $("#room_size").val();
    var num_people = $("#num_people").val();
    var num_beds = $("#num_beds").val();
    var room_cover = $("#room_cover").val();
    var roomtype = $("#roomtype option:selected").val();
    var view = $("#view option:selected").val();
    var desc = $("#desc").val();

    var numRegex = /^[0-9]*$/;
    var imageReg = /[\/.](gif|jpg|jpeg|tiff|png)$/;

    if(!numRegex.test(room_number) || (!room_number)){
        $("#room_number").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#room_number").css({"border" : "1px solid #3D4B0A"});
    }
    if(!numRegex.test(room_size) || (!room_size)){
        $("#room_size").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#room_size").css({"border" : "1px solid #3D4B0A"});
    }
    if(!numRegex.test(num_people) || (!num_people)){
        $("#num_people").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#num_people").css({"border" : "1px solid #3D4B0A"});
    }
    if(!numRegex.test(num_beds) || (!num_beds)){
        $("#num_beds").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#num_beds").css({"border" : "1px solid #3D4B0A"});
    }
    if(!imageReg.test(room_cover) || (!room_cover)){
        $("#room_cover").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#room_cover").css({"border" : "1px solid #3D4B0A"});
    }
    if(roomtype == "0"){
        $("#roomtype").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#roomtype").css({"border" : "1px solid #3D4B0A"});
    }
    if(view == "0"){
        $("#view").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#view").css({"border" : "1px solid #3D4B0A"});
    }
    if(!desc){
        $("#desc").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#desc").css({"border" : "1px solid #3D4B0A"});
    }
    return true;
}
function insertType(){
    var type = $("#roomtype").val();
    if(!type){
        $("#roomtype").css({"border" : "1px solid #AF0606"});
        console.log("jkawfnj");
        return false;
    }else{
        $("#roomtype").css({"border" : "1px solid #3D4B0A"});
    }
    return true;
}
function insertImage(){
    var room = $("#room option:selected").val();
    var image = $("#roomimage").val();

    var imageReg = /[\/.](gif|jpg|jpeg|tiff|png)$/;

    if(room == "0"){
        $("#room").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#room").css({"border" : "1px solid #3D4B0A"});
    }
    if(!imageReg.test(image) || (!image)){
        $("#roomimage").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#roomimage").css({"border" : "1px solid #3D4B0A"});
    }
    return true;
}
function insertView(){
    var view = $("#roomview").val();
    if(!view){
        $("#roomview").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#roomview").css({"border" : "1px solid #3D4B0A"});
    }
    return true;
}
function insertPrice(){
    var room = $("#room option:selected").val();
    var price = $("#roomprice").val();

    if(room == "0"){
        $("#room").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#room").css({"border" : "1px solid #3D4B0A"});
    }
    if(!price){
        $("#roomprice").css({"border" : "1px solid #AF0606"});
        return false;
    }else{
        $("#roomprice").css({"border" : "1px solid #3D4B0A"});
    }
    return true;

}