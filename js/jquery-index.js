/******************JQuery for index,about us and other page***************************/

						function checkusername(){
							var data=$('#t1').val();
							var letters=/^([A-Za-z]{5,})+$/;
							if(!letters.test(data))
							{
								$("#t1").css("background","rgb(255,217,239) url('images/wrong.png') 13px 13px no-repeat");
								alert("Username should contain only alphabets and length should be greater than 4");
								return false;
							}
							else
							{
								$("#t1").css("background","rgb(151,217,239) url('images/done.png') 10px 10px no-repeat");
								return true;
							}
						} 
						
						function checkloginusername(){
							var data=$('#username').val();
							var letters=/^([A-Za-z]{5,})+$/;
							if(!letters.test(data))
							{
								$("#username").css("background","rgb(255,217,239) url('images/wrong.png') 13px 13px no-repeat");
								alert("Invalid Username");
								return false;
							}
							else
							{
								$("#username").css("background","rgb(151,217,239) url('images/done.png') 10px 10px no-repeat");
								return true;
							}
						} 
                       
                       function checkpassword(){
							var data=$('#t2').val();
							var num=/^(?=.*\d.*\d)[0-9A-Za-z!@#$%*]{8,}$/;
							if(!num.test(data))
							{
								$("#t2").css("background","rgb(255,217,239) url('images/wrong.png') 13px 13px no-repeat");
                                alert("Password should contain atleast one of each upper alphabhet[A-Z],lower alphabhet[a-z],"+
								"number[0-9],special char[!@#$%*] and minimum length is 8"); 
								return false;
							}
							else
							{
								$("#t2").css("background","rgb(151,217,239) url('images/done.png') 10px 10px no-repeat");
								return true;
							}
                       } 
					   function checkloginpassword(){
							var data=$('#password').val();
							var num=/^(?=.*\d.*\d)[0-9A-Za-z!@#$%*]{8,}$/;
							if(!num.test(data))
							{
								$("#password").css("background","rgb(255,217,239) url('images/wrong.png') 13px 13px no-repeat");
                                alert("Invalid Password"); 
								return false;
							}
							else
							{
								$("#password").css("background","rgb(151,217,239) url('images/done.png') 10px 10px no-repeat");
								return true;
							}
                       } 
                        
                       function checkemail(){
							var data=$('#t3').val();
							var pass=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
							if(!pass.test(data))
							{
								$("#t3").css("background","rgb(255,217,239) url('images/wrong.png') 13px 13px no-repeat");
                                alert("Invalid Email address");
								return false;
							}
							else
							{
								$("#t3").css("background","rgb(151,217,239) url('images/done.png') 10px 10px no-repeat");
								return true;
							}
                       }
                       
                       function checkcontact(){
							var data=$('#t4').val();
							var con=/^([0-9]{10,10})+$/;
							if(!con.test(data)){
                                $("#t4").css("background","rgb(255,217,239) url('images/wrong.png') 13px 13px no-repeat");
								alert("Contact number should be 10 digits long");
								return false;								
							}
							else
							{
								$("#t4").css("background","rgb(151,217,239) url('images/done.png') 10px 10px no-repeat");
								return true;
							}
                       } 		
		
		function valid(form)
		{
			var isvalid = false;
			
			isvalid=checkusername();
			if(!isvalid)
			return false;
			
			isvalid=checkpassword();
			if(!isvalid)
			return false;
			
			isvalid=checkemail();
			if(!isvalid)
			return false;
			
			isvalid=checkcontact();
			if(!isvalid)
			return false;
		}
		function valid2(form)
		{
			var isvalid = false;
			
			isvalid=checkloginusername();
			if(!isvalid)
			return false;
			
			isvalid=checkloginpassword();
			if(!isvalid)
			return false;
		}
       
		$(document).ready(function(){

		setTimeout(function(){$("#upperbody").css("background-image","url(images/2.png)");},700);

			function hidesignup()
			{
					$("#signup").css("opacity","0");
					$("#lcenterlineup").animate({top:"15em"},700);
					$("#lcenterlinedown").animate({top:"15em"},700,function(){
					$("#lcenterlinedown").hide();
					$("#lcenterlineup").hide();
					$("#centerline").show(1);
					$("#centerline").animate({left:"35%"},700);
					});
					$("#signup").css("visibility","hidden");
			}
			function hidelogin()
			{
					$("#login").css("opacity","0");
					$("#rcenterlineup").animate({top:"15em"},700);
					$("#rcenterlinedown").animate({top:"15em"},700,function(){
					$("#rcenterlinedown").hide();
					$("#rcenterlineup").hide();
					$("#centerline").show(1);
					$("#centerline").animate({left:"35%"},700);
					});
					$("#login").css("visibility","hidden");
			}
			function showsignup()
			{
			$("#signup").css("display","block");
					$("#centerline").animate({left:"1.5%"},700,function(){
					$("#centerline").hide();
					$("#lcenterlineup").show(1);
					$("#lcenterlinedown").show(1);
					$("#lcenterlineup").animate({top:"3em"},700);
					$("#lcenterlinedown").animate({top:"26.6em"},700,function(){
					$("#signup").css("opacity","1");
					$("#signup").css("visibility","visible");
					});
					});
			}
			function showlogin()
			{
			$("#login").css("display","block");
					$("#centerline").animate({left:"68.5%"},700,function(){
					$("#centerline").hide();
					$("#rcenterlineup").show(1);
					$("#rcenterlinedown").show(1);
					$("#rcenterlineup").animate({top:"7.43em"},700);
					$("#rcenterlinedown").animate({top:"21.87em"},700,function(){
					$("#login").css("opacity","1");
					$("#login").css("visibility","visible");
					});
					});	
			}
		
			$("#signupbtn").click(function(){
			    var j=document.getElementById("signupbtn");
				j.setAttribute("disabled","disabled");
				if($("#login").css("opacity")=="1")
				{
					hidelogin();
					var i=setTimeout(function(){showsignup();},1000);
				}
				else if($("#signup").css("opacity")=="0")
				{
					showsignup();
				}
				else if($("#signup").css("opacity")=="1")
				{
					hidesignup();
				}
				j.removeAttribute("disabled");
			});


			$("#signinbtn").click(function(){
				var j=document.getElementById("signinbtn");
				j.setAttribute("disabled","disabled");
				if($("#signup").css("opacity")=="1")
				{
					hidesignup();
					var p=setTimeout(function(){showlogin();},1000);
				}
				else if($("#login").css("opacity")=="0")
				{
					showlogin();
				}
				else if($("#login").css("opacity")=="1")
				{
					hidelogin();
				}
				j.removeAttribute("disabled");
			});
			
		});
		
		