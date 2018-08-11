<?php

use trk\theme\Theme;
use trk\theme\Module;

echo Theme::view('header');
?>

<h1 class="uk-heading-primary uk-text-center"><?php Module::t('Oops! That page can&rsquo;t be found.') ?></h1>

<p class="uk-text-large uk-text-center uk-margin-large-bottom"><?php Module::t('It looks like nothing was found at this location. Maybe try a search?') ?></p>

<div class="uk-text-center">
    <?php echo Theme::view('templates/search') ?>
</div>

<?php

echo Theme::view('footer');