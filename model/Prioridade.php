<?php

class Prioridade {
	private ?int $id;
	private ?string $nivel;

	/**
	 * Get the value of id
	 */
	public function getId(): ?int
	{
		return $this->id;
	}

	/**
	 * Set the value of id
	 */
	public function setId(?int $id): self
	{
		$this->id = $id;
		return $this;
	}

	/**
	 * Get the value of nivel
	 */
	public function getNivel(): ?string
	{
		return $this->nivel;
	}

	/**
	 * Set the value of nivel
	 */
	public function setNivel(?string $nivel): self
	{
		$this->nivel = $nivel;
		return $this;
	}
}
