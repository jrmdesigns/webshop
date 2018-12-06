function ajax(PageTo, htmlOutput, id, idValue, kind, kindValue, value, valueValue){
    console.log("ajax");
    if(value != undefined){
        output = PageTo + "?" + id + "=" + idValue + "&" + kind + "=" + kindValue + "&" + value + "=" + valueValue; 
    }
    else if(kind != undefined){
        output = PageTo + "?" + id + "=" + idValue + "&" + kind + "=" + kindValue; 
    } else if(id != undefined){
        output = PageTo + "?" + id + "=" + idValue;
    } else{
        output = PageTo;
    }
    console.log(output);
    $.ajax({url: output, success: function(result){
        $(htmlOutput).html(result);
    }});
}