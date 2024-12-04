<?php

namespace OpenTechiz\Blog\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Translate\Inline\StateInterface;
use Magento\Framework\Escaper;
use Magento\Framework\Mail\Template\TransportBuilder;

class Email extends \Magento\Framework\App\Helper\AbstractHelper{

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * @var Escaper
     */
    protected $escaper;

    /**
     * @var StateInterface
     */
    protected $inlineTranslation;

    /**
     * @var TransportBuilder
     */
    protected $transportBuilder;

    public function __construct(
        Context $context,
        StateInterface $inlineTranslation,
        Escaper $escaper,
        TransportBuilder $transportBuilder,
    ) {
        parent::__construct($context);
        $this->inlineTranslation = $inlineTranslation;
        $this->transportBuilder = $transportBuilder;
        $this->escaper = $escaper;
        $this->logger = $context->getLogger();
    }

    /**
     * @throws LocalizedException
     */
    public function sendEmail() {


        $recipient_address = 'nguyentan65431@gmail.com';
        $from_address = [
            'name' => 'Huy Tân',
            'email' => 'nguyentan65432@gmail.com'
        ];

        $this->inlineTranslation->suspend();
        $this->transportBuilder->setTemplateIdentifier(
            'comment_notify_template'
        )
            ->setTemplateOptions(
                [
                    'area' => \Magento\Framework\App\Area::AREA_FRONTEND,
                    'store' => 1
                ]
            )
            ->setTemplateVars(
                []
            )
            ->setFrom(
                $from_address
            )
            ->addTo(
                $recipient_address, 'Admin'
            );

        $transport = $this->transportBuilder->getTransport();
        try {
            $transport->sendMessage();
            $this->inlineTranslation->resume();
        } catch (\Exception $exception) {
            $this->_logger->critical($exception->getMessage());
        }
    }
}
