<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Page
 *
 * @ORM\Table(name="page")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PageRepository")
 */
class Page
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pageId", type="string", length=255, unique=true)
     */
    private $pageId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="pageAccessToken", type="string", length=255)
     */
    private $pageAccessToken;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="associatedBlog", type="object")
     */
    private $associatedBlog;

    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255, nullable=true)
     */
    private $picture;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set pageId
     *
     * @param string $pageId
     *
     * @return Page
     */
    public function setPageId($pageId)
    {
        $this->pageId = $pageId;

        return $this;
    }

    /**
     * Get pageId
     *
     * @return string
     */
    public function getPageId()
    {
        return $this->pageId;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Page
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set pageAccessToken
     *
     * @param string $pageAccessToken
     *
     * @return Page
     */
    public function setPageAccessToken($pageAccessToken)
    {
        $this->pageAccessToken = $pageAccessToken;

        return $this;
    }

    /**
     * Get pageAccessToken
     *
     * @return string
     */
    public function getPageAccessToken()
    {
        return $this->pageAccessToken;
    }

    /**
     * Set associatedBlog
     *
     * @param \stdClass $associatedBlog
     *
     * @return Page
     */
    public function setAssociatedBlog($associatedBlog)
    {
        $this->associatedBlog = $associatedBlog;

        return $this;
    }

    /**
     * Get associatedBlog
     *
     * @return \stdClass
     */
    public function getAssociatedBlog()
    {
        return $this->associatedBlog;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Page
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }
}

