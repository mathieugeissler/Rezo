<?php

namespace Rezo\Bundle\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Rezo\Bundle\UserBundle\Entity\User;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Post
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Rezo\Bundle\BlogBundle\Entity\PostRepository")
 */
class Post
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     * @Assert\NotBlank()
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     * @Assert\NotBlank()
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Rezo\Bundle\UserBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @var boolean
     * @ORM\Column(name="published", type="boolean")
     */
    private $published;


    public function __construct()
    {
        $this->date = new \DateTime();
    }

    /**
     * @ORM\ManyToMany(targetEntity="Rezo\Bundle\BlogBundle\Entity\Category")
     * @ORM\JoinTable(name="post_category",
     *      joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")}
     * )
     */
    protected $categories;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Post
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return Post
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Post
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }


    /**
     * Set author
     *
     * @param User $author
     *
     * @return Post
     */
    public function setAuthor(User $author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get author
     *
     * @return User
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Get Published
     *
     * @return boolean
     */
    public function getPublished()
    {
        return $this->published;
    }

    /**
     * Set Published
     *
     * @param boolean $published
     */
    public function setPublished($published)
    {
        $this->published = $published;
    }


    /**
     * @return Category
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * @param Category $categories
     */
    public function setCategories(Category $categories)
    {
        $this->categories = $categories;
    }
}
