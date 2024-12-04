<?php
namespace OpenTechiz\Blog\Model\ResourceModel;


use Magento\Framework\Model\ResourceModel\Db\Context;

class Post extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
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
        $this->_init('blog_post', 'post_id');
    }
}