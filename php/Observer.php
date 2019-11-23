<?php

/**
 * Class Order in eCommerce system
 */
class Order implements \SplSubject
{

    const STATUS_PENDING = 1;
    const STATUS_COMPLETED = 2;

    /**
     * @var array
     *
     */
    private $observers;

    /**
     * @var ?int
     */
    private $status;

    public function getStatus()
    {
        return $this->status;
    }

    public function setStatus(?int $status): Order
    {
        $this->status = $status;
        $this->notify();
        return $this;
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
    }

    public function detach(SplObserver $observer)
    {
        unset($observer, $this->observers);
    }
}

class StatisticChart implements \SplObserver
{
    public function update(SplSubject $subject)
    {
        /**
         * @var Order $subject
         */

        if ($subject->getStatus() === Order::STATUS_COMPLETED) {
            $this->drawChart($subject);
        }
    }

    private function drawChart(Order $order): void
    {
        // refresh chart that displays number of orders in last week, last month period, etc.
        print 'chart rebuilt';
    }

}

// usage
$order = new Order();
$statisticChart = new StatisticChart();
$order->attach($statisticChart);
$order->setStatus(Order::STATUS_COMPLETED);

// when any Order status is changed to 'completed' chart with statistics is rebuilt

