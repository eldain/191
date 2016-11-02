<!-- View stored in app/views/greeting.php -->

<html>
    <body>

        <h1>Hello, 
        <?php
        echo $name;
        require_once __DIR__ . '/../../vendor/autoload.php';
        use Facebook\FacebookSession;
        
        $fb = new Facebook\Facebook([
        	'app_id' => '{app-id}',
        	'app_secret' => '{app-secret}',
        	'default_graph_version' => 'v2.5',
        	]);
        ?>
        	
        </h1>
    </body>
</html>