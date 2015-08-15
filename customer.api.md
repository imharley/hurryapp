HurryApp Customer API
=======

##### Registration/Login [/api/customer/login POST]

Paremeters 

	- phone
	- password (optional)
  
Response (with password parameter)

	{
		token: 1234567890
	}
	
##### Retrieve Stores [/api/customer/stores GET]

Parmeters	

	- name (optional)

Response

	{
		stores: [
			{
				id: 1,
				name: "Name",
				lat: 10,
				long: 15,
				items: [
					{
						id: 1001,
						name: "Inato 1",
						description: "So Cheap",
						price: 100,
						image_url: "http://imageurl",
					}
				]
			}
		]
	}

#### Create order [/api/customer/orders POST] 

Parameters

	- money
	- notes
	- items
		- id
		- quantity

Response

	Status code 201

##### Recent orders [/api/customer/orders/recent GET]

Response

	{
		money: 500,
		total: 300,
		change: 200,
		notes: "Hurry more",
		items: [
			{
				id: 1,
				name: "",
				description: "",
				quantity: 2,
				price: 100,
				image_url: ""
			}
		],
		lat: 100,
		long: 100,
		timestamp: 123456789,
	}