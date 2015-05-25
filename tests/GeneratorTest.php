<?php

use CoenJacobs\MergeComposerGenerator\Generator;

class GeneratorTest extends PHPUnit_Framework_TestCase {
	/** @test */
	public function it_generates_a_proper_file() {
		$generator = new Generator();
		$generator->addFile( 'test/composer.json' );
		$output = $generator->generate();
		$object = json_decode( $output );

		$this->assertObjectHasAttribute( 'require', $object );
		$this->assertObjectHasAttribute( 'extra', $object );
		$this->assertObjectHasAttribute( 'merge-plugin', $object->extra );
		$this->assertObjectHasAttribute( 'include', $object->extra->{'merge-plugin'} );

		$this->assertContains( 'test/composer.json', $object->extra->{'merge-plugin'}->include );
	}

	/** @test */
	public function it_generates_a_file_with_empty_files_array() {
		$generator = new Generator();
		$output = $generator->generate();
		$object = json_decode( $output );

		$this->assertEmpty( $object->extra->{'merge-plugin'}->include );
	}
}