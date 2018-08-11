<?php
$home = Yii::$app->menu->home;
$items = Yii::$app->menu->current->teardown;
?>
<ul class="uk-breadcrumb">
    <li><a href="<?= $home->link ?>"><?= $home->title ?></a></li>
    <?php foreach ($items as $i => $item) : ?>
        <?php if ($i < count($items) - 1) : ?>
            <?php if (!empty($item->link)) : ?>
                <li><a href="<?= $item->link ?>"><?= $item->title ?></a></li>
            <?php else : ?>
                <li><span><?= $item->title ?></span></li>
            <?php endif ?>
        <?php else : ?>
            <li><span><?= $item->title ?></span></li>
        <?php endif ?>
    <?php endforeach ?>
</ul>
