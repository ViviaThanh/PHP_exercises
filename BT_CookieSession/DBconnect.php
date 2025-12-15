<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
		
	</head>
	<body>
	<?php
		$dbname = "tuu-lms";
		$dbuser = "root";
		$dbpass = "";
		$servername = "localhost";

		try{
			$conn = new PDO("mysql:host=$servername;dbname=$dbname", $dbuser, $dbpass);
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected successfully";
		} catch(PDOException $e) {
		  //echo "Connection failed: " . $e->getMessage();
		}

		$sql = "select * from users";
		$stmt = $conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->setFetchMode(PDO::FETCH_OBJ); //OBJ
		//$result = $stmt->setFetchMode(PDO::FETCH_ASSOC); //array
		foreach($stmt->fetchAll() as $v)
			echo $v->email."<br>";
			//var_dump($v);
		?>
		<div class = "p-5 bg-primary text-white text-center">
			<h1>Welcome to my boostrap GUI </h1>
			<p>Lorem ifsum dola is met .....
		</div>
		
		<nav class="navbar navbar-expand-lg navbar-light bg-light">
		  <div class="container-fluid">
			<a class="navbar-brand" href="#">Navbar</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
			  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
				  <a class="nav-link active" aria-current="page" href="#">Home</a>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#">Link</a>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Dropdown
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">Action</a></li>
					<li><a class="dropdown-item" href="#">Another action</a></li>
					<li><hr class="dropdown-divider"></li>
					<li><a class="dropdown-item" href="#">Something else here</a></li>
				  </ul>
				</li>
				<li class="nav-item">
				  <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
				</li>
			  </ul>
			  <form class="d-flex">
				<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-outline-success" type="submit">Search</button>
			  </form>
			</div>
		  </div>
		</nav>
		<div class="row">
			<div class="col col-sm-2">
				<nav class="nav m-2 px-2 d-flex flex-column me-auto mb-lg-0 shadow-sm rounded	">
					<a class="nav-item nav-link text-primary active" href="#">Item</a>
					<a class="nav-item nav-link text-primary" href="#">Item1</a>
					<a class="nav-item nav-link text-primary" href="#">Item2</a>
					<a class="nav-item nav-link text-primary" href="#">Item3</a>
					<a class="nav-item nav-link text-primary" href="#">Item4</a>
				</nav>	
			</div>
	
			<div class="col">	
				<div class = "row pt-2">
					<div class = "row">
					<div class = "col col-sm-3">
					</div>
						<div id="carouselExampleIndicators" class="carousel carousel-white slide w-50 carousel-fade" data-bs-ride="carousel">
							<div class="carousel-indicators">
								<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
								<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
								<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
								<button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
							</div>
							<div class="carousel-inner ">
								<div class="carousel-item active">
									<img src="img/1.jpg" class = "d-block w-100">
									<div class="carousel-caption d-none d-md-block">
										<h5>First slide label</h5>
										<p>Some representative placeholder content for the first slide.</p>
								  </div>
								</div>
								<div class="carousel-item active">
									<img src="img/2.jpg" class = "d-block w-100">
									<div class="carousel-caption d-none d-md-block">
										<h5>Second slide label</h5>
										<p>Some representative placeholder content for the second slide.</p>
								  </div>							</div>
								<div class="carousel-item active">
									<img src="img/3.jpg" class = "d-block w-100">
									<div class="carousel-caption d-none d-md-block">
										<h5>Third slide label</h5>
										<p>Some representative placeholder content for the third slide.</p>
								  </div>							</div>
								<div class="carousel-item active">
									<img src="img/4.jpg" class = "d-block w-100">
									<div class="carousel-caption d-none d-md-block">
										<h5>Fourth slide label</h5>
										<p>Some representative placeholder content for the f slide.</p>
								  </div>							</div>
							</div>
							<button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Previous</span>
							</button>
							<button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="visually-hidden">Next</span>
							</button>
					</div>
				</div>
				
				</div>
			
				<div class="row pt-2">
					<div class = "col">
						<div class="card"> 
							<div class="card-header">
								<h1> Test card</h1>
							</div>
							<div class="card-body">
								<p>Themes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme. </p>
							</div>
							<div class="card-footer">
								<a href="#" class="btn btn-primary"> Chi tiết >></a>
							</div>
						</div>
					</div>
					<div class = "col">
						<div class="card"> 
							<div class="card-header">
								<h1> Test card</h1>
							</div>
							<div class="card-body">
								<p>Themes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme. </p>
							</div>
							<div class="card-footer">
								<a href="#" class="btn btn-primary"> Chi tiết >></a>
							</div>
						</div>
					</div><div class = "col">
						<div class="card"> 
							<div class="card-header">
								<h1> Test card</h1>
							</div>
							<div class="card-body">
								<p>Themes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme. </p>
							</div>
							<div class="card-footer">
								<a href="#" class="btn btn-primary"> Chi tiết >></a>
							</div>
						</div>
					</div><div class = "col">
						<div class="card"> 
							<div class="card-header">
								<h1> Test card</h1>
							</div>
							<div class="card-body">
								<p>Themes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme. </p>
							</div>
							<div class="card-footer">
								<a href="#" class="btn btn-primary"> Chi tiết >></a>
							</div>
						</div>
					</div>
				</div>
				<div class="row pt-3">
					<div class="col-sm-2">
						<div class="card"> 
							<div class="card-header">
								<h1> Test card</h1>
							</div>
							<div class="card-body">
								<p>Themes and styles also help keep your document coordinated. When you click Design and choose a new Theme, the pictures, charts, and SmartArt graphics change to match your new theme. When you apply styles, your headings change to match the new theme. </p>
							</div>
							<div class="card-footer">
								<a href="#" class="btn btn-sm btn-primary"> Chi tiết >></a>
							</div>
						</div>
					</div>
					<div class="col">
					
						<table class="table table-bordered border-primary table-hover">
							<tr class="table-warning">
								<th>Email</th>
								<th>Fullname</th>
							</tr>
							<?php while($user = $stmt->fetch()){ ?>
								<tr class="table-light">
									<td><?php echo $user['email'];?></td>
									<td><?php echo $user['full_name'];?></td>
								</tr>
							<?php }?>
						</table>
					</div>
				</div>
			</div>	
		</div>		
		
    <div class="p-2 text-center bg-dark">
      <p>&copy; 2025 MyWebsite. All rights reserved.</p>
      <ul class="list-inline">
        <li class="list-inline-item"><a href="#" class="text-white">Facebook</a></li>
        <li class="list-inline-item"><a href="#" class="text-white">Twitter</a></li>
        <li class="list-inline-item"><a href="#" class="text-white">Instagram</a></li>
      </ul>
    </div>
 

  <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

