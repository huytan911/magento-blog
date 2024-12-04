<?php
namespace OpenTechiz\Blog\Controller\Adminhtml\Post;

use Magento\Backend\App\Action\Context;
use OpenTechiz\Blog\Controller\Adminhtml\Post;
use OpenTechiz\Blog\Model\PostFactory;
use OpenTechiz\Blog\Helper\Data as HelperData;

class Save extends Post
{
    /**
     * @var HelperData
     */
    protected $helper;

    /**
     * @param Context $context
     * @param PostFactory $postFactory
     * @param HelperData $helper
     */
    public function __construct(
        Context     $context,
        PostFactory $postFactory,
        HelperData  $helper,
    )
    {
        $this->postFactory = $postFactory;
        $this->helper = $helper;

        parent::__construct($postFactory, $context);
    }

    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $post = $this->initPost();

        if($post->getId()) {
            if ($this->helper->checkDuplicateUrlRewrite($post, $data['url_rewrite'])) {
                $resultRedirect->setPath('blog/*/');
                $this->messageManager->addErrorMessage(__('This URL Rewrite was existed.'));
                return $resultRedirect;
            }
        }
        $post->addData($data);
        try {
            $post->save();
            $this->helper->createUrlRewriteForBlog($post);
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("Save Error"));
            return $resultRedirect->setPath('blog/post/edit', ['id' => $post->getId(), '_current' => true]);
        }
        $this->messageManager->addSuccessMessage(__("Save Success"));

        $resultRedirect->setPath('blog/post/index', ['id' => $post->getId(), '_current' => true]);

        return $resultRedirect;
    }

}
