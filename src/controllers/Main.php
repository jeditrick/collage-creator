<?php
namespace Home;

use Abraham\TwitterOAuth\TwitterOAuth;

class Main
{
    private $users;
    private $screenName;

    public function __construct($screen_name)
    {
        $this->screenName = $screen_name;
        $this->users = [];
        $this->Foo();
    }

    public function Foo()
    {
        $page = 1;
        $connection = new TwitterOAuth(
            'evr67AA0V4HeSUUV2Dv7mEvYM',
            'D6vpri9UaV5463Yn1a79hZQTWs5tKEUK5gJ9QPsgAGLZq6QeWl',
            '3625264097-yeZIh5jfBjzayNAne98AsVyozIiSDniJw810m4b',
            'D5vKZHjtKJjJJaVg5UCCJVqUwdgGmF3gsl4dtWaKIoAnQ'
        );

        do {
            $content = $connection->get("statuses/user_timeline",
                ['screen_name' => $this->screenName, 'count' => 200, 'page' => $page++, 'exclude_replies' => true]);
            foreach ($content as $twit) {
                if ($twit->retweeted_status != null) {
                    $nested_user = $twit->retweeted_status->user;
                } else {
                    $nested_user = $twit->user;
                }

                if ($this->users[$nested_user->id] == null) {
                    $this->users[$nested_user->id] = [
                        'screen_name' => $nested_user->screen_name,
                        'name' => $nested_user->name,
                        'avatar' => $nested_user->profile_image_url,
                        'count' => 0
                    ];
                }
                $this->users[$nested_user->id]['count'] += 1;

            }
            if (count($content) < 1) {
                var_dump($page);
            }

        } while (100 > $page);
        var_dump($this->users);
    }
}