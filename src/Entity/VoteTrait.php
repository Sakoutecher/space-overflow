<?php

declare(strict_types=1);

namespace App\Entity;
use Doctrine\ORM\Mapping\Column;

trait VoteTrait {
    #[Column(type: 'integer')]
    private int $votes = 0;

	/**
	 * @return int
	 */
	public function getVotes(): int {
		return $this->votes;
	}
	
	/**
	 * @param int $votes 
	 * @return self
	 */
	public function setVotes(int $votes): self {
		$this->votes = $votes;
		return $this;
	}

    public function upVote(): self {
        $this->votes++;
        return $this;
    }

    public function downVote(): self {
        $this->votes--;
        return $this;
    }
}
