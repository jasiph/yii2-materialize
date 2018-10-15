<?php

namespace jasiph\materialize;

use yii\web\AssetBundle;

/**
 * Asset bundle for the materializecss javascript file.
 *
 * @author Jasiph <jasiph@cloudapps.biz>
 */
class MaterializePluginAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize/dist';
    public $js = [
        'js/materialize.min.js',
    ];
}
