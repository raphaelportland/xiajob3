<p class='lead'>Lien direct d'accès à votre book</p>
        
    <div class="input-prepend">
    <span class="add-on"><i class='icon icon-lock'></i></span>
    <input type="text" value="<?= $short_url; ?>" class='input input-xlarge' />
    </div> 
    <p><small>URL raccourcie avec <?php echo anchor('https://bitly.com/','BitLy'); ?></small></p>

   
    <a href="<?= $short_url; ?>" target='_blank' class='btn'>Voir mon book tel qu'il apparaît</a>


    


