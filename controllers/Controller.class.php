<?php 

class Controller {

    public function loadModel($modelName) {
        include_once "models/Model.class.php";
        include_once "models/$modelName.class.php";

        return new $modelName;
    }

    public function loadView($viewName, $data = []) {
        foreach ($data as $var => $value) {
            $$var = $value;
        }

        include_once "views/$viewName.php";
    }

    public function create() {
        $this->loadView('insert_post');
    }
  
    public function create_process() {
        $postModel = $this->loadModel('PostModel');
        $title = $_POST['title'];
        $content = $_POST['content'];
  
        $postModel->insert($title, $content);
        header('Location: ?c=Post');
    }

    public function edit() {
        $id = $_GET['id'];
    
        if (!$id) header('Location: index.php?c=Post');
        
        $postModel = $this->loadModel('PostModel');
        $post = $postModel->getById($id);
        
        if (!$post->num_rows) header('Location: index.php?c=Post');
        
        $this->loadView('edit', ['post' => $post->fetch_object()]);
    }    

    public function edit_process() {
        $postModel = $this->loadModel('PostModel');
        $id = $_POST['id'];
        $title = addslashes($_POST['title']);
        $content = addslashes($_POST['content']);
  
        $postModel->update($id, $title, $content);
  
        header('Location: ?c=Post');
    }
    
    public function delete() {
        $id = $_POST['id'];
        $postModel = $this->loadModel('PostModel');
  
        $postModel->delete($id);
        header('Location: ?c=Post');
     }  
}