<?php
namespace InStore\PickUp\Model\Store\Source;

use Magento\Framework\Data\OptionSourceInterface;

/**
 * Class IsActive
 */
class IsActive implements OptionSourceInterface
{
    /**
     * @var \Magento\Cms\Model\Block
     */
    protected $store;

    /**
     * Constructor
     *
     * @param \InStore\PickUp\Model\Store $store
     */
    public function __construct(\InStore\PickUp\Model\Store $store)
    {
        $this->store = $store;
    }

    /**
     * Get options
     *
     * @return array
     */
    public function toOptionArray()
    {
        $availableOptions = $this->store->getAvailableStatuses();
        $options = [];
        foreach ($availableOptions as $key => $value) {
            $options[] = [
                'label' => $value,
                'value' => $key,
            ];
        }
        return $options;
    }
}
