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

    public function isRoot(): bool
    {
        return !empty($this->getParent());
    }

    public function isComposite(): bool
    {
        return true;
    }


    public function render(): string
    {
        $title = $this->getTitle();
        $html = '';
        if ($this->isRoot()) {
            $html = <<<html
<li><a>$title</a>
html;
        }

        $html .= '<ul>';
        foreach ($this->children as $child) {
            $html .= $child->render();
        }
        $html .= '</ul>';
        if ($this->isRoot()) {
            $html .= '</li>';
        }
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

$shoes = new MenuItem('Shoes', '/shoes');
$trousers = new MenuItem('Trousers', '/trousers');
$tops = new MenuItem('Tops', '/tops');
$man = new Menu('Man');
$man->add($shoes);
$man->add($trousers);
$man->add($tops);
$shop = new Menu('Shop');
$shop->add($man);

$shoes = new MenuItem('Shoes', '/shoes');
$trousers = new MenuItem('Trousers', '/trousers');
$tops = new MenuItem('Tops', '/tops');
$woman = new Menu('Woman');
$woman->add($shoes);
$woman->add($trousers);
$woman->add($tops);
$shop->add($woman);

$home = new MenuItem('Home', '/home');
$about = new MenuItem('About', '/about');
$contact = new MenuItem('Contact', '/contact');

$menu = new Menu('');
$menu->add($home);
$menu->add($about);
$menu->add($shop);

print_r(
    $menu->render()
);