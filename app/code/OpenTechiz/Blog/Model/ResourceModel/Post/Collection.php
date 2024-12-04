<?php
namespace OpenTechiz\Blog\Model\ResourceModel\Post;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'post_id';
    protected $_eventPrefix = 'blog_post_collection';
    protected $_eventObject = 'post_collection';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OpenTechiz\Blog\Model\Post', 'OpenTechiz\Blog\Model\ResourceModel\Post');
    }

}
