<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Table contenant les annonces emploi + table d'expérience
 * 
 */  
class Migration_Add_ad_job_table extends CI_Migration {
    
    function up() {
        
        /*
         * Table ad_job
         * 
         */
        
        // ajout du id
        $this->dbforge->add_field('id');        
        
        $this->dbforge->create_table('ad_job'); 
        
        // ajout des champs
        $fields = array(
            
            // id de l'utilisateur qui a passé l'annonce
            'user_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                ),
                
            // nom du contact, texte
            'contact_name' => array(
                'type' => 'varchar',
                'constraint' => '255',            
            ),
            
            // email du contact pour lui envoyer les propositions, texte
            'contact_mail' => array(
                'type' => 'varchar',
                'constraint' => '255',            
            ),            
            
            // téléphone du contact, texte
            'contact_phone' => array(
                'type' => 'varchar',
                'constraint' => '255',            
            ),
            
            // ville, pour l'affichage, liée à table cities
            'ad_city' => array(
                'type' => 'INT',
                'constraint' => 11,             
            ),
            
            // titre de l'annonce, texte
            'ad_title' => array(
                'type' => 'varchar',
                'constraint' => '255',             
            ),
            
            // description du poste, texte
            'ad_description' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            
            // le contrat proposé, texte
            'ad_contract' => array(
                'type' => 'TEXT',
                'null' => TRUE,            
            ),
            
            // les horaires, texte
            'ad_worktime' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            
            // le salaire, texte
            'ad_salary' => array(
                'type' => 'TEXT',
                'null' => TRUE,
            ),
            
            // niveau d'expérience minimum souhaité (corrélé à la table xp_levels)
            'ad_xp_seek' => array(
                'type' => 'INT',
                'constraint' => 11,            
            ),
            
            // permis de conduire vrai - faux
            'ad_driver_licence' => array(
                'type' => 'BOOL',
                'default' => 0,            
            ),
            
            // pour gérer le fait d'afficher le nom du contact, ou celui de l'entreprise etc.
            'ad_confidentiality' => array(
                'type' => 'INT',
                'constraint' => 11,               
            ),
            
            // s'il s'agit d'un module magasin ou d'un fiche magasin temporaire
            'shop_type' => array(
                'type' => 'INT',
                'constraint' => 11,               
            ),
            
            // la référence du magasin (à corréler au shop_type)
            'shop_ref' => array(
                'type' => 'INT',
                'constraint' => 11,               
            ),            
        );
        
        $this->dbforge->add_column('ad_job', $fields);  
           
        
    }
    
    
    function down() {
        
        $this->dbforge->drop_table('ad_job');
        
    }
}    