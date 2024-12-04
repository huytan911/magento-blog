<?php

namespace OpenTechiz\Blog\Block\Post;

use OpenTechiz\Blog\Model\PostFactory;

class View extends \Magento\Framework\View\Element\Template {

    protected $postFactory;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        PostFactory $postFactory,
        array $data = []
    )
    {
        $this->postFactory = $postFactory;
        parent::__construct($context, $data);
    }

    public function getPost()
    {
        $id = $this->getRequest()->getParam('id');
        return $this->postFactory->create()->load($id);
    }
}
