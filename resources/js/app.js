$(document).ready(()=>{
    $("forms").on("submit", function(){
        console.log($(this));
        var p = prompt("Please enter your password");
        if(p == null || p==""){
            return false;
        }else{
            if(p == "admin@123"){
                return true;
            }else{
                return false;
            }
        }
        // return confirm("Are you sure?");
    });
});