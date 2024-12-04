<?php
namespace OpenTechiz\Blog\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use OpenTechiz\Blog\Helper\Email;

class EmailNotify implements ObserverInterface
{
    /**
     * @var Email
     */
    private $helperEmail;

    public function __construct(
        Email $helperEmail
    ) {
        $this->helperEmail = $helperEmail;
    }

    /**
     * @param Observer $observer
     * @return bool
     */
    public function execute(Observer $observer)
    {
        try {
            $this->helperEmail->sendEmail();
        }
        catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
