<?php

use SilverStripe\Core\Extension;
use SilverStripe\TinyMCE\TinyMCEConfig;

// use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;

class CustomTinyMCEConfig extends Extension
{
    public function onAfterInit()
    {
        $config = TinyMCEConfig::get('cms');
        $config->enablePlugins(['textcolor' => null]);
        $config->enablePlugins(['customfonts' => 'app/plugins/customfonts/javascript/editor_plugin.js']);

        $existingCss = $config->getContentCSS();
        if (is_array($existingCss)) {
            $config->setContentCSS(array_merge($existingCss, ['themes/mmp/css/fonts.css']));
        } else {
            $config->setContentCSS(['themes/mmp/css/fonts.css']);
        }

        $config->addButtonsToLine(1, 'forecolor', 'backcolor', 'customfonts');

        $config->setOptions([
            'style_formats' => [
                ['title' => 'Font Styles', 'items' => [
                    // ['title' => 'Amasis MT Pro Regular', 'inline' => 'span', 'classes' => 'amasis-mt-pro-regular'],
                    // ['title' => 'Amasis MT Pro Light', 'inline' => 'span', 'classes' => 'amasis-mt-pro-light'],
                    ['title' => 'Angsana New', 'inline' => 'span', 'classes' => 'angsana-new'],
                    ['title' => 'Aparajita', 'inline' => 'span', 'classes' => 'aparajita'],
                    ['title' => 'Aptos Serif', 'inline' => 'span', 'classes' => 'aptos-serif'],
                    ['title' => 'Mr Gabe Regular', 'inline' => 'span', 'classes' => 'mr-gabe-regular'],
                    // ['title' => 'Chamberi Super Display Regular', 'inline' => 'span', 'classes' => 'chamberi-super-display-regular'],
                    ['title' => 'Times New Roman', 'inline' => 'span', 'classes' => 'times-new-roman'],
                    ['title' => 'Walbaum Display', 'inline' => 'span', 'classes' => 'walbaum-display']
                ]]
            ],
            'extended_valid_elements' => 'span[class]'
        ]);
    }
}
