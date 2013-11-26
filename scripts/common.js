// common.js

// Handle Links to External pages
$(document).ready(function () {
    $('a[rel="external"]').each(function(i) {
        $(this).attr('target', '_blank');
    });
});

// Upate Server Time

var pingerId = null;

$(document).ready(function() {
        
    function pingServer(onload,unload) {
        //console.log("Pinging Server: "+onload+", "+unload);
        
        var args = "?";
        args += 'onload='+onload;
        args += '&onunload='+unload;
        var isAsync = true;
        if (unload == true) isAsync = false;
        
        var sPath = window.location.pathname;
        var sPage = sPath.substring(sPath.lastIndexOf('/') + 1);
        sPage = encodeURIComponent(sPage);
        args += "&page="+sPage;
        
        $.ajax({
         type: 'POST',
         async: isAsync,
         url: 'scripts/pingServer.php'+args,
         timeout: 1000,
         success: function(data) {
            $("#serverMsg").html(data); 
            //window.setTimeout(pingServer(false,false), 1000);
         },
        });
      }
      pingServer(true,false);
      pingerId = setInterval(function () { pingServer(false,false); }, 1000);
   
      //if ('pagehide' in document.documentElement)
      //{
       $(window).on("pagehide", function () 
       { 
         //pingServer(false,true); return; 
       });
      //}
      //else
      //{
       //$(window).on("unload", function () {  pingServer(false,true); return; } );
       $(window).on("beforeunload", function () 
       {  
         pingServer(false,true); return; 
       });
      //}
      
});


// AJAX Load XML file
function loadXML(url)
{
    console.log("loadXML:");
    var xmlhttp;
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
    }
    else
    {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    xmlhttp.open("GET",url,false);
    xmlhttp.send();
    
    console.log("XML loaded...");
    var xmlDoc = xmlhttp.responseXML;
    console.log(xmlDoc);
    return xmlDoc;
}

// Update Sessions
function updateSession(name, value, newhref){
console.log("Updating Session: "+name+"="+value);
  $.ajax({
    type: "POST",
    async: "true",
    url: "scripts/updateSessions.php", 
    data: "name="+name+"&value="+value     
  }).done(function(data)
  {
    console.log("Update Session: "+data);
    if (newhref != "") window.location.href = newhref;
  });
}

// Update Cart
function updateCart(action, id, newhref){
console.log("Send Update to Cart: action="+action+", id="+id);
var sendData = "action="+action;
if (id != '') sendData = sendData + "&id="+id;
//console.log("sendData:"+sendData);
  $.ajax({
    type: "GET",
    async: "true",
    url: "pages/cart.php", 
    data: sendData  
  }).done(function(data)
  {
    console.log("Cart Updated: action="+action+", id="+id);
    //console.log("data:"+data);
    if (newhref != "") window.location.href = newhref;
  });
}

// Blinking Text
function blinkText
    (
    element,    // JavaScript element
    text1,      // String
    text2,      // String
    defaultText // String; Default
    )
{
    var currentText = element.innerHTML;
    console.log("currentText:"+currentText);
    if (currentText == text1)
    {
    // Switch to text1
    element.innerHTML = text2;
    }
    else if (currentText == text2)
    {
    // Switch to text1
    element.innerHTML = text1;
    }
    else
    {
    // Defaulte text 
    element.innerHTML = defaultText;
    }

}

// Marquee Text
function marqueeText
    (
    element,    // JavaScript element
    text,       // String. null=element.innerHTML
    move        // Integer. Both direction and rate, in the form DR, ex: +1. 
                    // Direction: +/- for forward/backward.
                    // Rate: in characters.
    )
{
    if (text == null)
    {
        text = element.innerHTML;   
    }
    
}

