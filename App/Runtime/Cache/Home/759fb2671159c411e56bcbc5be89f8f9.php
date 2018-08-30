<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo ($staticPath); ?>/layui/css/layui.css">
    <title>错误登录日志</title>
</head>
<body>
<div class="layui-card layui-anim layui-anim-up">
    <div class="layui-card-header"><span style="font-weight:700; font-size:1rem; color:#FF5722;"><span class="layui-icon layui-icon-username">错误登录日志</span></span></div>
</div>
<table class="layui-table layui-anim layui-anim-up" style="table-layout: fixed;" lay-size="sm">
    <thead>
    <tr>
        <th>ID</th>
        <th>尝试用户名</th>
        <th>尝试密码</th>
        <th>地址</th>
        <th>操作时间</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($log)): foreach($log as $k=>$vo): ?><tr class="rowData" index="<?php echo ($vo['id']); ?>">
            <td style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><?php echo ($vo['id']); ?></td>
            <td style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><?php echo ($vo['username']); ?></td>
            <td style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><?php echo ($vo['password']); ?></td>
            <td style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><?php echo ($vo['area']); ?></td>
            <td style="white-space: nowrap;text-overflow: ellipsis;overflow: hidden;"><?php echo ($vo['currtime']); ?></td>
        </tr><?php endforeach; endif; ?>
    </tbody>
</table>
</body>
<script src="<?php echo ($staticPath); ?>/layui/layui.js"></script>
</html>