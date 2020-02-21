$(document).ready(function() {

loadcart();

 $('.top-auth').toggle(
       function() {
           $(".top-auth").attr("id","active-button");
           $("#block-top-auth").fadeIn(200);
       },
       function() {
           $(".top-auth").attr("id","");
           $("#block-top-auth").fadeOut(200);  
       }
    );



$("#button-auth").click(function() {
         
 var auth_login = $("#auth_login").val();
 var auth_pass = $("#auth_pass").val();
 
  
 if (auth_login == "" || auth_login.length > 30 )
 {
    $("#auth_login").css("borderColor","#FDB6B6");
    send_login = 'no';
 }else {
     
   $("#auth_login").css("borderColor","#DBDBDB");
   send_login = 'yes'; 
      }
 
  
if (auth_pass == "" || auth_pass.length > 15 )
 {
    $("#auth_pass").css("borderColor","#FDB6B6");
    send_pass = 'no';
 }else { $("#auth_pass").css("borderColor","#DBDBDB");  send_pass = 'yes'; }
 
 
 
 if ($("#rememberme").prop('checked'))
 {
    auth_rememberme = 'yes';
 
 }else { auth_rememberme = 'no'; }
 
 
 if ( send_login == 'yes' && send_pass == 'yes' )
 { 
  $("#button-auth").hide();
  $(".auth-loading").show();
     
    $.ajax({
  type: "POST",
  url: "/include/auth.php",
  data: "login="+auth_login+"&pass="+auth_pass+"&rememberme="+auth_rememberme,
  dataType: "html",
  cache: false,
  success: function(data) {
 
  if (data == 'yes_auth')
  {
      location.reload();
  }else
  {
      $("#message-auth").slideDown(400);
      $(".auth-loading").hide();
      $("#button-auth").show();
       
  }
   
}
});  
}
}); 
 
 
$('#remindpass').click(function(){
     
            $('#input-email-pass').fadeOut(200, function() {  
            $('#block-remind').fadeIn(300);
            });
});
 
$('#prev-auth').click(function(){
     
            $('#block-remind').fadeOut(200, function() {  
            $('#input-email-pass').fadeIn(300);
            });
});
 
 
$('#button-remind').click(function(){
     
 var recall_email = $("#remind-email").val();
  
 if (recall_email == "" || recall_email.length > 20 )
 {
    $("#remind-email").css("borderColor","#FDB6B6");
 
 }else
 {
   $("#remind-email").css("borderColor","#DBDBDB");
    
   $("#button-remind").hide();
   $(".auth-loading").show();
     
  $.ajax({
  type: "POST",
  url: "/include/remind-pass.php",
  data: "email="+recall_email,
  dataType: "html",
  cache: false,
  success: function(data) {
 
  if (data == 'yes')
  {
     $(".auth-loading").hide();
     $("#button-remind").show();
     $('#message-remind').attr("class","message-remind-success").html("На ваш e-mail выслан пароль.").slideDown(400);
      
     setTimeout("$('#message-remind').html('').hide(),$('#block-remind').hide(),$('#input-email-pass').show()", 3000);
  
  }else
  {
      $("#button-remind").show();
      $('#message-remind').attr("class","message-remind-error").html(data).slideDown(400);
       
  }
  }
}); 
  }
  }); 
 
  $('#auth-user-info').toggle(
       function() {
           $("#block-user").fadeIn(100);
       },
       function() {
           $("#block-user").fadeOut(100);
       }
    );
 
 
$('#logout').click(function(){
     
    $.ajax({
  type: "POST",
  url: "/include/logout.php",
  dataType: "html",
  cache: false,
  success: function(data) {
 
  if (data == 'logout')
  {
      location.reload();
  }
   
}
}); 
});
loadcart();

$('.add-cart-style-grid').click(function(){
               
 var  tid = $(this).attr("tid");
 
 $.ajax({
  type: "POST",
  url: "/include/addtocart.php",
  data: "id="+tid,
  dataType: "html",
  cache: false,
  success: function(data) { 
  loadcart();
      }
});
 
});
 
function loadcart(){
     $.ajax({
  type: "POST",
  url: "/include/loadcart.php",
  dataType: "html",
  cache: false,
  success: function(data) {
     
  if (data == "0")
  {
   
    $("#block-basket > a").html("Корзина пуста");
     
  }else
  {
    $("#block-basket > a").html(data);
 
  }  
     
      }
});    
        
}
 
 
 function fun_group_price(intprice) {  
    // Группировка цифр по разрядам
  var result_total = String(intprice);
  var lenstr = result_total.length;
   
    switch(lenstr) {
  case 4: {
  groupprice = result_total.substring(0,1)+" "+result_total.substring(1,4);
    break;
  }
  case 5: {
  groupprice = result_total.substring(0,2)+" "+result_total.substring(2,5);
    break;
  }
  case 6: {
  groupprice = result_total.substring(0,3)+" "+result_total.substring(3,6); 
    break;
  }
  case 7: {
  groupprice = result_total.substring(0,1)+" "+result_total.substring(1,4)+" "+result_total.substring(4,7); 
    break;
  }
  default: {
  groupprice = result_total;  
  }
}  
    return groupprice;
    }
 
 
 
$('.count-minus').click(function(){
 
  var iid = $(this).attr("iid");      
  
 $.ajax({
  type: "POST",
  url: "/include/count-minus.php",
  data: "id="+iid,
  dataType: "html",
  cache: false,
  success: function(data) {   
  $("#input-id"+iid).val(data);  
  loadcart();
   
  // переменная с ценной продукта
  var priceproduct = $("#tovar"+iid+" > p").attr("price"); 
  // Цену умножаем на колличество
  result_total = Number(priceproduct) * Number(data);
  
  $("#tovar"+iid+" > p").html(fun_group_price(result_total)+" руб");
  $("#tovar"+iid+" > h5 > .span-count").html(data);
   
  itog_price();
      }
});
   
});
 
$('.count-plus').click(function(){
 
  var iid = $(this).attr("iid");      
   
 $.ajax({
  type: "POST",
  url: "/include/count-plus.php",
  data: "id="+iid,
  dataType: "html",
  cache: false,
  success: function(data) {   
  $("#input-id"+iid).val(data);  
  loadcart();
   
  // переменная с ценной продукта
  var priceproduct = $("#tovar"+iid+" > p").attr("price"); 
  // Цену умножаем на колличество
  result_total = Number(priceproduct) * Number(data);
  
  $("#tovar"+iid+" > p").html(fun_group_price(result_total)+" руб");
  $("#tovar"+iid+" > h5 > .span-count").html(data);
   
  itog_price();
      }
});
   
});
 
 $('.count-input').keypress(function(e){
     
 if(e.keyCode==13){
        
 var iid = $(this).attr("iid");
 var incount = $("#input-id"+iid).val();        
  
 $.ajax({
  type: "POST",
  url: "/include/count-input.php",
  data: "id="+iid+"&count="+incount,
  dataType: "html",
  cache: false,
  success: function(data) {
  $("#input-id"+iid).val(data);  
  loadcart();
     
  // переменная с ценной продукта
  var priceproduct = $("#tovar"+iid+" > p").attr("price"); 
  // Цену умножаем на колличество
  result_total = Number(priceproduct) * Number(data);
 
 
  $("#tovar"+iid+" > p").html(fun_group_price(result_total)+" руб");
  $("#tovar"+iid+" > h5 > .span-count").html(data);
  itog_price();
 
      }
}); 
  }
});
 
function  itog_price(){
  
 $.ajax({
  type: "POST",
  url: "/include/itog_price.php",
  dataType: "html",
  cache: false,
  success: function(data) {
 
  $(".itog-price > strong").html(data);
 
}
}); 
        
}
});

