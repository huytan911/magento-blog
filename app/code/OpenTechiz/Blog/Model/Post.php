<?php
namespace OpenTechiz\Blog\Model;

class Post extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'blog_post';
    protected $_cacheTag = 'blog_post';
    protected $_eventPrefix = 'blog_post';

    protected function _construct()
    {
        $this->_init('OpenTechiz\Blog\Model\ResourceModel\Post');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }
}
