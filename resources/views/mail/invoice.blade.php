<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Successfully Order Placed on Our Ecommerce</h1><br>
	<strong>Order Id (Tracking ID): {{ $order['order_id'] }}</strong><br>
	<strong>Order Date:{{ $order['date'] }} </strong><br>
	<strong>Total Amount: {{ $order['total'] }}</strong><br>
	@isset($order['coupon_discount'])
		<strong>Total Discount: {{ $order['coupon_discount'] }}</strong><br>
		<strong>Total After Discount: {{ $order['after_discount'] }}</strong><br>
	@endisset
	<hr> 
	<strong>Name: {{ $order['c_name'] }}</strong><br>
	<strong>Phone: {{ $order['c_phone'] }}</strong><br>
	<strong>Address: {{ $order['c_address'] }}</strong><br>
</body>
</html>