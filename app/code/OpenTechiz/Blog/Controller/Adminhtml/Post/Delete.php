<?php
namespace OpenTechiz\Blog\Controller\Adminhtml\Post;


class Delete extends \Magento\Backend\App\Action
{
    protected $postFactory;

    protected $helperData;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \OpenTechiz\Blog\Model\PostFactory $postFactory,
        \OpenTechiz\Blog\Helper\Data $helperData,
    )
    {
        parent::__construct($context);
        $this->postFactory = $postFactory;
        $this->helperData = $helperData;
    }

    public function execute()
    {
        $blog = $this->postFactory->create();
        $ids = $this->getRequest()->getParam('selected', []);
        try {
            foreach ($ids as $id) {
                $data = $blog->load($id);
                $this->helperData->deleteUrlRewrite($data->getData('url_rewrite'));
                if ($data->getId()) {
                    $blog->delete();
                } else {
                    echo 'Invalid';
                    $resultRedirect = $this->resultRedirectFactory->create();
                    return $resultRedirect->setPath('*/*/index', array('_current' => true));
                }
            }
            $this->messageManager->addSuccessMessage(__('You deleted these blog.'));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__('Delete error: %1.', $e->getMessage()));
        }
        $resultRedirect = $this->resultRedirectFactory->create();

        return $resultRedirect->setPath('*/*/index', array('_current' => true));
    }

}
