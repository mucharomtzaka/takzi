<?php

class Migration_Postartikel extends CI_Migration {

    public function up() {
        $this->dbforge->add_field(array(
            'article_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'article_title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
            ),
             'article_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE
            ),
             'Date'=>array('type'=>'DATE'),
             'Image' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
                                'null' => TRUE
            ),
        ));
        $this->dbforge->add_key('article_id', TRUE);
        $this->dbforge->create_table('postartikel');

         $this->dbforge->add_field(array(
            'categories_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'kategories_title' => array(
                                'type' => 'VARCHAR',
                                'constraint' => '100',
            ),
             'kategories_description' => array(
                                'type' => 'TEXT',
                                'null' => TRUE
            ),
        ));
        $this->dbforge->add_key('categories_id', TRUE);
        $this->dbforge->create_table('categoriespost');


        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => TRUE
            ),
            'categories_id' => array(
                               'type' => 'MEDIUMINT',
                                'constraint' => '8',
                                'unsigned' => TRUE
            ),
             'article_id' => array(
                                'type' => 'MEDIUMINT',
                                'constraint' => '8',
                                'unsigned' => TRUE
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('groups_post');
    }

    public function down() {
        $this->dbforge->drop_table('postartikel');
        $this->dbforge->drop_table('categoriespost');
        $this->dbforge->drop_table('groups_post');
    }

}