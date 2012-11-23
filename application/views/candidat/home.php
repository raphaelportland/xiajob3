<?php 
/**
 * Homepage de la partie Candidat
 */
?>
    
    <h1>florBooks</h1>
    <h2>Révélez vos talents !</h2>
    
    
<div class='pull-left'>
    
<iframe width="640" height="360" src="http://www.youtube.com/embed/P_qgquKHgV4?rel=0" frameborder="0" allowfullscreen></iframe>    

</div> 


<div class='span4'>
<?php 

$data['show_captcha'] = FALSE;
$data['login_by_username'] = FALSE;

$this->load->view('auth/login_form', $data); ?>    
</div>   
</div>
<div class='row-fluid'>
        <p class='lead'>Les derniers books</p>
 
        <?php foreach ($books->latest as $key => $book) : // les books récents?>       
            
            <?php $this->load->view('books/templates/book_thumb',$book); ?>
            
        <?php endforeach; ?> 
     
    <?php echo anchor('book','Explorer tous les books','class="btn"'); ?>   
       


