<?php

class GP_CLI {
	
	var $short_options = '';
	var $program_name = '';
	var $usage = '';
	
	function __construct() {
		global $argv;
		if ( gp_array_get( $_SERVER, 'HTTP_HOST' ) ) {
			die('CLI only!');
		}
		
		$this->program_name = array_shift( $argv );
		$this->options = getopt( $this->short_options );
	}
	
	function usage() {
		$this->error( $this->program_name.' '.$this->usage );
	}
	
	function to_stderr( $text, $no_new_line = false ) {
		$text .= ($no_new_line? '' : "\n");
		fwrite( STDERR, $text );
	}
	
	function error( $message, $exit_code = 1 ) {
		$this->to_stderr( $message );
		exit( $exit_code );
	}
}

class GP_Translation_Set_Script extends GP_CLI {
	
	var $short_options = 'p:l:t:';
	
	var $usage = "-p <project-path> -l <locale> [-t <translation-set-slug>]";
	
	function run() {
		if ( !isset( $this->options['l'] ) || !isset( $this->options['p'] ) ) {
			$this->usage();
		}
		$project = GP::$project->by_path( $this->options['p'] );
		if ( !$project ) $this->error( 'Project not found!' );
		
		$locale = GP_Locales::by_slug( $this->options['l'] );
		if ( !$locale ) $this->error( 'Locale not found!' );
		
		$this->options['t'] = gp_array_get( $this->options, 't', 'default' );
		
		$translation_set = GP::$translation_set->by_project_id_slug_and_locale( $project->id, $this->options['t'], $locale->slug );
		if ( !$translation_set ) $this->error( 'Translation set not found!' );

		$this->action_on_translation_set( $translation_set );
	}
	
	function action_on_translation_set( $translation_set ) {
		// define this function in a subclass
	}
}