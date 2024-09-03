/******************JQuery for home page***************************/

var path = '';
$imageindex = 0;
$prevchildindex=-1;
$(document).ready(function() 
{
	$("#logout").click(function()
	{
		window.location.href = 'logout.php';
	});


	$("#searchbtn").click(function()
	{
		search();
	});
	
	$('#search_field').keyup(function(e){
		if(e.keyCode == 13)
		{
			search();
		}
	});

	$("#showimage").click(function()
	{
		showOnly("image");
	});
	$("#showtext").click(function()
	{
		showOnly("text");
	});
	$("#showvideo").click(function()
	{
		showOnly("video");
	});
	$("#showaudio").click(function()
	{
		showOnly("audio");
	});
	
	$("#showapplication").click(function()
	{
		showOnly("application");
	});
	
	$("#showall").click(function()
	{
		showAll();
	});

	


	
	$(".alert").click(function(){
		alert('profile updated');
	});
	$("#edit").css({'opacity':'0'});
	$("#edit").hover(function(){
			$("#edit").stop().animate({'opacity':'0.7'},500);
	 }, function(){
		 $("#edit").stop().animate({'opacity':'0'},500);
	});
	//browse for the first time
	browse('/');
	
	$("#path_root").click(function()
	{
		browse('/');
		$(".foldername").remove();
	});
		
	var options = 
	{
		//ToDo
		// check no file size type before submit
		beforeSubmit:  beforeSubmit,
		uploadProgress: OnProgress,
		success: function(data)
		{
			//alert(data+"\n");
			var error = handleError(data);
			if(!error)
			{
				toast('File successfully uploaded..');
				$(".item:eq(1)").after(data);
				$(".item:eq(2)").click(function(){
					itemClick( $(this) );
				});
				$("#count").html(( parseInt($("#count").html()) +1));
			}
			$("#loading").css("display",'none');
		},
		resetForm: true
	};//end of options
		
	$('#MyUploadForm').submit(function()
	{	
		//changing the GET parameters
		$("#MyUploadForm").attr("action", "save.php?path="+path);
		$(this).ajaxSubmit(options);
		return false; //return false to prevent page navigation 
	});
	
	//customised
	function OnProgress(event, position, total, percentComplete)
	{
	//Progress bar
	$("#loading").css("display","block");
	$("#statustext").html(percentComplete + '%'); //update status text
	//$("#loading").css("display",'none');
	}

	//Add Folder
	$("#addfolderbtn").click(function()
	{	
		$fname = $("#foldername").val();

		//return if foldername is empty
		if(!$fname)
		{
			handleError("211");
			return false;
		}

		//ToDo
		//check for valid folder name

		$.get("mkdir.php",
		{
			foldername : $fname,
			path : path,
		},
		function(data)
		{
			//alert(data);
			var error = handleError(data);
			if(!error)
			{
				toast('Folder '+$fname+' Created');
				var d = new Date();
				$newdiv = 	"<div class='item' tabindex='0'>"+
								"<img id='icon' src=images/folder.png><br/>"+
								"<p>"+$fname+"</p>"+
								"<div id='hidden'>"+
									"<div id='filename' >"+$fname+"</div>"+
									"<div id='filetype'>Folder</div>"+
									"<div id='filesize'>0 MB</div>"+
									"<div id='filetime'>"+d.getFullYear()+"-"+(d.getMonth()+1)+
									"-"+d.getDate()+"-"+" "+d.getHours()+
									":"+d.getMinutes()+":"+d.getSeconds()+
									"</div>"+
								"</div>"+
							"</div>";
				
				$(".item:eq(1)").after($newdiv);
				//$(".item:eq(1)").after(data);
				
				$('.item:eq(2)').click(function()
				{
					itemClick( $(this) );
				});
				
				$("#foldername").val("");
				$("#count").html(( parseInt($("#count").html()) +1));
				//alert("folder created");
			}//end of if error
		});//end of get request
	});//end of Add Folder
	
	$("#close").click(function()
	{
		$("#lightbox").fadeOut(500);
	});
	
	$(".next").click(function()
	{
		$temp = $imageindex;
		$max = parseInt($("#count").html())+2;
		while(true)
		{
			$temp= $temp+1;
			if($temp==$max)
			$temp=2;
			
			$item=$(".item:eq("+$temp+")");
			$type = $item.children("#hidden").children("#filetype").html();
			
			if($type.indexOf("image") != -1)
			break;
		}
		$fname = encodeURIComponent($item.children("#hidden").children("#filename").html());

		$imageindex = $item.index();
		$("#lightbox_image").attr('src', "get.php?imagename="+$fname+"&path="+path).load(function() 
		{
			$("#lightbox_image").fadeIn();
		});
		$("#image_info").html($fname);
	});//end of next image click
	
	
	$(".prev").click(function()
	{
		$temp = $imageindex;
		$max = parseInt($("#count").html())+1;
		while(true)
		{
			$temp=($temp-1);
			if($temp==2)
			$temp=$max;
			
			$item=$(".item:eq("+$temp+")");
			$type = $item.children("#hidden").children("#filetype").html();
			
			if($type.indexOf("image") != -1)
			break;
		}
		$fname = encodeURIComponent($item.children("#hidden").children("#filename").html());

		$imageindex = $item.index();
		$("#lightbox_image").attr('src', "get.php?imagename="+$fname+"&path="+path).load(function() 
		{
			$("#lightbox_image").fadeIn();
		});
		$("#image_info").html($fname);
	});//end of prev image click
		
});//end of document.ready function

/*--------------------------------------------------------------------------------*/

//function to check file size before uploading.
function beforeSubmit(){
	//ToDo
}

function browse(fullpath)
{
	//alert(path);
	$.get("browse.php",
		{
			explore : fullpath
		},
		function(data)
		{
			var error = handleError(data);
			if(!error)
			{
				$(".item:gt('1')").remove();
				$(".item:eq('1')").after(data);
				
				$(".item").unbind('click');
				$(".item").click(function()
				{
					itemClick( $(this) );
				});
				
				$("#count").html($("#browse").children("#hidden").html());
				
				/*var str = fullpath;
				str = fullpath.replace(path, '');
				alert(fullpath.split('/')[fullpath.split('/').length-1]);
				//alert("path:"+path+"\nfullpath:"+fullpath+"\nstr:"+str);
				*/
				/*if(!(path=='/'||fullpath=='/'))
				str = str.replace('/', '');*/
				var str = fullpath.split('/');
				str = str[str.length-1];
				//str=str==''?'/':str;
				
				path = fullpath;
				$prevchildindex=-1;
				
				if(str!='')
				$("#track_path").append("<span class='foldername'>"+str+"&nbsp;/"+"<div id='hidden'>"+path+"</div></span>");
				
				$(".foldername").unbind('click');	
				$(".foldername").click(function()
				{
					if($(this).children("#hidden").html()!=path)
					{
						if($(this).index()==1)
						$(".foldername").remove();
						else
						$(".foldername:gt('"+($(this).index()-2)+"')").remove();
						browse($(this).children("#hidden").html());
					}
				});//end of onclick mypath
			}//end of if no error
		}//end of success function
	);//end of get request
}//end of browse()


function handleError(data)
{
	switch(data)
	{
		case '000':
		alert("testing error");
		return true;
		break;
				
		case '111':
		alert("Unable to connect to SQL server");
		return true;
		break;
				
		case '112':
		alert("Unable to select Database : error no. 112");
		return true;
		break;
				
		case '113':
		alert("Querry failed");
		return true;
		break;
				
		case '211':
		alert("Folder/File Name cannot be Blank");
		return true;
		break;
		
		case '215':
		alert("empty search");
		return true;
		break;
		
		case '212':
		alert("Invalid Request");
		return true;
		break;
				
		case '213':
		alert("Some error in creating folder");
		return true;
		break;
				
		case '214':
		alert("Empty Request");
		return true;
		break;
				
		case '876':
		alert("This destination already contains a folder/file with same name");
		return true;
		break;
				
		case '986':
		alert("exist 0 entry 1");
		return true;
		break;
				
		case '987':
		alert("exist 1 entry 0");
		return true;
		break;
				
		case '563':
		alert("No file submitted");
		return true;
		break;
				
		case '564':
		alert("some error in File");
		return true;
		break;
				
		case '672':
		alert("Cannot move uploaded file");
		return true;
		break;
				
		case 'xxx':
		alert("xxx");
		return true;
		break;
				
		default:
		return false;
	}//end of switch
}//end of handleError()


function itemClick($item)
{
	//alert($item.index());
	$itemIndex = $item.index();
	if( $prevchildindex != $itemIndex )
	{
		$(".item:eq("+$prevchildindex+")").children("#box").remove();
			
		//	IMAGE clicked
		//if($type.indexOf("image") != -1)
		$type = $item.children("#hidden").children("#filetype").html();
		if($type.indexOf("image") != -1)
		{
			$nothing = 	"<span id='box'>"+
							"<input class='box_button' id='box_view' type='button' value='View'/>"+
							"<input class='box_button' id='box_download' type='button' value='Download'>"+
						"</span>";
			
			$item.children("p").before($nothing);
			
			$("#box_download").click(function(data)
			{
				$fname = $item.children("#hidden").children("#filename").html();
				window.open("download.php?filename="+$fname+"&path="+path, '_blank');
			});
			$("#box_view").click(function(data)
			{	
				$imageindex = $itemIndex;
				$fname = encodeURIComponent($item.children("#hidden").children("#filename").html());
				
				$("#lightbox_image").attr('src', "get.php?imagename="+$fname+"&path="+path).load(function() 
				{
					$("#lightbox_image").fadeIn();
				});
				
				$("#lightbox").fadeIn(500);
				$("#image_info").html($fname);
			});
		}//end of image clicked
		
		//	Folder clicked
		else if($type=="Folder")
		{
			$nothing = 	"<span id='box'>"+
							"<input type='button' value='view' class='box_button'>"+
						"</span>";
			$item.children("p").before($nothing);
			
			$(".box_button").click(function()
			{
				if(path=='/')
					browse(path+$item.children("#hidden").children("#filename").html());
				else
					browse(path+"/"+$item.children("#hidden").children("#filename").html());
			});
		}//end of folder clicked
		
		//	only DOWNLOAD
		else if(!($itemIndex==0||$itemIndex==1))
		{
		//ToDo
			$nothing = 	"<span id='box'>"+
							"<input class='box_button' id='box_download' type='button' value='Download'>"+
						"</span>";
			$item.children("p").before($nothing);
			$("#box_download").click(function(data)
			{
				$fname = $item.children("#hidden").children("#filename").html();
				window.open("download.php?filename="+$fname+"&path="+path, '_blank');
			});
		}
		$prevchildindex = $itemIndex;
		
		
		//update info box
		if( $itemIndex == '0')
		{
		}
		else if( $itemIndex == 1 )
		{
		}
		else
		{
			$("#displayname").html($item.children("#hidden").children("#filename").html());
			$("#displaytype").html($item.children("#hidden").children("#filetype").html());
			$("#displaysize").html($item.children("#hidden").children("#filesize").html());
			$("#displaytime").html($item.children("#hidden").children("#filetime").html());
		}
	}
}

function search()
{
	$keyword = $("#search_field").val();

		//return if keyword is empty
		if(!$keyword)
		{
			handleError("215");
			return;
		}
		
		$.get("search.php",
		{
			search : $keyword
		},
		function(data)
		{
			var error = handleError(data);
			if(!error)
			{
				$(".item:gt('1')").remove();
				$(".item:eq('1')").after(data);
				
				$(".item").unbind('click');
				$(".item").click(function()
				{
					itemClick( $(this) );
				});
				
				$("#count").html($("#browse").children("#hidden").html());
				
				$prevchildindex=-1;
				
				}//end of if no error
		}//end of success function
	);//end of get request
		
}
function showOnly($filetype)
{
	$(".dock-item:eq(0)").css("opacity","0.7");
	$(".dock-item:gt(0)").css("opacity","0.7");
	$index = 2;
	$max = parseInt($("#count").html())+2;
	while($index < $max)
	{
		$type = $(".item:eq("+$index+")").children("#hidden").children("#filetype").html();
		//alert($type);
		if($type.indexOf($filetype) == -1)
		$(".item:eq("+$index+")").fadeOut();
		else
		$(".item:eq("+$index+")").fadeIn();
		$index = $index +1;
	}
	$("#show"+$filetype).css("opacity","1");
}
function toast($msg)
{
	$("#shadow_text").html($msg);
	$("#shadow").fadeIn(1500,function(){
	$("#shadow").delay(1000).fadeOut(1500);});
}


function showAll()
{
	$(".dock-item:gt(0)").css("opacity","0.7");
	$(".dock-item:eq(0)").css("opacity","1");
	$index = 2;
	$max = parseInt($("#count").html())+2;
	while($index < $max)
	{
		$(".item:eq("+$index+")").fadeIn();	
		$index = $index +1;
	}
}