<?php

class Migration_links extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE,
            ),
            'title_link_menu'=>array(
                'type'=>'varchar',
                'constraint'=>'50',
                ),
            'desc_link_menu'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('linkscompany');

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'title_link_menu_support'=>array(
                'type'=>'varchar',
                'constraint'=>'50',
                ),
            'desc_link_menu_support'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('linkssupport');

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'title_link_menu_develop'=>array(
                'type'=>'varchar',
                'constraint'=>'50',
                ),
            'desc_link_menu_develop'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('linksdevelop');

        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'title_link_menu_partner'=>array(
                'type'=>'varchar',
                'constraint'=>'50',
                ),
            'desc_link_menu_partner'=>array(
                'type'=>'varchar',
                'constraint'=>'100',
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('linkspartner');

    
    }

    public function down() {
        $this->dbforge->drop_table('linkscompany');
        $this->dbforge->drop_table('linkssupport');
        $this->dbforge->drop_table('linksdevelop');
        $this->dbforge->drop_table('linkspartner');
    }

}