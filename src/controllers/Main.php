<?php
namespace Home;

use Abraham\TwitterOAuth\TwitterOAuth;
use SSX\EpiTwitter;

class Main
{
    const YEAR = 2014;
    public $usersFeed;
    private $screenName;
    private $connection;

    public function __construct($screen_name)
    {
        $this->screenName = $screen_name;
        $this->usersFeed = [];
        $this->connection = $this->makeConnection();
        $this->usersFeed = $this->getResultFeed();
        return $this->usersFeed;
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
    }


    public function getFriendsIds()
    {
        return $this->connection->get_friendsIds(['screen_name' => $this->screenName])->ids;
    }

    public function getResultFeed()
    {

        $feed = [];
        $users = $this->getFriendsIds();
        $this->connection->useAsynchronous(true);
        foreach ($users as $id) {
            $info = $this->connection->get_usersShow(['user_id' => $id, 'include_entities' => false]);
            $feed[$id]['info'] = [
                'statuses_count' => $info->statuses_count,
                'name' => $info->name,
                'profile_image_url' => str_replace('_normal', '', $info->profile_image_url)
            ];
        }
        return $feed;
    }
}