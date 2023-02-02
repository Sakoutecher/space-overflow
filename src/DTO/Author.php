<?php

namespace App\DTO;

class Author {
	public function __construct(
		private readonly string $firstName,
		private readonly string $lastName
	) {}

	/**
	 * @return string
	 */
	public function getFirstName(): string {
		return $this->firstName;
	}
	
	/**
	 * @return string
	 */
	public function getLastName(): string {
		return $this->lastName;
	}
}
