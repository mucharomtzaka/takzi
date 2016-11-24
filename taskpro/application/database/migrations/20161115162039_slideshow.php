<?php

class Migration_slideshow extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'image_front' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'null' => TRUE
            ),
            'image_back' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'null' => TRUE
            ),
            'description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE
            ),
            'active' => array(
                'type' => 'tinyint',
                'constraint' => 11,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('slideshow');
    }

    public function down() {
        $this->dbforge->drop_table('slideshow');
    }

}