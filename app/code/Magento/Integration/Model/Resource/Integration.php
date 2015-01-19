<?php
/**
 * Copyright © 2015 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Magento\Integration\Model\Resource;

/**
 * Integration resource model
 */
class Integration extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('integration', 'integration_id');
    }

    /**
     * Select token for a given customer.
     *
     * @param int $consumerId
     * @return array|boolean - Row data (array) or false if there is no corresponding row
     */
    public function selectActiveIntegrationByConsumerId($consumerId)
    {
        $adapter = $this->_getReadAdapter();
        $select = $adapter->select()
            ->from($this->getMainTable())
            ->where('consumer_id = ?', $consumerId)
            ->where('status = ?', \Magento\Integration\Model\Integration::STATUS_ACTIVE);
        return $adapter->fetchRow($select);
    }
}
