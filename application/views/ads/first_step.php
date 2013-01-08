<h1>Annonces florBooks</h1>

<div class='alert alert-info'>
    <strong>Vous êtes sur le point de créer une annonce</strong><br />
    Cela ne vous prendra que 5 minutes !
</div>

<p class='lead'>Votre annonce concerne : </p>

<div class='row'>
    <div class='span4'>
        <div class="btn-group">
            <?= anchor('ads/job_ad', '<br />Une offre d\'emploi<br /><br />', 'class="btn btn-large"'); ?>
            <?= anchor('ads/job_ad', '<br /><i class="icon-chevron-right icon-white"></i><br /><br />', 'class="btn btn-success btn-large"'); ?>
        </div>
    </div>
    
    <div class='span4'>
        <div class="btn-group">
            <?= anchor('', '<br />Une vente de magasin<br /><br />', 'class="btn btn-large"'); ?>
            <?= anchor('', '<br /><i class="icon-chevron-right icon-white"></i><br /><br />', 'class="btn btn-warning btn-large"'); ?>
        </div>
    </div>
    
    <div class='span4'>
        <div class="btn-group">
            <?= anchor('', '<br />Une recherche de partenaire<br /><small class="muted">associé / franchisé</small>', 'class="btn btn-large"'); ?>
            <?= anchor('', '<br /><i class="icon-chevron-right icon-white"></i><br /><br />', 'class="btn btn-info btn-large"'); ?>
        </div>
    </div>
        
</div>
