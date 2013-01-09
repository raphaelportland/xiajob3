<h1><?= $rubrique['name']; ?></h1>

<?php $this->load->view('ads/'.$rubrique['folder'].'/menu'); ?>


<?php $this->load->view('ads/'.$rubrique['folder'].'/step'.$step); ?>
