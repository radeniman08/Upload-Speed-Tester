<script src="../UploadSpeedTester/jquery-3.6.0.min.js"></script>
<?php


define('DOCROOT', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('WEBROOT', getenv('WEBROOT'));
define('CURRENT_DIR', str_replace(DOCROOT, '', realpath('.') . DIRECTORY_SEPARATOR));

include(DOCROOT . 'functions.php');

define('MAX_UPLOAD_SIZE', min(
	to_bytes(ini_get('upload_max_filesize')),
	to_bytes(ini_get('post_max_size'))
));

?>
<?php session_start() ?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>Upload File</title>
	<link rel="stylesheet" href="style.css">

	<script type="text/javascript">
		$(function() {
			$('form').submit(function() {
				$.ajax({
					url: 'start-timer.php',
					type: 'POST',
					context: this,
					success: function() {
						this.submit();
					},
				});

				return false;
			});
		});
	</script>

</head>


<body>
	<img id="gambar" src="pesawat.png" width="100%">
	</div>
	<div class="container">
		<br>
		<div id="file-name">File name here</div>
		<br><br>
		<p>Upload Sesuatu (Max <?php echo to_human(MAX_UPLOAD_SIZE, 0) ?>), Dan Ini Akan Menghitung Berapa Lama File Yang Diupload...</p>
		<form method="post" action="upload.php" enctype="multipart/form-data" id="formupload">
			<label for="pilih_file" id="custom-btn">Pilih File</label>
			<input id="pilih_file" type="file" name="file" hidden />
			<input id="custom-btn" type="submit" value="Upload" hidden />
		</form>
	</div>


	<script>
		$(document).ready(function() {
			$('input[type="file"]').change(function(e) {
				var nama = e.target.files[0].name;
				var size = e.target.files[0].size;
				$("#file-name").text(nama + " (" + Math.round((size / 1024)) + " KB)");
			});
		});
	</script>

	<footer>
		<p>Copyright @Raden Iman</p>
	</footer>
</body>

</html>