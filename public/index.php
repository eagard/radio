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
			<i> Welcome, </i> <br/>
			<i>
				At UMD Classic Radio, we host only the finest classical music available.
				All of our music is creative commons and is cited and sourced where applicable.
			</i>
			<h1> Features </h1> </br>
			<h2> Live Music </h2>
			<p>
				Listeners can click the listen now button to hear live radio streamed directly from
				our servers!  Music is selected based on the preference of our collective listeners.
				Click on the "Listen Now!" link at the top of the page to start listening.  A new
				window or tab will pop up and begin to play the stream.  You are free to browse the
				site while the music is playing.
			</p>
			<h2> Information </h2>
			<p>
				Our website is designed to keep our users informed.  This means that we keep our
				full playlist in the browse navigation tab, the favorite songs in the top ten
				navigation tab, and the list of recent songs in the recent songs tab.  Users can
				search our playlist for song titles, composers, and performers by using the search
				page.
			</p>
			<h2> Interaction </h2>
			<p>
				Any listener may create a free account by clicking the register link on the top of
				the page.  No personal or contact information is required.  Upon login, the user is
				encouraged to give feedback to the station by rating the musical selection in any
				of our list formats (excluding the search page).  These ratings will influence the
				music everyone hears!
			</p>
			<h1> Functions </h1>
			<ul>
				<li>
					Users can rate music by clicking on the stars they want to give.
					The page will reload and confirm their submission.
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
