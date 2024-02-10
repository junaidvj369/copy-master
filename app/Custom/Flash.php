<?php

namespace App\Custom;

use Str;
use Throwable;

class Flash
{
    public $title;
    public $message;
    public $originalMessage;
    public $level;
    public $type;
    public $important;
    public $uuid;
    public $showOriginal = false;

    public static $sessionKeyName = 'flash_message';

    public function __construct()
    {
        $uuid = (string)(Str::uuid());
        $this->uuid = $uuid;
    }

    public static function newInstance()
    {
        return new static();
    }

    public function setOption($option, $value)
    {
        $this->{$option} = $value;
        $this->updateInSession();
        return $this;
    }

    public static function success($message, $statusCode = null)
    {
        return static::generateFlashMessage($message, 'success', $statusCode);
    }
    public static function error($message, $statusCode = null)
    {
        return static::generateFlashMessage($message, 'error', $statusCode);
    }
    public static function warning($message, $statusCode = null)
    {
        return static::generateFlashMessage($message, 'warning', $statusCode);
    }
    public static function secondary($message, $statusCode = null)
    {
        return static::generateFlashMessage($message, 'secondary', $statusCode);
    }

    public function showOriginal()
    {
        return $this->setOption('showOriginal', true);
    }

    private static function generateFlashMessage($message, $level, $statusCode = null)
    {
        $newInstance = static::newInstance();

        if ($message instanceof Throwable) {
            $message = $message->getMessage();
        }
        $originalMessage = $message;
        if (app()->isProduction() && $statusCode == 500) {
            $message  = 'Technical Error. Please Try again later';
        }

        $newInstance->setOption('message', $message);
        $newInstance->setOption('originalMessage', $originalMessage);
        $newInstance->setLevel($level);

        return $newInstance;
    }

    public function updateInSession()
    {
        $updatedValue = [
            'message' => $this->message,
            'title' => $this->title,
            'originalMessage' => $this->originalMessage,
            'level' => $this->level,
            'type' => $this->type,
            'important' => $this->important,
            'uuid' => $this->uuid,
            'showOriginal' => $this->showOriginal,
        ];

        $existingValues = session(static::$sessionKeyName, []);
        $existingValueIndex = array_search($this->uuid, array_column($existingValues, 'uuid'));

        if ($existingValueIndex !== false) {
            $existingValues[$existingValueIndex] = $updatedValue;
        } else {
            $existingValues[] = $updatedValue;
        }

        session()->flash(static::$sessionKeyName, $existingValues);
    }

    public function setLevel($level)
    {
        $this->setOption('level', $level);
        $type = '';
        switch ($level) {
            case 'error':
                $type = 'danger';
                break;
            default:
                $type = $level;
        }
        $this->setOption('type', $type);
    }
}
