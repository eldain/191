<!-- View stored in app/views/greeting.php -->

<html>
    <body>

        
        <?php
        require_once __DIR__ . '/../../vendor/autoload.php';


        // Facebook
        echo "<h1>Facebook</h1>";

        $fb = new Facebook\Facebook([
            'app_id' => '1675423156013517',
            'app_secret' => 'e336cc48fe592916c5968024714d7a89',
            'default_graph_version' => 'v2.8',
            ]);
        $request = $fb->request('GET', '/196346717485902');
        // $access_token = $fb->getAccessToken();
        $request->setAccessToken('EAAXzydoQCc0BAJbmpPN3JM5QKQkkLcOLH1ejZABVpakox1N69nXeHdrETtFUfwXfhdNJ226B4WdVAkZBKlEhyPOtvZCkwMuDjTyJga0mWTEE5d8YwoYYzE42SDqlB1jDJuYpItf3QJoSlbivfDFSVzOfXYKQZAKmuYSnMYag5gZDZD');

        // Send the request to Graph
        try {
          $response = $fb->getClient()->sendRequest($request);
          $graphNode = $response->getGraphNode();
          echo 'User name: ' . $graphNode['name'];
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
          // When Graph returns an error
          echo 'Graph returned an error: ' . $e->getMessage();
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
          // When validation fails or other local issues
          echo 'Facebook SDK returned an error: ' . $e->getMessage();
        }

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