//productShowcase.js
function showcase(container)
{

this.container = container;

// Global variables
this.xmlDoc = null;
this.productArray = [];

// Load Products information
this.load = function load(xmlLocation)
{  
  try
  {
  //this.xmlDoc = loadXML("database/products.php"); // Use AJAX now; use PHP/MySQL later.
  this.xmlDoc = loadXML(xmlLocation); // Use AJAX now; use PHP/MySQL later.
  
  var categories = this.xmlDoc.getElementsByTagName("CATEGORY");
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
        this.productArray.push(tempProd);
      } catch (err) 
      { console.log(err); }  
    }
  } // End categories iteration loop
  
}


//Rotate the images in the array
this.rotateId = null;
this.rotationPeriod = 1000;
this.imageCounter = 0;
console.log("imageCounter:"+this.imageCounter);
this.rotate = function rotate() // Defining methods to an object.
{
    console.log("Rotating images:"+this.imageCounter);
    var legendObject = document.getElementById('rBox-Legend');
    var imageObject = document.getElementById('rBox-Img');
    var descriptionObject = document.getElementById('rBox-Desc');
    
    console.log(this.productArray);
    
    legendObject.innerHTML = "<strong>" + this.productArray[this.imageCounter][1] + " - " + this.productArray[this.imageCounter][0] + "</strong>";
    imageObject.src = this.productArray[this.imageCounter][2];
    descriptionObject.innerHTML = this.productArray[this.imageCounter][3];
        
    ++this.imageCounter;
    if (this.imageCounter > (this.productArray.length-1)) 
    {
        this.imageCounter = 0;
    }
}

this.startRotation = function startRotation()
{
    console.log("Starting Rotation");
    // Initialize
    var rotate = this.rotate();
    console.log(rotate);
    // Continue rotation
    this.rotateId = setInterval(rotate, this.rotationPeriod);
}

this.prevImage = function prevImage()
{
    console.log("Previous Image");
    // Stop Rotating Process
    if (this.rotateId != null) 
    {
    clearInterval(this.rotateId);
    rotateId = null;
    }
    // Select previous image
    this.imageCounter-=2;
    if (this.imageCounter < 0)
    {
        this.imageCounter = this.productArray.length-1;
    }
    // Rotate
    rotate();
    // Restart Rotation
    this.rotateId = setInterval('rotate()', this.rotationPeriod);
}

this.nextImage = function nextImage()
{
    console.log("Next Image");
    // Stop Rotating Process
    if (this.rotateId != null) 
    {
    clearInterval(this.rotateId);
    this.rotateId = null;
    }
    // Select next image
    ++this.imageCounter;
    if (this.imageCounter > (productArray.length-1))
    {
        this.imageCounter = 0;
    }
    // Rotate
    rotate();
    // Restart Rotation
    this.rotateId = setInterval('rotate()', this.rotationPeriod);
}

this.toggleImage = function toggleImage()
{
    console.log("Toggle (Play/Pause) Image");
    if (this.rotateId == null) 
    {
    // Is NOT rotating
    // Restart Rotation
    console.log("Restart rotation");
    this.rotateId = setInterval('rotate()', this.rotationPeriod);
    }
    else
    {
    //IS rotating
    // Stop Rotating Process
    console.log("Stop rotation");
    clearInterval(this.rotateId);
    this.rotateId = null;
    }
    
}


}