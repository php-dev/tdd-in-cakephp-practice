<?php
App::uses('PostsTag', 'Model');

/**
 * PostsTag Test Case
 *
 */
class PostsTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.posts_tag',
		'app.post',
		'app.category',
		'app.user',
		'app.comment',
		'app.tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PostsTag = ClassRegistry::init('PostsTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PostsTag);

		parent::tearDown();
	}

}
