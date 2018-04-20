<?php 
namespace App\Entity;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="usuarios")
 * @ORM\HasLifecycleCallbacks
 */
class Usuario {
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    public $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $nome;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $login;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $senha;

    /**
     * @ORM\Column(type="string", length=100)
     */
    public $email;

    /**
     * @ORM\Column(type="string", length=100, columnDefinition="ENUM('Escrita', 'Leitura')")
     */
    public $permissao;

    /**
     * @var datetime $created_at
     *
     * @ORM\Column(type="datetime")
     */
    protected $created_at;

    /**
     * @var datetime $updated_at
     * 
     * @ORM\Column(type="datetime", nullable = true)
     */
    protected $updated_at;
    
    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->updated_at = new \DateTime('now');

        if ($this->created_at == null) {
            $this->created_at = new \DateTime('now');
        }
    }
}