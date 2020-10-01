<?php

class Core {

	// Function to validate the post data
	function validate_post($data)
	{
		/* Validating the hostname, the database name and the username. The password is optional. */
		return !empty($data['hostname']) && !empty($data['username']) && !empty($data['database']);
	}

	// Function to show an error
	function show_message($type,$message)
	{
		return $message;
	}

	// Function to write the config file
	function write_config($data)
	{
		$return = false;

		// Database file path
		$database_template 	= 'config/database.php';
		$database_output 	= '../apps/config/database.php';

		// Write database file
		$database_file = file_get_contents($database_template);

		$database_new  = str_replace("%HOSTNAME%", $data['hostname'], $database_file);
		$database_new  = str_replace("%USERNAME%", $data['username'], $database_new);
		$database_new  = str_replace("%PASSWORD%", $data['password'], $database_new);
		$database_new  = str_replace("%DATABASE%", $data['database'], $database_new);

		// Open the file
		$database_handle = fopen($database_output,'w+');

		// Chmod the file, in case the user forgot
		@chmod($database_output, 0777);

		// Verify file permissions
		if (is_writable($database_output))
		{
			// Write the file
			if (fwrite($database_handle, $database_new))
			{
				$return = true;
			}
			else
			{
				$return = false;
			}

		}
		else
		{
			$return = false;
		}

		// Config file path
		$config_template 	= 'config/config.php';
		$config_output 		= '../apps/config/config.php';

		// Open the file
		$config_file = file_get_contents($config_template);

		$config_new  = str_replace("%BASE_URL%", $data['base_url'], $config_file);

		// Write the new config.php file
		$config_handle = fopen($config_output, 'w+');

		// Chmod the file, in case the user forgot
		@chmod($config_output, 0777);

		// Verify file permissions
		if (is_writable($config_output))
		{
			// Write the file
			if (fwrite($config_handle, $config_new))
			{
				$return = true;
			}
			else
			{
				$return = false;
			}

		}
		else
		{
			$return = false;
		}

		return $return;
	}
}