<?php

use Megumi\WP\Post\Helper;

class WP_Post_Helper_Test extends WP_UnitTestCase {

	public function testSample()
	{
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	/**
	 * @test
	 */
	public function update_test()
	{
		$args = array(
			'post_title' => 'original post',   // post title
		);

		$helper = new Helper( $args );
		$original = $helper->insert();
		$this->assertSame( 'original post', get_post( $original )->post_title );

		$args = array(
			'ID'         => $original,
			'post_title' => 'updated post',   // post title
		);

		$helper = new Helper( $args );
		$updated = $helper->insert();
		$this->assertSame( 'updated post', get_post( $updated )->post_title );
		$this->assertSame( $updated, $original );
	}

	/**
	 * @test
	 */
	public function constructor_test()
	{
		$args = array(
			'post_author'  => 'admin',   // author's name
			'post_title'   => 'title',   // post title
		);

		$helper = new Helper( $args );
		$this->assertSame( 1, $helper->get_post()->post_author );

		$args = array(
			'post_author'  => 'xxxx',   // Illegal author's name
			'post_title'   => 'title',   // post title
		);

		$helper = new Helper( $args );
		$this->assertSame( "", $helper->get_post()->post_author );

		$args = array(
			'post_date'  => '2014-01-01',   // Illegal author's name
			'post_title'   => 'title',   // post title
		);

		$helper = new Helper( $args );
		$this->assertSame( "2014-01-01 00:00:00", $helper->get_post()->post_date );

		$args = array(
			'ID'  => 1,   // Illegal author's name
			'post_title'   => 'title',   // post title
		);

		$helper = new Helper( $args );
		$this->assertSame( 1, $helper->get_post()->ID );
	}

	/**
	 * @test
	 */
	public function basic_test()
	{
		$args = array(
			'post_name'    => 'slug',                // slug
			'post_author'  => '1',                     // author's ID
			'post_date'    => '2012-11-15 20:00:00', // post date and time
			'post_type'    => 'post',               // post type (you can use custom post type)
			'post_status'  => 'publish',             // post status, publish, draft and so on
			'post_title'   => 'title',               // post title
			'post_content' => 'content',             // post content
			'post_category'=> array( 1 ),           // category IDs in an array
			'post_tags'    => array( 'tag1', 'tag2' ), // post tags in an array
		);

		$helper = new Helper( $args );
		$post_id = $helper->insert();

		$post = get_post( $post_id );

		foreach ( $args as $key => $value) {
			if ( 'post_category' === $key || 'post_tags' === $key ) {
				continue;
			}
			$this->assertSame( $value, $post->$key );
		}

		$this->assertSame( 2, count( get_the_tags( $post_id ) ) );
		$this->assertTrue( in_category( 1, $post ) );

		// it should be success to upload and should be attached to the post
		$attachment_id = $helper->add_media(
			'http://placehold.jp/100x100.png',
			'title',
			'description',
			'caption',
			false
		);
		$media = get_attached_media( 'image', $post_id );
		$this->assertSame( $attachment_id, $media[ $attachment_id ]->ID );

		$helper->add_meta( 'test-key', 'test-value' );
		$this->assertSame( 'test-value', get_post_meta( $post_id, 'test-key', true ) );
	}

}
