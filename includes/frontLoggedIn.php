<?php
	require('includes/featured.php');
?>

<!--=========FEATRURED IMAGE SLIDESHOW=========-->
<div class="row firstRow">
	<div class="large-9 columns large-centered">
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
	<!-- Titles -->
	<div class="medium-2 push-1 columns featuredTitle">
		<h3>Featured albums</h3>
	</div>

	<div class="medium-2 columns pull-3 featuredTitle">
		<h3>Featured images</h3>
	</div>
</div>

<div class="row">
	<!-- Featured Albums -->
	<div class="medium-3 columns albumsMargin">
		<div class="row">
			<?php 
				$featuredAlbums = getFeaturedAlbums();

				# Þetta er ógeðslega ljótt. Sé eftir því að nota ekki templating engine
				for ($i=0; $i < count($featuredAlbums); $i++) {
					echo '<a class="medium-12 columns featuredAlbum" href="#">
						<div class="row">
							<div class="medium-5 columns">
								<img src="userImg/faggotlordinn@faggot.com/Wallpapers/wallpaper-2492652.jpg" >
							</div>
							<div class="medium-7 columns">
								<p>Title: '.$featuredAlbums[$i]['albumTitle'].'</p>
								<p>User: '.$featuredAlbums[$i]['fullName'].'</p>
							</div>
						</div>
					</a>';
				}
			?>
		</div>
	</div>

	<!-- Featured Images -->
	<div class="medium-8 columns">
		<div class="row">
			<?php 
				$featuredImages = getFeaturedImages();

				# Þetta er líka ógeðslega ljótt. Sé eftir því að nota ekki templating engine
				for ($i=0; $i < count($featuredImages); $i++) {
					echo '<div class="medium-6 columns">
						<div class="row">
							<a class="medium-11 columns featuredImage" href="'.$featuredImages[$i]['url'].'">
								<div class="row">
									<div class="medium-5 columns">
										<img src="'.$featuredImages[$i]['url'].'" >
									</div>
									<div class="medium-7 columns">
										<p>Title: '.$featuredImages[$i]['fileName'].'</p>
										<p>User: '.$featuredImages[$i]['fullName'].'</p>
									</div>
								</div>
							</a>
						</div>
					</div>';
				}
			?>
		</div>
	</div>
</div>

<!--=========LATEST=========-->
<div class="row">
	<!-- Titles -->
	<div class="medium-2 push-1 columns featuredTitle">
		<h3>Latest albums</h3>
	</div>

	<div class="medium-2 columns pull-3 featuredTitle">
		<h3>Latest images</h3>
	</div>
</div>

<div class="row">

	<!-- Latest Albums -->
	<div class="medium-3 columns albumsMargin">
		<div class="row">
			<?php 
				$featuredAlbums = getFeaturedAlbums();

				# Vá hvað þetta er ógeðslega ljótt. Sé eftir því að nota ekki templating engine
				for ($i=0; $i < count($featuredAlbums); $i++) {
					echo '<a class="medium-12 columns featuredAlbum" href="#">
						<div class="row">
							<div class="medium-5 columns">
								<img src="userImg/faggotlordinn@faggot.com/Wallpapers/wallpaper-2492652.jpg" >
							</div>
							<div class="medium-7 columns">
								<p>Title: '.$featuredAlbums[$i]['albumTitle'].'</p>
								<p>User: '.$featuredAlbums[$i]['fullName'].'</p>
							</div>
						</div>
					</a>';
				}
			?>
		</div>
	</div>
	
	<!-- Latest Images -->
	<div class="medium-8 columns">
		<div class="row">
			<?php 
				$latestImages = getLatestImages();

				# Þetta er svo mikið ógeðslega ljótt. Sé eftir því að nota ekki templating engine
				for ($i=0; $i < count($latestImages); $i++) {
					echo '<div class="medium-6 columns">
						<div class="row">
							<a class="medium-11 columns featuredImage" href="'.$latestImages[$i]['url'].'">
								<div class="row">
									<div class="medium-5 columns">
										<img src="'.$latestImages[$i]['url'].'" >
									</div>
									<div class="medium-7 columns">
										<p>Title: '.$latestImages[$i]['fileName'].'</p>
										<p>User: '.$latestImages[$i]['fullName'].'</p>
									</div>
								</div>
							</a>
						</div>
					</div>';
				}
			?>
		</div>
	</div>
</div>