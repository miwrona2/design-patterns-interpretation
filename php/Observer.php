<?php

class Subject {

    /**
     * @var array
     *
     */
    private $observer;

    //business logic

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

interface ObserverInterface {
    public function update();
}

class ExampleObserver implements ObserverInterface {
    public function update()
    {
    }

}