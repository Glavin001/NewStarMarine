//rotateImages.js

// Global variables
var xmlDoc = null;
var productArray = [];

// Load Products information
try
{
xmlDoc = loadXML("database/products.php"); // Use AJAX now; use PHP/MySQL later.
var categories = xmlDoc.getElementsByTagName("CATEGORY");
} catch (err)
{ console.log(err); }

//Get all of today's information in a JavaScript Date object
var today = new Date();
// Use today's date to decide on the category of product to display.
// Current categories are: 0=outboards, 1=scooters
// Weekdays are 1=scooters, else weekends are 0=outboards
/*
var categoryNum = 0; 
switch (today.getDay())
{
    // Weekend
    case 0:
    case 5:
    case 6:
        categoryNum = 1;
        break;
    // Else, weekdays
    default:
        categoryNum = 0;
}
*/
for (var categoryNum=0; categoryNum<categories.length; categoryNum++) // Begin categories iteration loop
{
  try
  {
    var catName = categories[categoryNum].getElementsByTagName("CATNAME")[0].childNodes[0].nodeValue;
    console.log(catName);
    var products = categories[categoryNum].getElementsByTagName("PRODUCT");
  } catch (err) 
  { console.log(err); }
  var prefixDir = "images/original/";
  for (var p=0; p<products.length; p++)
  {      
    try 
    {
      var productTitle = products[p].getElementsByTagName("PRODNAME")[0].childNodes[0].nodeValue;
      var productImgSrc = prefixDir + products[p].getElementsByTagName("IMGSRC")[0].childNodes[0].nodeValue;
      var productDescription = products[p].getElementsByTagName("DESCR")[0].childNodes[0].nodeValue;
      
      var tempProd = [catName, productTitle, productImgSrc, productDescription];
      productArray.push(tempProd);
    } catch (err) 
    { console.log(err); }  
  }
} // End categories iteration loop

//Rotate the images in the array
var rotateId = null;
var rotationPeriod = 1000;
var imageCounter = 0;
function rotate()
{
    console.log("Rotating images:"+imageCounter);
    var legendObject = document.getElementById('rBox-Legend');
    var imageObject = document.getElementById('rBox-Img');
    var descriptionObject = document.getElementById('rBox-Desc');
    
    legendObject.innerHTML = "<strong>" + productArray[imageCounter][1] + " - " + productArray[imageCounter][0] + "</strong>";
    imageObject.src = productArray[imageCounter][2];
    descriptionObject.innerHTML = productArray[imageCounter][3];
        
    ++imageCounter;
    if (imageCounter > (productArray.length-1)) 
    {
        imageCounter = 0;
    }
}

function startRotation()
{
    console.log("Starting Rotation");
    // Initialize
    rotate();
    // Continue rotation
    rotateId = setInterval('rotate()', rotationPeriod);
}

function prevImage()
{
    console.log("Previous Image");
    // Stop Rotating Process
    if (rotateId != null) 
    {
    clearInterval(rotateId);
    rotateId = null;
    }
    // Select previous image
    imageCounter-=2;
    if (imageCounter < 0)
    {
        imageCounter = productArray.length-1;
    }
    // Rotate
    rotate();
    // Restart Rotation
    rotateId = setInterval('rotate()', rotationPeriod);
}

function nextImage()
{
    console.log("Next Image");
    // Stop Rotating Process
    if (rotateId != null) 
    {
    clearInterval(rotateId);
    rotateId = null;
    }
    // Select next image
    ++imageCounter;
    if (imageCounter > (productArray.length-1))
    {
        imageCounter = 0;
    }
    // Rotate
    rotate();
    // Restart Rotation
    rotateId = setInterval('rotate()', rotationPeriod);
}

function toggleImage()
{
    console.log("Toggle (Play/Pause) Image");
    if (rotateId == null) 
    {
    // Is NOT rotating
    // Restart Rotation
    console.log("Restart rotation");
    rotateId = setInterval('rotate()', rotationPeriod);
    }
    else
    {
    //IS rotating
    // Stop Rotating Process
    console.log("Stop rotation");
    clearInterval(rotateId);
    rotateId = null;
    }
    
}


