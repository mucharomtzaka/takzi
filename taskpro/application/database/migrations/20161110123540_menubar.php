<?php

class Migration_menubar extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'menu_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'menu' => array(
                'type' => 'varchar',
                'constraint' => 20,  
            ),
            'menu_link' => array(
                'type' => 'varchar',
                'constraint' => 200,  
            ),
        ));
        $this->dbforge->add_key('menu_id', TRUE);
        $this->dbforge->create_table('menubar');

         $this->dbforge->add_field(array(
            'submenu_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'submenu' => array(
                'type' => 'varchar',
                'constraint' => 20,  
            ),
            'menu_id' => array(
                'type' => 'varchar',
                'constraint' => 20,  
            ),
            'submenu_link' => array(
                'type' => 'varchar',
                'constraint' => 200,  
            ),
        ));
        $this->dbforge->add_key('submenu_id', TRUE);
        $this->dbforge->create_table('submenubar');
    }

    public function down() {
        $this->dbforge->drop_table('menubar',TRUE);
        $this->dbforge->drop_table('submenubar',TRUE);
    }

}