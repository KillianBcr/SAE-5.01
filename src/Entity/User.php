<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Put;
use App\Controller\GetMeController;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(
            normalizationContext: ['groups' => ['get_User']]
        ),
        new GetCollection(
            uriTemplate: '/me',
            controller: GetMeController::class,
            openapiContext: [
                'responses' => [
                    '200', '401' => [
                        'description' => 'Get connected User',
                        'summary' => 'Get connected User',
                    ],
                ],
            ],
            paginationEnabled: false,
            normalizationContext: ['groups' => ['get_Me', 'get_User']],
            security: "is_granted('ROLE_USER')"
        ),
        new Put(
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user"
        ),
        new Patch(
            denormalizationContext: ['groups' => ['set_User']],
            security: "is_granted('ROLE_USER') and object == user"
        ),
        new Delete(
            security: "is_granted('ROLE_USER') and object == user"
        ),
    ],
    normalizationContext: ['groups' => ['get_User', 'get_Me']]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_User'])]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    #[Groups(['set_User', 'get_Me', 'get_User'])]
    private ?string $login = null;

    #[ORM\Column]
    private array $roles = ['ROLE_USER'];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    #[Groups(['set_User'])]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $firstname = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $lastname = null;

    #[ORM\Column(length: 20)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $phone = null;

    #[ORM\Column(length: 10)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $postalCode = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $city = null;

    #[ORM\Column(length: 255)]
    #[Groups(['get_User', 'set_User'])]
    private ?string $email = null;

    #[ORM\Column]
    #[Groups(['set_User', 'get_Me', 'get_User'])]
    private ?int $minHours = null;

    #[ORM\Column]
    #[Groups(['set_User', 'get_Me', 'get_User'])]
    private ?int $maxHours = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->login;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): static
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): static
    {
        $this->city = $city;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getMinHours(): ?int
    {
        return $this->minHours;
    }

    public function setMinHours(int $minHours): static
    {
        $this->minHours = $minHours;

        return $this;
    }

    public function getMaxHours(): ?int
    {
        return $this->maxHours;
    }

    public function setMaxHours(int $maxHours): static
    {
        $this->maxHours = $maxHours;

        return $this;
    }
}
