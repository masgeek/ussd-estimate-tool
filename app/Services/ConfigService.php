<?php
/**
 * Created by PhpStorm.
 * User: kenboi
 * Date: 9/3/18
 * Time: 7:33 PM
 */

namespace App\Services;


use App\SessionConfig;

class ConfigService
{
    /**
     * @param $key
     * @param $sessionId
     * @return SessionConfig
     */
    public static function incrementConfig($key, $sessionId)
    {
        #Get config
        $config = self::getConfig($key, $sessionId);
        #if config does not exist, create new
        if (!$config) {
            return self::setConfig($key, 1, $sessionId);
        }

        #increment config
        if (!is_numeric($config->value) || $config->value < 0) {
            $config->value = 1;
        } else {
            $config->value += 1;
        }

        $config->save();
        return $config;
    }

    /**
     * @param $key
     * @param $sessionId
     * @return SessionConfig
     */
    public static function getConfig($key, $sessionId)
    {
        return SessionConfig::query()->where('key', $key)->where('session_id', $sessionId)->first();
    }

    /**
     * @param $key
     * @param $value
     * @param $sessionId
     * @return SessionConfig
     */
    public static function setConfig($key, $value, $sessionId)
    {
        #Get config
        $config = self::getConfig($key, $sessionId);
        #if config does not exist, create new
        if (!$config) {
            $config = new SessionConfig();
        }
        #set value
        $config->value = $value;
        #update session id if set
        if ($sessionId) {
            $config->session_id = $sessionId;
            $config->key = $key;
        }
        #save
        $config->save();
        return $config;
    }

    /**
     * @param $key
     * @param $sessionId
     * @return SessionConfig
     */
    public static function decrementConfig($key, $sessionId)
    {
        #Get config
        $config = self::getConfig($key, $sessionId);
        #if config does not exist, create new
        if (!$config) {
            return self::setConfig($key, 0, $sessionId);
        }

        #decrement config
        if (!is_numeric($config->value) || $config->value < 1) {
            $config->value = 0;
        } else {
            $config->value -= 1;
        }

        $config->save();

        return $config;
    }

}