<?php
/**
 * src/pocketmine/block/Thin.php
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

namespace pocketmine\block;

use pocketmine\math\AxisAlignedBB;

abstract class Thin extends Transparent
{

    /**
     *
     * @return unknown
     */
    public function isSolid()
    {
        return false;
    }


    /**
     *
     * @return unknown
     */
    protected function recalculateBoundingBox()
    {
        $f = 0.4375;
        $f1 = 0.5625;
        $f2 = 0.4375;
        $f3 = 0.5625;

        $flag = $this->canConnect($this->getSide(2));
        $flag1 = $this->canConnect($this->getSide(3));
        $flag2 = $this->canConnect($this->getSide(4));
        $flag3 = $this->canConnect($this->getSide(5));

        if ((!$flag2 or !$flag3) and ($flag2 or $flag3 or $flag or $flag1)) {
            if ($flag2 and !$flag3) {
                $f = 0;
            } elseif (!$flag2 and $flag3) {
                $f1 = 1;
            }
        } else {
            $f = 0;
            $f1 = 1;
        }

        if ((!$flag or !$flag1) and ($flag2 or $flag3 or $flag or $flag1)) {
            if ($flag and !$flag1) {
                $f2 = 0;
            } elseif (!$flag and $flag1) {
                $f3 = 1;
            }
        } else {
            $f2 = 0;
            $f3 = 1;
        }

        return new AxisAlignedBB(
            $this->x + $f,
            $this->y,
            $this->z + $f2,
            $this->x + $f1,
            $this->y + 1,
            $this->z + $f3
        );
    }


    /**
     *
     * @param Block   $block
     * @return unknown
     */
    public function canConnect(Block $block)
    {
        return $block->isSolid() or $block->getId() === $this->getId() or $block->getId() === self::GLASS_PANE or $block->getId() === self::GLASS;
    }
}