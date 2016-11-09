<!-- View stored in app/views/greeting.php -->

<html>
    <body>

        
        <?php
        require_once __DIR__ . '/../../vendor/autoload.php';

        // Facebook
        echo "<h1>Facebook</h1>";

        $fbApp = new Facebook\FacebookApp('1675423156013517', 'e336cc48fe592916c5968024714d7a89');
        
        $fb = new Facebook\Facebook([
        	'app_id' => '1675423156013517',
        	'app_secret' => 'e336cc48fe592916c5968024714d7a89',
        	'default_graph_version' => 'v2.5',
        	]);
        /* make the API call */

        $request = new Facebook\FacebookRequest(
          $fbApp,
          'GET',
          '/53663958923'
        );
        //$response = $request->execute();
        //$graphObject = $response->getGraphObject();

        // Twitter
        echo "<h1>Twitter</h1>";
        echo "<h3>List of @Gigasavvy followers</h3>";
        $settings = array(
            'oauth_access_token' => "4775133980-wGivgWH5O91qrdoo9oBVJio4uwUgfQ9baSk2U6s",
            'oauth_access_token_secret' => "Gq3MBg5I7erXfQbYOTGD8G7VugaeVMTwecpuO1X3tvcdk",
            'consumer_key' => "HqSjdxilaF7ogzd6ldpbS6DoA",
            'consumer_secret' => "xRsiyK1v7aylulNDVPqUxrBFBWq3tDqjkIfGfcPbkXnSUmQVj0"
            );
        $url = 'https://api.twitter.com/1.1/followers/list.json';
        $getfield = '?screen_name=Gigasavvy';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($settings);
        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();


        echo $response;
        ?>

    
    </body>
</html>