<div class="preview">
	<div class="content">
<?php echo $comment_message; ?>
	</div>
	<div class="meta">
		Comment by <?php if ($comment_website) echo '<a href="'.$comment_website.'">'.$comment_user.'</a>'; ?> on <?php echo $comment_date; ?> at <?php echo $comment_time; ?>.
	</div>
</div>