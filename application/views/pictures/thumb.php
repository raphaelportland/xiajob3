<div class='pic-thumb pull-left'>
    <a href='<?= site_url('book/show/'.$book_id.'/picture/'.$id); ?>' title='cliquez pour voir la photo'>
    <img src='<?= base_url().$th_url; ?>' class='img-polaroid' /></a><br />
    
    <i class='icon icon-asterisk'></i> <small>   
    <?php // affichage des fleurs 
    if($flower_data != '') :
        $this->load->view('flowers/simple_list',$flower_data);
    else :
        echo '<font class="muted">aucune fleur identifiée</font>';
    endif; 
    ?></small><br />  
    
    <i class='icon icon-comment'></i> <small>
    <?php // affichage du nombre de commentaires 
    if(isset($comments->nb)) :
        echo count($comments->nb);
    else : 
        echo "<font class='muted'>aucun commentaire</font>"; 
    endif; ?>    
    </small><br />
    
    
</div>

