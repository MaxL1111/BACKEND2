<?php


namespace App\Controllers;

use App\View;

class Admin
    extends Base
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    //контроллер показа всех новостей в панели администратора
    public function actionIndex()
    {
        $page = (int)$_GET['page'];
        $count_p = \App\Models\News::count($page);
        $page = $count_p[0];
        $count_post = $count_p[1];
        $news = $this->view->news = \App\Models\News::findAll($page);
        $this->view->display('admin.php', $page, $news, $count_post );
    }

    //контроллер открытия редактора для добвления одной новости в панели администратора
    public function actionInsert()
    {
        $this->view->display('insert.php', '', '', '');
    }

    //контроллер добавления новости в панели администратора
    public function actionInsertOne()
    {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $text = $_POST['text'];

        $obj = new \App\Models\News();
        $data = $obj->validate($title, $date, $text);

        if (!empty($data['title'] && $data['date'] && $data['text'])) {
            $article = new \App\Models\News;
            $article->title = $data['title'];
            $article->date = $data['date'];
            $article->text = $data['text'];
            $article->insert();
            echo 'Новость добавлена!';
        } else {
            echo 'Внимание!Новость не добавлена, не все поля заполнены, либо формат даты некорректен!';
        }
    }

    //контроллер показа существующей новости для редактирования в панели администратора
    public function actionEdit()
    {
        $id = (int)$_GET['id'];
        $news = $this->view->news = \App\Models\News::findOneById($id);
        $this->view->display('edit.php', '', $news , '');
    }

    //контроллер обновления в базе данных отредактированной новости в панели администратора
    public function actionEditOne()
    {
        $title = $_POST['title'];
        $date = $_POST['date'];
        $text = $_POST['text'];

        $obj = new \App\Models\News();
        $data = $obj->validate($title, $date, $text);

        if (!empty($_POST['id'] && $data['title'] && $data['date'] && $data['text'])) {
            $article = new \App\Models\News;
            $article->id = $_POST['id'];
            $article->title = $data['title'];
            $article->date = $data['date'];
            $article->text = $data['text'];
            $article->update();
            echo 'Новость отредактирована!';
        } else {
            echo 'Внимание!Новость не отредактирована: не все поля заполнены, либо формат даты некорректен!';
        }
    }

    //контроллер удаления новости в панели администратора
    public function actionDelete()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $article = new \App\Models\News;
            $article->delete($id);
            $comment = new \App\Models\Comment;
            $comment->delete($id);
            header('Location: admin.php?ctrl=Admin&act=Index');
            die;
        }
    }

}