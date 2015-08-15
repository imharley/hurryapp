@extends('master')

@section('content')
<div class="panel panel-default" id="">
	<div class="panel-body">
	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">
  Add Product
</button>

	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
	    <div class="modal-content">
	    <form method="post" action="/product/add" enctype="multipart/form-data">
	    <input type="hidden" name="_token" value="{{ csrf_token() }}">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Product Details</h4>
	      </div>
	      <div class="modal-body">
	        
			  <div class="form-group">
			    <label for="product_name">Product Name</label>
			    <input type="text" name="product_name" class="form-control" id="product_name" placeholder="Name">
			  </div>
			  <div class="form-group">
			    <label for="product_price">Product Price</label>
			    <input type="numer" name="product_price" class="form-control" id="product_price" placeholder="Price">
			  </div>
			  <div class="form-group">
			    <label for="product_image">Product Image</label>
			    <input type="file" name="product_image" id="product_image">			    
			  </div>
			  			  
			
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <input type="submit" value="Save Product" class="btn btn-info" />
	      </div>
	      </form>
	    </div>
	  </div>
	</div>

    <div id="content">
      <table class="table table-bordered table-striped">
      	<thead>
      		<th>Name</th>
      		<th>Short Description</th>
      		<th>Price</th>
      	</thead>
      	<tbody>
      		<tr>
      			<td>Product 1</td>
      			<td>This is just a test desc</td>
      			<td>P100</td>
      		</tr>
      	</tbody>
      </table>
      
    </div>
    
     
  </div>
</div>
  
@stop