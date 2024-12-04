<?php

namespace OpenTechiz\Blog\Block;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;
use Magento\Customer\Model\SessionFactory;

class CommentForm extends Template
{
    /**
     * @var SessionFactory
     */
    protected $customerSession;

    /**
     * @param Context $context
     * @param SessionFactory $customerSession
     * @param array $data
     */
    public function __construct(
        Context $context,
        SessionFactory $customerSession,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        parent::__construct($context, $data);
    }

    /**
     * @return bool
     */
    public function isLoggedIn()
    {
        return $this->customerSession->create()->isLoggedIn();
    }

    /**
     * @return string
     */
    public function getLoginUrl()
    {
        $redirectUrl = $this->getUrl('*/*/*', ['_current' => true]); // URL hiện tại
        return $this->getUrl('customer/account/login', ['referer' => base64_encode($redirectUrl)]);
    }

    /**
     * @return int|null
     */
    public function getCurrentCustomerId() {
        return $this->customerSession->create()->getCustomerId();
    }

    /**
     * @return int|null
     */
    public function getPostId()
    {
        return $this->getRequest()->getParam('id');
    }
}
