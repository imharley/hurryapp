@extends('master')

@section('content')
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
		      <li role="presentation" class=""><a href="#delivery" role="tab" id="delivery-tab" data-toggle="tab" aria-controls="delivery" aria-expanded="true">Delivery Persons</a></li>
		      <li role="presentation" class=""><a href="/logout">Logout</a></li>
		    </ul>
		    <ul class="nav navbar-nav navbar-right">
	            <li class="active"><a>Hi <strong>{{ @$logged_store_name }}!</strong></a>	</li>
	          </ul>
        </div>
      </div>
    </nav>


	<div class="panel panel-default" id="">
		<div class="panel-body" >
		
		  @if (isset($msg_alert))
		    <div class="alert alert-{{ $msg_alert['alert_type'] }}">
		      {{ $msg_alert['msg'] }}
		    </div>		    
		  @endif


		<div class="tab-content">
			<div role="tabpanel" class="tab-pane fade active in" id="products" aria-labelledby="products-tab">
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
					    <label for="product_name">Product Description</label>			    
					    <textarea name="product_description" placeholder="Description" class="form-control"></textarea>
					  </div>
					  <div class="form-group">
					    <label for="product_price">Product Price</label>
					    <input type="number" name="product_price" class="form-control" id="product_price" placeholder="Price">
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

			<br/><br/>
		    
		      <table class="table table-bordered table-striped 	table-hover" >
		      	<thead>
		      		<tr>
			      		<th>Picture</th>
			      		<th>Name</th>
			      		<th>Short Description</th>
			      		<th>Price</th>
		      		</tr>
		      	</thead>
		      	<tbody>
		      		@if(count(@$products))
			      		@foreach($products as $product)
				      		<tr>
				      			<td><img width="70" class="img-responsive img-thumbnail" src="{{ $product['image'] }}" alt="{{ $product['product_name'] }}"/></td>
				      			<td >{{ $product['product_name'] }}</td>
				      			<td >{{ $product['product_description'] }}</td>
				      			<td >P {{ $product['product_price'] }}</td>
				      		</tr>
			      		@endforeach
			      	@else
			      		<tr>
			      			<td colspan="4">No Products Found.</td>
			      		</tr>
			      	@endif
		      	</tbody>
		      </table>		    
		     
		  </div>
		  

		  <div role="tabpanel" class="tab-pane fade in" id="orders" aria-labelledby="orders-tab">

		  	<!-- Modal -->
			<div class="modal fade" id="for-delivery-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			    <form method="post" action="/order/for-delivery/">
			    <input type="hidden" name="_token" value="{{ csrf_token() }}">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="myModalLabel">Assign Driver</h4>
			      </div>
			      <div class="modal-body">
			        
					  <div class="form-group">					    
					    <input type="hidden" name="order_id" class="form-control" id="order_id" placeholder="Name">
					  </div>
					  <div class="form-group">	
					  	<label for="assigned_delivery_person">Delivery Person</label>				    
					    <select class="form-control" id="assigned_delivery_person" name="assigned_delivery_person">
						  @foreach($delivery_persons as $delivery_person)
						  	<option value="{{ $delivery_person['id'] }}">{{ $delivery_person['name'] }}</option>
						  @endforeach
						</select>
					  </div>
					  
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			        <input type="submit" value="Assign Delivery Person" class="btn btn-info" />
			      </div>
			      </form>
			    </div>
			  </div>
			</div>


	        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
		    <ul id="myTabs" class="nav nav-tabs" role="tablist">
		      <li role="presentation" class="active"><a href="#pending" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Pending</a></li>
		      <li role="presentation" class=""><a href="#acknowledge" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Acknowledge</a></li>
		      <li role="presentation" class=""><a href="#for-delivery" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">For delivery</a></li>
		      <li role="presentation" class=""><a href="#on-the-way" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">On the way</a></li>
		      <li role="presentation" class=""><a href="#delivered" role="tab" id="delivered-tab" data-toggle="tab" aria-controls="delivered" aria-expanded="false">Delivered</a></li>
		      
		    </ul>
		    <div id="myTabContent" class="tab-content">
			      <div role="tabpanel" class="tab-pane fade active in" id="pending" aria-labelledby="pending-tab">

			        <table class="table table-bordered table-striped 	table-hover" >
				      	<thead>
				      		<tr>				      		
					      		<th>Order ID</th>					      		
					      		<th>Product Count</th>					      		
					      		<th>Notes</th>
					      		<th>Total</th>	
					      		<th>Status</th>	

				      		</tr>
				      	</thead>
				      	<tbody>
				      		@if(count(@$orders))
					      		@foreach($orders as $order)						      		
					      			@if($order['status'] == 'pending')
							      		<tr>				      			
							      			<td >{{ $order['id'] }}</td>							      										      			
							      			<td >{{ count(@$order['items']) }}</td>							      			
							      			<td >{{ @$order['notes'] }}</td>
							      			<td >{{ $order['total'] }}</td>							      			
							      			<td ><a href="/order/acknowledge/{{ $order['id'] }}" class="btn btn-info" >					      		
			  Acknowledge
			</a></td>	
							      		</tr>
						      		@endif
					      		@endforeach
					      	@else
					      		<tr>
					      			<td colspan="4">No Pending Orders Found.</td>
					      		</tr>
					      	@endif
				      	</tbody>
			      	</table>
			      </div>
			      <div role="tabpanel" class="tab-pane fade" id="acknowledge" aria-labelledby="acknowledge-tab">
			        
			        <table class="table table-bordered table-striped 	table-hover" >
				      	<thead>
				      		<tr>				      		
					      		<th>Order ID</th>					      		
					      		<th>Product Count</th>					      		
					      		<th>Notes</th>
					      		<th>Total</th>	
					      		<th>Status</th>				      		
				      		</tr>
				      	</thead>
				      	<tbody>
				      		@if(count(@$orders))
					      		@foreach($orders as $order)						      		
					      			@if($order['status'] == 'acknowledge')
							      		<tr>				      			
							      			<td >{{ $order['id'] }}</td>							      										      			
							      			<td >{{ count(@$order['items']) }}</td>							      			
							      			<td >{{ @$order['notes'] }}</td>
							      			<td >{{ $order['total'] }}</td>							      			
							      			<td ><a onclick="assign_order('{{ $order['id'] }}')" href="#" class="btn btn-info" data-toggle="modal" data-target="#for-delivery-modal">
			  For Delivery
			</a></td>	
							      		</tr>
						      		@endif
					      		@endforeach
					      	@else
					      		<tr>
					      			<td colspan="4">No Acknowledge Orders Found.</td>
					      		</tr>
					      	@endif
				      	</tbody>
			      	</table>
			      </div>
			      <div role="tabpanel" class="tab-pane fade" id="for-delivery" aria-labelledby="for-delivery-tab">
			        
			        <table class="table table-bordered table-striped 	table-hover" >
				      	<thead>
				      		<tr>				      		
					      		<th>Order ID</th>					      		
					      		<th>Product Count</th>
					      		<th>Delivery Person</th>
					      		<th>Notes</th>
					      		<th>Total</th>						      							      
				      		</tr>
				      	</thead>
				      	<tbody>
				      		@if(count(@$orders))
					      		@foreach($orders as $order)
					      			@if($order['status'] == 'for_delivery')
							      		<tr>				      			
							      			<td >{{ $order['id'] }}</td>							      										      			
							      			<td >{{ count(@$order['items']) }}</td>							      			
							      			<td >{{ @$order['delivery_person_name'] }}</td>
							      			<td >{{ @$order['notes'] }}</td>
							      			<td >{{ $order['total'] }}</td>								      			
							      		</tr>
						      		@endif
					      		@endforeach
					      	@else
					      		<tr>
					      			<td colspan="4">No For Delivery Orders Found.</td>
					      		</tr>
					      	@endif
				      	</tbody>
			      	</table>
			      </div>
			      <div role="tabpanel" class="tab-pane fade" id="on-the-way" aria-labelledby="on-the-way-tab">			        
			        <table class="table table-bordered table-striped 	table-hover" >
				      	<thead>
				      		<tr>				      		
					      		<th>Order ID</th>					      		
					      		<th>Product Count</th>					      		
					      		<th>Notes</th>
					      		<th>Total</th>	
					      								      						      	
				      		</tr>
				      	</thead>
				      	<tbody>
				      		@if(count(@$orders))
					      		@foreach($orders as $order)
					      			@if($order['status'] == 'on_the_way')
							      		<tr>				      			
							      			<td >{{ $order['id'] }}</td>							      										      			
							      			<td >{{ count(@$order['items']) }}</td>							      			
							      			<td >{{ @$order['notes'] }}</td>
							      			<td >{{ $order['total'] }}</td>	
							      			
							      		</tr>
						      		@endif
					      		@endforeach
					      	@else
					      		<tr>
					      			<td colspan="4">No On The Way Orders Found.</td>
					      		</tr>
					      	@endif
				      	</tbody>
			      	</table>
			      </div>
			      <div role="tabpanel" class="tab-pane fade" id="delivered" aria-labelledby="delivered-tab">
			        <table class="table table-bordered table-striped 	table-hover" >
				      	<thead>
				      		<tr>				      		
					      		<th>Order ID</th>					      		
					      		<th>Product Count</th>					      		
					      		<th>Notes</th>
					      		<th>Total</th>						      			      	
				      		</tr>
				      	</thead>
				      	<tbody>
				      		@if(count(@$orders))
					      		@foreach($orders as $order)
					      			@if($order['status'] == 'delivered')
							      		<tr>				      			
							      			<td >{{ $order['id'] }}</td>							      										      			
							      			<td >{{ count(@$order['items']) }}</td>							      			
							      			<td >{{ @$order['notes'] }}</td>
							      			<td >{{ $order['total'] }}</td>				
							      		</tr>
						      		@endif
					      		@endforeach
					      	@else
					      		<tr>
					      			<td colspan="4">No Delivered Orders Found.</td>
					      		</tr>
					      	@endif
				      	</tbody>
			      	</table>
			      </div>
			    </div>
			  </div>
	      </div>



	      <div role="tabpanel" class="tab-pane fade in" id="delivery" aria-labelledby="delivery-tab">
		        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#delivery-person">
				  Add Delivery Person
				</button>

				<!-- Modal -->
				<div class="modal fade" id="delivery-person" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				  <div class="modal-dialog" role="document">
				    <div class="modal-content">
				    <form method="post" action="/delivery/add-person" enctype="multipart/form-data">
				    <input type="hidden" name="_token" value="{{ csrf_token() }}">
				      <div class="modal-header">
				        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				        <h4 class="modal-title" id="myModalLabel">Delivery Person Details</h4>
				      </div>
				      <div class="modal-body">
				        
						  <div class="form-group">
						    <label for="name">Name</label>
						    <input type="text" name="name" class="form-control" id="name" placeholder="Name">
						  </div>
						  <div class="form-group">
						    <label for="username">Username</label>			    
						    <input type="text" name="username" class="form-control" id="username" placeholder="Username">
						  </div>
						  <div class="form-group">
						    <label for="password">Password</label>
						    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
						  </div>
						  
				      </div>
				      <div class="modal-footer">
				        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				        <input type="submit" value="Save Delivery Person" class="btn btn-info" />
				      </div>
				      </form>
				    </div>
				  </div>
				</div>

				<br/><br/>
			    
			      <table class="table table-bordered table-striped 	table-hover" >
			      	<thead>
			      		<tr>				      		
				      		<th>Name</th>
				      		<th>Username</th>
				      		<th>Password</th>				      		
			      		</tr>
			      	</thead>
			      	<tbody>
			      		@if(count(@$delivery_persons))
				      		@foreach($delivery_persons as $delivery_person)
					      		<tr>				      			
					      			<td >{{ $delivery_person['name'] }}</td>
					      			<td >{{ $delivery_person['username'] }}</td>
					      			<td >{{ $delivery_person['password'] }}</td>
					      		</tr>
				      		@endforeach
				      	@else
				      		<tr>
				      			<td colspan="4">No Delivery Persons Found.</td>
				      		</tr>
				      	@endif
			      	</tbody>
			      </table>	
	      </div>
      </div>

	</div>
</div>
@stop

@section('footer')
<script type="text/javascript">
	function assign_order(order_id){
		var order = document.getElementById("order_id");
      	order.value = order_id;
	}

</script>
@stop
