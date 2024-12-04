<?php
namespace OpenTechiz\Blog\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\Context;

class Comment extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * @param Context $context
     */
    public function __construct(
        Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct() {
        $this->_init('blog_comment', 'comment_id');
    }
}
