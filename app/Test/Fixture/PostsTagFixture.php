<?php
/**
 * PostsTagFixture
 *
 */
class PostsTagFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'post_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'tag_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'index'),
		'indexes' => array(
			'fk_posts_has_tags_tags1' => array('column' => 'tag_id', 'unique' => 0),
			'fk_posts_has_tags_posts1' => array('column' => 'post_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'post_id' => 1,
			'tag_id' => 1
		),
	);

}
