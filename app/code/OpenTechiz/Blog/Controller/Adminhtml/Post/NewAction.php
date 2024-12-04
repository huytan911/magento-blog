<?php

namespace OpenTechiz\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Forward;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;

class NewAction extends \Magento\Backend\App\Action
{
    protected $_resultForwardFactory = false;

    /**
     * @param ForwardFactory $resultForwardFactory
     * @param Context $context
     */
    public function __construct
    (
        ForwardFactory $resultForwardFactory,
        Context $context
    )
    {
        $this->_resultForwardFactory = $resultForwardFactory;
        parent::__construct($context);
    }

    /**
     * @return Forward|ResponseInterface|ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->_resultForwardFactory->create();
        $resultPage->forward('edit');
        return $resultPage;
    }
}
