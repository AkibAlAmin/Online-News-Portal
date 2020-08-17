<?php  
	require_once("commonCode.php");
	
	function ON_THIS_DAY() {
		$conn = DB_START();
		$today = getdate();
		$today = $today["mon"]."-".$today["mday"];

		$sql = "SELECT * FROM `onthisday` WHERE `eventDate` LIKE '%".$today."' AND `deleted_on` IS null ORDER BY `eventDate`  ASC";
		$result = mysqli_query($conn, $sql);
		if(mysqli_num_rows($result) == 0) {
			echo ' 
					<div class="event">
						No Information is Available for This Current Date
					</div>';
		}
		else {
			while ($res = mysqli_fetch_array($result)) {
				/* 
				date() function doesn't work for dates before 1970.
				This will generate those dates.
				*/
				$date = date_create($res['eventDate']);
				if (!$date) {
					$e = date_get_last_errors();
					foreach ($e['errors'] as $error) {
						echo "$error\n";
					}
					exit(1);
				}
				$year = date_format($date, "Y");
				
				echo ' 
					<div class="event">
						<span class="OTD_year">'.$year.'</span>
						<span>'.$res["event"].'</span>
					</div>';
			}
			DB_STOP($conn);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="icon" href="IMG/IconLogo.png">
	<title>Home | Akib's News Portal</title>
	<meta charset="utf-8">
	
	<link rel="stylesheet" type="text/css" href="CSS/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="CSS/commonCode.css">
	<link rel="stylesheet" type="text/css" href="CSS/home.css">
</head>

<body>
	<!--main div starts from here-->
	<div id="main_body">
		<!-- header icon and slogan -->
		<?php TITLE_LOGO(); ?>
		<!-- header ends -->
		<!-- navigation bar -->
		<?php NAVIGATION_BAR(); ?>
		<!-- navigation bar ends -->
		
		<!-- news div -->
		<div>
			<!-- left column -->
			<div class="leftColumn">
				<!-- featured news -->
				<div class="featured_news">
					<img src="IMG/test.png"><br>
					<a class="featured_news_headline" href="#">Arrested Alchemist Must Make Gold To Win Freedom</a>
				</div>
				<!-- featured news ends -->

				<!-- normal news section -->
				<div>
				<?php  
					$conn = DB_START();
					$sql = "SELECT * FROM categories WHERE categoryID != 110 AND deleted_at IS NULL";
					$res = mysqli_query($conn, $sql);
					while ($cat = mysqli_fetch_array($res)) {
						echo '<div class="news_section">';
						echo '<h2 class="category">'.$cat["category"].'</h2>';

						$sql1 = "SELECT news.newsID, news.headline, news.description, newsimages.imagePath FROM news,newsimages WHERE news.categoryID = ".$cat['categoryID']." AND news.newsID = newsimages.newsID AND news.deleted_at IS NULL ORDER BY newsID DESC LIMIT 3";
						$ns = mysqli_query($conn, $sql1);
						while($nws = mysqli_fetch_array($ns)) {
							echo '<div class="news">';
							echo '<img class="news_image" src="docs/'.$nws["imagePath"].'">';
							echo '<a class="news_headline" href="news.php?q='.$nws["newsID"].'">'.$nws["headline"].'</a>';
							echo '</div>';
						}
						echo '</div>';					
					}
				?>
				</div>
				<!-- normal news ends -->
			</div>
			<!-- left col ends -->
			




			<!-- right col starts -->
			<div class="rightColumn">
				<div class="on_this_day">
					<div style="text-align: center; background-color: #f0f0ee">
						<strong>On This Day</strong><br>
						<strong style="color: #ef4224;">
						<?php
							$today = getdate();
							$today = $today["month"]." ".$today["mday"];
							echo($today);
						?>
						</strong>
					</div>
					<div class="otd_container">
						<?php ON_THIS_DAY(); ?>
					</div>
				</div>
				<!-- on this day ends -->

				<!-- latest news -->
				<div class="box">
					<h5>Latest News</h5>
					<hr>
				<?php  
					//latest news
					$conn = DB_START();
					$sql = "SELECT newsID, headline FROM news WHERE categoryID != 110 AND deleted_at IS NULL ORDER BY newsID DESC";
					$result = mysqli_query($conn, $sql);
					echo '<ul>';
					while ($heads = mysqli_fetch_array($result)) {
						echo '
							<li>
							<a style="font-size:20px;" href="news.php?q='.$heads["newsID"].'">'.$heads["headline"].'</a>
							</li>';
					}
					echo '</ul>';

					DB_STOP($conn);
				?>
				</div>
				<!-- latest news ends -->
						
				<div class="box">
					<h5>Most Read News</h5>
					<hr>
				<?php  
					$conn = DB_START();
					$sql = "SELECT newsID, headline FROM news WHERE categoryID != 110 AND deleted_at IS NULL ORDER BY popularity DESC";
					$result = mysqli_query($conn, $sql);
					echo '<ul>';
					while ($heads = mysqli_fetch_array($result)) {
						echo '
							<li>
							<a style="font-size:20px;" href="news.php?q='.$heads["newsID"].'">'.$heads["headline"].'</a>
							</li>';
					}
					echo '</ul>';

					DB_STOP($conn);
				?>
				</div>
			</div>
			<!-- right col ends -->
		</div>
		<!-- news div ends -->

		<!-- footer -->
		<?php FOOTER(); ?>
		<!-- footer ends -->
	</div>
	<?php STICKY_SOCIAL_BAR(); ?>
		
</body>
</html>