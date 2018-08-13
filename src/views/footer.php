<?php

use trk\theme\Module;

$site = Module::getConfig('site');
$header = Module::getConfig('header');
$mobile = Module::getConfig('mobile');
$footer = Module::getConfig('footer');
?>
        <?php if (!Module::sidebar('footer')) : ?>
                        </div>
                        <?php if (Module::sidebar('sidebar')) echo Module::sidebar('sidebar') ?>
                    </div>

                </div>
            </div>
            <?php endif ?>
            <?= Module::sidebar("bottom:section") ?>
            <?= Module::sidebar('footer') ?>
        </div>
        <?php if ($site['layout'] == 'boxed') : ?>
        </div>
        <?php endif ?>

        <?php if (strpos($header['layout'], 'offcanvas') === 0 || $mobile['animation'] == 'offcanvas') : ?>
        </div>
        <?php endif ?>

        <?php Yii::$app->view->endBody() ?>
    </body>
</html>