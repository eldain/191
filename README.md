# 191 Gigasavvy
191 Project code

## Contributors
Luke Raus
Daniel McInnis
Jasmine Nguyen
Sania Bishnoi
Xen Eldridge

## Installation
1. Set up Laravel with Homestead (tutorial here: https://youtu.be/NcIPANwBghU)
2. Instead of cloning Laravel in the tutorial, clone this repo instead.
3. Run: `vagrant ssh` to enter virtual machine.
4. cd to the Laravel directory (the one with app,boostrap,config... folders).
5. Inside your vagrant machine run: `composer install` and then `composer update` to get php depenancies.
6. Create .env file based on example.env and match it to your local computer (should have done in tutorial but check here too).
7. Inside your vagrant machine run: `php artisan key:generate` to create your app Key.
8. Inside your vagrant machine run: `php artisan migrate:refresh --seed` to get your DB up and current.

## Design
Most of the heavy lifting and social media API calls can be found in the /app directory

The following files are php classes that take simple parameters, make the API call via curl,
parses the data, and then retuns the reuslt as JSON strings:
`/app/MyFacebookApi.php`
`/app/MyInstagramApi.php`
`/app/MyTwitterApi.php`

The following files are controlers that construct and call the My[social]Api.php classes.
The doct string in each methods shows how the calls need to be constucted:   
`/app/Http/Controllers/FacebookController.php`
`/app/Http/Controllers/InstagramController.php`
`/app/Http/Controllers/TwitterController.php`

The following JS files handle the API calls to the controllers, and updates the HTML page via asynchronous fetch calls:
`/public/js/dashboard-script.js`
`/public/js/fb-script.js`
`/public/js/instagram-script.js`
`/public/js/twitter-script.js`

## API Keys

Current the API keys used for each socail media account are owned by Luke and can be changed easily.
Instagram's access token is located in `/app/MyInstagramApi.php` as a private static variable ($access_token).
Twittter's settings is located in `/app/MyTwitterApi.php` as a private static array ($settings). 
	NOTE: the $twitterCountApi is a third party api key for an app called TwitterCount but was never used

Facebook's appid and appsecret are tied to each user and can be changed in `/database/seeds/UserTableSeeder.php`
or in the advanced setting section of the web app.
This was made tied to the user so that it could be changed from within the app website.
We did not have time to tie Instagrm's and Twitter's settings to the each user.

## Known Issues

It was found late in development that Safari 10 does not support the JS call fetch.  
But it will be supported in Safari 10.1.  
A work around could be found here:
http://stackoverflow.com/questions/35830202/fetch-not-defined-in-safari-referenceerror-cant-find-variable-fetch

But do to time constraints we were not able to implment this fix.

## Contact

If you have any questions feel free to contact us with the following email:
lraus@uci.edu