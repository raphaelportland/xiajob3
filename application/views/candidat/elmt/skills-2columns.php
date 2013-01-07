    <div class='row'>     
        <div class='span6'>
            <table class='table'>

                    <?php for ($j=1; $j < 6; $j++) :
                        
                        $competence = $user->resume->skills[$j]; 
                        $score = $competence->score;
                        
                        echo("<tr>
                        <td><img src='".base_url().'public/img/skills/'.$competence->picto."' /></td>
                        <td><p>".$competence->nom."</p></td><td>");  
                        
                        for ($i=0; $i < 4; $i++) {
                            if($score > 1) : ?>
                                <i class='star star-on'></i>
                            <?php $score = $score - 1;
                            else : ?>
                                <i class='star star-off'></i>                
                            <?php endif;
                        }
                        echo("</td></tr>");
                    endfor;?>
            </table>                        
        </div>
        <div class='span6'>
            <table class='table'>
                    <?php for ($j=6; $j < 11; $j++) :
                        
                        $competence = $user->resume->skills[$j]; 
                        $score = $competence->score;
                        
                        echo("<tr>
                        <td><img src='".base_url().'public/img/skills/'.$competence->picto."' /></td>
                        <td><p>".$competence->nom."</p></td><td>");  
                        
                        for ($i=0; $i < 4; $i++) {
                            if($score > 1) : ?>
                                <i class='star star-on'></i>
                            <?php $score = $score - 1;
                            else : ?>
                                <i class='star star-off'></i>                
                            <?php endif;
                        }
                        echo("</td></tr>");
                    endfor;?>
            </table>             
        </div>
    </div>