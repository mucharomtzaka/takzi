<?php

class Migration_groups_portfolio extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'id_categories'=>array(
                'type' => 'INT',
                'constraint' => 11,
                ),
            'id_porto'=>array(
                'type' => 'INT',
                'constraint' => 11,
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('groups_portfolio');
    }

    public function down() {
        $this->dbforge->drop_table('groups_portfolio');
    }

}