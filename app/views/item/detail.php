<?php
/**
 * Created by PhpStorm.
 * User: crlt_
 * Date: 2018/5/7
 * Time: 下午7:55
 */
?>
ID：<?php echo $item['id'] ?><br />
Name：<?php echo isset($item['name']) ? $item['name'] : '' ?><br />
Age：<?php echo isset($item['age']) ? $item['age'] : '' ?>
<br />
<br />
<a class="big" href="/item/index">返回</a>
