<?php

namespace OpenTechiz\Blog\Controller\Comment;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use OpenTechiz\Blog\Model\CommentFactory;

class Save extends Action
{
    /**
     * @var CommentFactory
     */
    protected $commentFactory;

    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    public function __construct(
        Context $context,
        CommentFactory $commentFactory,
        JsonFactory $jsonFactory
    ) {
        $this->commentFactory = $commentFactory;
        $this->jsonFactory = $jsonFactory;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|Json|ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->jsonFactory->create();
        $content = $this->getRequest()->getParam('content');
        $postId = (int)$this->getRequest()->getParam('post_id');
        $entityId = (int)$this->getRequest()->getParam('entity_id');
        if ($content) {
            try {
                $comment = $this->commentFactory->create();
                $data = [
                    'post_id' => $postId,
                    'content' => $content,
                    'entity_id' => $entityId,
                    'status' => 0
                ];
                $comment->setData($data);
                $comment->save();

                return $resultJson->setData([
                    'success' => true,
                    'message' => __('Your comment has been submitted.')
                ]);
            } catch (\Exception $e) {
                return $resultJson->setData([
                    'success' => false,
                    'message' => __('Unable to post comment.')
                ]);
            }
        }

        return $resultJson->setData([
            'success' => false,
            'message' => __('Invalid request.')
        ]);
    }
}
