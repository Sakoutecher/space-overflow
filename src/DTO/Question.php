<?php

namespace App\DTO;

class Question {
    private string $slug;
    private string $title;
    private Author $author;

    public function __construct(string $slug, string $title, Author $author) {
        $this->slug = $slug;
        $this->title = $title;
        $this->author = $author;
    }

	/**
	 * @return string
	 */
	public function getSlug(): string {
		return $this->slug;
	}
	
	/**
	 * @return string
	 */
	public function getTitle(): string {
		return $this->title;
	}
	
	/**
	 * @return string
	 */
	public function getAuthor(): Author {
		return $this->author;
	}
}
