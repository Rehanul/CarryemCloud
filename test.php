<html>
	<head>
		<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
	 <script>
	$(document).ready(function(){
		$("#btn").click(function()
	{
		//$("#item").last();
		alert($("#container").children("#item").last().index());
		$("#container").children("#item:eq(0)").fadeOut();
		alert($("#container").children("#item").last().index());
	});
	});
	</script>
	</head>
	
	<body>
		<input type="button" id="btn" value="click me" />
		<div id="container">
			<div id="item">
				<img src="a.png" />
				<p>1</p>
			</div>
			<div id="item">
				<img src="b.png" />
				<p>2</p>
			</div>
			<div id="item">
				<img src="a.png" />
				<p>3</p>
			</div>
			<div id="item">
				<img src="c.png" />
				<p>4</p>
			</div>
		</div>
	</body>
</html>