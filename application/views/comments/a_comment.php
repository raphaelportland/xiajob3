<div class='comment'>
    
    <div class='author'>
        <strong><?php echo anchor('profile/view/'.$user_id, $username);?></strong>
    </div>
    
    <div class='message'>
        <p><?= $comment; ?></p>
    </div>
    
    <div class='meta-data'>
        <p class='muted pull-right'><small><?= $created_at; ?></small></p>
    </div>
   
</div>
