<?php

session_start();

include '../tools/connection.php';

// LOGIN ADMIN

if (isset($_SESSION["login_user"])) {
	header("location: ../admin/admin.php");
	exit();
}

if (isset($_POST['login_user'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$query = $conn->query("SELECT * FROM tb_user WHERE user_nama = '$username'");

	//cek username
	if (mysqli_num_rows($query) === 1) {

		//cek password
		$row = mysqli_fetch_assoc($query);
		if ($password === $row["user_password"]) {

			// set session
			$_SESSION["login_user"] = true;

			header("location: ../home/home.php");
			exit();
		}
	}
	$error = true;
}

?>

<?php include '../blade/header.php' ?>

<div class="container">
	<div class="row" style="margin-top: 140px;">
		<div class="col-lg-2"></div>
		<div class="col-lg-4 shadow py-3">
			<p class="text-center fw-bold">Dinas Koperasi, Usaha Kecil dan Mengah</p>
			<div class="gambar mb-3">
				<div class="text-center">
					<img src="../img/logo-koperasi.png" class="rounded">
				</div>
			</div>
			<p class="text-center fw-bold">Melayani Dengan I S3 (Ikhlas, Sapa, Senyum, Solusi)</p>
		</div>
		<div class="col-lg-4 shadow py-3">

			<p class="text-center fw-bold">Login Form</p>
			<hr>

			<form action="" method="post">
				<?php if (isset($error)) : ?>
					<p style="color: red; font-style: italic;">Username atau Password salah !</p>
				<?php endif; ?>
				<div class="row mb-3">
					<label for="username" class="col-sm-4 col-form-label">Username</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" name="username" autocomplete="off" autofocus required>
					</div>
				</div>
				<div class="row mb-3">
					<label for="password" class="col-sm-4 col-form-label">Password</label>
					<div class="col-sm-8">
						<input type="password" class="form-control" name="password" required>
					</div>
				</div>
				<div class="d-grid gap-3">
					<button type="submit" class="btn btn-outline-primary" name="login_user">Login</button>
				</div>
				<div class="mt-3 text-center">
					<p>Belum Punya Akun ?</p>
					<!-- button add user -->
					<div class="d-grid gap-3">
						<button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modalAdd">
							Sign Up
						</button>
					</div>
				</div>
			</form>
		</div>
		<div class="col-lg-2"></div>
	</div>
</div>

<!-- Modal ADD -->
<div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up</h1>
				<button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close" style="color: red;">X</button>
			</div>
			<div class="modal-body">
				<!-- Form disini -->
				<form method="post" action="userAdd.php">
					<div class="row mb-3">
						<label for="userNama" class="col-sm-2 col-form-label">Nama</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="userNama" name="userNama" required>
						</div>
					</div>
					<div class="row mb-3">
						<label for="userPassword" class="col-sm-2 col-form-label">Password</label>
						<div class="col-sm-10">
							<input type="text" class="form-control" id="userPassword" name="userPassword" required>
						</div>
					</div>
					<div class="d-grid gap-2 d-md-flex justify-content-md-end">
						<button type="submit" class="btn btn-outline-success" name="save">Save</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<?php include '../blade/footer.php' ?>