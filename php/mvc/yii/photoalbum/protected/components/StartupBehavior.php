<?php

// see http://rethrowexception.wordpress.com/2010/10/16/php-and-yii-framework-use-browser-locale-to-set-application-locale/

class StartupBehavior extends CBehavior{
    public function attach($owner){
        $owner->attachEventHandler('onBeginRequest', array($this, 'beginRequest'));
    }

    public function beginRequest(CEvent $event){
        $language=Yii::app()->request->getPreferredLanguage();
        Yii::app()->language=$language;
    }
}
