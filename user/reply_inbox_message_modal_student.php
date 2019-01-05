		<!-- Modal -->
<div id="reply<?php echo $id; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		<h3 id="myModalLabel">Reply</h3>
	</div>
		<div class="modal-body">
		<center>

		<div class="control-group">
			<label class="control-label" for="inputEmail">To:</label>
			<div class="controls">
				<input type="hidden" name="sender_id" id="inputEmail" value="<?php echo $sender_id; ?>" readonly>
				<input type="hidden" name="my_name" value="<?php echo $reciever_name; ?>" readonly>
				<input type="text" name="name_of_sender"  id="inputEmail" value="<?php echo $sender_name; ?>" readonly>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="inputPassword">Content:</label>
			<div class="controls">
				<textarea name="my_message"></textarea>
			</div>
		</div>
		<div class="control-group">
			<div class="controls">
			<button type="submit" name="reply" id="<?php echo $id; ?>" class="btn btn-success reply"><i class="icon-reply"></i> Reply</button>
			</div>
		</div>
 
	</center>
		</div>
	<div class="modal-footer">
		<button class="btn" data-dismiss="modal" aria-hidden="true"><i class="icon-remove icon-large"></i> Close</button>
		<button   id="<?php echo $id; ?>" class="btn btn-danger remove" data-dismiss="modal" aria-hidden="true"><i class="icon-check icon-large"></i> Yes</button>
	</div>
</div>
				
				

			