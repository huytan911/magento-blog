<?php

namespace OpenTechiz\Blog\Block\Post;

use OpenTechiz\Blog\Model\ResourceModel\Post\CollectionFactory;

class Index extends \Magento\Framework\View\Element\Template {

    protected $postCollectionFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Catalog\Api\Data\ProductInterface $productFactory,
        CollectionFactory $postCollectionFactory,
        array $data = []
    )
    {
        $this->postCollectionFactory = $postCollectionFactory;
        $this->productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    public function getPostData() {
        return $this->postCollectionFactory->create()->getData();
    }
}
