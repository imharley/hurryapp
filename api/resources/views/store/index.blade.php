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
		      <li role="presentation" class=""><a href="#delivery" role="tab" id="delivery-tab" data-toggle="tab" aria-controls="delivery" aria-expanded="true">Delivery</a></li>
		      <li role="presentation" class=""><a href="/logout">Logout</a></li>
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
		      		@if(count($products))
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
	        <div class="bs-example bs-example-tabs" data-example-id="togglable-tabs">
		    <ul id="myTabs" class="nav nav-tabs" role="tablist">
		      <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Pending</a></li>
		      <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">Acknowledge</a></li>
		      <li role="presentation" class=""><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile" aria-expanded="false">For Delivery</a></li>
		      
		    </ul>
		    <div id="myTabContent" class="tab-content">
			      <div role="tabpanel" class="tab-pane fade active in" id="home" aria-labelledby="home-tab">
			        <p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.</p>
			      </div>
			      <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
			        <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vinyl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bit, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stumptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
			      </div>
			      <div role="tabpanel" class="tab-pane fade" id="dropdown1" aria-labelledby="dropdown1-tab">
			        <p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
			      </div>
			      <div role="tabpanel" class="tab-pane fade" id="dropdown2" aria-labelledby="dropdown2-tab">
			        <p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
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
			      		@if(count($delivery_persons))
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
<script src="https://maps.googleapis.com/maps/api/js?callback=initMap"
        async defer></script>
@stop