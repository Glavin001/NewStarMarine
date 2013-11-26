This site is now functional to the extent requested by submission11's outline.

See "New Products" or "Pre-Owned Products" pages, as seen in main menu,
  to view my access to MySQL database and retrieval of information.
  There are now many other little MySQL database accessess, 
  see if you can spot them in action ;).

Exceeds expectations:
- Completed a customer registration, that works and can login and logout, 
  and stays logged in using PHP Sessions.
- I have implemented a cart and a final checkout page. 
  Emails the customer their purchase bill, and also submits to MySQL table my_purchases.
  The cart uses PHP sessions to retain it's contents.
- Feedback form fully functional! 
  Emails both customer and business. Writes to a file. And even inserts in my_feedback table!
  Instead of redundantly retyping in customer information,
  it uses the customer_id and auto-fills the information and submits it for that customer.
  Later processing can be done now to prove that customer did in fact purchase said product,
  or even display a customer feedback form where only the known purchase products are displayed!
- In progress: In the pages/admin/ there is report.php which displays graphs and charts of select statical data.

Issues and concerns to discuss:
- CSS: vendor/browser specific CSS properties
  Some parts of the CSS code will not fully validate. This is simply because I am using some vendor specific experimental implements of CSS properties,
  to obtain my desired gradients. This can be removed very, very quickly and easily, however, as noted by many other website designers, 
  the W3C CSS3 Validator sometimes does not always return the best reports and also that this is more so a fault of the lack-of-support from validator, 
  and not so much an actual error in code. The code that is invalid is browser specific and not recognized by the CSS validator; this is simply a design choice.
  See http://stackoverflow.com/questions/5715281/css-background-gradient-validation 
  and http://stackoverflow.com/questions/1889724/how-to-validate-vendor-prefixes-in-css-like-webkit-and-moz for more info.
  I have personally validated each .css file without the afflicting lines of vendor/browser specific code, and they all validate. :)
- db.php:
  I had original stored the db.php file inside public_html/ folder, under scripts/, analogous with the webbook hierarchy seen in csc35549.
  This has now been fixed and db.php is moved outside of public_html/ and into a secure/ directory inside of the ~user directory.
  To make life MUCH easier, and more portable, I used the original db.php file to store another PHP include that THEN would redirect to the secure db.php in secure/ directory.
  
Let me know if there is any issues/questions/concerns worth discussing.

Thanks,
Glavin

Glavin Wiechert, csc35523, A00358331
Glavin.Wiechert@gmail.com
