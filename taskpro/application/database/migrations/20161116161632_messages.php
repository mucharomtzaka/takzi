<?php

class Migration_messages extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'nameuser' => array(
                'type' => 'varchar',
               'constraint' => 50,
            ),
            'emailuser' => array(
                'type' => 'varchar',
               'constraint' => 100,
            ),
            'phoneuser' => array(
                'type' => 'varchar',
               'constraint' => 12,
            ),
            'companyuser' => array(
                'type' => 'varchar',
               'constraint' => 50,
               'null'=>TRUE,
            ),
            'subject' => array(
                'type' => 'varchar',
               'constraint' => 100,
            ),
            'message' => array(
                'type' => 'text',
                 'null'=>FALSE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('messages');
    }

    public function down() {
        $this->dbforge->drop_table('messages');
    }

}