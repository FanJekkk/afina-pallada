<?php
	include("functions/functions.php");
    include("include/db_connect.php");
    session_start();
    include("include/auth_cookie.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>

<head>
 <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
 
 <link href="css/reset.css" rel="stylesheet" type="text/css" />
 <link href="css/style.css" rel="stylesheet" type="text/css" />
 
 <script type="text/javascript" src="/js/jquery-1.8.2.min.js"></script> 
 <script type="text/javascript" src="/js/jcarousellite_1.0.1.js"></script> 
 <script type="text/javascript" src="/js/shop-script.js"></script>
 <script type="text/javascript" src="/js/jquery.cookie.min.js"></script>

 <script type="text/javascript" src="/js/jquery.form.js"></script>
 <script type="text/javascript" src="/js/jquery.validate.js"></script> 
 
  <script type="text/javascript">
$(document).ready(function() {  
      $('#form_reg').validate(
                {   
                    // ������� ��� ��������
                    rules:{
                        "reg_login":{
                            required:true,
                            minlength:3,
                            maxlength:15,
                            remote: {
                            type: "post",    
                            url: "/reg/check_login.php"
                                    }
                        },
                        "reg_pass":{
                            required:true,
                            minlength:7,
                            maxlength:15
                        },
                        "reg_surname":{
                            required:true,
                            minlength:3,
                            maxlength:15
                        },
                        "reg_name":{
                            required:true,
                            minlength:3,
                            maxlength:15
                        },
                        "reg_patronymic":{
                            required:true,
                            minlength:3,
                            maxlength:25
                        },
                        "reg_email":{
                            required:true,
                            email:true
                        },
                        "reg_phone":{
                            required:true
                        }
                             
                    },
 
                    // ��������� ��������� ��� ��������� ��������������� ������
                    messages:{
                        "reg_login":{
                            required:"������� �����!",
                            minlength:"�� 3 �� 15 ��������!",
                            maxlength:"�� 3 �� 15 ��������!",
                            remote: "����� �����!"
                        },
                        "reg_pass":{
                            required:"������� ������!",
                            minlength:"�� 7 �� 15 ��������!",
                            maxlength:"�� 7 �� 15 ��������!"
                        },
                        "reg_surname":{
                            required:"������� ���� �������!",
                            minlength:"�� 3 �� 20 ��������!",
                            maxlength:"�� 3 �� 20 ��������!"                           
                        },
                        "reg_name":{
                            required:"������� ���� ���!",
                            minlength:"�� 3 �� 15 ��������!",
                            maxlength:"�� 3 �� 15 ��������!"                              
                        },
                        "reg_patronymic":{
                            required:"������� ���� ��������!",
                            minlength:"�� 3 �� 25 ��������!",
                            maxlength:"�� 3 �� 25 ��������!" 
                        },
                        "reg_email":{
                            required:"������� ���� E-mail",
                            email:"�� ���������� E-mail"
                        },
                        "reg_phone":{
                            required:"������� ����� ��������!"
                        }
                    },
                     
    submitHandler: function(form){
    $(form).ajaxSubmit({
    success: function(data) { 
                                  
        if (data == 'true')
    {
       $("#block-form-registration").fadeOut(300,function() {
         
        $("#reg_message").addClass("reg_message_good").fadeIn(400).html("�� ������� ����������������!");
        $("#form_submit").hide();
         
       });
          
    }
    else
    {
       $("#reg_message").addClass("reg_message_error").fadeIn(400).html(data); 
    }
        } 
            }); 
            }
            });
        });
      
</script>
 
 <title>�����������</title>
</head>

<body>
<div id="block-body">
<?php
if( isset($_SESSION['logged_user'])): ?>
�������������!
������, <?php echo $_SESSION['logged_user']->login; ?>
<hr/>
<button type="submit" id="exit"><a href="/logout.php">�����</a></button>
<p id="block-cart"><a href="cart.php?action=oneclick">������� �����</a></p>
<?php else: ?>
<p id="reg-auth-title" align="right"><a href="auth.php">����/�����������</a></p>
<?php endif; ?>

<div id="block-search1">

<form method="GET" action="search.php?q=" >
<input type="text" id="input-search" name="q" value="����� ����� � ���������" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/><span id="span1"></span>
<input type="submit" id="button-search" value="�����" />




</form>


</div>
</div>
<?php
	include("include/block-header.php");
?>
<?php
	include("include/block-header-bottom.php");
?>





<div id="block-content1">
<div id="block-registration">

<h2 class="h2-title">�����������</h2>
<form method="post" id="form_reg" action="reg/handler_reg.php">
<p id="reg_message"></p>
<div id="block-form-registration">
<ul id="form-registration">
 
<li>
<label>�����</label>
<span class="star" >*</span>
<input type="text" name="reg_login" id="reg_login" />
</li>
 
<li>
<label>������</label>
<span class="star" >*</span>
<input type="text" name="reg_pass" id="reg_pass" />
</li>
 
<li>
<label>�������</label>
<span class="star" >*</span>
<input type="text" name="reg_surname" id="reg_surname" />
</li>
 
<li>
<label>���</label>
<span class="star" >*</span>
<input type="text" name="reg_name" id="reg_name" />
</li>
 
<li>
<label>��������</label>
<span class="star" >*</span>
<input type="text" name="reg_patronymic" id="reg_patronymic" />
</li>
 
<li>
<label>E-mail</label>
<span class="star" >*</span>
<input type="text" name="reg_email" id="reg_email" />
</li>
 
<li>
<label>��������� �������</label>
<span class="star" >*</span>
<input type="text" name="reg_phone" id="reg_phone" />
</li>

<p align="right"><input type="submit" name="form_submit" id="form_submit" value="�����������" /></p>
 
</form>
 
</ul>
</div>







</div>

</div>
<?php
	include("include/block-footer.php");
?>
</div>
</body>
</html>