<?php

\Hongyukeji\Plugin\Event::forge('the.bootstrap.was.loaded')
    ->setCall(function($result) {
        $result->set('success');
    });

\Hongyukeji\Plugin\Event::forge('Hongyukeji\PluginTheme\Theme.execute.hongyukeji/foolfake-theme-fake')
    ->setCall(function($result) {
        $result->set('success');
    });

\Hongyukeji\Plugin\Event::forge('Hongyukeji\PluginTheme\Theme.install.hongyukeji/foolfake-theme-fake')
    ->setCall(function($result) {
        $result->set('success');
    });

\Hongyukeji\Plugin\Event::forge('Hongyukeji\PluginTheme\Theme.uninstall.hongyukeji/foolfake-theme-fake')
    ->setCall(function($result) {
        $result->set('success');
    });

\Hongyukeji\Plugin\Event::forge('Hongyukeji\PluginTheme\Theme.upgrade.hongyukeji/foolfake-theme-fake')
    ->setCall(function($result) {
        $result->set('success');
    });
