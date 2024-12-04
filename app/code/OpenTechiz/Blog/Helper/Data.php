<?php
namespace OpenTechiz\Blog\Helper;

use Exception;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\UrlRewrite\Model\UrlRewrite;
use Magento\UrlRewrite\Model\UrlRewriteFactory;
use Magento\Framework\App\Helper\Context;
use OpenTechiz\Blog\Model\Post;

class Data extends AbstractHelper {

    /**
     * @var UrlRewriteFactory
     */
    protected $urlRewriteFactory;

    /**
     * Helper Data Construct
     *
     * @param UrlRewriteFactory $urlRewriteFactory
     * @param Context $context
     */
    public function __construct(
        UrlRewriteFactory $urlRewriteFactory,
        Context $context,
    )
    {
        $this->urlRewriteFactory = $urlRewriteFactory;
        parent::__construct($context);
    }

    /**
     * Create URL Rewrite Blog
     *
     * @param Post $post
     */
    public function createUrlRewriteForBlog($post)
    {
        $urlRewriteModel = $this->urlRewriteFactory->create();
        $urlRewriteModel->setStoreId(2);
        $urlRewriteModel->setTargetPath("blog/index/view/id/".$post->getId());
        $urlRewriteModel->setRequestPath($post->getUrlRewrite().".html");
        $urlRewriteModel->save();

        return $urlRewriteModel;
    }

    /**
     * @param Post $post
     * @param string $url_rewrite
     * @return bool
     */
    public function checkDuplicateUrlRewrite($post, $url_rewrite)
    {
        if($post->getData('url_rewrite') != $url_rewrite) {
            return false;
        }
        $urlRewriteCollection = $this->urlRewriteFactory->create()->getCollection();
        $urlRewrite = $urlRewriteCollection
            ->addFieldToSelect('request_path')
            ->addFieldToFilter('request_path', ['eq' => $url_rewrite.'.html'])
            ->getData();
        if($urlRewrite) return true;
        return false;
    }

    /**
     * @param $urlRewrite
     * @return UrlRewrite
     * @throws Exception
     */
    public function deleteUrlRewrite($urlRewrite) {
        $urlRewriteModel = $this->urlRewriteFactory->create()->load($urlRewrite.'.html', 'request_path');
        $urlRewriteModel->delete();
        return $urlRewriteModel;
    }
}
