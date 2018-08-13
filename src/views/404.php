<?php

use trk\theme\Module;

echo Module::render('header');
?>

<h1 class="uk-heading-primary uk-text-center"><?php Module::t('Oops! That page can&rsquo;t be found.') ?></h1>

<p class="uk-text-large uk-text-center uk-margin-large-bottom"><?php Module::t('It looks like nothing was found at this location. Maybe try a search?') ?></p>

<div class="uk-text-center">
    <?php echo Module::render('templates/search') ?>
</div>

<?php

echo Module::render('footer');