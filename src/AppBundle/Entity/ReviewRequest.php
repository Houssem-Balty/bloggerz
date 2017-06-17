<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReviewRequest
 *
 * @ORM\Table(name="review_request")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ReviewRequestRepository")
 */
class ReviewRequest
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000)
     */
    private $description;

    /**
     * @var \stdClass
     *
     * @ORM\Column(name="userDeclare", type="object")
     */
    private $userDeclare;


    /**
   * Many reviewRequests have One userRecieve.
   * @ORM\ManyToOne(targetEntity="User", inversedBy="reviewRequests")
   * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
   */
    private $userRecieve;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiryDate", type="datetime")
     */
    private $expiryDate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;


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
     * Set title
     *
     * @param string $title
     *
     * @return ReviewRequest
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
     * Set description
     *
     * @param string $description
     *
     * @return ReviewRequest
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set userDeclare
     *
     * @param \stdClass $userDeclare
     *
     * @return ReviewRequest
     */
    public function setUserDeclare($userDeclare)
    {
        $this->userDeclare = $userDeclare;

        return $this;
    }

    /**
     * Get userDeclare
     *
     * @return \stdClass
     */
    public function getUserDeclare()
    {
        return $this->userDeclare;
    }

    /**
     * Set userRecieve
     *
     * @param \stdClass $userRecieve
     *
     * @return ReviewRequest
     */
    public function setUserRecieve($userRecieve)
    {
        $this->userRecieve = $userRecieve;

        return $this;
    }

    /**
     * Get userRecieve
     *
     * @return \stdClass
     */
    public function getUserRecieve()
    {
        return $this->userRecieve;
    }

    /**
     * Set expiryDate
     *
     * @param \DateTime $expiryDate
     *
     * @return ReviewRequest
     */
    public function setExpiryDate($expiryDate)
    {
        $this->expiryDate = $expiryDate;

        return $this;
    }

    /**
     * Get expiryDate
     *
     * @return \DateTime
     */
    public function getExpiryDate()
    {
        return $this->expiryDate;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return ReviewRequest
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
