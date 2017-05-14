<?php

namespace FacebookBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="facebook")
 * @ORM\Entity(repositoryClass="FacebookBundle\Repository\FacebookRepository")
 */

class Facebook
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected  $id;

    /**
     * @var string
     *
     * @ORM\Column(name="accountName", type="string", length=255)
     */
    protected $accountName;

    /**
     * @var string
     *
     * @ORM\Column(name="accountId", type="string", length=255,unique=true)
     */
    protected $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="accessToken", type="string", length=255)
     */
    protected $accessToken;


    /**
    * Many Features have One Product.
    * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="facebookAccounts")
    * @ORM\JoinColumn(name="user_owner_id", referencedColumnName="id")
    */

    private $user_owner ;


    /**
     * @var array
     *
     * @ORM\Column(name="permission", type="array")
     */

    private $permissions;

    /**
     * Set permission
     *
     * @param object $permissions
     *
     * @return Facebook
     */
    public function setPermissions($permissions)
    {
        $this->permissions = $permissions;

        return $this;
    }



    /**
     * Get permissions
     *
     * @return array
     */
    public function getPermissions()
    {
        return $this->permissions;
    }



    /**
     * Set user_owner
     *
     * @param object $user_owner
     *
     * @return Facebook
     */
    public function setUserOwner($owner)
    {
        $this->user_owner = $owner;

        return $this;
    }


    /**
     * Get user_owner
     *
     * @return string
     */
    public function getUserOwner()
    {
        return $this->user_owner;
    }



    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     */
    private $picture ;


        /**
         * Set picture
         *
         * @param string $picture
         *
         * @return Facebook
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


    /**
     * Set accessToken
     *
     * @param string $accessToken
     *
     * @return Facebook
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get accessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }




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
     * Set accountName
     *
     * @param string $accountName
     *
     * @return Facebook
     */
    public function setAccountName($accountName)
    {
        $this->accountName = $accountName;

        return $this;
    }

    /**
     * Get accountName
     *
     * @return string
     */
    public function getAccountName()
    {
        return $this->accountName;
    }

    /**
     * Set accountId
     *
     * @param string $accountId
     *
     * @return User
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }






}
