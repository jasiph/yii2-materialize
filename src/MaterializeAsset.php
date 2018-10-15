<?php
/**
 * Materialize css file
 */

namespace jasiph\materialize;

use yii\web\AssetBundle;

class MaterializeAsset extends AssetBundle
{
    public $sourcePath = '@bower/materialize/dist';
    public $css = [
        'css/materialize.min.css',
    ];
}