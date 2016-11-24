<?php

class Migration_portofolio extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'title_porto'=>array(
                'type'=>'varchar',
                'constraint'=>100,
            ),
            'desc_porto'=>array(
                'type'=>'text',
                'null'=>TRUE
            ),
            'image_porto'=>array(
                'type'=>'varchar',
                'constraint'=>100,
                )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('portofolio');
    }

    public function down() {
        $this->dbforge->drop_table('portofolio');
    }

}