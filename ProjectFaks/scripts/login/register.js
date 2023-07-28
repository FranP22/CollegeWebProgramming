document.getElementById("submit").onclick = function (event) {
    var send=true;

    var fname=document.getElementById("fname");
    var lname=document.getElementById("lname");
    var uname=document.getElementById("uname");
    var pword=document.getElementById("pword");

    if(fname.value.length<4 || fname.value.length>32){
        send=false;
        document.getElementById("fname-text").innerHTML="* First name must be between 4 and 32 characters long";
        document.getElementById("fname-text").style.color="red";
        
        fname.style.borderColor="red";
    }else{
        document.getElementById("fname-text").innerHTML="";
        fname.style.borderColor="";
    }

    if(lname.value.length<4 || lname.value.length>32){
        send=false;
        document.getElementById("lname-text").innerHTML="* Last name must be between 4 and 32 characters long";
        document.getElementById("lname-text").style.color="red";

        lname.style.borderColor="red";
    }else{
        document.getElementById("lname-text").innerHTML="";
        lname.style.borderColor="";
    }

    if(uname.value.length<8 || uname.value.length>32){
        send=false;
        document.getElementById("uname-text").innerHTML="* Username must be between 8 and 32 characters long";
        document.getElementById("uname-text").style.color="red";

        uname.style.borderColor="red";
    }else{
        document.getElementById("uname-text").innerHTML="";
        uname.style.borderColor="";
    }

    if(pword.value.length<8 || pword.value.length>20){
        send=false;
        document.getElementById("pword-text").innerHTML="* Password must be between 8 and 20 characters long";
        document.getElementById("pword-text").style.color="red";

        pword.style.borderColor="red";
    }else{
        document.getElementById("pword-text").innerHTML="";
        pword.style.borderColor="";
    }

    if (send!=true) event.preventDefault();
}