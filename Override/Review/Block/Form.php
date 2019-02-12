<?php
/**
 * GiaPhuGroup Co., Ltd.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GiaPhuGroup.com license that is
 * available through the world-wide-web at this URL:
 * https://www.giaphugroup.com/LICENSE.txt
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    PHPCuong
 * @package     PHPCuong_ProductReviewForm
 * @copyright   Copyright (c) 2019-2020 GiaPhuGroup Co., Ltd. All rights reserved. (http://www.giaphugroup.com/)
 * @license     https://www.giaphugroup.com/LICENSE.txt
 */

namespace PHPCuong\ProductReviewForm\Override\Review\Block;

class Form extends \Magento\Review\Block\Form
{
    /**
     * Initialize review form
     *
     * @return void
     */
    protected function _construct()
    {
        parent::_construct();
        // If the current product doesn't exist in the orders of the current customer
        if (!$this->getAlreadyPurchasedProduct()) {
            $this->setTemplate('PHPCuong_ProductReviewForm::review/form.phtml');
        } else {
            $this->setTemplate('Magento_Review::form.phtml');
        }
    }

    /**
     * Retrieve the current customer purchased the current product.
     *
     * @return boolean
     */
    private function getAlreadyPurchasedProduct()
    {
        // If is Guest then hide the review form
        if (!$this->getCustomerId()) {
            return false;
        }
        try {
            $product = $this->getProductInfo();
            $orders = $this->getCustomerOrders();
            foreach ($orders as $order) {
                // Get all visible items in the order
                /** @var $items \Magento\Sales\Api\Data\OrderItemInterface[] **/
                $items = $order->getAllVisibleItems();
                // Loop all items
                foreach ($items as $item) {
                    // Check whether the current product exist in the order.
                    if ($item->getProductId() == $product->getId()) {
                        return true;
                    }
                }
            }
            return false;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Retrieve the orders of the current customer. Only get orders are completed
     *
     * @return \Magento\Sales\Model\Order[]
     */
    private function getCustomerOrders()
    {
        $order = \Magento\Framework\App\ObjectManager::getInstance()->get(\Magento\Sales\Model\OrderFactory::class);
        $orderCollection = $order->create()->getCollection()->addFieldToFilter(
            'customer_id', $this->getCustomerId()
        )->addFieldToFilter(
            'status', \Magento\Sales\Model\Order::STATE_COMPLETE
        );
        return $orderCollection;
    }

    /**
     * Returns customer id from session
     *
     * @return int
     */
    private function getCustomerId()
    {
        $customerSession = \Magento\Framework\App\ObjectManager::getInstance()->get(\Magento\Customer\Model\SessionFactory::class);
        return $customerSession->create()->getId();
    }
}
