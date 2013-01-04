<!-- The file upload form used as target for the file upload widget -->
<form id="fileupload" action="<?php echo base_url(); ?>index.php/upload/upload_img" method="POST" enctype="multipart/form-data">   

    <?php 
    // L'ID DU BOOK POUR LE TRAITEMENT
    echo form_hidden('book_id',$book->id)?>
        
    <!-- The fileupload-buttonbar contains buttons to add/delete files and start/cancel the upload -->
    <div class="row-fluid fileupload-buttonbar">




       
    <?php 
    // TESTE LE NOMBRE DE PHOTO POUR AFFICHER L'ALERTE CORRESPONDANTE
    // ET ACTIVER OU NON LE BOUTON AJOUT
    
    if(($book->pic_nb) < 10) : ?>
    
        <div class='alert alert-info'>
            <strong>Attention</strong>
            Pour des books de qualité, merci de vous limiter à 10 photos maximum par book.
        </div><div class="span7">
       
        <span class="btn btn-success fileinput-button">
            <i class="icon-plus icon-white"></i>
            <span>Choisir des photos...</span>
            <input type="file" name="userfile" multiple>
        </span>
    
    <?php else : ?>
                    
        <div class='alert alert-danger'>
            <strong>Trop d'images ! </strong>
            Vous devez d'abord supprimer certaines photos pour pouvoir en rajouter : <?php echo anchor('book/edit/'.$book->id, 'Modifier votre book'); ?>
        </div><div class="span7">                    
                    
        <span class="btn btn-success disabled">
            <i class="icon-plus icon-white"></i>
            <span>Choisir des photos...</span>
        </span>
                
    <?php endif; ?>
    
    
    
    
    
    
                <button type="button" class="btn btn-danger delete">
                    <i class="icon-trash icon-white"></i>
                    <span>Supprimer</span>
                </button>
                <input type="checkbox" class="toggle">
            </div>
            <!-- The global progress information -->
            <div class="span5 fileupload-progress fade">
                <!-- The global progress bar -->
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                    <div class="bar" style="width:0%;"></div>
                </div>
                <!-- The extended global progress information -->
                <div class="progress-extended">&nbsp;</div>
            </div>
        </div>
        <!-- The loading indicator is shown during file processing -->
        <div class="fileupload-loading"></div>
        <br>
        <!-- The table listing the files available for upload/download -->
        <table role="presentation" class="table table-striped"><tbody class="files" data-toggle="modal-gallery" data-target="#modal-gallery"></tbody></table>
    </form>
    <br>


<!-- modal-gallery is the modal dialog used for the image gallery -->
<div id="modal-gallery" class="modal modal-gallery hide fade" data-filter=":odd" tabindex="-1">
    <div class="modal-header">
        <a class="close" data-dismiss="modal">&times;</a>
        <h3 class="modal-title"></h3>
    </div>
    <div class="modal-body"><div class="modal-image">
        
    <img class="" src="{%=file.url%}">    
        
    </div></div>
    <div class="modal-footer">
        <a class="btn modal-download" target="_blank">
            <i class="icon-download"></i>
            <span>Download</span>
        </a>
    </div>
</div>


<!-- The template to display files available for upload -->
<script id="template-upload" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-upload fade">
        <td class="preview"><span class="fade"></span></td>
        <td class="name"><span>{%=file.name%}</span></td>
        <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
        {% if (file.error) { %}
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else if (o.files.valid && !i) { %}
            <td>
                <div class="progress progress-success progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="bar" style="width:0%;"></div></div>
            </td>
            <td class="start">{% if (!o.options.autoUpload) { %}
                <button class="btn btn-primary">
                    <i class="icon-upload icon-white"></i>
                    <span>Charger</span>
                </button>
            {% } %}</td>
        {% } else { %}
            <td colspan="2"></td>
        {% } %}
        <td class="cancel">{% if (!i) { %}
            <button class="btn btn-warning">
                <i class="icon-ban-circle icon-white"></i>
                <span>Annuler</span>
            </button>
        {% } %}</td>
    </tr>
{% } %}
</script>







<!-- The template to display files available for download -->
<script id="template-download" type="text/x-tmpl">
{% for (var i=0, file; file=o.files[i]; i++) { %}
    <tr class="template-download fade">
        {% if (file.error) { %}
            <td></td>
            <td class="name"><span>{%=file.name%}</span></td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td class="error" colspan="2"><span class="label label-important">Error</span> {%=file.error%}</td>
        {% } else { %}
            <td class="preview">{% if (file.thumbnail_url) { %}
               <!-- <a href="{%=file.url%}" title="{%=file.name%}" rel="gallery" download="{%=file.name%}">-->
                    <img class="img-polaroid" src="<?php echo base_url(); ?>/{%=file.thumbnail_url%}">
               <!-- </a>-->
            {% } %}</td>
            
            <td class="name">Photo enregistrée</td>
            
            <!--
            <td class="name">
                <a href="{%=file.url%}" title="{%=file.name%}" rel="{%=file.thumbnail_url&&'gallery'%}" download="{%=file.name%}">{%=file.name%}</a>
            </td>
            <td class="size"><span>{%=o.formatFileSize(file.size)%}</span></td>
            <td colspan="2"></td>-->
        {% } %}
        <td class="delete">
            <button class="btn btn-danger" data-type="{%=file.delete_type%}" data-url="{%=file.delete_url%}">
                <i class="icon-trash icon-white"></i>
                <span>Supprimer</span>
            </button>
            <input type="checkbox" name="delete" value="1">
        </td>
    </tr>
{% } %}
</script>
<!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
<script src="<?= base_url(); ?>public/js/fileupload/vendor/jquery.ui.widget.js"></script>

<!-- The Templates plugin is included to render the upload/download listings -->
<script src="<?= base_url(); ?>public/js/fileupload/blueimp/blueimp.js"></script>
<script src="<?= base_url(); ?>public/js/fileupload/blueimp/bootstrap-img-gallery.js"></script>

<!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
<script src="<?= base_url(); ?>public/js/fileupload/jquery.iframe-transport.js"></script>
<!-- The basic File Upload plugin -->
<script src="<?= base_url(); ?>public/js/fileupload/jquery.fileupload.js"></script>
<!-- The File Upload file processing plugin -->
<script src="<?= base_url(); ?>public/js/fileupload/jquery.fileupload-fp.js"></script>
<!-- The File Upload user interface plugin -->
<script src="<?= base_url(); ?>public/js/fileupload/jquery.fileupload-ui.js"></script>
<!-- The main application script -->
<script src="<?= base_url(); ?>public/js/fileupload/main.js"></script>
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE8+ -->
<!--[if gte IE 8]><script src="js/cors/jquery.xdr-transport.js"></script><![endif]-->