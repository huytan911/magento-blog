<?php
namespace OpenTechiz\Blog\Model;

class Comment extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
    const CACHE_TAG = 'blog_comment';

    protected $_cacheTag = 'blog_comment';

    protected $_eventPrefix = 'blog_comment';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('OpenTechiz\Blog\Model\ResourceModel\Comment');
    }

    /**
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}
