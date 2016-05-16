<?php
/**
 * src/pocketmine/event/TranslationContainer.php
 *
 * @package default
 */


/*
 *
 *  _                       _           _ __  __ _
 * (_)                     (_)         | |  \/  (_)
 *  _ _ __ ___   __ _  __ _ _  ___ __ _| | \  / |_ _ __   ___
 * | | '_ ` _ \ / _` |/ _` | |/ __/ _` | | |\/| | | '_ \ / _ \
 * | | | | | | | (_| | (_| | | (_| (_| | | |  | | | | | |  __/
 * |_|_| |_| |_|\__,_|\__, |_|\___\__,_|_|_|  |_|_|_| |_|\___|
 *                     __/ |
 *                    |___/
 *
 * This program is a third party build by ImagicalMine.
 *
 * PocketMine is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * @author ImagicalMine Team
 * @link http://forums.imagicalcorp.ml/
 *
 *
*/

namespace pocketmine\event;

class TranslationContainer extends TextContainer
{

    /** @var string[] $params */
    protected $params = [];

    /**
     *
     * @param string   $text
     * @param string[] $params
     */
    public function __construct($text, array $params = [])
    {
        parent::__construct($text);

        $this->setParameters($params);
    }


    /**
     *
     * @return string[]
     */
    public function getParameters()
    {
        return $this->params;
    }


    /**
     *
     * @param int     $i
     * @return string
     */
    public function getParameter($i)
    {
        return isset($this->params[$i]) ? $this->params[$i] : null;
    }


    /**
     *
     * @param int     $i
     * @param string  $str
     */
    public function setParameter($i, $str)
    {
        if ($i < 0 or $i > count($this->params)) { //Intended, allow to set the last
            throw new \InvalidArgumentException("Invalid index $i, have " . count($this->params));
        }

        $this->params[(int) $i] = $str;
    }


    /**
     *
     * @param string[] $params
     */
    public function setParameters(array $params)
    {
        $i = 0;
        foreach ($params as $str) {
            $this->params[$i] = (string) $str;

            ++$i;
        }
    }
}