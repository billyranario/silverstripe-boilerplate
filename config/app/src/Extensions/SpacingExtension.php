<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataExtension;

class SpacingExtension extends DataExtension
{
    protected $tabPath = 'Root.Spacing';

    private static $db = [
        // Mobile
        'MarginTopMobile' => "Varchar",
        'MarginBottomMobile' => "Varchar",
        'MarginLeftMobile' => "Varchar",
        'MarginRightMobile' => "Varchar",
        'PaddingTopMobile' => "Varchar",
        'PaddingBottomMobile' => "Varchar",
        'PaddingLeftMobile' => "Varchar",
        'PaddingRightMobile' => "Varchar",
        // Tablet
        'MarginTopTablet' => "Varchar",
        'MarginBottomTablet' => "Varchar",
        'MarginLeftTablet' => "Varchar",
        'MarginRightTablet' => "Varchar",
        'PaddingTopTablet' => "Varchar",
        'PaddingBottomTablet' => "Varchar",
        'PaddingLeftTablet' => "Varchar",
        'PaddingRightTablet' => "Varchar",
        // Desktop
        'MarginTopDesktop' => "Varchar",
        'MarginBottomDesktop' => "Varchar",
        'MarginLeftDesktop' => "Varchar",
        'MarginRightDesktop' => "Varchar",
        'PaddingTopDesktop' => "Varchar",
        'PaddingBottomDesktop' => "Varchar",
        'PaddingLeftDesktop' => "Varchar",
        'PaddingRightDesktop' => "Varchar",
    ];

    private static $defaults = [];

    public function setTabPath($path)
    {
        $this->tabPath = $path;
        return $this;
    }

    public function updateCMSFields(FieldList $fields)
    {
        $devices = [
            'Desktop' => $this->tabPath . '.Desktop',
            'Tablet'  => $this->tabPath . '.Tablet',
            'Mobile'  => $this->tabPath . '.Mobile',
        ];

        $fields->removeByName(array_keys(self::$db));

        foreach ($devices as $device => $tab) {
            $defaultPad = self::$defaults["PaddingTop{$device}"] ?? null;

            $makeField = function ($name, $label, $isDefault = false) use ($device, $defaultPad) {
                $field = TextField::create($name, $label);
                $existing = $this->owner->getField($name);
                if ($existing !== null) {
                    $field->setValue($existing);
                } elseif ($isDefault && $defaultPad !== null) {
                    $field->setValue($defaultPad);
                }
                return $field;
            };

            $mTop = $makeField("MarginTop{$device}", "Top");
            $mBottom = $makeField("MarginBottom{$device}", "Bottom");
            $mLeft = $makeField("MarginLeft{$device}", "Left");
            $mRight = $makeField("MarginRight{$device}", "Right");

            $margins = CompositeField::create(
                FieldGroup::create($mTop, $mBottom)->setTitle('Vertical Margins'),
                FieldGroup::create($mLeft, $mRight)->setTitle('Horizontal Margins')
            )->setTitle("Margins ({$device})")->setName("Margins{$device}");

            $pTop = $makeField("PaddingTop{$device}", "Top", true);
            $pBottom = $makeField("PaddingBottom{$device}", "Bottom", true);
            $pLeft = $makeField("PaddingLeft{$device}", "Left");
            $pRight = $makeField("PaddingRight{$device}", "Right");

            $paddings = CompositeField::create(
                FieldGroup::create($pTop, $pBottom)->setTitle('Vertical Paddings'),
                FieldGroup::create($pLeft, $pRight)->setTitle('Horizontal Paddings')
            )->setTitle("Paddings ({$device})")->setName("Paddings{$device}");

            $fields->addFieldsToTab($tab, [$margins, $paddings]);
        }
    }

    public function HasAttributeValue(mixed $value): bool
    {
        if (is_null($value) || $value == '') {
            return false;
        }

        return (int) $value >= 0;
    }

    /**
     * CSS for mobile ("Base") spacing
     *
     * Usage in template: $MobileSpacingCSS
     *
     * @return string CSS declarations (with trailing semicolons & newlines)
     */
    public function getMobileSpacingCSS(): string
    {
        return $this->getSpacingCSSForDevice('Mobile');
    }

    /**
     * CSS for tablet breakpoint
     *
     * Usage in template: $TabletSpacingCSS
     *
     * @return string CSS declarations (with trailing semicolons & newlines)
     */
    public function getTabletSpacingCSS(): string
    {
        return $this->getSpacingCSSForDevice('Tablet');
    }

    /**
     * CSS for desktop breakpoint
     *
     * Usage in template: $DesktopSpacingCSS
     *
     * @return string CSS declarations (with trailing semicolons & newlines)
     */
    public function getDesktopSpacingCSS(): string
    {
        return $this->getSpacingCSSForDevice('Desktop');
    }

    /**
     * Helper to build the CSS for any one device key.
     *
     * @param string $device One of "Mobile", "Tablet", "Desktop"
     * @return string
     */
    protected function getSpacingCSSForDevice(string $device): string
    {
        $css = '';
        foreach (['Top', 'Bottom', 'Left', 'Right'] as $dir) {
            // margin
            $m = $this->owner->{"Margin{$dir}{$device}"};
            if ($m !== null && $m !== '') {
                $css .= "margin-" . strtolower($dir) . ":{$m}px;\n";
            }
            // padding
            $p = $this->owner->{"Padding{$dir}{$device}"};
            if ($p !== null && $p !== '') {
                $css .= "padding-" . strtolower($dir) . ":{$p}px;\n";
            }
        }
        return trim($css);
    }


    // In your template, you can use the following to output the CSS:
    // <style>
    // .textblock-{$ID} {
    //     $MobileSpacingCSS
    // }

    // @media (min-width: 768px) {
    //     .textblock-{$ID} {
    //         $TabletSpacingCSS
    //     }
    // }

    // @media (min-width: 1280px) {
    //     .textblock-{$ID} {
    //         $DesktopSpacingCSS
    //     }
    // }
    // </style>
}
