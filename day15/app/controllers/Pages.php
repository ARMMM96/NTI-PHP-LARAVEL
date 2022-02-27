<?php

class Pages  extends Controller {
    public function __construct() {
    }
    public function index() {
        if(isLoggedIn()){
            redirect('posts');
        }
        $data = [
            'title' => 'SharePosts',
            'description' => 'Simple social network built on the PHP mvc'
        ];
        $this->view('pages/index', $data);
    }
    public function about() {
        $data = [
            'title' => 'Welcome About',
            'description'=>'App to shair posts with other users',
        ];

        $this->view('pages/about', $data);
    }
}
