<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HEADER</title>

	<style>
		html,body {
  height:100%;
}
body{
	margin:0;
	padding:0;
	box-sizing: border-box;
}

a:hover{text-decoration: none;}
/* Globals type styling */

h1,h2,h3,h4,h5,h6,p,label,.btn,a{
	font-family:"Open Sans", sans-serif;
  	color: #333;
} 

/* NavBar */

#nav-bloc {
  margin-bottom: 10px;
  padding-bottom: 10px;
  background-color: #6EA7E4;
  
  
}

.navbar-brand{
	font-size: 25px;
	font-weight: bold;
	font-family: "Open Sans", Helvetica, Arial, sans-serif;
	font-weight: 600;
}
.navbar-brand img{
	width: auto;
	max-height: 40px;
	margin: -12px 5px 0 0;
}
.navbar-brand{
	padding: 15px 15px;
}
.navbar .nav{
	padding-top: 2px;
	margin-right: -16px;
	float:right;
}
.nav > li{
	float: left;
	margin-top: 4px;
	font-size: 16px;
}

.nav>li>a{
	padding: 20px 15px;
}

.nav > li a:hover{
	background:transparent;
}
.navbar-toggle{
	margin: 12px;
	border: 0px;
}
.navbar-toggle:hover{
	background:transparent!important;
}
.navbar-toggle .icon-bar{
	background-color: rgba(0,0,0,.5);
	width: 26px;
}
.navbar-collapse.in {
overflow-y: visible;
float: left;
width: 100%;
}
.navbar-1 {
  float: right;
}
.site-navigation:first-child {
  float: right;
}
.site-navigation:nth-child(2) {
  float: right;
}
.site-navigation:nth-child(2) a {
  color: #ccc;
  font-size: 85%;
  padding-right: 0px;
}

.site-navigation .nav > .active{
  color: #333;
}

.cart, .out{
	color: white;
	font-size: 15px;
}

.navbar-brand{
	color: white;
	font-size: 30px;
}
	</style>
</head>
<body>
<div class="bloc l-bloc" id="nav-bloc">
	<div class="container">
		<nav class="navbar row">
			<div class="navbar-header">
				<a class="navbar-brand" href="./cart.php">SHOPEE FAKE</a>
				<button id="nav-toggle" type="button" class="ui-navbar-toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-1">
					<span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
				</button>
			
			<div class="collapse navbar-collapse navbar-1">
				<ul class="site-navigation nav">
					<li>
						<a href="../Backend/payment.php" class="cart">Giỏ hàng</a>
					</li>
					
					<li>
						<a href="../Backend/history_bill.php" class="cart">Lịch sử đơn hàng</a>
					</li>

					<li>
						<a href="../Frontend/login.html" class="out">Đăng xuất</a>
					</li>
          </ul>
			</div>
		</nav>
	</div>
</div>
</body>
</html>