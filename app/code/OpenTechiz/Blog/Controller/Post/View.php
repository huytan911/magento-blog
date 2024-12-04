<?php

namespace OpenTechiz\Blog\Controller\Post;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;

class View extends \Magento\Framework\App\Action\Action {

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param PageFactory $resultPageFactory
     * @param Context $context
     */
    public function __construct (
        PageFactory $resultPageFactory,
        Context $context,
    )
    {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|ResultInterface|Page
     */
    public function execute()
    {
        return $this->resultPageFactory->create();
    }
}
