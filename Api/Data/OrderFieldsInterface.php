<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Api\Data;

interface OrderFieldsInterface
{
    /**
     * @return string|null
     */
    public function getComment();

    /**
     * @param string $comment
     * @return null
     */
    public function setComment($comment);

    /**
     * @return string|null
     */
    public function getDate();

    /**
     * @param string $date
     * @return null
     */
    public function setDate($date);
}
