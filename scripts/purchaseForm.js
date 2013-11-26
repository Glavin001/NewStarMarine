//purchaseForm.js

// Global variables
var shakePage = null; // Will represent a global function that shakes the page.
var cart = [[],[],[]]; // Working variable to hold Customer's Cart information.
// Cart format: [[category],[product],[quantity]]
var cartTotal = 0;
var xmlDoc = null; // Storing the product list XML prevents redundant load requests.

// ===== jQuery ======
$(function() {
// pageShaker()
    function pageShaker() {
        //$(function() {
            //console.log("dude");
            $("#page").effect("shake");
            $("#purchaseForm").effect("highlight", {}, 3000);
            //alert("test");
        //});
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

// Load Products list
xmlDoc = loadXML("database/products.php");
// Category chooser
    loadCategories();
    loadProducts(0);
    // Bind function to event of element.
    $("#category").change(function() {
        // Update products given new "Category". 
        var category = $("#category").val();
        //console.log(category); 
        // Clear Product list
        $("#product").html("");
        // Add upadted Products to Product list
        loadProducts(category)
        // Process change of product
        var product = 0;
        $("#quantity").val(0);
        var quantity = 0;
        console.log(category+","+product+","+quantity);
        // Update prices fields.
        processIndividualPrice(category, product, parseInt(quantity));
        
    });
    $("#product, #quantity").change(function() {
        // Process change of product
        var category = $("#category").val();
        var product = $("#product").val();
        var quantity = $("#quantity").val();
        //console.log(quantity);
        // Update prices fields.
        processIndividualPrice(category, product, parseInt(quantity));
    });
    
    
    $("#taxExempt").change(function() {
        displayReceipt();
    });

});

// ===== JavaScript =====
// AJAX
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

function loadCategories()
{
   
        var selectCategory = document.getElementById("category");
       

        // Display category options
        selectCategory.innerHTML = ""; // '<option value="0">'+"Loading..."+'</option>'; // Clear
        // Itterate through all categories
        var c = xmlDoc.getElementsByTagName("CATEGORY");
        for (var i=0; i<c.length; i++)
        {
            var cname = (c[i].getElementsByTagName("CATNAME")[0].childNodes[0].nodeValue);
            selectCategory.innerHTML += '<option value="'+i+'" >'+cname+'</option>';
        }

}

function loadProducts(cNum)
{

        var selectProduct = document.getElementById("product");

        // Display product options
        selectProduct.innerHTML = ""; // '<option value="0">'+"Loading..."+'</option>'; // Clear
        // Itterate through all categories
        var c = xmlDoc.getElementsByTagName("CATEGORY");
        var p = c[cNum].getElementsByTagName("PRODUCT");
        for (var i=0; i<p.length; i++)
        {
            var pname = (p[i].getElementsByTagName("PRODNAME")[0].childNodes[0].nodeValue);
            var price = parseFloat(p[i].getElementsByTagName("PRICE")[0].childNodes[0].nodeValue);
            selectProduct.innerHTML += '<option value="'+i+'" >'+"$"+price.toFixed(2)+" - "+pname+'</option>';
        }

}

function processIndividualPrice(category, product, quantity)
{

        var taxPrice = document.getElementById("tax");
        var totalPrice = document.getElementById("total");

        // Display product options
        taxPrice.innerHTML = ""; // '<option value="0">'+"Loading..."+'</option>'; // Clear
        totalPrice.innerHTML = "";
        // Itterate through all categories
        var cs = xmlDoc.getElementsByTagName("CATEGORY");
        var ps = cs[category].getElementsByTagName("PRODUCT");
        var p = ps[product];
        var pname = (p.getElementsByTagName("PRODNAME")[0].childNodes[0].nodeValue);
        console.log(pname);
        var price = parseFloat(p.getElementsByTagName("PRICE")[0].childNodes[0].nodeValue);
        console.log(price);
        taxPrice.value = "$"+(price*0.15*quantity).toFixed(2);
        totalPrice.value = "$"+(price*1.15*quantity).toFixed(2);
}

function addToCart()
{

var category = $("#category").val();
var product = $("#product").val();
var quantity = $("#quantity").val();

if (isNaN(quantity))
{
// Not a number
$("#quantity").val("Enter a *number*: "+quantity);
$("#quantity").parent().effect("shake");
$("#quantity").parent().parent().effect("highlight", {"color":"red"}, 2500);
}
else
{
// Is a number
cart[0].push(category);
cart[1].push(product);
cart[2].push(quantity);

displayReceipt();
}

}

function removeFromCart(itemNum)
{

cart[0].splice(itemNum,1);
cart[1].splice(itemNum,1);
cart[2].splice(itemNum,1);

displayReceipt();
}

function displayReceipt()
{

  var receipt = $("#receipt");
  // Clear receipt
  receipt.html("");
  
  // Build top of table
  receipt.append('<tr>\
<th colspan="6">Receipt</th>\
</tr>\
<tr>\
<th>Category</th>\
<th>Product</th>\
<th>Product Price</th>\
<th>Quantity</th>\
<th>Item-Total (Before Tax)</th>\
<th>Remove?</th>\
</tr>');
  
  // Store pricing information
  var totalBeforeTax = 0;
  var tax = 0;
  var totalAfterTax = 0;
  // Iterate through all cart items
  var count = cart[0].length;
  for (var i=0; i<count; i++)
  {

    var categoryNum = cart[0][i];
    var productNum = cart[1][i];
    var quantity = cart[2][i];
    
    var categoryNumXML = xmlDoc.getElementsByTagName("CATEGORY")[categoryNum];
    var productNumXML = categoryNumXML.getElementsByTagName("PRODUCT")[productNum];
    
    var categoryName = categoryNumXML.getElementsByTagName("CATNAME")[0].childNodes[0].nodeValue;
    var productName = (productNumXML.getElementsByTagName("PRODNAME")[0].childNodes[0].nodeValue);
    var price = parseFloat(productNumXML.getElementsByTagName("PRICE")[0].childNodes[0].nodeValue);
    
    receipt.append('<tr>\
    <td>'+categoryName+'</th>\
    <td>'+productName+'</td>\
    <td>$'+price+'</td>\
    <td>'+quantity+'</td>\
    <td>$'+(price*quantity).toFixed(2)+'</td>\
    <td><input type="button" onclick="removeFromCart('+i+');" value="Remove" /></td>\
    </tr>');
    
    // Add to totalBeforeTax
    totalBeforeTax = parseFloat(parseFloat(totalBeforeTax) + (parseFloat(price)*parseFloat(quantity))).toFixed(2);

  }
  
  // Process tax and final total
  var taxExempted = $("#taxExempt").is(':checked');
  
  if (taxExempted)
  {
  console.log("No tax!");
   // Without tax
  $("td.tax").css("text-decoration","line-through");
  tax = (parseFloat(totalBeforeTax)*0.15).toFixed(2);
  totalAfterTax = parseFloat(totalBeforeTax).toFixed(2);
  }
  else
  {
  console.log("With tax!");
  // With tax
  $("td.tax").css("text-decoration","none");
  tax = (parseFloat(totalBeforeTax)*0.15).toFixed(2);
  totalAfterTax = (parseFloat(totalBeforeTax)+parseFloat(tax)).toFixed(2);
  }
  
  // Build bottom of table
  receipt.append('<tr><td colspan="6"></td></tr>\
<tr>\
<td colspan="4">Total (before tax)</td>\
<td colspan="1">$'+totalBeforeTax+'</td>\
</tr>\
<tr class="tax">\
<td colspan="4" class="tax">Tax</td>\
<td colspan="1" class="tax">$'+tax+'</td>\
</tr>\
<tr>\
<td colspan="4">Total</td>\
<td colspan="2"><em>$'+totalAfterTax+'</em></td>\
</tr>');
  
  if (taxExempted)
  {
  // Without tax
  $("td.tax").css("text-decoration","line-through");
  }
  else
  {
  // With tax
  $("td.tax").css("text-decoration","none");
  }
  
  // Update cartTotal variable
  cartTotal = totalAfterTax;
  
  // Update form cart
  updateFormCart();

}

function updateFormCart()
{
  // === Updates the cartData of Form
  // Form Element variables, that store parts of cart[].
  var categoryData = $("#cartData_category");
  var productData = $("#cartData_product");
  var quantityData = $("#cartData_quantity");
  // Update form
  categoryData.val(cart[0].join(","));
  productData.val(cart[1].join(","));
  quantityData.val(cart[2].join(","));
}

// ===== Form validation ===== **************************************
function validatePurchaseForm()
{
var purchaseFormObj = document.getElementById("purchaseForm");
var firstName = purchaseFormObj.firstName.value;
var lastName = purchaseFormObj.lastName.value;
var phone = purchaseFormObj.phone.value;
var email = purchaseFormObj.email.value;
var everythingOK = true;

if (!validateName(firstName))
{
$("#firstName").css('backgroundColor', 'red');
//alert("Error: Invalid first name.");
everythingOK = false;
console.log("Invalid First Name");
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
console.log("Invalid Last Name");
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
console.log("Invalid Phone");
}
else
{
$("#phone").css('backgroundColor', 'green');
}

if (!validateEmail(email))
{
$("#email").css('backgroundColor', 'red');
$("#replyYes").parent().css('backgroundColor', 'red');
//alert("Error: Invalid e-mail address.");
everythingOK = false;
console.log("Invalid Email");
}
else
{
$("#email").css('backgroundColor', 'green');
$("#replyYes").parent().css('backgroundColor', 'green');
}

//=== Return result
if (everythingOK)
{

var msg = "All the information looks good.\n \
Thank you!\n \
Customer name: \
"+((purchaseFormObj.salute.value != "Please select a title")?purchaseFormObj.salute.value+"" : "" )+"\
"+firstName+" "+lastName+" \n\
Email: "+email+" \n\
Phone: "+phone+" \n\
\n \
Cart Data (Category): ["+purchaseFormObj.cartData_category.value+"]\n \
Cart Data (Product): ["+purchaseFormObj.cartData_product.value+"]\n \
Cart Data (Quantity): ["+purchaseFormObj.cartData_quantity.value+"]\n \
Send the Cart Data to PHP to be parsed and processed. \n\
The total, to be processed and checked by the PHP server side script, \
is: $"+cartTotal+"\n \
Notice that the tax "+((purchaseFormObj.taxExempt.checked)?"is":"is not")+"\
 exempted.";
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
var p1 = phone.search(/^\d{3}[-\s]{0,1}\d{3}[-.\s]{0,1}\d{4}$/);
var p2 = phone.search(/^\d{3}[-\s]{0,1}\d{4}$/);
if (p1 == 0 || p2 == 0 || phone=="")
return true;
else
return false;
}

function validateEmail(address)
{
var canReply = document.getElementById("replyYes").checked;

var p = address.search(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})$/);
if (p == 0)
return true && canReply;
else
return false && canReply;
}

