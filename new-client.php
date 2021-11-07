<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<div class="container">
		<div class="row justify-content-md-center">
			<div class="col-md-6">
				<h1 class="centered">Créer un compte</h1>
				<form>

					<div class="form-group">
						<label for="raison-sociale">Nom de société (raison sociale)</label>
						<input type="text" class="form-control" name="raison-sociale" id="raison-sociale" placeholder="Raison sociale" required>
					</div>
					
					<div class="form-group">
						<label for="siren">Numéro de Siren</label>
						<input type="number" class="form-control" name="siren" id="siren" placeholder="012 345 678 09876" required>
					</div>

					<button type="submit" class="btn btn-primary">Créer le client</button>
				</form>
			</div>
		</div>
	</div>
</body>
</html>