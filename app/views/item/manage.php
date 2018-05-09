<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/7
 * Time: 下午5:33
 */
?>

<form <?php if (isset($item['id'])) { ?>
    action="/item/update/<?php echo $item['id'] ?>"
<?php } else { ?>
    action="/item/add"
<?php } ?>
        method="post">

    <?php if (isset($item['id'])): ?>
        <input type="hidden" name="id" value="<?php echo $item['id'] ?>">
    <?php endif; ?>
    Name: <input type="text" name="name" value="<?php echo isset($item['name']) ? $item['name'] : '' ?>"><br>
    Age:  <input type="text" name="age" value="<?php echo isset($item['age']) ? $item['age'] : '' ?>">
    <input type="submit" value="提交">
</form>

<a class="big" href="/item/index">返回</a>