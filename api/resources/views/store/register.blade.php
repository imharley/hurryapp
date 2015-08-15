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
<div class="panel panel-default">
  <div class="panel-heading">Register Store</div>

 <div class="panel-body">
  <form method="post" action="/register">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="col-sm-6">
    <div class="form-group">
      <label for="name">Store Name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Name">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email">
    </div>
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
    </div>
    <div class="form-group">
      <label for="description">Store Description</label>      
      <textarea class="form-control" id="description" name="description"></textarea>
    </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label for="name">Store Location</label>
        <br/>
        <div class="col-sm-12">
        <label class="">Longtitude</label>
        
          <input type="text" class="form-control" name="longtitude" id="longtitude" placeholder="Longtitude">
        </div>
        <div class="col-sm-12">
        <label class="">Latitude</label>      
          <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Latitude">
        </div>
        <div class="clearfix"></div>
      </div>
      <div class="form-group">
        <label for="name">Store Hours</label>
        <br/>
        <div class="col-sm-12">
        <label class="">Open</label>
        
          <input type="text" class="form-control" name="open" id="open" placeholder="Open">
        </div>
        <div class="col-sm-12">
        <label class="">Close</label>      
          <input type="text" class="form-control" name="close" id="close" placeholder="Close">
        </div>
      </div>
      
    </div>
<div class="clearfix"></div>

    <button type="submit" class="btn btn-info">Register Now</button>
  </form>
 </div>

   </div>
</div>

<footer>

  <script src="http://code.jquery.com/jquery-2.1.4.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  
</footer>

</body>

</html>