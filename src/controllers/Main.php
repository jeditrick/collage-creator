<?php
namespace Home;

use Abraham\TwitterOAuth\TwitterOAuth;
use SSX\EpiTwitter;

class Main
{
    const YEAR = 2014;
    private $usersFeed;
    private $screenName;
    private $connection;

    public function __construct($screen_name)
    {

        $this->screenName = $screen_name;
        $this->usersFeed = [];
        $this->connection = $this->makeConnection();
        $this->usersFeed = $this->getResultFeed();
        var_dump($this->usersFeed);

    }

    public function makeConnection()
    {
        $twitterObj = new EpiTwitter(
            'evr67AA0V4HeSUUV2Dv7mEvYM',
            'D6vpri9UaV5463Yn1a79hZQTWs5tKEUK5gJ9QPsgAGLZq6QeWl',
            '3625264097-yeZIh5jfBjzayNAne98AsVyozIiSDniJw810m4b',
            'D5vKZHjtKJjJJaVg5UCCJVqUwdgGmF3gsl4dtWaKIoAnQ'

        );

        return $twitterObj;
        /*return new TwitterOAuth(
            'evr67AA0V4HeSUUV2Dv7mEvYM',
            'D6vpri9UaV5463Yn1a79hZQTWs5tKEUK5gJ9QPsgAGLZq6QeWl',
            '3625264097-yeZIh5jfBjzayNAne98AsVyozIiSDniJw810m4b',
            'D5vKZHjtKJjJJaVg5UCCJVqUwdgGmF3gsl4dtWaKIoAnQ'
        );*/
    }


    public function getFriendsIds()
    {
        return $this->connection->get_friendsIds(['screen_name' => $this->screenName])->ids;
    }

    public function getResultFeed()
    {
        $feed = [];
        foreach ($this->getFriendsIds() as $id) {
            $feed[$id] = $this->getUserFeed($id);
            $feed[$id]['info'] = $this->getUserInfo($id);
        }
        return $feed;
    }

    public function getUserInfo($id)
    {
        $info = $this->connection->get_usersShow(['user_id' => $id, 'include_entities' => false]);
        return ['name' => $info->name, 'profile_image_url' => $info->profile_image_url];
    }

    public function getUserFeed($id)
    {
        $page = 1;
        $feed['count'] = 0;

        while ($page < 6) {
            $twits = $this->connection->get_statusesUser_timeline(
                ['user_id' => $id, 'count' => 200, 'page' => $page++]
            );
            if (count($twits) < 1) {
                break;
            } else {
                $feed['count'] += count($twits);
            }
        }
        return $feed;
    }
}