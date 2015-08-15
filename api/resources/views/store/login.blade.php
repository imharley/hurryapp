<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Hurry App - Login</title>

<link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/superhero/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container">
<div class="panel panel-default">
  <div class="panel-heading">Login {{ @$error_msg }}</div>

  <div class="panel-body">
    <form class="form-horizontal" action="/login" method="post">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      <div class="form-group">
        <label for="email" class="col-sm-2 control-label">Email</label>
        <div class="col-sm-10">
          <input type="email"  name="email" class="form-control" id="email" placeholder="Email">
        </div>
      </div>
      <div class="form-group">
        <label for="password" class="col-sm-2 control-label">Password</label>
        <div class="col-sm-10">
          <input type="password" name="password" class="form-control" id="password" placeholder="Password">
        </div>
      </div>
      
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-info">Sign in</button>
        </div>
      </div>
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