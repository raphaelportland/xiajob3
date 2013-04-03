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

<?php $msg;
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
	</script>
<script>
function updateLikeDislike(formId) { 
	var editURL = "<?php echo base_url()?>index.php/wall/likeDislikeInser";
	var values = $(formId).serialize();

    $.ajax( {
        type:"POST",
		url: editURL,
		data: values,
		success: function(data) {	
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
                	<div class="main_image" style='overflow:hidden;'>
					     <?php 
							   
							   
							   //
							   /*$bookImage = "<img src='".base_url().$val->cover->pic_url."'/>";
							   $valImage = getimagesize(base_url().$val->cover->pic_url);
							   $valNewImage=ceil($valImage[1]/$valImage[0] * 843);
							   $bookImage = "<img src='".base_url()."public/phpthumb/thumbnail.php?file=".base_url().$val->cover->pic_url."&maxw=843&maxh=403' />";
							   */
							  // echo "<pre>";print_r($valNewImage);echo 'asdsadsadas';
							 
							  $bookImage = "<img style='width:100%;' src='".base_url().$val->cover->pic_url."' />";
							 
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
						$imageValue = array();
						foreach($likeDislikeCount as $count=>$valCount):
						if($val->id == $count){
						$imageValue[$count] = $valCount;
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
						<style>
						#target_div_sad<?php echo $val->id;?> a
						{
						background:url('<?php echo base_url();?>/public/img/images/broken_heart_hover.png') no-repeat scroll left center transparent;
						}
						#target_div_happy<?php echo $val->id;?> a
						{
						background:url('<?php echo base_url();?>/public/img/images/heart1_hover.png') no-repeat scroll left center transparent;
						}
						</style>
                        	<div class="sad_smile" id="sad_smile_<?php echo $val->id;?>">
							    <?php  if( !empty($likeDislikeCountNew)){ if($imageValue1!=1 ){
								        ?>
										<div id="target_div_sad<?php echo $val->id;?>"><a id="sad_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);" ></a></div>
										<input type="hidden" name="imagedislike<?php echo $val->id;?>" value="1" id="imagedislike<?php echo $val->id;?>"/>
										<?php
								}else{
								?>
								<div id="target_sad<?php echo $val->id;?>"><a id="sad_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);" ></a></div>
								<input type="hidden" name="imagedislike<?php echo $val->id;?>" value="1" id="imagedislike<?php echo $val->id;?>"/>
								<?php
								} }else{
								//echo $imageValue; 
								?>
								<a id="sad_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);" ></a>
								<?php } ?>
								<div style="display:none;"><input type="radio" value="1" name="like" id="like_<?php echo $val->id;?>" /></div>
							</div>
                            <div class="happy_smile" id="happy_smile_<?php echo $val->id;?>">
								<?php
                                 if( !empty($likeDislikeCountNew)){								
								if($imageValue1!=0 ){?>
								<div id="target_div_happy<?php echo $val->id;?>"><a  id="happy_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);" ></a></div>
								<input type="hidden" name="imagelike<?php echo $val->id;?>" value="1" id="imagelike<?php echo $val->id;?>"/>
								<?php }else{?>
								<div id="target_happy<?php echo $val->id;?>"><a  id="happy_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);"></a></div>
								<input type="hidden" name="imagelike<?php echo $val->id;?>" value="1" id="imagelike<?php echo $val->id;?>"/>
								<?php
								} }else {
								?>
								<a  id="happy_smile_decrease_<?php echo $val->id;?>" href="javascript:void(0);"></a>
								<?php } ?>
								
								<div style="display:none;"><input type="radio" value="0" name="like" id="Dislike_<?php echo $val->id;?>" /></div>
							</div>
							
							<input type="hidden" name="likeUserId" value="<?php echo $likeDislikeUid;?>"/>
							<input type="hidden" name="likeBookId" value="<?php echo $val->id;?>"/>
							
                        </div>
                    </div>
					</form>
					<script>
					var count=0;
						$('#happy_smile_<?php echo $val->id;?>').click(function()
						{
					          var id_like = $(this).parent().find('input[type="hidden"][name="imagelike<?php echo $val->id;?>"]').val();
							  
							 
							 if(id_like==1)
							 {
							 $("#imagelike<?php echo $val->id;?>").val(2);
							 
							 }else{
							 $("#imagelike<?php echo $val->id;?>").val(1);
							 }
			
							 //alert(id_like);
							 
					 
								if($("#happy_smile_<?php echo $val->id;?> a").attr('disabled')!='disabled'){
								<?php if( !empty($likeDislikeCountNew)){ ?>
							  
								<?php } ?>
								$('#like_<?php echo $val->id;?>').attr("checked","checked");
								<?php 
								if($imageValue1==1) { ?>
									if(id_like==2){
										$("#target_div_happy<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/heart1.png)'});
										var count = <?php echo $imageValue[$val->id]; ?>;
										count = count-1;
									}else
									{
										$("#target_div_happy<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/heart1_hover.png)'});
										var count = <?php echo $imageValue[$val->id]; ?>;
										count = count ;
									}
									$("#target_sad<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/broken_heart.png)'});
								<?php }
								else { ?>
									if(id_like==1){
										$("#target_happy<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/heart1_hover.png)'});
										var count = <?php echo $imageValue[$val->id]; ?>;
										count = count + 2;
									}else{
										$("#target_happy<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/heart1.png)'});
										var count = <?php echo $imageValue[$val->id]; ?>;
										count = count+1;
									}
									$("#target_div_sad<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/broken_heart.png)'});
									<?php 
								} ?>
								$("#sad_smile_<?php echo $val->id;?> a").removeAttr('disabled');
								$('#smiley_<?php echo $val->id;?>').html(count);
								<?php if(empty($likeDislikeCountNew)){ ?>
								$('#likeDilikeForm<?php echo $val->id;?>').submit();
								<?php }else { ?>
								updateLikeDislike('#likeDilikeForm<?php echo $val->id;?>');
								<?php } ?>
							}
						});
						
                        $('#sad_smile_<?php echo $val->id;?>').click(function(){
						    <?php if( !empty($likeDislikeCountNew)){ ?>
						     var count=<?php echo $imageValue[$val->id]; ?>;
							
							 
							
							
							<?php } ?>
						   // document.getElementById("p2").innerHTML = count;
						   var id_dislike = $(this).parent().find('input[type="hidden"][name="imagedislike<?php echo $val->id;?>"]').val();
							  
							 
							if(id_dislike==1)
							{
								$("#imagedislike<?php echo $val->id;?>").val(2);
							}else{
								$("#imagedislike<?php echo $val->id;?>").val(1);
							}
							if($("#sad_smile_<?php echo $val->id;?> a").attr('disabled')!='disabled')
							{
							
								$('#Dislike_<?php echo $val->id;?>').attr("checked","checked");
								<?php if($imageValue1==0) { ?>
							     if(id_dislike ==2)
								 {
								 $("#target_div_sad<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/broken_heart.png)'});
								 if(count>0){
								count = count + 1;
							             }
								 }else{
								 $("#target_div_sad<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/broken_heart_hover.png)'});
								 if(count>0){
								count = count;
							}
								 }
								$("#target_happy<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/heart1.png)'});
								
								<?php }
								else { ?>
								
								if(id_dislike ==1)
								 {
								$("#target_sad<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/broken_heart_hover.png)'});
								if(count<2){
								count = 0;
							    }else{
								count=count-2;
								}
								}else{
								$("#target_sad<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/broken_heart.png)'});
								if(count<2){
								count = count;
							       }else{
								   count = count+1;
								   }
								}
								$("#target_div_happy<?php echo $val->id;?> a").css({ 'background-image': 'url(<?php echo base_url();?>/public/img/images/heart1.png)'});
				
								<?php } ?>
							
							$("#happy_smile_<?php echo $val->id;?> a").removeAttr('disabled');
							$('#smiley_<?php echo $val->id;?>').html(count);
							<?php if(empty($likeDislikeCountNew)){ ?>
							$('#likeDilikeForm<?php echo $val->id;?>').submit();
							<?php }else { ?>
							updateLikeDislike('#likeDilikeForm<?php echo $val->id;?>');
							<?php } ?>
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
                    
					
					<?php // bouton ajouter ou retirer des favoris 
        /*if($is_your_fav == true) :
        echo anchor('wall/del_fav/'.$val->id.'/book', '<i class="icon icon-white icon-star"></i> Retirer des favoris','class="btn btn-danger"');
        else :
        echo anchor('wall/add_fav/'.$val->id.'/book','<i class="icon icon-star"></i> Ajouter aux favoris','class="btn"');
        endif;*/ ?>
					
					
				
                    <div class="favourite">
						<?php 
						     $favImage = '<img src="'.base_url().'/public/img/images/favourite_button.png" />';  
							 echo anchor('wall/add_fav/'.$val->id.'/book', $favImage);
						?>	
					<!--<a href="#"></a>-->
					</div>
					
                    <div class="favourite2">
						<?php 
						     $favImage = '<img src="'.base_url().'/public/img/images/favourite_clicked_button.png" />';  
							 echo anchor('wall/del_fav/'.$val->id.'/book', $favImage);
						?>
						<!--<a href="#"><img src="<?php echo base_url()?>/public/img/images/favourite_clicked_button.png" /></a>-->
					</div>
                   
                    
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

