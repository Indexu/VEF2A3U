<?php
	require('includes/featured.php');
?>

<!--=========FEATRURED IMAGE=========-->
<div class="row firstRow">
	<div class="medium-9 columns medium-centered">
		<div class="featuredSlide">
			<?php 
				$slideImages = getSlideImages();
				for ($i=0; $i < count($slideImages); $i++) {
					echo '<div class="slideImg" style="background-image: url('.$slideImages[$i]['url'].')"><a href="'.$slideImages[$i]['url'].'"></a></div>';
				}
			?>
		</div>
	</div>
</div>

<!--=========FEATRURED=========-->
<div class="row">
	<div class="medium-6 columns">
		<h3>Featured albums</h3>
	</div>

	<div class="medium-6 columns">
		<h3>Featured images</h3>
	</div>
</div>

<div class="row">
	<div class="medium-6 columns">
		<div class="row">
			<div class="medium-12 columns">
				<h4>featured album 1</h4>
			</div>

			<div class="medium-12 columns">
				<h4>featured album 1</h4>
			</div>

			<div class="medium-12 columns">
				<h4>featured album 1</h4>
			</div>
		</div>
	</div>

	<div class="medium-6 columns">
		<div class="row">
			<div class="medium-6 columns">
				<h4>featured image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>featured image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>featured image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>featured image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>featured image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>featured image 1</h4>
			</div>
		</div>
	</div>
</div>

<!--=========LATEST=========-->
<div class="row">
	<div class="medium-6 columns medium-centered">
		<h3>Latest</h3>
	</div>
</div>

<div class="row">
	<div class="medium-6 columns">
		<div class="row">
			<div class="medium-12 columns">
				<h4>Latest album 1</h4>
			</div>

			<div class="medium-12 columns">
				<h4>Latest album 1</h4>
			</div>

			<div class="medium-12 columns">
				<h4>Latest album 1</h4>
			</div>
		</div>
	</div>

	<div class="medium-6 columns">
		<div class="row">
			<div class="medium-6 columns">
				<h4>Latest image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>Latest image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>Latest image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>Latest image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>Latest image 1</h4>
			</div>

			<div class="medium-6 columns">
				<h4>Latest image 1</h4>
			</div>
		</div>
	</div>
</div>