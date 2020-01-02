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

    public function getParent(): Component
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
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $url;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function render(): string
    {
        $url = $this->getUrl();
        $title = $this->getTitle();
        return <<<html
            <div>
                <a href="$url">$title</a>
            </div>
html;
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

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
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
        $html = '<div>';
        print_r($this->children);
//        foreach ($this->children as $child) {
//            /** @var Component $child */
//            $html .= '<div>'. $title . $child->render() . '</div>';
//        }
        $html .= '</div>';
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
$navbar = new Menu();
$navbar->setTitle('Menu');
$home = new MenuItem();
$home->setTitle('Home');
$home->setUrl('/home');
$navbar->add($home);

$shop = new Menu();
$shop->setTitle('Shop');
$navbar->add($shop);
$woman = new Menu();
$woman->setTitle('Woman');
$shop->add($woman);

$shoes = new MenuItem();
$shoes->setTitle('Shoes');
$shoes->setUrl('/shoes');
$woman->add($shoes);

$about = new MenuItem();
$about->setTitle('About');
$about->setUrl('/about');
$navbar->add($about);

$contact = new MenuItem();
$contact->setTitle('Contact');
$contact->setUrl('/contact');
$navbar->add($contact);

$navbar->render();