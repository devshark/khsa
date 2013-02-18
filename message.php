	<?php if(isset($_SESSION['clientid'])){ ?>
				<div class="box">
					<div id="sidebar-title">Comments and Suggestions</div>
					<div align="center" class="sidebar-inside" style="padding-left:10px;">
					<form method="post" action="comments.php">
						<textarea name="comments"></textarea>
						<input type="submit" name="btnPost" value="Comment" />
					</form>
					</div>
				</div>
				<?php } ?>