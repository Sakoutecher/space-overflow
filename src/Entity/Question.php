<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: QuestionRepository::class)]
#[ORM\Table(name: 'questions')]
class Question {
	use VoteTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255, unique: true)]
	#[Gedmo\Slug(fields: ['title'])]
    private string $slug;

    #[ORM\Column(type: 'string', length: 255)]
	#[Assert\Length(min: 10, max: 255)]
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $askedAt = null;

    #[ORM\OneToMany(mappedBy: 'question', targetEntity: Answer::class, orphanRemoval: true)]
    private Collection $answers;

    public function __construct()
    {
        $this->answers = new ArrayCollection();
    }

	/**
	 * @return int
	 */
	public function getId(): int {
                        		return $this->id;
                        	}
	
	/**
	 * @return string
	 */
	public function getSlug(): string {
                        		return $this->slug;
                        	}
	
	/**
	 * @param string $slug 
	 * @return self
	 */
	public function setSlug(string $slug): self {
                        		$this->slug = $slug;
                        		return $this;
                        	}
	
	/**
	 * @return string
	 */
	public function getTitle(): string {
                        		return $this->title;
                        	}
	
	/**
	 * @param string $title 
	 * @return self
	 */
	public function setTitle(string $title): self {
                        		$this->title = $title;
                        		return $this;
                        	}
	
	/**
	 * @return string
	 */
	public function getContent(): string {
                        		return $this->content;
                        	}
	
	/**
	 * @param string $content 
	 * @return self
	 */
	public function setContent(string $content): self {
                        		$this->content = $content;
                        		return $this;
                        	}
	
	/**
	 * @return \DateTime|null
	 */
	public function getAskedAt(): ?\DateTime {
                        		return $this->askedAt;
                        	}
	
	/**
	 * @param \DateTime|null $askedAt 
	 * @return self
	 */
	public function setAskedAt(?\DateTime $askedAt): self {
                        		$this->askedAt = $askedAt;
                        		return $this;
                        	}

    /**
     * @return Collection<int, Answer>
     */
    public function getAnswers(): Collection
    {
        return $this->answers;
    }

    public function addAnswer(Answer $answer): self
    {
        if (!$this->answers->contains($answer)) {
            $this->answers->add($answer);
            $answer->setQuestion($this);
        }

        return $this;
    }

    public function removeAnswer(Answer $answer): self
    {
        if ($this->answers->removeElement($answer)) {
            // set the owning side to null (unless already changed)
            if ($answer->getQuestion() === $this) {
                $answer->setQuestion(null);
            }
        }

        return $this;
    }
}