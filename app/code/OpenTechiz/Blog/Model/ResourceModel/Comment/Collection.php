<?php
namespace OpenTechiz\Blog\Model\ResourceModel\Comment;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'comment_id';
    protected $_eventPrefix = 'blog_comment_collection';
    protected $_eventObject = 'comment_collection';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OpenTechiz\Blog\Model\Comment', 'OpenTechiz\Blog\Model\ResourceModel\Comment');
    }

}
