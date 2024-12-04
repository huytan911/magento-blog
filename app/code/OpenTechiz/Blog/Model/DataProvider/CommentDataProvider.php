<?php

namespace OpenTechiz\Blog\Model\DataProvider;

use OpenTechiz\Blog\Model\ResourceModel\Post\CollectionFactory;

class CommentDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    protected $_loadedData;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $postCollectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $postCollectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $postCollectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $comment) {
            $this->_loadedData[$comment->getId()] = $comment->getData();
        }
        return $this->_loadedData;
    }
}
