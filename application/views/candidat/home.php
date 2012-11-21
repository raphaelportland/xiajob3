<?php 
/**
 * Homepage de la partie Candidat
 */
?>
<br /><br />

<div class='span6'>
    
<iframe width="640" height="360" src="http://www.youtube.com/embed/P_qgquKHgV4?rel=0" frameborder="0" allowfullscreen></iframe>    

</div> 


<div class='span4'>
<?php 

$data['show_captcha'] = FALSE;
$data['login_by_username'] = FALSE;

$this->load->view('auth/login_form', $data); ?>    
</div>   

    




