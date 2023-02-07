<?php

namespace App\Entity;

use App\Repository\QuestionRepository;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

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
    private string $title;

    #[ORM\Column(type: 'text')]
    private string $content;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTime $askedAt = null;

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
}