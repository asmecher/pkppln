<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Deposit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\DepositRepository")
 */
class Deposit
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
     * The journal that sent this deposit.
     *
     * @var AppBundle\Entity\Journal
     * 
     * @ORM\ManyToOne(targetEntity="Journal", inversedBy="deposits")
     * @ORM\JoinColumn(name="journal_id", referencedColumnName="id")
     */
    private $journal;
    
    /**
     * UUID for the deposit file. Journals may send the same deposit multiple
     * times (eg. changes to an issue).
     *
     * @var string
     * 
     * @Assert\Uuid
     * @ORM\Column(type="string", length=36, nullable=false)
     */
    private $file_uuid;
    
    /**
     * Deposit UUID, as generated by the PLN plugin.
     *
     * @var string
     * 
     * @Assert\Uuid
     * @ORM\Column(type="string", length=36, nullable=false)
     */
    private $deposit_uuid;

    /**
     * When the deposit was received.
     *
     * @var string
     * 
     * @ORM\Column(type="date", nullable=false)
     */
    private $received;

    /**
     * The deposit action (add, edit)
     *
     * @var string
     * @ORM\Column(type="string", nullable=false)
     */
    private $action;
            
    /**
     * The issue volume number
     *
     * @var int
     * 
     * @ORM\Column(type="integer", nullable=false)
     */
    private $volume;
    
    /**
     * The issue number for the deposit.
     *
     * @var int
     * 
     * @ORM\Column(type="integer")
     */
    private $issue;

    /**
     * Publication date of the deposit content.
     *
     * @var string
     * @ORM\Column(type="date")
     */
    private $pubDate;
    
    /**
     * The checksum type for the deposit (SHA1, MD5)
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $checksumType;

    /**
     * The checksum value, in hex.
     *
     * @var string
     * @Assert\Regex("/^[0-9a-f]+$/");
     * @ORM\Column(type="string")
     */
    private $checksumValue;
    
    /**
     * The source URL for the deposit. This may be a very large string.
     *
     * @var string
     * 
     * @Assert\Url
     * @ORM\Column(type="string", length=2048)
     */
    private $url;

    /**
     * Size of the deposit, in bytes.
     *
     * @var int
     * 
     * @ORM\Column(type="integer")
     */
    private $size;
    
    /**
     * Current processing state
     *
     * @var string
     * 
     * @ORM\Column(type="string")
     */
    private $state = "deposited";
    
    /**
     * Success or failure of the processing in $state.
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $outcome;

    /**
     * Stae of the deposit in LOCKSSOMatic or the PLN.
     *
     * @var string
     * @ORM\Column(type="string")
     */
    private $plnState;

    /**
     * Date the deposit was sent to LOCKSSOmatic or the PLN.
     *
     * @var date
     * @ORM\Column(type="date")
     */
    private $depositDate;
    
    /**
     * URL for the deposit receipt.
     *
     * @var string
     * @Assert\Url
     * @ORM\Column(type="string", length=2048)
     */
    private $depositReceipt;

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
     * Set file_uuid
     *
     * @param string $fileUuid
     * @return Deposit
     */
    public function setFileUuid($fileUuid)
    {
        $this->file_uuid = $fileUuid;

        return $this;
    }

    /**
     * Get file_uuid
     *
     * @return string 
     */
    public function getFileUuid()
    {
        return $this->file_uuid;
    }

    /**
     * Set deposit_uuid
     *
     * @param string $depositUuid
     * @return Deposit
     */
    public function setDepositUuid($depositUuid)
    {
        $this->deposit_uuid = $depositUuid;

        return $this;
    }

    /**
     * Get deposit_uuid
     *
     * @return string 
     */
    public function getDepositUuid()
    {
        return $this->deposit_uuid;
    }

    /**
     * Set received
     *
     * @param \DateTime $received
     * @return Deposit
     */
    public function setReceived($received)
    {
        $this->received = $received;

        return $this;
    }

    /**
     * Get received
     *
     * @return \DateTime 
     */
    public function getReceived()
    {
        return $this->received;
    }

    /**
     * Set action
     *
     * @param string $action
     * @return Deposit
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string 
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set volume
     *
     * @param integer $volume
     * @return Deposit
     */
    public function setVolume($volume)
    {
        $this->volume = $volume;

        return $this;
    }

    /**
     * Get volume
     *
     * @return integer 
     */
    public function getVolume()
    {
        return $this->volume;
    }

    /**
     * Set issue
     *
     * @param integer $issue
     * @return Deposit
     */
    public function setIssue($issue)
    {
        $this->issue = $issue;

        return $this;
    }

    /**
     * Get issue
     *
     * @return integer 
     */
    public function getIssue()
    {
        return $this->issue;
    }

    /**
     * Set pubDate
     *
     * @param \DateTime $pubDate
     * @return Deposit
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;

        return $this;
    }

    /**
     * Get pubDate
     *
     * @return \DateTime 
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * Set checksumType
     *
     * @param string $checksumType
     * @return Deposit
     */
    public function setChecksumType($checksumType)
    {
        $this->checksumType = $checksumType;

        return $this;
    }

    /**
     * Get checksumType
     *
     * @return string 
     */
    public function getChecksumType()
    {
        return $this->checksumType;
    }

    /**
     * Set checksumValue
     *
     * @param string $checksumValue
     * @return Deposit
     */
    public function setChecksumValue($checksumValue)
    {
        $this->checksumValue = $checksumValue;

        return $this;
    }

    /**
     * Get checksumValue
     *
     * @return string 
     */
    public function getChecksumValue()
    {
        return $this->checksumValue;
    }

    /**
     * Set url
     *
     * @param string $url
     * @return Deposit
     */
    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Get url
     *
     * @return string 
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * Set size
     *
     * @param integer $size
     * @return Deposit
     */
    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get size
     *
     * @return integer 
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Set state
     *
     * @param string $state
     * @return Deposit
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string 
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set outcome
     *
     * @param string $outcome
     * @return Deposit
     */
    public function setOutcome($outcome)
    {
        $this->outcome = $outcome;

        return $this;
    }

    /**
     * Get outcome
     *
     * @return string 
     */
    public function getOutcome()
    {
        return $this->outcome;
    }

    /**
     * Set plnState
     *
     * @param string $plnState
     * @return Deposit
     */
    public function setPlnState($plnState)
    {
        $this->plnState = $plnState;

        return $this;
    }

    /**
     * Get plnState
     *
     * @return string 
     */
    public function getPlnState()
    {
        return $this->plnState;
    }

    /**
     * Set depositDate
     *
     * @param \DateTime $depositDate
     * @return Deposit
     */
    public function setDepositDate($depositDate)
    {
        $this->depositDate = $depositDate;

        return $this;
    }

    /**
     * Get depositDate
     *
     * @return \DateTime 
     */
    public function getDepositDate()
    {
        return $this->depositDate;
    }

    /**
     * Set depositReceipt
     *
     * @param string $depositReceipt
     * @return Deposit
     */
    public function setDepositReceipt($depositReceipt)
    {
        $this->depositReceipt = $depositReceipt;

        return $this;
    }

    /**
     * Get depositReceipt
     *
     * @return string 
     */
    public function getDepositReceipt()
    {
        return $this->depositReceipt;
    }

    /**
     * Set journal
     *
     * @param \AppBundle\Entity\Journal $journal
     * @return Deposit
     */
    public function setJournal(\AppBundle\Entity\Journal $journal = null)
    {
        $this->journal = $journal;

        return $this;
    }

    /**
     * Get journal
     *
     * @return \AppBundle\Entity\Journal 
     */
    public function getJournal()
    {
        return $this->journal;
    }
}
