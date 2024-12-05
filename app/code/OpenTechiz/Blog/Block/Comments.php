<?php

namespace OpenTechiz\Blog\Block;

use Magento\Framework\View\Element\Template;
use OpenTechiz\Blog\Model\ResourceModel\Comment\Collection;
use OpenTechiz\Blog\Model\ResourceModel\Comment\CollectionFactory;
use Magento\Framework\DataObject\IdentityInterface;

class Comments extends Template implements IdentityInterface
{
    /**
     * @var CollectionFactory
     */
    protected $commentCollectionFactory;


    /**
     * @param Template\Context $context
     * @param CollectionFactory $commentCollectionFactory
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $commentCollectionFactory,
        array $data = []
    ) {
        $this->commentCollectionFactory = $commentCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return Collection
     */
    public function getComments()
    {
        $postId = $this->getPostId();
        $collection = $this->commentCollectionFactory->create()
            ->addFieldToFilter('post_id', $postId)
            ->addFieldToFilter('status', 1)
            ->setOrder('created_at', 'DESC');

        return $collection;
    }

    /**
     * @return int|null
     */
    public function getPostId()
    {
        return $this->getRequest()->getParam('id');
    }

    public function getIdentities()
    {
        $identities = [];
        foreach ($this->getComments() as $comment) {
            $identities[] = $comment->getIdentities();
        }
        return array_merge([], ...$identities);
    }


}
