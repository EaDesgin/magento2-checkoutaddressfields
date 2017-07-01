<?php
/**
 * Copyright © 2017 EaDesign by Eco Active S.R.L. All rights reserved.
 * See LICENSE for license details.
 */

namespace Eadesigndev\Checkoutaddressfields\Model\Data;

use Eadesigndev\Checkoutaddressfields\Api\Data\OrderFieldsInterface;
use Magento\Framework\Api\AbstractSimpleObject;

class OrderFields extends AbstractSimpleObject implements OrderFieldsInterface
{
    const COMMENT_FIELD_NAME = 'order_comment';
    const DATE_FIELD_NAME = 'delivery_date';

    /**
     * @return string|null
     */
    public function getComment()
    {
        return $this->_get(self::COMMENT_FIELD_NAME);
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT_FIELD_NAME, $comment);
    }

    /**
     * @return string|null
     */
    public function getDate()
    {
        return $this->_get(self::DATE_FIELD_NAME);
    }

    /**
     * @param string $comment
     * @return $this
     */
    public function setDate($comment)
    {
        return $this->setData(self::DATE_FIELD_NAME, $comment);
    }
}
