<?php

\Hongyukeji\Plugin\Event::forge('the.bootstrap.was.loaded')
    ->setCall(function($result) {
        $result->set('success');
    });

\Hongyukeji\Plugin\Event::forge('Hongyukeji\Theme\Theme.execute.hongyukeji/foolfake-theme-fake')
    ->setCall(function($result) {
        $result->set('success');
    });

\Hongyukeji\Plugin\Event::forge('Hongyukeji\Theme\Theme.install.hongyukeji/foolfake-theme-fake')
    ->setCall(function($result) {
        $result->set('success');
    });

\Hongyukeji\Plugin\Event::forge('Hongyukeji\Theme\Theme.uninstall.hongyukeji/foolfake-theme-fake')
    ->setCall(function($result) {
        $result->set('success');
    });

\Hongyukeji\Plugin\Event::forge('Hongyukeji\Theme\Theme.upgrade.hongyukeji/foolfake-theme-fake')
    ->setCall(function($result) {
        $result->set('success');
    });
