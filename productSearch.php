<?php
$AppID = 'ShayanSh-Homework-PRD-316e2f5cf-902a2e95';
$myhashmap = array();
$myhashmap['Art'] = 550;
$myhashmap['Baby'] = 2984;
$myhashmap['Books'] = 267;
$myhashmap['Clothing'] = 11450;
$myhashmap['Computers'] = 58058;
$myhashmap['Health'] = 26395;
$myhashmap['Music'] = 11233;
$myhashmap['Video'] = 1249;
//$newkey = "";
$num = 0;

if(isset($_POST['search'])){ 
    
        $urlSearch = 'http://svcs.ebay.com/services/search/FindingService/v1?OPERATION-NAME=findItemsAdvanced&SERVICE-VERSION=1.0.0&SECURITY-APPNAME='.$AppID;
       
      
      if(isset($_POST['kword'])){
        $new = str_replace(' ', '%20',$_POST['kword']); 
        $urlSearch .= '&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&paginationInput.entriesPerPage=50&keywords='.$new;
        $keyword = $_POST['kword'];  
      }
      
      if($_POST['categ'] <> "All"){
        $temp =   $_POST['categ'];
        $urlSearch .= '&categoryId='.$myhashmap[$temp];
        $category = $_POST['categ'];
      }
    
    
   if(isset($_POST['NEARBY'])){ 
       
       echo isset($_POST['maxdist']);
    if(isset($_POST['nearby'])){
        $urlSearch .= '&buyerPostalCode='.$_POST['zipcode'];
        $zip = true;
        $zipcode = $_POST['zipcode'];
        $enable = true;
      
//      if($_POST['maxdist'] != null){
     if($_POST['maxdist'] != null){
        $urlSearch .= '&itemFilter(0).name=MaxDistance&itemFilter(0).value='.$_POST['maxdist'];
          $maxdis = $_POST['maxdist'];
          $enable = true;
      }else{
          $urlSearch .= '&itemFilter(0).name=MaxDistance&itemFilter(0).value=10';
      }
        $num++;
         }else if(isset($_POST['tempzipcode'])){
        $urlSearch .= '&buyerPostalCode='.$_POST['tempzipcode'];
      if($_POST['maxdist'] != null){
          $urlSearch .= '&itemFilter(0).name=MaxDistance&itemFilter(0).value='.$_POST['maxdist'];
          $maxdis = $_POST['maxdist'];
          $enable = true;
      }else{
          $urlSearch .= '&itemFilter(0).name=MaxDistance&itemFilter(0).value=10';
      } 
        $num++;
    }
   }


      if(isset($_POST['shipping1'])){
          $urlSearch .= '&itemFilter('.$num.').name=LocalPickupOnly&itemFilter('.$num.').value=true';
          $optloc = true;
          $num++;
      }else{
          $urlSearch .= '&itemFilter('.$num.').name=LocalPickupOnly&itemFilter('.$num.').value=false';
          $num++;
      }
    
      if(isset($_POST['shipping2'])){
       $urlSearch .= '&itemFilter('.$num.').name=FreeShippingOnly&itemFilter('.$num.').value=true';
        $optfree = true;
          $num++;
      }else{
          $urlSearch .= '&itemFilter('.$num.').name=FreeShippingOnly&itemFilter('.$num.').value=false';
          $num++;
      }   
      
      $urlSearch .= '&itemFilter('.$num.').name=HideDuplicateItems&itemFilter('.$num.').value=true';
      $num++;
      if(isset($_POST['condition1'])){
          $urlSearch .='&itemFilter('.$num.').name=Condition&itemFilter('.$num.').value(0)='.$_POST['condition1'];
          $condnew = true;
      }else if(isset($_POST['condition2'])){
          $urlSearch .='&itemFilter('.$num.').name=Condition&itemFilter('.$num.').value(0)='.$_POST['condition2'];
          $condused = true;
      }else if(isset($_POST['condition3'])){
          $urlSearch .='&itemFilter('.$num.').name=Condition&itemFilter('.$num.').value(0)='.$_POST['condition3'];
          $condunsp = true;
      }else if(isset($_POST['condition1']) && isset($_POST['condition2'])){
          $urlSearch .='&itemFilter('.$num.').name=Condition&itemFilter('.$num.').value(0)='.$_POST['condition1'].'&itemFilter('.$num.').value(1)='.$_POST['condition2'];
          $condnew = true;
          $condused = true;
      }else if(isset($_POST['condition2']) && isset($_POST['condition3'])){
          $urlSearch .='&itemFilter('.$num.').name=Condition&itemFilter('.$num.').value(0)='.$_POST['condition2'].'&itemFilter('.$num.').value(1)='.$_POST['condition3'];
          $condused = true;
          $condunsp = true;
      }else if(isset($_POST['condition1']) && isset($_POST['condition3'])){
          $urlSearch .='&itemFilter('.$num.').name=Condition&itemFilter('.$num.').value(0)='.$_POST['condition1'].'&itemFilter('.$num.').value(1)='.$_POST['condition3'];
          $condnew = true;
          $condunsp = true;
      }else if(isset($_POST['condition1']) && isset($_POST['condition2']) && isset($_POST['condition3'])){
          $urlSearch .= '&itemFilter('.$num.').name=Condition&itemFilter('.$num.').value(0)=New&itemFilter('.$num.').value(1)=Used&itemFilter('.$num.').value(2)=Unspecified';
          $condnew = true;
          $condused = true;
          $condunsp = true;
      }
      $resp = file_get_contents($urlSearch);   
//      echo $resp;
  }
?>

<html> 
<body>    
    
<style>
    
body{
text-align: center;
}    

div.form {
 margin-top: 200px;
 margin-left: 650px;
 height: 300px;
 width: 600px;
 margin: auto auto;  
 background-color: #FAFAFA;
 border-style: solid;
 border-bottom-color: darkgray;
}
h1 {    
 text-align: center;
} 

div{
/* margin-left: 650px;*/
 width: 600px;
 margin: auto auto; 
}
    
.num1{
        color: #D3D3D3;
}    

</style>

<script>

function clearValues() 
{
	document.getElementById("tables").innerHTML = "";

    document.getElementById('categ').value = "All";
    
    document.getElementById('formMain').reset();
    document.getElementById('team4').checked = true;
    document.getElementById('condition1').checked = false;
    document.getElementById('condition2').checked = false;
    document.getElementById('condition3').checked = false;
    document.getElementById('shipping1').checked = false;
    document.getElementById('shipping2').checked = false;
    document.getElementById('maxdist').placeholder = "10";
}
    
    
    
    function getSelectValue(selectObject)
    { 
      return selectObject.options[selectObject.selectedIndex].value; }
    function enable1() { 
       document.getElementById("maxdist").disabled = false;
       document.getElementById("search").disabled = false;
       document.getElementById("here").disabled = false;   
//       document.getElementById("zipcode").disabled = false;
       document.getElementById("formMain").getElementsByClassName("num1").style.color = '#000000';
    }
    function enable() { 
       document.getElementById("zipcode").disabled = false; } 
      
</script>

<div class = "form">
    <h1> Product Search </h1>
    <hr>
    
<form method="POST" action="<?= $_SERVER['PHP_SELF']; ?>"  id="formMain">    
<p><label for="username">Keyword</label>
<input type="text" name="kword" id="kword" required/>

    </p>
<p>    

<label for="categ">Category</label>
    <SELECT name="categ" id="categ" value="<?php echo $_POST['categ']; ?>"> 
        <OPTION value="All" >All Categories </OPTION>
        <OPTION value="Art">Art </OPTION>
        <OPTION value="Baby">Baby </OPTION>
        <OPTION value="Books">Books </OPTION>
        <OPTION value="Clothing">CLothing,Shoes &amp; Accessories </OPTION>
        <OPTION value="Computers">Computers/Tablets &amp; Networking </OPTION>
        <OPTION value="Health">Health &amp; Beauty </OPTION>
        <OPTION value="Music">Music </OPTION>
        <OPTION value="Video">Video Games &amp; Consoles </OPTION>
    </SELECT> 
</p>        
<p>    
<label for="cond">Condition</label>
    <INPUT TYPE="checkbox" name="condition1" value="New"/>New 
    <INPUT TYPE="checkbox" name="condition2" value="Used"/>Used     
    <INPUT TYPE="checkbox" name="condition3" value="Unspecified"/>Unspecifed     
</p>     
            
<p>    
<label for="Ship">Shipping Options</label>
    <INPUT TYPE="checkbox" name="shipping1" value="Local Pickup" />Local Pickup 
    <INPUT TYPE="checkbox" name="shipping2" value="Free Shipping" />Free Shipping     
</p>  
 
<p>    
    <INPUT TYPE="checkbox" name="NEARBY" id="NEARBY" onclick="enable1()" style="display:none" />
<!--    Enable Nearby Search-->
    <input type="text" name="maxdist" id="maxdist" disabled = "true" placeholder="10" style="display:none" />
    <label class="num1" style="display:none">
        miles from</label> 
    <INPUT TYPE="radio" name="teams4" id="here" style="display:none" value="team4" checked/>
    <label class="num1" style="display:none">
        Here</label> <br>
    <INPUT TYPE="radio" id="nearby" name="nearby" value="nearby" style="display:none" onclick="enable()" /> 
    <input type="text" name="zipcode" id="zipcode" placeholder="zipcode" disabled = "true" style="display:none" required/> 
</p>
    
<p>
    <button id="search" name="search">Search</button>
    
    <button type="submit" name="clear" value="clear" onclick="clearValues()">Clear</button> 
    <input type="text" name="tempzipcode" id="tempzipcode" style="display:none">
</p>
</form>
</div>
<div><p id="check"></p></div>    

    
<div>
<p id="tables"></p>
</div>     

<div><p id="sellerMessage" name = "sellerMessage"></p></div> 

<div>        
<iframe id="myframe" name="myframe" height="200" width="800" style="text-aligh: center;display:none"></iframe> 
</div>        
        
<div><p id="similarItems"></p></div>  
 
<div>        
<iframe id="myframe1" name="myframe1" height="200" width="800" style="text-aligh: center;display:none"></iframe> 
</div>        

<script type="text/javascript">
var xmlhttp = "";

document.getElementById("search").disabled = true;
document.getElementById("here").disabled = true;   
document.getElementById("zipcode").disabled = true;     
  
    if (window.XMLHttpRequest)
    {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp=new XMLHttpRequest();
    } else {// code for IE6, IE5
            xmlhttp=new ActiveXObject("Microsoft.XMLHTTP"); 
    }
    
            xmlhttp.open("GET","http://ip-api.com/json",false); // ."synchronous"
            xmlhttp.send(); 
    if (xmlhttp.readyState == 4 || xmlhttp.status==200){
//             console.log("good");
           usefulResponse = xmlhttp.responseText;
              jsonDoc = JSON.parse(usefulResponse);
//               console.log(jsonDoc.zip);
        //              return jsonDoc;
  document.getElementById("tempzipcode").value = jsonDoc.zip;
        document.getElementById("search").disabled = false;
   
    }
  
var passover = "";    
var heightvalue = 0;    

    
function check(json1){
    
console.log(json1["Ack"] == "Failure");
    if(json1["Ack"] == "Failure"){
         failureout();    
    }else{
         jsfunction(json1);
    }
    
}    

function failureout(){
    html_text = "";
    html_text = "<table style='background-color:grey' border='1'>";
html_text+= "<tbody>";
html_text+= "<tr>";
html_text+= "<th style='width:800px;height:45px'>No Item Detail Exists!</th>";    
html_text+= "</tr>";
//html_text+= "</tbody>";     
//   html_text = "</table>";   
    document.getElementById("tables").innerHTML=html_text;
}   
    
function Event_Search_table(json){   
 
html_text = "<table border='1'>";
html_text+= "<tbody>";
html_text+= "<tr>";
html_text+= "<th style='width:85px'>index</th>";
html_text+= "<th style='width:75px'>Photo</th>";
html_text+= "<th>Name</th>";
html_text+= "<th>Price</th>";
html_text+= "<th>Zip code</th>";    
html_text+= "<th>Condition</th>";    
html_text+= "<th>Shipping Option</th>";    
html_text+= "</tr>";

    var items = json.findItemsAdvancedResponse[0].searchResult[0].item || [];    
for (var i = 0; i < 20; i++) {
    var item     = items[i];
    var title    = item.title[0];
    var itemid   = item.itemId;      
    var pic      = item.galleryURL;
    var viewitem = item.viewItemURL;
    var price    = item.sellingStatus[0].currentPrice[0].__value__ + ' ' + item.sellingStatus[0].currentPrice[0]["@currencyId"];
    var zipcode  = item.postalCode;
    var condition = item.condition;
    var option   = item.shippingInfo[0].shippingServiceCost[0].__value__;
    if(i == 4){
        console.log(option);
    }          
    if (null != title && null != viewitem) {
        if(zipcode != null){
         html_text += '<tr><td>' + (i+1) + '</td>' + '<td><img src="' + pic + '" border="0">' + '</td>' + '<td><a href="productSearch.php?itemId='+itemid+'">' + title + '</a></td>'+'<td>' + price + '</td>'+'<td>' + zipcode + '</td>';   
        }else{
          html_text += '<tr><td>' + (i+1) + '</td>' + '<td><img src="' + pic + '" border="0">' + '</td>' + '<td><a href="productSearch.php?itemId='+itemid+'">' + title + '</a></td>'+'<td>' + price + '</td>'+'<td>N/A</td>';  
        }
        
        if(item.condition!= null && null != item.condition[0].conditionDisplayName[0]){
        html_text += '<td>' + item.condition[0].conditionDisplayName[0] + '</td>';
        }
    else{
            html_text += '<td>N/A</td>';
        }
        
        if(option != null){
            if(option == "0.0"){
                    html_text += '<td>Free Shipping</td></tr>';
               }else{
                    html_text += '<td>'+ option + ' ' +item.shippingInfo[0].shippingServiceCost[0]["@currencyId"] + '</td></tr>';
               }
               
        }else{
            html_text += '<td>N/A</td></tr>';
        }
         
    }
  }  
html_text+= "</tbody>";
html_text+= "</table>";
document.getElementById("tables").innerHTML=html_text;
}
     
function jsfunction(json1){

var photocheck = false;       
    html_text = "";       
    
var items = json1.Item;
var photo =  items.PictureURL[0];   
var title = items.Title;
var subtitle = items.Subtitle;
var price = items.currentPrice;    
var Location = items.Location + items.postalcode;
var seller = items.Seller.UserId;
var returnpolicy = items.ReturnPolicy.Refund+items.ReturnPolicy.ReturnsWithin+items.ReturnPolicy.ReturnsAccepted;
if(items.ItemSpecifics != null){
    var itemspec = items.ItemSpecifics.NameValueList;
var itemspeclen = items.ItemSpecifics.NameValueList.length;
}
var descrip = items.Description;
    passover = descrip;
html_text+= "<table border='1'>";
html_text+= "<tbody>";
html_text+= "<tr>";
html_text+= "<th style='width:150px'>Photo</th>";
//if(photocheck){
//    html_text+= "<th style='width:800px'></th>";
//}
//    else{
//        html_text+= "<th style='width:800px'><img src="+ items.PictureURL[0] +" height=150 width=150></th>";
//    }
        html_text+= "<th style='width:800px'><img src="+ items.PictureURL[0] +" height=150 width=150></th>";    
html_text+= "</tr>";

    if(null != title){
             html_text+= "<tr>";
             html_text+= "<th style='width:150px'>title</th>";
             html_text+= "<th style='width:800px'>"+ title +"</th>";
             html_text+= "</tr>";
       }
    if(null != subtitle){
        html_text+= "<tr>";
             html_text+= "<th style='width:150px'>subtitle</th>";
             html_text+= "<th style='width:800px'>"+ subtitle +"</th>";
             html_text+= "</tr>";
    }
    if(null != price){
        html_text+= "<tr>";
             html_text+= "<th style='width:150px'>price</th>";
             html_text+= "<th style='width:800px'>"+ price +"</th>";
             html_text+= "</tr>";
    }
    if(null != Location){
        html_text+= "<tr>";
             html_text+= "<th style='width:150px'>location</th>";
             html_text+= "<th style='width:800px'>"+ Location +"</th>";
             html_text+= "</tr>";
    }
    if(null != seller){
        html_text+= "<tr>";
             html_text+= "<th style='width:150px'>seller</th>";
             html_text+= "<th style='width:800px'>"+ seller +"</th>";
             html_text+= "</tr>";
    }
    if(null != returnpolicy){
        html_text+= "<tr>";
             html_text+= "<th style='width:150px'>Return Policy(US)</th>";
             html_text+= "<th style='width:800px'>"+ returnpolicy  +"</th>";
             html_text+= "</tr>";
    }
    if(null != itemspec){   
        for (var i = 0; i < 20; ++i){
           if(itemspec[i] != null){
            html_text+= "<tr>";
             html_text+= "<th style='width:150px'>"+ itemspec[i].Name +"</th>";
             html_text+= "<th style='width:800px'>"+ itemspec[i].Value  +"</th>";
             html_text+= "</tr>"; 
              }
        }
    }else{
        html_text+= "<tr>";
             html_text+= "<th style='width:150px'>No Detail info from Seller</th>";
             html_text+= "<th style='width:800px'></th>";
             html_text+= "</tr>"; 
    }
    document.getElementById("tables").innerHTML=html_text;
    
    html_text1 = "";
    html_text1 += "<h4 style='color:grey'>click to show seller message</h4>"
    html_text1 += "<input type='image' name='sellerdetail' src='http://csci571.com/hw/hw6/images/arrow_down.png' width='60' height='40'  value='' onclick='sellerfunction()'>";     
    document.getElementById("sellerMessage").innerHTML=html_text1;
    
    html_text2 = "";
    html_text2 += "<h4 style='color:grey'>click to show similar items</h4>"
    html_text2 += "<img border='0' name='similarItems' src='http://csci571.com/hw/hw6/images/arrow_down.png' width='60' height='40' onclick='similarfunction()'>";
    
    document.getElementById("similarItems").innerHTML = html_text2;
}
    

function sellerfunction(){
    
    html_text2 = "";
    html_text2 += "<h4 style='color:grey'>click to close seller message</h4>"
    html_text2 += "<img border='0' src='http://csci571.com/hw/hw6/images/arrow_up.png' width='60' height='40' onclick='closeSellerfunction()'>";    
    
    document.getElementById("sellerMessage").innerHTML = html_text2;
    var iFrameID = document.getElementById('myframe');
    console.log(heightvalue);
    iFrameID.style.display = "block";
    console.log(heightvalue);
}
    
function closeSellerfunction(){
    html_text1 = "";
    html_text1 += "<h4 style='color:grey'>click to show seller message</h4>"
    html_text1 += "<input type='image' name='sellerdetail' src='http://csci571.com/hw/hw6/images/arrow_down.png' width='60' height='40'  value='' onclick='sellerfunction()'>";     
    document.getElementById("sellerMessage").innerHTML=html_text1;
    
    var iFrameID = document.getElementById('myframe');
    iFrameID.style.display = "none";
}    
    

function sellerfunction1(){

    var iFrameID = document.getElementById('myframe');
    iFrameID.style.display = "block";
    html_text3 = "";
    html_text3 += passover;  
    window.frames['myframe'].document.body.innerHTML = html_text3;  
    
}
    
function similarfunction(){
    html_text5 = "";
    html_text5 += "<h4 style='color:grey'>click to close similar items</h4>"
    html_text5 += "<img border='0' src='http://csci571.com/hw/hw6/images/arrow_up.png' width='60' height='40' onclick='closeSimilarfunction()'>";
    document.getElementById("similarItems").innerHTML = html_text5;
    var iFrameID = document.getElementById('myframe1');
    console.log(heightvalue);
    iFrameID.style.display = "block";
    console.log(heightvalue);
}

function closeSimilarfunction(){
    html_text1 = "";
    html_text1 += "<h4 style='color:grey'>click to show similar items</h4>"
    html_text1 += "<input type='image' name='sellerdetail' src='http://csci571.com/hw/hw6/images/arrow_down.png' width='60' height='40'  value='' onclick='similarfunction()'>";     
    document.getElementById("similarItems").innerHTML=html_text1;
    
    var iFrameID = document.getElementById('myframe1');
    iFrameID.style.display = "none";
    
}    

function similarfunction1(code){
    
    var iFrameID = document.getElementById('myframe1');
    iFrameID.style.display = "block";
    var items = code.getSimilarItemsResponse.itemRecommendations.item;
    
    html_txt = "";
    html_txt+= "<table>";
    html_txt+= "<tbody>";
    html_txt+= "<tr>"; 

    for (var i = 0; i < 8; i++){
       var item = items[i]; 
       var photo =  item.imageURL; 
       var itemiD = item.itemId;

        html_txt+= '<th style="width:600px"><img src="'+ photo +'" height=150 width=150></th>';
    }
    
    
    html_txt+= "</tr>";
    html_txt+= "<tr>";
    for (var i = 0; i < 8; i++){
       var item = items[i]; 
       var title = item.title;   
        html_txt+= '<th style="width:600px"><a target="_parent" href="productSearch.php?itemId='+itemiD+'">'+ title +'</a></th>';
        
    }
    html_txt+= "</tr>";
    html_txt+= "<tr>";
    for (var i = 0; i < 8; i++){
       var item = items[i]; 
       var price =  item.buyItNowPrice.__value__ + ' ' +item.buyItNowPrice["@currencyId"];    
        html_txt+= "<th style='width:600px'>"+ price +"</th>";
    }
    html_txt+= "</tr>";
    html_txt+= "</tbody>";
    html_txt+= "</table>";
    
    window.frames['myframe1'].document.body.innerHTML = html_txt;

}    
     
function iframeLoaded1() {
      var iFrameID = document.getElementById('myframe1');
      if(iFrameID) {
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
            heightvalue = iFrameID.height;
            console.log(heightvalue);
            document.getElementById('myframe1').style.display = "none";     
      }   
}     
        
function iframeLoaded() {
      var iFrameID = document.getElementById('myframe');
      if(iFrameID) {
            iFrameID.height = "";
            iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
            heightvalue = iFrameID.height;
            console.log(heightvalue);
            document.getElementById('myframe').style.display = "none";     
      }   
  }    
    

</script>    
    
           
    </body>
</html>
<?php
       
    if(isset($_POST['search']) && $_SERVER['REQUEST_METHOD'] == "POST"){
      echo "<script>  Event_Search_table($resp); </script>";    
	
      }       
        
   if(isset($_GET['itemId']) && !isset($_POST['search'])){

       $URL = "http://open.api.ebay.com/shopping?callname=GetSingleItem&responseencoding=JSON&appid=".$AppID."&siteid=0&version=967&ItemID=".$_GET['itemId']."&IncludeSelector=Description,Details,ItemSpecifics";
       $second = file_get_contents($URL);

       echo "<script>  check($second); </script>";
       $URL1="http://svcs.ebay.com/MerchandisingService?OPERATION-NAME=getSimilarItems&SERVICE-NAME=MerchandisingService&SERVICE-VERSION=1.1.0&CONSUMER-ID=".$AppID."&RESPONSE-DATA-FORMAT=JSON&REST-PAYLOAD&itemId=".$_GET['itemId']."&maxResults=8";
       
       
       $third = file_get_contents($URL1);
       echo "<script>  sellerfunction1(); </script>";
       echo "<script>  iframeLoaded(); </script>";  
   
       echo "<script>  similarfunction1($third); </script>";
       echo "<script>  iframeLoaded1(); </script>";
   }
?>
   