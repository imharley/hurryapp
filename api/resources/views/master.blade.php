<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hurry App</title>

<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/superhero/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container">
	<nav id="navbar-example2" class="navbar navbar-default navbar-static">
      <div class="container-fluid">
        <div class="navbar-header">
          <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-scrollspy">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Hurry App</a>
        </div>
        <div class="collapse navbar-collapse bs-example-js-navbar-scrollspy">
          <ul id="myTabs" class="nav navbar-nav" role="tablist">
		      <li role="presentation" class="active"><a href="#products" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="false">Products</a></li>
		      <li role="presentation" class=""><a href="#orders" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="true">Orders</a></li>		      
		    </ul>
        </div>
      </div>
    </nav>


 <div class="">
 	@yield('content')
 </div>

 </div>

<footer>
	@yield('footer')

	<script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script type="text/javascript">
		$('#myTabs a').click(function (e) {
		  e.preventDefault()
		  console.log($(this));
		  $(this).tab('show');
		})
	</script>

</footer>

</body>

</html>