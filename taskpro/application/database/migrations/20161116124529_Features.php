<?php

class Migration_Features extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'title_features'=>array(
                 'type' => 'varchar',
                'constraint' => 100,
            ),
            'desc_features'=>array(
                 'type' => 'varchar',
                'constraint' => 100,
            ),
            'icon_features'=>array(
                 'type' => 'varchar',
                'constraint' => 100,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('features');
    }

    public function down() {
        $this->dbforge->drop_table('features');
    }

}