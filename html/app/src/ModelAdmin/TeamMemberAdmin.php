<?php

use SilverStripe\Admin\ModelAdmin;

class TeamMemberAdmin extends ModelAdmin
{
    private static $managed_models = [
        TeamMember::class,
    ];

    private static $url_segment = 'team-members';
    private static $menu_title = 'Team Members';
    private static $menu_icon_class = 'font-icon-torso';
    private static $menu_priority = 20;
}