<?php
/**
 * Created by PhpStorm.
 * User: rome0s
 * Date: 08.05.17
 * Time: 0:39
 */

namespace App\Services;

class FlashMessages {

    protected static $sessionName = 'flash_messages';

    /**
     * @param $type
     * @param string $message
     */
    public static function add($type, string $message) {

        $messages = session(static::$sessionName, []);

        session()->forget(static::$sessionName);

        if(!isset($messages[$type])) {

            $messages[$type] = array();

        }

        $messages[$type][] = $message;

        session()->flash(static::$sessionName, $messages);

    }

    public static function getMessages() {

        $messages = session(static::$sessionName, []);

        return $messages;

    }

}