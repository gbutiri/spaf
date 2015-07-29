<?php include ($_SERVER['DOCUMENT_ROOT'] . '/config.php'); ?>
<?php include (_DOCROOT . '/htmls/header.php'); ?>


		<h1>Index Testing Page</h1>
		
		<h2>Updates:</h2>
		<ul>
		<li>Flat-UI design implemented for basic styling. This may be changed by simply not including the files required to run.</li>
		<li>AJAX File Upload added to framework since it was a highly requested feature. Test here!</li>
		</ul>
		
		<link href="/libs/mini-upload-form/css/style.css" rel="stylesheet" />

		<form id="upload" method="post" action="/libs/mini-upload-form/upload.php" enctype="multipart/form-data">
			<div id="drop">
				Drop Here

				<a>Browse</a>
				<input type="file" name="upl" multiple />
			</div>

			<ul>
				<!-- The file uploads will be shown here -->
			</ul>

		</form>

		<!-- JavaScript Includes -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
		<script src="/libs/mini-upload-form/js/jquery.knob.js"></script>

		<!-- jQuery File Upload Dependencies -->
		<script src="/libs/mini-upload-form/js/jquery.ui.widget.js"></script>
		<script src="/libs/mini-upload-form/js/jquery.iframe-transport.js"></script>
		<script src="/libs/mini-upload-form/js/jquery.fileupload.js"></script>
		
		<!-- Our main JS file -->
		<script src="/libs/mini-upload-form/js/script.js"></script>

<?php include (_DOCROOT . '/htmls/footer.php'); ?>
