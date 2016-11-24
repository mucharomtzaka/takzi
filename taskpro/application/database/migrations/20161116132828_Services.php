<?php

class Migration_Services extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
             'title_services'=>array(
                 'type' => 'varchar',
                'constraint' => 100,
            ),
            'desc_services'=>array(
                 'type' => 'tinytext',
                'null' =>false
            ),
            'icon_services'=>array(
                 'type' => 'varchar',
                'constraint' => 100,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('services');
    }

    public function down() {
        $this->dbforge->drop_table('services');
    }

}