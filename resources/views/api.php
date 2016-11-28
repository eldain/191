<!-- View stored in app/views/greeting.php -->

<html>
    <body>

        
        <?php
        require_once __DIR__ . '/../../vendor/autoload.php';


        // Facebook
        echo "<h1>Facebook</h1>";
        echo "Page Example<br>";

        if(!session_id()) {
            session_start();
        }

        $fb = new Facebook\Facebook([
            'app_id' => '1675423156013517',
            'app_secret' => 'e336cc48fe592916c5968024714d7a89',
            'default_graph_version' => 'v2.8',
            ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email', 'manage_pages']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://homestead.app/facebook', $permissions);

        echo "<br><br>User Example";
        echo '<br><a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';


         // Instagram
        echo "<h1>Instagram</h1>";
        use MetzWeb\Instagram\Instagram;

        $instagram = new Instagram(array(
            'apiKey'      => 'feac92c4402246d1b3aa77001c72e574',
            'apiSecret'   => 'd87070d9f2aa432e845434c908d367dd',
            'apiCallback' => 'https://rtdiprod.herokuapp.com/api'
        ));

        echo "<a href='{$instagram->getLoginUrl()}'>Login with Instagram</a>";

        // // grab OAuth callback code
        // if (isset($_GET['code'])){
        //     $code = $_GET['code'];
        //     $data = $instagram->getOAuthToken($code);

        //     echo 'Your username is: ' . $data->user->username;

        //     // set user access token
        //     $instagram->setAccessToken($data);

        //     // get all user likes
        //     $likes = $instagram->getUserLikes();

        //     // take a look at the API response
        //     echo '<pre>';
        //     print_r($likes);
        //     echo '<pre>';
        // }

        // Twitter
        // TODO CREATE A TWITTER CLASS
        echo "<h1>Twitter</h1>";
        echo "<h3>Latest @Gigasavvy Timeline</h3>";
        $settings = array(
            'oauth_access_token' => "4775133980-wGivgWH5O91qrdoo9oBVJio4uwUgfQ9baSk2U6s",
            'oauth_access_token_secret' => "Gq3MBg5I7erXfQbYOTGD8G7VugaeVMTwecpuO1X3tvcdk",
            'consumer_key' => "HqSjdxilaF7ogzd6ldpbS6DoA",
            'consumer_secret' => "xRsiyK1v7aylulNDVPqUxrBFBWq3tDqjkIfGfcPbkXnSUmQVj0"
            );
        $url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';
        $getfield = '?screen_name=Gigasavvy&count=1';
        $requestMethod = 'GET';

        $twitter = new TwitterAPIExchange($settings);
        $response = $twitter->setGetfield($getfield)
            ->buildOauth($url, $requestMethod)
            ->performRequest();


        // $json_a=json_decode($response,true);
        // $tweet = $json_a[0]['text'];
        echo $response;
        ?>

    
    </body>
</html>