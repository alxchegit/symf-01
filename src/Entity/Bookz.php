<?php

namespace App\Entity;

use App\Repository\BookzRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity(repositoryClass=BookzRepository::class)
 */
class Bookz
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=250)
     * @Assert\NotBlank(message="Название книги не может быть пустым")
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Длина поля Название книги не может быть меньше {{ limit }} символов",
     * )
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Необходимо указать автора")
     * @Assert\Length(
     *      min = 3,
     *      minMessage = "Длина поля Автор не может быть меньше {{ limit }} символов",
     * )
     */
    private $author;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Необходимо указать год выпуска")
     * @Assert\Type(
     *     type="integer",
     *     message="При указании года используйте только цифры"
     * )
     *
     */
    private $year;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }
}
