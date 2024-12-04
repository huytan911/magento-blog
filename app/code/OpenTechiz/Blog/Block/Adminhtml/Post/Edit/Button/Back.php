<?php


namespace OpenTechiz\Blog\Block\Adminhtml\Post\Edit\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class Back extends GenericButton  implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'class' => 'back',
            'on_click' => sprintf("location.href= '%s';", $this->getBackUrl()),
            'sort_order' => 10
        ];
    }
    public function getBackUrl() {
        return $this->getUrl('*/*/');
    }
}
