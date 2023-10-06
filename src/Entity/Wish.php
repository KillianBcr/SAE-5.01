<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\WishRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: WishRepository::class)]
#[ApiResource(
    operations: [
        new Get(
            normalizationContext: ['groups' => ['get_Wish']],
        ),
        new GetCollection(),
        new Post(
            security: "is_granted('get_Wish')"
        ),
        new Put(
            security: "is_granted('get_Wish')"
        ),
        new Patch(
            security: "is_granted('get_Wish')"
        ),
        new Delete(
            security: "is_granted('get_Wish')"
        ),
    ]
)]
class Wish
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_Wish'])]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['get_Wish'])]
    private ?int $chosenGroups = null;

    #[ORM\ManyToOne(inversedBy: 'wishes')]
    #[Groups(['get_User', 'set_User'])]
    private ?Group $groupeType = null;

    #[ORM\ManyToOne(inversedBy: 'wishes')]
    #[Groups(['get_User', 'set_User'])]
    private ?Subject $subjectId = null;

    #[ORM\ManyToOne(inversedBy: 'wishes')]
    private ?User $User_id = null;

    #[Groups(['get_Wish'])]
    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    #[Groups(['get_Wish'])]
    public function getUserId(): ?User
    {
        return $this->User_id;
    }

    public function setUserId(?User $User_id): static
    {
        $this->User_id = $User_id;

        return $this;
    }

    #[Groups(['get_Wish'])]
    public function getChosenGroups(): ?int
    {
        return $this->chosenGroups;
    }

    public function setChosenGroups(?int $chosenGroups): static
    {
        $this->chosenGroups = $chosenGroups;

        return $this;
    }

    #[Groups(['get_Wish'])]
    public function getGroupeType(): ?Group
    {
        return $this->groupeType;
    }

    public function setGroupeType(?Group $groupeType): static
    {
        $this->groupeType = $groupeType;

        return $this;
    }

    #[Groups(['get_Wish'])]
    public function getSubjectId(): ?Subject
    {
        return $this->subjectId;
    }

    public function setSubjectId(?Subject $subjectId): static
    {
        $this->subjectId = $subjectId;

        return $this;
    }
}
