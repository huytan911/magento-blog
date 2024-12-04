<?php
namespace OpenTechiz\Blog\Observer;

use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class InvalidateCache implements ObserverInterface
{
    /**
     * @var TypeListInterface
     */
    protected $typeList;

    public function __construct(
        TypeListInterface $typeList
    ) {
        $this->typeList = $typeList;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $commentId = $observer->getData()['data_object']->getId();
        $this->typeList->invalidate('blog_comment' . '_' . $commentId);
    }
}
