<?php
	include 'scripts/init.php';
?>
<!DOCTYPE html>

<!-- 	John Battaglia
		Eric Gardner
		Ahmed Altai
		CIS 435 - Fall 2014
		Term Project
		File: index.php
							-->
<html>
<?php
	include 'includes/head.php';
?>
<body>
<div id="body">
	<div id="wrapper">
		<?php
			include 'includes/header.php';
			include 'includes/nav.php';
		?>
		<div id="section">
			<i> Home </i> <br/> <br/>
			<i>
				At UMD Classic Radio, we host only the finest classical music
				available.  All of our music is creative commons and is cited
				and sourced where applicable.
			</i>
			<h1> Features </h1>
			<h2> Live Music </h2>
			<p>
				Listeners can click the listen now button to hear live radio
				streamed directly from our servers!  Music is selected based on
				the preference of our collective listeners.  Click on the
				"Listen Now!" link at the top of the page to start listening.
				A new window or tab will pop up and begin to play the stream.
				You are free to browse the site while the music is playing.
			</p>
			<h2> Information </h2>
			<p>
				Our website is designed to keep our users informed.  This means
				that we keep our full playlist in the browse navigation tab,
				the favorite songs in the top ten navigation tab, and the list
				of recent songs in the recent songs tab.  Users can search our
				playlist for song titles, composers, and performers by using
				the search page.
			</p>
			<h2> Interaction </h2>
			<p>
				Any listener may create a free account by clicking the
				register link on the top of the page.  No personal or contact
				information is required.  Upon login, the user is encouraged
				to give feedback to the station by rating the musical selection
				in any of our list formats (excluding the search page).  These
				ratings will influence the music everyone hears!
			</p>
			<h1> Functions </h1>
			<ul>
				<li>
					Users can log in and log out of the system using the links
					on the top of the page.  The page will also display how many
					users are logged in.
				</li>
				<li>
					Users can rate music by clicking on the stars they want to
					give.  The page will reload and confirm their submission.
					Ratings can be changed by clicking on the stars again.
				</li>
				<li>
					Songs are selected based on two criteria using a custom
					php script.  This script is executed from liquidsoap.
					<ul>
						<li>
							The same song cannot be played until five other
							songs have been played.
						</li>
						<li>
							User favorites are selected more often than other
							songs.
						</li>
					</ul>
				</li>
				<li>
					The top ten list is periodically refreshed using php and
					a cron job.  The algorithm orders songs by their collective
					star counts (3 stars is set to neutral, 4 adds one), then
					ordering them.
				</li>
			</ul>
		</div>
		<?php
			include 'includes/footer.php';
		?>
	</div>
</div>
</body>
</html>
