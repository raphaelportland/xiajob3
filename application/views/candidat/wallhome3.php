<?php 
/**
 * Homepage New Wall Page
 */
?>
<?php
// seconds, minutes, hours, days
$expires = 60*60*24*14;
header("Pragma: public");
header("Cache-Control: maxage=".$expires);
header('Expires: ' . gmdate('D, d M Y H:i:s', time()+$expires) . ' GMT');
?>

<?php
$msg;
		 if($msg!=''){
		     ?><script type="text/javascript">alert('<?php echo $msg;?>');</script><?php
		 }
		?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url()."public/css/$css"?>">
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="<?php echo base_url('/public');?>" type="text/javascript"></script>
<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
	<div id="fb-root"></div>
		<script>
		(function(d, s, id) {
		  var js, fjs = d.getElementsByTagName(s)[0];
		  if (d.getElementById(id)) return;
		  js = d.createElement(s); js.id = id;
		  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=407397235982056";
		  fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
		</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="https://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<script type="text/javascript">
		$(document).ready(function(){
			$('.favourite').click(function(){
				$('.favourite2').show();
				$('.favourite').hide();
			
			});
			$('.favourite2').click(function(){
				$('.favourite2').hide();
				$('.favourite').show();
			
			});
		});
		var count = 0;
		function countClicksIncrease() {
		//  document.getElementById("p2").innerHTML = count;
		    if($("#happy_smile a").attr('disabled')!='disabled'){
				count = count + 1;
				$('#smiley').html(count);
				$("#happy_smile a").attr('disabled', 'disabled');
				$("#sad_smile a").removeAttr('disabled');
			}
		}

		function countClicksDecrese() {
		 if(count>0){
		   count = count - 1;
		 }
		   // document.getElementById("p2").innerHTML = count;
			if($("#sad_smile a").attr('disabled')!='disabled'){
			$('#smiley').html(count);
			$("#sad_smile a").attr('disabled', 'disabled');
			$("#happy_smile a").removeAttr('disabled');
			}
		}
	
	
	function updatefav(formId, typeURL) { 
	
	var values = $(formId).serialize();
    alert (typeURL);
    $.ajax( {
        type:"POST",
		url: typeURL,
		data: values,
		success: function(data) {
        alert ("sucess");		
			$('#message').html(data);
        }
    });
    return false;
}
	
	
	
	</script>	

<div class="wrapper">
    	<div class="top_buttons">
        	<div class="best"><a href="#">BEST</a></div>
            <div class="best"><a href="#">VOTE</a></div>
            <div class="filter"><a href="#">filter by country...</a></div>
            <div class="clr"></div>
        </div>
		
	<?php 
		foreach($books as $book=>$val):
	?>
        <div class="lower_cont">
        	<div class="portfolio_name">
            	<h4><?php echo $val->book_name;?> - by <?php echo $val->owner->first_name;?> <span>(<?php echo $val->pic_nb;?> photos)</span></h4>
                <p><?php echo $val->description;?>, <?php echo $val->owner->first_name;?></p>
            </div>
            
            <div class="lower_main_cont">
            	<div class="lower_left">
                	<div class="main_image">
					     <?php 
							   
							   
							   //
							   $bookImage = "<img src='".base_url().$val->cover->pic_url."'/>";
							   $valImage = getimagesize(base_url().$val->cover->pic_url);
							   $valNewImage=ceil($valImage[1]/$valImage[0] * 843);
							   $bookImage = "<img src='".base_url()."public/phpthumb/thumbnail.php?file=".base_url().$val->cover->pic_url."&maxw=843&maxh=403' />";
							  // echo "<pre>";print_r($valNewImage);echo 'asdsadsadas';
							   echo anchor('book/show/'.$val->id, $bookImage);
						 ?>
							   
					</div>
                    
                    <div id="slider1">
                        
                        <div class="viewport">
                            <ul class="overview">
                                <?php
									foreach($val->pictures as $pic):
										$imageURL = "<img src='".base_url()."public/phpthumb/thumbnail.php?file=".base_url().$pic->th_url."&maxw=118&maxh=118' />";
										echo '<li>'.anchor('book/show/'.$val->id.'/picture/'.$pic->id, $imageURL).'</li>';
									endforeach;
								?>
								<!--<li><a href="#"><img src="<?php echo base_url()?>/public/img/images/smallcar1.png"  /></a></li>
                                <li><a href="#"><img src="<?php echo base_url()?>/public/img/images/smallcar2.png"  /></a></li>
                                <li><a href="#"><img src="<?php echo base_url()?>/public/img/images/smallcar3.png"  /></a></li>
                                <li><a href="#"><img src="<?php echo base_url()?>/public/img/images/small_img4.png"  /></a></li>
                                <li><a href="#"><img src="<?php echo base_url()?>/public/img/images/small_img5.png"  /></a></li>
                                <li><a href="#"><img src="<?php echo base_url()?>/public/img/images/small_img6.png"  /></a></li>
                                <li><a href="#"><img src="<?php echo base_url()?>/public/img/images/small_img7.png"  /></a></li>-->    
                                <li></li> 
                            </ul>
                        </div>
                        <a class="buttons prev" href="#">left</a>
                        <a class="buttons next" href="#">right</a>
                    </div>
                    <div class="fb-comments" data-href="<?php echo base_url()?>index.php/book/show/<?php echo $val->id ?>" data-width="830" data-num-posts="2" style="display:block;"></div>
                    
                </div>
                
                <div class="lower_right">
                	<div class="smiley_comment">
                    	<div class="comment"><div class="fb-comments-count" data-href="<?php echo base_url()?>index.php/book/show/<?php echo $val->id ?>"></div></div>
                        <?php 
						$imageValue = '';
						foreach($likeDislikeCount as $count=>$valCount):
						if($val->id == $count){
						$imageValue = $valCount;
						?>
						<div class="smiley" id="smiley_<?php echo $val->id;?>"><?php echo $valCount;?></div>
						<?php }else{
						     continue;
						} ?>
						<?php endforeach;?>
                        <div class="clr"></div>
                    </div>
                    <?php 
					$attributes = array('id' => 'likeDilikeForm'.$val->id);
					echo form_open('wall/likeDislikeInser' ,$attributes);?>
					<?php 
					 $imageValue1 = '';
						foreach($likeDislikeCountNew as $count1=>$valCount1):
						if($val->id == $count1){
						$imageValue1 = $valCount1;}?>
						<?php endforeach;?>
                    <div class="right_box">
                    	<div class="right_box_top"></div>
                        <div class="right_box_mid">
                        	<div class="sad_smile" id="sad_smile_<?php echo $val->id;?>">
							    <?php if($imageValue1!=1){
								        ?>
										<a id="sad_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);" style="background:url('<?php echo base_url();?>/public/img/images/broken_heart_hover.png') no-repeat scroll left center transparent;" disabled></a>
										<?php
								}else{
								?>
								<a id="sad_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);" ></a>
								<?php
								}
								//echo $imageValue; 
								?>
								
								<div style="display:none;"><input type="radio" value="1" name="like" id="like_<?php echo $val->id;?>" /></div>
							</div>
                            <div class="happy_smile" id="happy_smile_<?php echo $val->id;?>">
								<?php 
								if($imageValue1!=0){?>
								<a  id="happy_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);" style="background:url('<?php echo base_url();?>/public/img/images/heart1_hover.png') no-repeat scroll left center transparent;" disabled></a>
								<?php }else{?>
								<a  id="happy_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);"></a>
								<?php
								}
								?>
								
								<div style="display:none;"><input type="radio" value="0" name="like" id="Dislike_<?php echo $val->id;?>" /></div>
							</div>
							<input type="hidden" name="likeUserId" value="<?php echo $likeDislikeUid;?>"/>
							<input type="hidden" name="likeBookId" value="<?php echo $val->id;?>"/>
							
                        </div>
                    </div>
					</form>
					<script>
					var count=0;
					$('#happy_smile_<?php echo $val->id;?>').click(function(){
						      if($("#happy_smile_<?php echo $val->id;?> a").attr('disabled')!='disabled'){
								count = count + 1;
								$('#like_<?php echo $val->id;?>').attr("checked","checked");
								$('#smiley_<?php echo $val->id;?>').html(count);
								$("#happy_smile_<?php echo $val->id;?> a").attr('disabled', 'disabled');
								$("#sad_smile_<?php echo $val->id;?> a").removeAttr('disabled');
								$('#likeDilikeForm<?php echo $val->id;?>').submit();
							}
						});
						
                        $('#sad_smile_<?php echo $val->id;?>').click(function(){
							 if(count>0){
								count = count - 1;
							}
							
						   // document.getElementById("p2").innerHTML = count;
							if($("#sad_smile_<?php echo $val->id;?> a").attr('disabled')!='disabled'){
							$('#smiley_<?php echo $val->id;?>').html(count);
							$('#Dislike_<?php echo $val->id;?>').attr("checked","checked");
							
							$("#sad_smile_<?php echo $val->id;?> a").attr('disabled', 'disabled');
							$("#happy_smile_<?php echo $val->id;?> a").removeAttr('disabled');
							$('#likeDilikeForm<?php echo $val->id;?>').submit();
							}
						});
					</script>
					
					<?php
						$url1 = base_url().'book/show/'.$val->id;
						$image=urlencode($bookImage);
					?>
					<div class="lower_right_box">
                    	<div class="lower_right_box_top">
                        	<div class="tweet_sec">
                            	<div class="tweet"><a href="https://twitter.com/share" data-url="<?php echo $url1;?>" class="twitter-share-button" data-lang="en"></a></div>
                            </div>
                            <div class="facebook_sec">
                            	<div class="facebook"><a share_url="<?php echo $url1; ?>" href="http://www.facebook.com/sharer.php?" name="fb_share" rel="nofollow" type="button_count"></a></div>
                            </div>
                        </div>
                        <div class="lower_right_box_bottom"></div>
                    </div>
                   
	              <?php 
				  $asd = '';
				  foreach($favcount as $favcountnum=>$valCountfav): ?>
				  <?php if($val->id==$favcountnum AND $valCountfav==1){ 
				     $asd = $valCountfav;
				  }
				  endforeach;?>
				  <?php if($asd==1){?>
				  <form id="del_fav_<?php echo $val->id; ?>"> 
                    <div class="favourite_<?php echo $val->id;?> abc" id="favourite_<?php echo $val->id;?>">
						<?php 
						     $favImage = '<a href="javascript:;"><img src="'.base_url().'/public/img/images/favourite_clicked_button.png" />
							 </a><input type="hidden" name="book_id" value="'.$val->id.'">';  
							 echo  $favImage;
						?>	
					<!--<a href="#"></a>-->
					</div>
					</form>
					<?} else { ?>
					 <form id="add_fav_<?php echo $val->id; ?>"> 
                    <div class="favourite_<?php echo $val->id;?> abc" id="favourite_<?php echo $val->id;?>">
						<?php 
						     $favImage = '<a href="javascript:;">
							 <img src="'.base_url().'/public/img/images/favourite_button.png" /></a><input type="hidden" name="book_id" value="'.$val->id.'">';  
							 echo  $favImage;
						?>
						<!--<a href="#"><img src="<?php echo base_url()?>/public/img/images/favourite_clicked_button.png" /></a>-->
					</div>
					</form>
                    <?php } ?>
					<?php //endforeach;?>
                    
					<script>
					
					$('#add_fav_<?php echo $val->id;?>').click(function()
						{
						alert("hi");
						var editURL = "<?php echo base_url()?>index.php/wall3/add_fav";
					    updatefav('#add_fav_<?php echo $val->id;?>', editURL);
						$('#favourite_<?php echo $val->id;?> img').attr('src','<?php echo base_url()?>public/img/images/favourite_clicked_button.png');
						
						});
						
						$('#del_fav_<?php echo $val->id;?>').click(function()
						{
						//alert("hello");
						var editURL = "<?php echo base_url()?>index.php/wall3/del_fav";
					     updatefav('#del_fav_<?php echo $val->id;?>', editURL);	
						 $('#favourite_<?php echo $val->id;?> img').attr('src','<?php echo base_url()?>public/img/images/favourite_button.png');
					    	
						});
						
						
						

						
						
						
					</script>
					
                    <div class="alert">
                    	<div class="alert_icon"><a href="#"><img src="<?php echo base_url()?>/public/img/images/alert2.png"  /></a></div>
                        <div class="alert_text">
							<a href="#" id="reportAbuse_<?php echo $val->id;?>">report this</a>
						</div>
					</div>
					<?php echo validation_errors(); ?>
					<div id="reportAbuseForm_<?php echo $val->id;?>" style="width:130px;">
					
					<?php echo form_open('wall/abusive_comment');?>
						<font size="2" color="maroon"><b>Comment:</b></font><br>

						<textarea id="txtholder" class="txtholder" name="txtholder" rows="8" cols="45"></textarea>
						<select name="reportAbuseCategory" id="reportAbuseCategory">
							 <option value='' select="selected">Selected</option>
							 <?php 
								  
								 foreach($word as $val1=>$key1):
								 ?>
								 <option value="<?php echo $key1->ID;?>"><?php echo $key1->abusive_word;?></option>
								 <?php
								 endforeach;
							 ?>
						</select>
                        <input type="hidden" name="bookId" id="bookId" value="<?php echo $val->id?>" /> 
						<input type="submit" id="submit" Value="submit" name="submit" />
					</form>
					
					</div>	
					<script>
						$('#reportAbuseForm_<?php echo $val->id;?>').css('display','none'); 
						$('#reportAbuse_<?php echo $val->id;?>').click (function () {
							 $('#reportAbuseForm_<?php echo $val->id;?>').toggle('slow'); 
						   });
					</script>
                    
                </div>
                <div class="clr"></div>
            </div>
        </div>
	<?php endforeach;?>	
        
    </div>

