<?php

class User
{
    private string $firstName;
    private string $lastName;

    public function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }


    public function getFullName(): string
    {
        return $this->firstName . ' ' . $this->lastName;
    }
}

class Post
{
    public function get(string $text, User $user): array
    {
        $post = [];
        $post['added'] = (new \DateTime('now'))->format('Y-m-d H:i:s');
        $post['author_fullName'] = $user->getFullName();
        $post['content'] = $text;
        return $post;
    }
}

class DecoratedPost
{
    private Post $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function getWithEmoji(string $text, User $user): array
    {
        $singlePost = $this->post->get($text, $user);
        $singlePost['content_with_emoji'] = $this->makeActionsToParseEmoji($singlePost['content']);
        return $singlePost;

    }

    public function makeActionsToParseEmoji(string $text): string
    {
        return $text . ":-)";
    }

}

//client code
$jackMo = new User('Jack', 'Mo');
$post = new Post();
$decoratedPost = new DecoratedPost($post);
$decoratedPostArray = $decoratedPost->getWithEmoji("Content of new post .. ", $jackMo);
print_r($decoratedPostArray);