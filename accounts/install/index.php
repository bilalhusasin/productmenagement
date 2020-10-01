<?php
//error_reporting( E_ALL ); //Setting this to E_ALL showed that that cause of not redirecting were few blank lines added in some php files.

$config_path = '../apps/config/config.php';
$db_config_path = '../apps/config/database.php';

// Only load the classes in case the user submitted the form
if ($_POST)
{

    // Load the classes and create the new objects
    require_once('includes/core_class.php');
    require_once('includes/database_class.php');

    $core = new Core();
    $database = new Database();

    // Validate the post data
    if ($core->validate_post( $_POST ) == true)
    {

        // First create tables, then write config file
        if ($database->create_tables( $_POST ) == false)
        {
            $message = $core->show_message( 'error', "The database tables could not be created, please verify your settings." );
        }
        else if ($core->write_config( $_POST ) == false)
        {
            $message = $core->show_message( 'error', "The database configuration file could not be written, please chmod apps/config/database.php file to 777" );
        }

        sleep(20);

		//create admin user
        $database->create_admin($_POST, $_POST['app_user'], $_POST['app_pass']);

        // If no errors, redirect to registration page
        if ( ! isset($message))
        {
            $redir = ((isset( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] == "on") ? "https" : "http");
            $redir .= "://" . $_SERVER['HTTP_HOST'];
            $redir .= str_replace( basename( $_SERVER['SCRIPT_NAME'] ), "", $_SERVER['SCRIPT_NAME'] );
            $redir = str_replace( 'install/', '', $redir );
            header( 'Location: ' . $redir . '' );
        }
    }
    else
    {
        $message = $core->show_message( 'error', 'Not all fields have been filled in correctly. The host, username, password, and database name are required.' );
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Install | POS with Accounts</title>
    <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
    <link href="css/bootstrap.min.css" rel="stylesheet" />
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet" />
    <link href="css/font-awesome.css" rel="stylesheet" />
    <link href="css/style.css" rel="stylesheet" />
    <link href="css/style-responsive.css" rel="stylesheet" />
    <link href="css/style-default.css" rel="stylesheet" id="style_color" />
</head>
<!-- BEGIN BODY -->
<body class="lock">
    <div class="lock-header">
        <!-- BEGIN LOGO -->
        <a class="center" id="logo" href="">
            <img class="center" alt="logo" src="images/logo.png" width="250">
        </a>
        <!-- END LOGO -->
        <h2>Install POS with Accounts</h2>
    </div>
    <!-- BEGIN PAGE -->
    <div id="main-content">
        <!-- BEGIN PAGE CONTAINER-->
        <div class="container-fluid">
            <!-- BEGIN PAGE CONTENT-->
            <div class="row-fluid">
                <?php if( is_writable($db_config_path) && is_writable($config_path) ) { ?>
                <?php
                if (isset($message))
                {
                    echo '<p class="error">' . $message . '</p>';
                }
                ?>
                <form id="install_form" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="span12">
                        <!-- BEGIN SAMPLE FORMPORTLET-->
                        <div class="widget green">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Database settings </h4>
                            </div>
                            <div class="widget-body">
                                <!-- BEGIN FORM-->
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label">Hostname</label>
                                        <div class="controls">
                                            <input type="text" name="hostname" class="span6" value="localhost" placeholder="Hostname" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Username</label>
                                        <div class="controls">
                                            <input type="text" name="username" class="span6" placeholder="Database Username" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Password</label>
                                        <div class="controls">
                                            <input type="password" name="password" class="span6" placeholder="Database Password" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Database Name</label>
                                        <div class="controls">
                                            <input type="text" name="database" class="span6" placeholder="Database Name" />
                                        </div>
                                    </div>
                                </div>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <div class="widget green">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> URL settings </h4>
                            </div>
                            <div class="widget-body">
                                <!-- BEGIN FORM-->
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label">Base URL</label>
                                        <div class="controls">
                                            <input type="text" name="base_url" class="span6" value="<?php if( isset($_POST['base_url']) ){echo $_POST['base_url'];}else{echo "http://".$_SERVER['HTTP_HOST']."/";}?>" placeholder="Base URL" />
                                            <span class="help-inline"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <div class="widget green">
                            <div class="widget-title">
                                <h4><i class="icon-reorder"></i> Application settings </h4>
                            </div>
                            <div class="widget-body">
                                <!-- BEGIN FORM-->
                                <div class="form-horizontal">
                                    <div class="control-group">
                                        <label class="control-label">Username</label>
                                        <div class="controls">
                                            <input type="text" name="app_user" class="span6" placeholder="Email Address as username" />
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <label class="control-label">Password</label>
                                        <div class="controls">
                                            <input type="password" name="app_pass" class="span6" placeholder="Password" />
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <button type="submit" class="btn btn-success">Install</button>
                                    </div>
                                </div>
                                <!-- END FORM-->
                            </div>
                        </div>
                        <!-- END SAMPLE FORM PORTLET-->
                    </div>
                </form>
                <?php } else { ?>
                <p class="error">
                    Please make the apps/config/config.php and apps/config/database.php file writable.<br>
                    <strong>Example</strong>:
                    <br /><code>chmod 777 apps/config/config.php</code>
                    <br /><code>chmod 777 apps/config/database.php</code>
                </p>
                <?php } ?>
            </div>
        </div>
        <!-- END PAGE CONTAINER-->
    </div>
    <!-- END PAGE -->
</body>
<!-- END BODY -->

</html>
