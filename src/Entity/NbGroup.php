<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\NbGroupRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: NbGroupRepository::class)]
#[ApiResource(
    operations: [
        new Get(),
        new Post(
            normalizationContext: ['groups' => ['get_NbGroup']],
            denormalizationContext: ['groups' => ['set_NbGroup']],
            security: "is_granted('ROLE_ADMIN')"
        ),
        new Put(
            security: "is_granted('ROLE_ADMIN')",
        ),
        new Patch(
            security: "is_granted('ROLE_ADMIN')",
        ),
        new Delete(
            security: "is_granted('ROLE_ADMIN')",
        ),
        new Put(
            normalizationContext: ['groups' => ['get_NbGroup']],
            denormalizationContext: ['groups' => ['set_NbGroup']],
            security: "is_granted('ROLE_USER')"
        ),
        new Patch(
            normalizationContext: ['groups' => ['get_NbGroup']],
            denormalizationContext: ['groups' => ['set_NbGroup']],
            security: "is_granted('ROLE_USER')"
        ),
    ]
)]
#[ORM\Table(name: 'nbGroups')]
class NbGroup
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['get_NbGroup', 'set_NbGroup'])]
    private ?int $id = null;

    #[ORM\Column]
    #[Groups(['get_NbGroup', 'set_NbGroup'])]
    private ?int $nbGroup = null;

    #[ORM\ManyToMany(targetEntity: Group::class, inversedBy: 'nbGroups')]
    #[Groups(['get_NbGroup', 'set_NbGroup'])]
    private Collection $GroupRelation;

    #[ORM\ManyToMany(targetEntity: Subject::class, inversedBy: 'nbGroups')]
    #[Groups(['get_NbGroup', 'set_NbGroup'])]
    private Collection $subject;

    public function __construct()
    {
        $this->GroupRelation = new ArrayCollection();
        $this->subject = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbGroup(): ?int
    {
        return $this->nbGroup;
    }

    public function setNbGroup(int $nbGroup): static
    {
        $this->nbGroup = $nbGroup;

        return $this;
    }

    /**
     * @return Collection<int, Group>
     */
    public function getGroupRelation(): Collection
    {
        return $this->GroupRelation;
    }

    public function addGroupRelation(Group $groupRelation): static
    {
        if (!$this->GroupRelation->contains($groupRelation)) {
            $this->GroupRelation->add($groupRelation);
        }

        return $this;
    }

    public function removeGroupRelation(Group $groupRelation): static
    {
        $this->GroupRelation->removeElement($groupRelation);

        return $this;
    }

    /**
     * @return Collection<int, Subject>
     */
    public function getSubject(): Collection
    {
        return $this->subject;
    }

    public function addSubject(Subject $subject): static
    {
        if (!$this->subject->contains($subject)) {
            $this->subject->add($subject);
        }

        return $this;
    }

    public function removeSubject(Subject $subject): static
    {
        $this->subject->removeElement($subject);

        return $this;
    }
}
