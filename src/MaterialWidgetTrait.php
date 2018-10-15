<?php

namespace jasiph\materialize;

use Yii;
use yii\helpers\Json;

/**
 * This trait provides basic features for all materialize widgets
 *
 * The structure of this trait is an adoption of yii\bootstrap trait.
 *
 * ```php
 * class MyWidget extends \yii\base\Widget
 * {
 *     use BootstrapWidgetTrait;
 *
 *     public $options = [];
 * }
 * ```
 */

trait MaterializeWidgetTrait
{
    /**
     * @var array the options for the underlying materialize JS plugin.
     */
    public $clientOptions = [];

    /**
     * @var array the event handlers for the underlying materialize JS plugin.
     */
    public $clientEvents = [];

    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
    }

    /**
     * Registers a specific materialize plugin and the related events
     * @param string $name the name of the Bootstrap plugin
     */
    protected function registerPlugin($name)
    {
        $view = $this->getView();

        MaterializePluginAsset::register($view);

        $id = $this->options['id'];

        if ($this->clientOptions !== false) {
            $options = empty($this->clientOptions) ? '' : Json::htmlEncode($this->clientOptions);
            $js = "jQuery('#$id').$name($options);";
            $view->registerJs($js);
        }

        $this->registerClientEvents();
    }

    /**
     * Registers JS event handlers that are listed in [[clientEvents]].
     * @since 2.0.2
     */
    protected function registerClientEvents()
    {
        if (!empty($this->clientEvents)) {
            $id = $this->options['id'];
            $js = [];
            foreach ($this->clientEvents as $event => $handler) {
                $js[] = "jQuery('#$id').on('$event', $handler);";
            }
            $this->getView()->registerJs(implode("\n", $js));
        }
    }

    /**
     * @return \yii\web\View the view object that can be used to render views or view files.
     * @see \yii\base\Widget::getView()
     */
    abstract function getView();
}
