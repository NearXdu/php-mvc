<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/7
 * Time: 下午3:38
 */

namespace app\controllers;

use app\models\ItemModel;
use crlt\fastphp\base\Controller;
use function print_r;
use function var_dump;


class ItemController extends Controller
{
    public function actionIndex()
    {

        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';

        if ($keyword) {
            $items = (new ItemModel())->search($keyword);
        } else {

            $items = (new ItemModel)->where()->order(['id DESC'])->fetchAll();
        }

        $this->assign('title', '首页');
        $this->assign('items', $items);
        $this->assign('keyword', $keyword);
        $this->render();
    }

    public function actionManage($id = 0)
    {
        $item = array();
        if ($id) {

            $item = (new ItemModel())->where(["id = :id"], [':id' => $id])->fetch();
        }

        $this->assign('title', '管理');
        $this->assign('item', $item);
        $this->render();
    }

    public function actionDetail($id)
    {

        $item = (new ItemModel())->where(["id = :id"], [':id'=>$id])->fetch();

        $this->assign('title', '详情页面');
        $this->assign('item', $item);
        $this->render();
    }

    public function actionUpdate()
    {
        $data = array('id' => $_POST['id'], 'name' => $_POST['name'],'age'=>$_POST['age']);


        $count = (new ItemModel)->where(['id = :id'], [':id' => $data['id']])->update($data);

        $this->assign('title', '修改成功');
        $this->assign('count', $count);
        $this->render();
    }
    public function actionAdd()
    {
        $data['name'] = $_POST['name'];
        $data['age']=$_POST['age'];
        $count = (new ItemModel)->add($data);

        $this->assign('title', '添加成功');
        $this->assign('count', $count);
        $this->render();
    }

    public function actionDelete($id)
    {
        $count = (new ItemModel)->delete($id);

        $this->assign('title', '删除成功');
        $this->assign('count', $count);
        $this->render();
    }


}