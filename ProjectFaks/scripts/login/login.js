function logout(){
    document.location = "logout.php";
}

function getcategories(query = '', callback){
    var fData = new FormData();
    fData.append('query', query);

    var ajaxreq = new XMLHttpRequest();
    ajaxreq.open('POST','scripts/login/getcategories.php');
    ajaxreq.send(fData);
    ajaxreq.onreadystatechange = function (){
        if(ajaxreq.readyState==4 && ajaxreq.status==200){
            const res = JSON.parse(ajaxreq.responseText);
            const arrID = [];
            const arrNAME = [];
            for(var i=0;i<res.length;i++){
                arrID[i]=res[i].id;
                arrNAME[i]=res[i].name;
            }

            sessionStorage.setItem('categoryID', JSON.stringify(arrID));
            sessionStorage.setItem('categoryName', JSON.stringify(arrNAME));

            if (typeof callback === 'function') {
                callback();
            }
        }
    }
}

function checkfields(){
    var send=true;

    var title=document.getElementById('title').value;
    var summary=document.getElementById('summary').value;
    var text=document.getElementById('text').value;
    var image=document.getElementById('image').value;
    var category=document.getElementById('select').value;

    var titlespan=document.getElementById('titlespan');
    var summaryspan=document.getElementById('summaryspan');
    var textspan=document.getElementById('textspan');
    var imagespan=document.getElementById('imagespan');
    var categoryspan=document.getElementById('selectspan');

    if(title.length<5 || title.length>30){
        send=false;
        titlespan.innerHTML=" * Title must be between 5 and 30 characters";
        titlespan.style.color="red";
    }else{
        titlespan.innerHTML="";
    }

    if(summary.length<10 || summary.length>100){
        send=false;
        summaryspan.innerHTML=" * Summary must be between 10 and 100 characters";
        summaryspan.style.color="red";
    }else{
        summaryspan.innerHTML="";
    }

    if(text.length==0){
        send=false;
        textspan.innerHTML=" * Text field must not be empty";
        textspan.style.color="red";
    }else{
        textspan.innerHTML="";
    }

    if(image.length==0){
        send=false;
        imagespan.innerHTML=" * Image must be selected";
        imagespan.style.color="red";
    }else{
        var imagename = document.getElementById('image').files[0].name;
        var extensions = [".jpg",".jpeg",".jpe",".jfif",".pjpeg",".pjp",".png"];
        var img=false;
        for(var i=0;i<extensions.length;i++){
            if(imagename.toLowerCase().endsWith(extensions[i])){
                img=true;
                break;
            }
        }
        if(!img){
            send=false;
            imagespan.innerHTML=" * Selected file isn't a supported format";
            imagespan.style.color="red";
        }else{
            imagespan.innerHTML="";
        }
    }

    if(category=="sel"){
        send=false;
        categoryspan.innerHTML=" * Category must be selected";
        categoryspan.style.color="red";
    }else{
        categoryspan.innerHTML="";
    }

    return send;
}

function login(){
    var body = document.getElementById('login');
    body.innerHTML="";

    function inputLabel(title, htmlfor){
        var el=document.createElement('label');
        el.innerHTML=title;
        el.htmlFor=htmlfor;
        return el;
    }
    function inputIn(type, id){
        if(type=='textarea'){
            var el=document.createElement('textarea');
            el.id=id;
            el.name=id;
            el.rows="7";
            el.cols="25";
            return el;
        }

        var el=document.createElement('input');
        el.type=type;
        el.id=id;
        el.name=id;
        return el;
    }
    function makeBr(){
        var el=document.createElement('span');
        el.innerHTML="<br>";
        return el;
    }

    const lo = document.createElement('button');
    lo.classList="btn btn-custom";
    lo.innerHTML="Logout";
    lo.addEventListener('click', logout, false);

    const form = document.createElement('form');
    form.action="scripts/submit.php";
    form.method="post";
    form.classList="d-flex flex-column justify-content-center align-items-center";
    form.enctype="multipart/form-data";

    const l =  [];
    l[0] = inputLabel("Title:","title");
    l[1] = inputLabel("Summary:","summary");
    l[2] = inputLabel("Text:","text");
    l[3] = inputLabel("Image:","image");
    l[4] = inputLabel("Visible:","visible");
    l[5] = inputLabel("Category:","select");

    const el = [];
    el[0] = inputIn("text","title");
    el[1] = inputIn("text","summary");
    el[2] = inputIn("textarea","text");
    el[3] = inputIn("file","image");
    el[4] = inputIn("checkbox","visible");

    var sub = document.createElement('input');
    sub.type="button";
    sub.id="submit2";
    sub.classList="btn btn-custom";
    sub.value="Submit";

    var brA=makeBr();
    form.appendChild(brA);

    form.appendChild(l[5]);
    var a = document.createElement('span');
    a.id="selectspan";
    form.appendChild(a);

    const sel = document.createElement('select');
    sel.id="select";
    sel.name="select";

    form.appendChild(sel);
    var brB=makeBr();
    form.appendChild(brB);

    for(var i=0;i<5;i++){
        var b = document.createElement('span');
        b.id=el[i].id + "span";

        form.appendChild(l[i]);
        form.appendChild(b);

        form.appendChild(el[i]);

        var br=makeBr();
        form.appendChild(br);
    }
    form.appendChild(sub);
    body.appendChild(lo);
    body.appendChild(form);

    document.getElementById("submit2").addEventListener("click", function(event) {
        var send = checkfields();
        if (send) {
          document.forms[0].submit();
        }
    });

    getcategories('',function() {
        var catid = sessionStorage.getItem('categoryID');
        catid = JSON.parse(catid);
        var catname = sessionStorage.getItem('categoryName');
        catname = JSON.parse(catname);

        var s = document.getElementById('select');

        var o1 = document.createElement('option');
        o1.value = "sel";
        o1.innerHTML = "Select";
        o1.disabled;
        o1.selected;
        s.appendChild(o1);

        for(var i=0;i<catid.length;i++){
            var opt = document.createElement('option');
            opt.value=catid[i];
            opt.innerHTML=catname[i];
            s.appendChild(opt);
        }
    });
}