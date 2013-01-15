<h2>Merci d'accepter nos Conditions Générales d'Utilisation</h2>

<p>Pour poursuivre sur le site, vous devez accepter nos CGU</p>

<div class='cgu-box'>
    <?php $this->load->view('common/pages/cgu'); ?>
</div>

<?php echo anchor('main/valid_cgu',"J'accepte et je continue sur florBooks", "class='btn btn-success'"); ?>
&nbsp;
<?php echo anchor('main/decline_cgu',"Je refuse et je quitte florBooks", "class='btn btn-danger'"); ?>
