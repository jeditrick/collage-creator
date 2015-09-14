<?php

namespace Home;


class CanvasBuilder
{
    private $canvasSize;
    private $twitterInfo;
    private $virtual_canvas;

    public function __construct($canvas_size, $twitter_info)
    {
        $this->canvasSize = $canvas_size;
        $this->twitterInfo = $twitter_info;
        $k = 0;
    }

}