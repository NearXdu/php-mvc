<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/7
 * Time: 下午5:14
 */
?>
<form action="" method="get">
    <input type="text" value="<?php echo $keyword ?>" name="keyword">
    <input type="submit" value="搜索">
</form>

<p><a href="/item/manage">新建</a></p>

<table>
    <tr>
        <th>ID</th>
        <th>姓名</th>
        <th>年龄</th>
        <th>操作</th>
    </tr>
    <?php foreach ($items as $item): ?>
        <tr>
            <td><?php echo $item['id'] ?></td>
            <td><?php echo $item['name'] ?></td>
            <td><?php echo $item['age'] ?></td>
            <td>
                <a href="/item/detail/<?php echo $item['id'] ?>">详情</a>
                <a href="/item/manage/<?php echo $item['id'] ?>">编辑</a>
                <a href="/item/delete/<?php echo $item['id'] ?>">删除</a>
            </td>
        </tr>
    <?php endforeach ?>
</table>
