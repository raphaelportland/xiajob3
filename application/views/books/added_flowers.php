<div id='added_flowers'>
    
<?php 

if($added_flowers) :
    
    //code($added_flowers);


    if(isset($added_flowers['official'])) :
    
        foreach ($added_flowers['official'] as $key => $flower) : ?>           
                <span class="label label-inverse"><?= $flower->name_fr; ?>
                    <?php if(!isset($forbidden_edit)) : ?>
                    <?php echo anchor('book/del_pic_flower/'.$pic_id.'/'.$flower->flower_id,"<i class='icon icon-white icon-remove'></i>"); ?>
                    <?php endif; ?>
                </span>
                             
    <?php endforeach; 
  
    endif;

    if(isset($added_flowers['custom'])) :
    
        foreach ($added_flowers['custom'] as $key => $flower) : ?>           
                <span class="label"><?= $flower->custom_name; ?>
                    <?php if(!isset($forbidden_edit)) : ?>
                    <?php echo anchor('book/del_pic_flower/'.$pic_id.'/'.$flower->id.'/1',"<i class='icon icon-white icon-remove'></i>"); ?>
                    <?php endif; ?>
                </span> 
    <?php endforeach; 
  
    endif;
    
else :
    
    echo('aucune fleur identifiée');

endif; ?>
    
</div>