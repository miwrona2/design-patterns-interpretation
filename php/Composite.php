<?php

abstract class Component
{
    /**
     * @var Component
     */
    protected $parent;

    public function setParent(?Component $parent): Component
    {
        $this->parent = $parent;
        return $this;
    }

    public function getParent(): ?Component
    {
        return $this->parent;
    }

    public function isComposite(): bool
    {
        return false;
    }

    abstract public function render(): string;
}

class MenuItem extends Component
{
    //todo title and url to constructor
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $url;

    public function __construct(string $title, string $url)
    {
        $this->title = $title;
        $this->url = $url;

    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function render(): string
    {
        $url = $this->getUrl();
        $title = $this->getTitle();
        return <<<html
<li><a href="$url">$title</a></li>
html. PHP_EOL;
    }
}

class Menu extends Component
{
    /**
     * @var SplObjectStorage
     */
    private $children;

    /**
     * @var string
     */
    private $title;

    //TODO title to constructor
    public function __construct(string $title)
    {
        $this->children = new \SplObjectStorage;
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function add(Component $component)
    {
        $this->children->attach($component);
        $component->setParent($this);
    }

    public function remove(Component $component)
    {
        $this->children->detach($component);
        $component->setParent(null);
    }

    public function isComposite(): bool
    {
        return true;
    }


    public function render(): string
    {
        $title = $this->getTitle();
        $html = '<ul>' . PHP_EOL;
        foreach ($this->children as $child) {

            /** @var Component $child */
            if ($child->isComposite()) {
                $html .= '<li><a>' . $title . $child->render() . '</a></li>' . PHP_EOL;
            } else {
                $html .= $child->render();
            }

        }
        $html .= '</ul>' . PHP_EOL;
        return $html;
    }
}

//client code
/**
 * Build Navigation Bar with structure:
 * Home | Shop | About | Contact
 *          * Man
 *              -> Shoos
 *              -> Trousers
 *              -> Tops
 *          * Woman
 *              -> Shoes
 *              -> Trousers
 *              -> Tops
 */

$man = new Menu('Man');

$shoes = new MenuItem('Shoes','/shoes');
$man->add($shoes);

print_r(
    $man->render()
);