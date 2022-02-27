<?php

class Posts extends Controller {
    public function __construct() {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index() {

        // Get Posts
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];


        $this->view('posts/index', $data);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // Validate Image  
            if (empty($_FILES['image']['name'])) {
                flash('post_message', 'Post Added');
                $data['image_err']   = "Field Required";
            } else {

                $imgName  = $_FILES['image']['name'];
                $imgTemp  = $_FILES['image']['tmp_name'];
                $imgType  = $_FILES['image']['type'];   //size 

                $nameArray =  explode('.', $imgName);
                $imgExtension =  strtolower(end($nameArray));
                $imgFinalName = time() . rand() . '.' . $imgExtension;
                $allowedExt = ['png', 'jpg'];

                if (!in_array($imgExtension, $allowedExt)) {
                    $data['image_err']   = "Not Allowed Extension";
                }
            }
            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'image' => $imgFinalName,
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
                'image_err' => ''
            ];
            // Validate title
            if (empty($data['title'])) {

                $data['title_err'] = 'Plase enter title';
            }
            if (empty($data['body'])) {

                $data['body_err'] = 'Plase enter body text';
            }


            // Makse sure there is no errors
            if (empty($data['title_err']) && empty($data['body_err']) && empty($data['image_err'])) {
                $disPath = './uploads/' . $imgFinalName;
                echo move_uploaded_file($imgTemp, $disPath);
                if (move_uploaded_file($imgTemp, $disPath)) {
                    die('something went wrong');
                }

                // Validated
                if ($this->postModel->addPost($data)) {
                    flash('post_message', 'Post Added');
                    redirect('posts');
                } else {
                    die('something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('posts/add', $data);
            }
        } else {
            $data = [
                'title' => '',
                'body' => '',
            ];


            $this->view('posts/add', $data);
        }
    }


    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];
            // Validate title
            if (empty($data['title'])) {

                $data['title_err'] = 'Plase enter title';
            }
            if (empty($data['body'])) {

                $data['body_err'] = 'Plase enter body text';
            }

            // Makse sure there is no errors
            if (empty($data['title_err']) && empty($data['body_err'])) {
                // Validated
                if ($this->postModel->updatePost($data)) {
                    flash('post_message', 'Post Updated');
                    redirect('posts');
                } else {
                    die('something went wrong');
                }
            } else {
                // Load view with errors
                $this->view('posts/edit', $data);
            }
        } else {
            // Get exisitng post from model
            $post = $this->postModel->getPostById($id);

            // Check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }
            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];

            $this->view('posts/edit', $data);
        }
    }


    public function show($id) {
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);

        $data = [
            'post' => $post,
            'user' => $user
        ];


        $this->view('posts/show', $data);
    }

    public function delete($id) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get exisitng post from model
            $post = $this->postModel->getPostById($id);

            // Check for owner
            if ($post->user_id != $_SESSION['user_id']) {
                redirect('posts');
            }
            if ($this->postModel->deletePost($id)) {
                flash('post_message', 'Post Removed');
                redirect('posts');
            } else {
                die('Something went wrong');
            }
        } else {
            redirect('posts');
        }
    }
}
