
<?php include('sessions.php'); ?>
<?php
include 'temp_nav.php';
?>
<section id="page-banner" class="page-banner-main-block" style="background-image: url('images/bg/page-banner.jpg'); ">
  <div class="col-sm-2" style="float:left;"> <a href="userlogin.php"><button type="submit" class="btn btn-default">Back</button></a></div>
  <div class="col-sm-8">
   <br> <h2 class="page-banner-heading text-center">Student Panel:  </h2>
   <center><p> Logged In:</p>
   <img src="<?php echo $_SESSION['img'];?>" style="width:120px; border-radius:80px;"/></center>
   <center> <h4 class=" text-center"><?php echo $_SESSION['name']; ?></h4></center></div>
 <div class="col-sm-2" style="float:right;"> <a href="logout.php"><button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Log Out</button></a></div>
  </section>
<div class="col-sm-12 text-center"><center><h1> Messages: </h1></center></div><br><br>
        <div class="container-fluid" >
			<div class="row-fluid" style="margin-top:20px;">
			
			<div class="col-sm-1"></div>
			<div class="col-sm-6 text-center" style="border:2px solid black; margin:10px; padding:20px;">
			<h4><i class="glyphicon glyphicon-envelope"></i> View Messages</h4>
				<?php //include('student_message_sidebar.php'); ?>
               <div class="span6" id="content">
                     <div class="row-fluid">
					   
                       
                        <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div id="" class="muted pull-left"></div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
										<ul class="nav nav-pills">
										<li class=""><a href="student_message.php"><i class="icon-envelope-alt"></i>inbox</a></li>
										<li class="active"><a href="sent_message_student.php"><i class="icon-envelope-alt"></i>Send messages</a></li>
										</ul>
									
								<?php
								 $query_announcement = mysqli_query($con, "select * from message_sent
																	LEFT JOIN tbl_student ON tbl_student.id = message_sent.reciever_id
																	where  sender_id =".$_SESSION['id']. " and sender_is_teacher=1 order by date_sended DESC
																	")or die(mysqli_error());
								 $count_my_message = mysqli_num_rows($query_announcement);
								 if ($count_my_message != '0'){
								 while($row = mysqli_fetch_array($query_announcement)){
								 $id = $row['message_sent_id'];
								 $recieveristeacher = $row['reciever_is_teacher'];
								 ?>
											<div class="post"  id="del<?php echo $id; ?>">
											<?php echo $row['content']; ?>
											<hr>	
											Send to(<?php if ($recieveristeacher == '1'){
												echo 'Supervisor';
											}else{
												echo 'Student'; ?>
											
											<?php } ?>): <strong><?php echo $row['reciever_name']; ?></strong>

											<i class="icon-calendar"></i> <?php echo $row['date_sended']; ?>
													<div class="pull-right">
													<button style="background:red;" class="btn-default" onClick="getConfirmation(<?php echo $id; ?>);">Remove</button>
													
													</div>
													<hr>
													<hr>
											</div>
										
								<?php }}else{ ?>
								<div class="alert alert-info"><i class="icon-info-sign"></i> No Message in your Send Items</div>
								<?php } ?>	
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    <!-- /block -->
					  </div>
				
					  <script type="text/javascript">
					  function getConfirmation(getId){
               var retVal = confirm("Do you want to Delete the message ?");
               if( retVal == true ){
			
var id = getId;
	$.ajax({
	type: "POST",
	url: "remove_sent_message.php",
	data: ({id: id}),
	cache: false,
	success: function(html){
	$("#del"+id).fadeOut('slow', function(){
		 $(this).remove();}); 
	$('#'+id).modal("hide");
	
	}
	}); 
			


               }
               else{
                 
                  return false;
               }
            }
					
	
</script>
	
	

								<script>
					/*	jQuery(document).ready(function(){
								jQuery("#reply").submit(function(e){
										e.preventDefault();
										var id = $('.reply').attr("id");
										var _this = $(e.target);
										var formData = jQuery(this).serialize();
										$.ajax({
											type: "POST",
											url: "reply.php",
											data: formData,
											success: function(html){
											$.jGrowl("Message Successfully Sent", { header: 'Message Sent' });
											$('#reply'+id).modal('hide');
											}
											
										});
										return false;
									});
								}); */
								</script>
						
					
									</div>
							</div>
									<div class="col-sm-4" style="border:2px solid black; margin:10px; padding:20px;">
									<?php include('create_message_student.php') ?>
							</div>
							<div class="col-sm-1"></div></div>
							
							</div>
					
							
							<?php include('temp_footer.php'); ?>
