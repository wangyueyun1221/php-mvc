<?php
require_once ROOT_DIR . '/model/demoModel.php';

/**
* demoController
*/
class demoController
{
    public function showAction()
    {
        require_once ROOT_DIR . '/view/demo.html';
    }

    public function getNameAction()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $name = '';
        if ($id > 0) {
            $model = new demoModel();
            $name = $model->getName($id);
        }
        header('Content-type: application/json');
        echo json_encode([
            'status' => 'ok',
            'message' => '',
            'data' => [
                'name' => $name
            ]
        ]);
    }

    public function listAction()
    {
        $model = new demoModel();
        $list = $model->getList();
        require_once ROOT_DIR . '/view/list.html';
    }

    public function editAction()
    {
        $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        if ($id < 1) {
            echo 'ID不可小于1';
            exit();
        }
        $model = new demoModel();
        $user = $model->getUser($id);
        if (!$user) {
            echo '用户不存在';
            exit();
        }
        require_once ROOT_DIR . '/view/edit.html';
    }

    public function doDeleteAction()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        if ($id < 1) {
            responseError('ID不可小于1');
        }
        $model = new demoModel();
        $result = $model->remove($id);
        if ($result) {
            responseSuccess([]);
        }
        responseError('删除失败');
    }

    public function doEditAction()
    {
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
        $name = isset($_POST['name']) ? (string)$_POST['name'] : '';
        $sex = isset($_POST['sex']) ? (string)$_POST['sex'] : 'male';
        $age = isset($_POST['age']) ? (int)$_POST['age'] : 0;
        $description = isset($_POST['description']) ? (string)$_POST['description'] : '';
        if ($id < 1) {
            responseError('ID不可小于1');
        }
        if (!$name) {
            responseError('姓名不可为空');
        }
        if (!in_array($sex, ['male', 'female'])) {
            responseError('性别不存在');
        }
        if ($age < 1) {
            responseError('年龄不可小于1');
        }
        if (!$description) {
            responseError('描述不可为空');
        }
        $model = new demoModel();
        $result = $model->update($id, [
            'name' => $name,
            'sex' => $sex,
            'age' => $age,
            'description' => $description
        ]);
        if ($result) {
            responseSuccess([]);
        }
        responseError('更新失败');
    }
}
