<?php namespace CoenJacobs\MergeComposerGenerator;

class Generator {
	private $files = [];

	public function addFile( $path ) {
		array_push( $this->files, $path );
	}

	public function generate() {
		$array = array_merge( $this->getRequiresArray(), [
			'extra' => [
				'merge-plugin' => [
					'include' => $this->files,
				],
			],
		]);

		return json_encode( $array );
	}

	public function getRequiresArray() {
		return [
			'require' => [
				'wikimedia/composer-merge-plugin' => 'dev-master',
			],
		];
	}
}