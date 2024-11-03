<?php class Post extends Controller {

    public function index() {
        $postModel = $this->loadModel('PostModel');

        $posts = $postModel->getAll();

        $this->loadView('posts', ['posts' => $posts]);
    }
}