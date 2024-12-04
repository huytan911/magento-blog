<?php

namespace OpenTechiz\Blog\Controller\Adminhtml;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use OpenTechiz\Blog\Model\PostFactory;

abstract class Post extends Action
{
    /**
     * @var PostFactory
     */
    public $postFactory;

    /**
     * @param PostFactory $postFactory
     * @param Context $context
     */
    public function __construct(
        PostFactory $postFactory,
        Context     $context
    )
    {
        $this->postFactory = $postFactory;
        parent::__construct($context);
    }

    /**
     * Init Post
     *
     * @return bool|\OpenTechiz\Blog\Model\Post
     */
    protected function initPost()
    {
        $postId = (int)$this->getRequest()->getParam('id');

        $post = $this->postFactory->create();
        if ($postId) {
            $post->load($postId);
            if (!$post->getId()) {
                $this->messageManager->addErrorMessage(__('This post no longer exists.'));

                return false;
            }
        }
        return $post;
    }
}
