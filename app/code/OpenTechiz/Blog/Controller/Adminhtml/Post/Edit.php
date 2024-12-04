<?php
namespace OpenTechiz\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use OpenTechiz\Blog\Controller\Adminhtml\Post;
use OpenTechiz\Blog\Model\PostFactory;

/**
 * Class Edit
 * @package OpenTechiz\Blog\Controller\Adminhtml\Post
 */
class Edit extends Post
{
    /**
     * Page factory
     *
     * @var PageFactory
     */
    public $resultPageFactory;

    /**
     * Edit constructor.
     *
     * @param Context $context
     * @param PostFactory $postFactory
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PostFactory $postFactory,
        PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;

        parent::__construct($postFactory, $context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|Redirect|Page
     */
    public function execute()
    {
        /** @var \OpenTechiz\Blog\Model\Post $post */
        $post = $this->initPost();

        if (!$post) {
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('*');

            return $resultRedirect;
        }

        $data = $this->_session->getData('blog_post_data', true);
        if (!empty($data)) {
            $post->setData($data);
        }


        /** @var \Magento\Backend\Model\View\Result\Page|Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('OpenTechiz_Blog::post');
        $resultPage->getConfig()->getTitle()->set(__('Posts'));

        $title = $post->getId() ? $post->getName() : __('New Post');
        $resultPage->getConfig()->getTitle()->prepend($title);

        return $resultPage;
    }
}
