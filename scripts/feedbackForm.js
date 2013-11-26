//feedbackForm.js
shakePage = null;
// jQuery
$(function() {
    function pageShaker() {
            $("#page").effect("shake");
            $("#feedbackForm").effect("highlight", {}, 3000);
    }
    shakePage = pageShaker;
   /* 
    $("form input, form select").focus(function() {
        $(this).parent().parent().addClass("curFocus");
    });
    
    $("form input, form select").blur(function() {
        $(this).parent().parent().removeClass("curFocus");
    });
    
    var $fields = $("form fieldset");
    $fields.focusin(function() {
        $fields.removeClass("active-form");
        $(this).addClass("active-form");        
    });
    */
    
    // Build Feedback table
    var xmlDoc = loadXML("database/products.php");
    buildFeedback(xmlDoc);
    
});

// ===== JavaScript =====
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

function validateFeedbackForm()
{
console.log("validateFeedbackForm");
var feedbackFormObj = document.getElementById("feedbackForm");
var firstName = feedbackFormObj.firstName.value;
var lastName = feedbackFormObj.lastName.value;
var phone = feedbackFormObj.phone.value;
var email = feedbackFormObj.email.value;
var everythingOK = true;

if (!validateName(firstName))
{
$("#firstName").css('backgroundColor', 'red');
//alert("Error: Invalid first name.");
everythingOK = false;
}
else
{
$("#firstName").css('backgroundColor', 'green');
}

if (!validateName(lastName))
{
$("#lastName").css('backgroundColor', 'red');
//alert("Error: Invalid last name.");
everythingOK = false;
}
else
{
$("#lastName").css('backgroundColor', 'green');
}

if (!validatePhone(phone))
{
$("#phone").css('backgroundColor', 'red');
//alert("Error: Invalid phone number.");
everythingOK = false;
}
else
{
$("#phone").css('backgroundColor', 'green');
}

if (!validateEmail(email))
{
$("#email").css('backgroundColor', 'red');
$("#replyYes").css('backgroundColor', 'red');
//alert("Error: Invalid e-mail address.");
everythingOK = false;
console.log("Invalid Email");
}
else
{
$("#email").css('backgroundColor', 'green');
$("#replyYes").css('backgroundColor', 'green');
}


if (feedbackFormObj.reply.checked)
{
    $("#reply").parent().css('backgroundColor', 'green');
    if (!validateEmail(email))
    {
    $("#email").css('backgroundColor', 'red');
    //alert("Error: Invalid e-mail address.");
    everythingOK = false;
    }
    else
    {
    $("#email").css('backgroundColor', 'green');
    }
}
else
{
    $("#reply").parent().css('backgroundColor', 'red');
    everythingOK = false;
}

if (everythingOK)
{
var msg = "All the information looks good.\n\
Thank you!\n\
The information you have submitted is as follows:\n\
Customer name:\n\
"+((feedbackFormObj.salute.value != "Please select a title")?feedbackFormObj.salute.value+" " : "" )+"\
"+firstName+" "+lastName+" \n\
Email: "+email+" \n\
Phone: "+phone+" \n\
You "+((feedbackFormObj.reply.checked)?"accept":"deny")+" that you may receive a response email.";
 
alert(msg);
return true;
}
else
{
shakePage();
//alert("Please check your information above. Possible problems are highlighted in red, and the valid entries are highlighted in green.\n\Also be sure to accept that you may receive an email.");
return false;
}

}

function validateName(name)
{
var p = name.search(/^[-'\w\s]+$/);
if (p == 0)
return true;
else
return false;
}

function validatePhone(phone)
{
var p1 = phone.search(/^\d{3}[-\s]{0,1}\d{3}[-\s]{0,1}\d{4}$/);
var p2 = phone.search(/^\d{3}[-\s]{0,1}\d{4}$/);
if (p1 == 0 || p2 == 0 || phone=="")
return true;
else
return false;
}

function validateEmail(address)
{
var canReply = document.getElementById("reply").checked;

var p = address.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/);

if (p == 0)
return true && canReply;
else
return false && canReply;
}


// ==== Build Feedback table ==== 
function buildFeedback(xmlDoc)
{

var feedbackTable = $("#feedback tbody");
var categories = xmlDoc.getElementsByTagName("CATEGORY");

var feedbackContents = "";

// First instruction
feedbackContents += ('<h4>From which categories have you purchased from?</h4>');

for (var categoryNum=0; categoryNum<categories.length; categoryNum++)
{

var categoryName = categories[categoryNum].getElementsByTagName("CATNAME")[0].childNodes[0].nodeValue; //"Outboard Motors";
var categoryId = categories[categoryNum].getElementsByTagName("CATID")[0].childNodes[0].nodeValue; //0;

//var categoryNum = 0;
var allProducts = categories[categoryNum].getElementsByTagName("PRODUCT");

/*
<tr valign="top">
<td>
<label for="purchased_0">Purchased from the <strong>Outboards Motors</strong> category: </label>
<input type="checkbox" id="purchased_0" name="purchased_0" />
</td>
</tr>
*/
feedbackContents += ('<tr valign="top"><td>');
feedbackContents += ('<label for="purchased:'+categoryId+'">');
feedbackContents += ('Purchased from the <strong>'+categoryName+'</strong> category: ');
feedbackContents += ('</label>');
feedbackContents += ('<input type="checkbox" id="purchased:'+categoryId+'" name="purchased:'+categoryId+'" onchange="$(\'.purchased'+categoryId+'\').toggle(\'blind\', { direction: \'vertical\'}, 200);" />');
feedbackContents += ('</td></tr>');

/*
<tr valign="top">
<td>
<label for="comments:0">
Comments for this category<a name="comments" class="formRequired">*</a>:
</label></td>
</tr>
*/
feedbackContents += ('<tr valign="top" class="purchased'+categoryId+'" style="display: none;" ><td>');
feedbackContents += ('<label for="comments:'+categoryId+'">');
feedbackContents += ('Comments for '+categoryName+' category');
feedbackContents += ('<a name="comments" class="formRequired">*</a>');
feedbackContents += (': </label></td></tr>');

/*
<tr valign="top">
<td>
<textarea id="comments:0" name="comments:0" rows="12" cols="120"></textarea></td>
</tr>
*/
feedbackContents += ('<tr valign="top" class="purchased'+categoryId+'" style="display: none;"><td>');
feedbackContents += ('<textarea id="comments:'+categoryId+'" name="comments:'+categoryId+'" rows="12" cols="120"></textarea>');
feedbackContents += ('</td></tr>');


/*
<tr valign="top">
<td>
<h4>What products did you purchase?</h4>
</td>
</tr>
*/
feedbackContents += ('<tr valign="top" class="purchased'+categoryId+'" style="display: none;" ><td>');
feedbackContents += ('<h4>What products did you purchase?</h4>');
feedbackContents += ('</td></tr>');

for (var productNum=0; productNum<allProducts.length; productNum++ )
{

var productName = allProducts[productNum].getElementsByTagName("PRODNAME")[0].childNodes[0].nodeValue; // "2.6 HP";
var productId = allProducts[productNum].getElementsByTagName("PRODID")[0].childNodes[0].nodeValue; // 0;
// var productNum = 0;

/*
<tr valign="top">
<td>
<label for="purchasedProd:0.0">Purchased <strong>2.6 HP</strong>:</label>
<input type="checkbox" id="purchasedProd:0.0" name="purchasedProd:0.0" />
</td>
</tr>
*/
feedbackContents += ('<tr valign="top" class="purchased'+categoryId+'"  style="display: none;" ><td>');
feedbackContents += ('<label for="purchasedProd:'+categoryId+'.'+productId+'">Purchased <strong>'+productName+'</strong>:</label>');
feedbackContents += ('<input type="checkbox" id="purchasedProd:'+categoryId+'.'+productId+'" name="purchasedProd:'+categoryId+'.'+productId+'" onchange="$(\'.purchased'+categoryId+'_'+productId+'\').toggle(\'blind\', { direction: \'vertical\'}, 50);" />');
feedbackContents += ('</td></tr>');

/*
<tr valign="top">
<td>
How satisfied were you with your purchase?<br />
Not satisfied 
1 <input type="radio" name="rate:0.1" value="1"></input>
2 <input type="radio" name="rate:0.1" value="2"></input>
3 <input type="radio" name="rate:0.1" value="3"></input>
4 <input type="radio" name="rate:0.1" value="4"></input>
5 <input type="radio" name="rate:0.1" value="5"></input>
6 <input type="radio" name="rate:0.1" value="6"></input>
7 <input type="radio" name="rate:0.1" value="7"></input>
8 <input type="radio" name="rate:0.1" value="8"></input>
9 <input type="radio" name="rate:0.1" value="9"></input> 
10 <input type="radio" name="rate:0.1" value="10"></input>
Very satisfied
<input type="radio" name="rate:0.1" value="0" checked="checked"></input>
Not Applicable/Unknown 
</td>
</tr>
*/
feedbackContents += ('<tr valign="top" class="purchased'+categoryId+'_'+productId+'" style="display: none;" ><td>');
feedbackContents += ('How satisfied were you with your purchase?<br />');
feedbackContents += ('(Not satisfied) 1 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="1"></input>, ');
feedbackContents += ('2 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="2"></input>, ');
feedbackContents += ('3 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="3"></input>, ');
feedbackContents += ('4 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="4"></input>, ');
feedbackContents += ('5 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="5"></input>, ');
feedbackContents += ('6 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="6"></input>, ');
feedbackContents += ('7 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="7"></input>, ');
feedbackContents += ('8 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="8"></input>, ');
feedbackContents += ('9 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="9"></input>, ');
feedbackContents += ('10 <input type="radio" name="rate:'+categoryId+'.'+productId+'" value="10"></input> (Very satisfied), ');
feedbackContents += ('<input type="radio" name="rate:'+categoryId+'.'+productId+'" value="0" checked="checked"></input> Not Applicable/Unknown');
feedbackContents += ('</td></tr>');

/*
<tr><td><hr /></td></tr>
*/
feedbackContents += ('<tr class="purchased'+categoryId+'_'+productId+'" style="display: none;" ><td><br /></td></tr>');

}

feedbackContents += ('<tr class="purchased'+categoryId+'" style="display: none;" ><td><hr /></td></tr>');

}

// Re-Set Contents of table
feedbackTable.html(feedbackContents);


}

