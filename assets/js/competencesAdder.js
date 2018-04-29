function mydicttoString(dict) {
    var o = "";
    for (var p in dict) {
        if (dict.hasOwnProperty(p))
            o += p + "::" + dict[p] + "///";
    }
    return o;
}

function setPOST() {
    var dict = {};
    for (var i=0; i < document.getElementById("competences-list").children.length; ++i) {
        var c = document.getElementById("competences-list").children[i];
        var d = c.children[1].children[0].children[0];
        var g = c.children[1].children[1];
        var h = 0;
        for (var j=0; j < g.children.length; ++j) {
            if ($(g.children[j]).hasClass("btn-primary"))
                ++h;
        }
        dict[d.value] = h;
    }
    document.getElementById("editcompetences").value = mydicttoString(dict);
}

function createButton() {
    var btn = document.createElement("button");
    btn.setAttribute("type", "button");
    btn.setAttribute("class", "btn btn-default");
    btn.setAttribute("data-toggle", "button");
    
    btn.appendChild(document.createTextNode('\xa0\xa0'));
    
    return btn;
}

function resetButton(a) {
    a.className = "btn btn-default";
}

function createBlocks(level, container) {
    // créons 5 blocs chacun activant son prédescesseur
    // à partir de checkbox bootstrap
    var btn1 = createButton();
    var btn2 = createButton();
    var btn3 = createButton();
    var btn4 = createButton();
    var btn5 = createButton();
    
    $(btn1).on('click', function () {
        btn1.className = "btn btn-primary";
        resetButton(btn2);
        resetButton(btn3);
        resetButton(btn4);
        resetButton(btn5);
    });
    
    $(btn2).on('click', function () {
        btn1.className = "btn btn-primary";
        btn2.className = btn1.className;
        resetButton(btn3);
        resetButton(btn4);
        resetButton(btn5);
    });
    
    $(btn3).on('click', function () {
        btn1.className = "btn btn-primary";
        btn2.className = btn1.className;
        btn3.className = btn2.className;
        resetButton(btn4);
        resetButton(btn5);
    });
    
    $(btn4).on('click', function () {
        btn1.className = "btn btn-primary";
        btn2.className = btn1.className;
        btn3.className = btn2.className;
        btn4.className = btn3.className;
        resetButton(btn5);
    });
    
    $(btn5).on('click', function () {
        btn1.className = "btn btn-primary";
        btn2.className = btn1.className;
        btn3.className = btn2.className;
        btn4.className = btn3.className;
        btn5.className = btn4.className;
    });
    
    if (level == 1) $(btn1).click();
    if (level == 2) $(btn2).click();
    if (level == 3) $(btn3).click();
    if (level == 4) $(btn4).click();
    if (level == 5) $(btn5).click();
    
    container.appendChild(btn1);
    container.appendChild(document.createTextNode('\xa0'));
    container.appendChild(btn2);
    container.appendChild(document.createTextNode('\xa0'));
    container.appendChild(btn3);
    container.appendChild(document.createTextNode('\xa0'));
    container.appendChild(btn4);
    container.appendChild(document.createTextNode('\xa0'));
    container.appendChild(btn5);
}

function addCompetence(name="", level=0) {
    var daddy = document.getElementById("competences-list");
    var container = document.createElement("div");
    container.className = "competence-bloc";
    var sub = document.createElement("div");
    sub.className = "row";
    
        var divleft = document.createElement("div");
        divleft.className = "col-md-6";
        
            var input = document.createElement("input");
            input.type = "text";
            input.className = "competence-input-name form-control";
            input.setAttribute("placeholder", "Nom de la compétence. Ex: C++, plomberie...");
            input.setAttribute("value", name);
            
            divleft.appendChild(input);
        
        var divright = document.createElement("div");
        divright.className = "col-md-6";
        divright.setAttribute("style", "width:45%");
        
            createBlocks(level, divright);
    
        var cross = document.createElement("button");
        cross.type = "button";
        cross.className = "close";
        cross.setAttribute("data-dismiss", "alert");
        cross.setAttribute("aria-label", "Close");
        
        var span_cnt = document.createElement("span");
        span_cnt.setAttribute("aria-hidden", "true");
        span_cnt.appendChild(document.createTextNode("x"));
    
    cross.appendChild(span_cnt);
    cross.onclick = function() {
        daddy.removeChild(container);
    };
    
    sub.appendChild(divleft);
    sub.appendChild(divright);
    container.appendChild(cross);
    container.appendChild(sub);
    container.appendChild(document.createElement("br"));
    
    daddy.appendChild(container);
}