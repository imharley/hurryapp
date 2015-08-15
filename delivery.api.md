HurryApp Driver API
===================

##### Login [/login/driver POST]

Parameters

    - id
    - password

Response
    
    {
        token: 1234567890
    }
    
##### Orders for delivery [/orders GET]

Response

    {
        orders: [
            {
                id: 1,
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
                customer: "",
                phone: "",
                timestamp: 123456789
            },
            {
                id: 2,
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
                customer: "",
                phone: "",
                timestamp: 123456789
            }
        ]
    }

##### Update order's status (/orders/{id} PUT}
    
Parameters
 
    - status: 5 - on the way
    
Response

    Status code 204