<?php

use trk\theme\Theme;

$site = Theme::get('site');
$header = Theme::get('header');
$mobile = Theme::get('mobile');
$footer = Theme::get('footer');
?>
        <?php if (!Theme::sidebar('footer')) : ?>
                        </div>
                        <?php if (Theme::sidebar('sidebar')) echo Theme::sidebar('sidebar') ?>
                    </div>

                </div>
            </div>
            <?php endif ?>
            <?= Theme::sidebar("bottom:section") ?>
            <?= Theme::sidebar('footer') ?>
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