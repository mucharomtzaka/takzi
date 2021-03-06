<?php

class Migration_Settings extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id_sett' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
             'header_title' => array(
                'type' => 'varchar',
                'constraint' => 80,
                'null'=>TRUE
            )
             ,
             'footer_title' => array(
                'type' => 'varchar',
                'constraint' => 100,
                'null'=>TRUE,
            ),
             'meta_title' => array(
                'type' => 'varchar',
                'constraint' => 200,
                'null'=>TRUE,
            ),
             'themes' => array(
                'type' => 'varchar',
                'constraint' => 95,
                'null'=>TRUE,
            ),
             'image_favicon' => array(
                'type' => 'varchar',
                'constraint' => 95,
                'null'=>TRUE,
            ),
             'backgrounds' => array(
                'type' => 'varchar',
                'constraint' => 100,
                'null'=>TRUE,
            ),'name_company' => array(
                'type' => 'varchar',
                'constraint' => 100,
                'null'=>TRUE,
            ),'address_company' => array(
                'type' => 'varchar',
                'constraint' => 100,
                'null'=>TRUE,
            ),'contact_company' => array(
                'type' => 'varchar',
                'constraint' => 100,
                'null'=>TRUE,
            ),'name_company_profil_des' => array(
                'type' => 'TEXT',
                'null'=>TRUE,
            )
        ));
        $this->dbforge->add_key('id_sett', TRUE);
        $this->dbforge->create_table('settings');


    }

    public function down() {
        $this->dbforge->drop_table('settings');
    }

}