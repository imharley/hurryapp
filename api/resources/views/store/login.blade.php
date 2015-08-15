@extends('master')

@section('content')

<div class="container">
<div class="panel panel-default">
  <div class="panel-heading">Login</div>

  <div class="panel-body">
  @if (isset($error_msg))
    <div class="alert alert-danger">
      {{ $error_msg }}
    </div>
    
  @endif
  
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

@stop