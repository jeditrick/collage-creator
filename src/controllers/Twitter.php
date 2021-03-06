<?php
namespace Home;

use SSX\EpiTwitter;

class Twitter
{
    private $usersFeed;
    private $screenName;
    private $connection;
    private $tweetsCount;

    public function __construct($screen_name)
    {
        $this->screenName = $screen_name;
        $this->usersFeed = [];
        $this->tweetsCount = 0;
        $this->connection = $this->makeConnection();
        $this->usersFeed = $this->createResultFeed();
        $this->setSize();

        return $this->usersFeed;
    }


    public function getUsersFeed()
    {
        return $this->usersFeed;
    }


    public function makeConnection()
    {
        $twitterObj = new EpiTwitter(
            CONSUMER_KEY,
            CONSUMER_SECRET,
            OAUTH_TOKEN,
            OAUTH_TOKEN_SECRET
        );

        return $twitterObj;
    }


    public function getFriendsIds()
    {
        $this->connection->setDebug(true);
        $cursor = -1;
        $ids = [];
        do {
            $content = $this->connection->get(
                '/friends/ids.json',
                ['screen_name' => $this->screenName, 'cursor' => $cursor]
            );
            $ids[] = $content->ids;
            $cursor = $content->response['next_cursor'];
        } while ($cursor != 0);

        return $ids[0];
    }

    public function createResultFeed()
    {
        $feed = [];
        $ids = $this->getFriendsIds();
        $this->connection->useAsynchronous(true);
        foreach (array_chunk($ids, 100) as $k => $id_arr) {
            $content = $this->connection->get('/users/lookup.json', [
                'user_id' => implode(',', $id_arr),
                'include_entities' => false
            ]);
            foreach ($content->response as $info) {
                $feed[$info['id']]['info'] = [
                    'statuses_count' => $info['statuses_count'] + 1,
                    'name' => $info['name'],
                    'profile_image_url' => str_replace('_normal', '', $info['profile_image_url'])
                ];
                $this->tweetsCount += $info['statuses_count'];
            }
            if (count($feed) > 2999) {
                break;
            }
        }

        return $feed;
    }

    public function setSize()
    {
        foreach ($this->usersFeed as $k => $el) {
            $this->usersFeed[$k]['info']['size'] = ($el['info']['statuses_count'] * 100) / $this->tweetsCount;
        }
    }
}
