<?php include ($_SERVER['DOCUMENT_ROOT'] . '/config.php'); ?>
<?php include (_DOCROOT . '/htmls/header.php'); ?>


<div class="container">
<div class="row">
<div class="col-lg-12">
	<p>Using this as a start</p>
	<p><code>http://maps.googleapis.com/maps/api/geocode/json?address=Santa%20Monica&sensor=true</code></p>
	<p>Obviously, the location can be anything recognized in google maps.</p>
	<p>
		<code>$url = "http://maps.googleapis.com/maps/api/geocode/json?address=Santa%20Monica&sensor=true";</code>
		<br>
		<code>$data_back = json_decode(file_get_contents($url));</code>
	</p>
	<p>And this is the result.</p>
	<?php 
	$url = "http://maps.googleapis.com/maps/api/geocode/json?address=Santa%20Monica&sensor=true";
	$data_back = file_get_contents($url);
	
	?><pre style="max-height: 400px; overflow-y: scroll;"><?php
	echo($data_back);
	?></pre><?php
	?>
	
	<p>So, to get all of the details, just simply use the object notation to indicate what you want to pull.</p>
	
	<p>
<pre>
$data_back->results[0]->geometry->location->lat = <?php 
$data_back = json_decode($data_back);
echo($data_back->results[0]->geometry->location->lat);
?>
</pre>
<pre>
$data_back->results[0]->geometry->location->lng = <?php
echo($data_back->results[0]->geometry->location->lng);
?>
</pre>
	</p>
	<p>
		And now we have latitude and longitude for a location.
	</p>
	
	<p></p>
	
</div>
</div>
</div>


<?php include (_DOCROOT . '/htmls/footer.php'); ?>
