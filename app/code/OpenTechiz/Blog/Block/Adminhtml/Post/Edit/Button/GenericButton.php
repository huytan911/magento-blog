<?php


namespace OpenTechiz\Blog\Block\Adminhtml\Post\Edit\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\PageRepositoryInterface;

class GenericButton
{
    protected $context;
    protected $pageRepository;

    public function __construct(
        Context                 $context,
        PageRepositoryInterface $pageRepository
    )
    {
        $this->context = $context;
        $this->pageRepository = $pageRepository;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
