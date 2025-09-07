<?php
require_once(__DIR__ . "/Prioridade.php");
require_once(__DIR__ . "/Categoria.php");

class Item {
    private ?int $id;
    private ?string $nome;
    private ?string $descricao;
    private ?Categoria $categoria; // objeto Categoria
    private ?Prioridade $prioridade; // objeto Prioridade
    private ?float $precoEstimado;
    private ?string $dataDesejo;
    private ?string $urlImagem;
    private ?string $urlWeb;
    private bool $comprado = false; // Adicionando a propriedade 'comprado'

    public function getUrlWeb(): ?string
    {
        return $this->urlWeb;
    }

    /**
     * Set the value of urlWeb
     */
    public function setUrlWeb(?string $urlWeb): self
    {
        $this->urlWeb = $urlWeb;
        return $this;
    }
    /**
     * Get the value of urlImagem
     */
    public function getUrlImagem(): ?string
    {
        return $this->urlImagem;
    }

    /**
     * Set the value of urlImagem
     */
    public function setUrlImagem(?string $urlImagem): self
    {
        $this->urlImagem = $urlImagem;
        return $this;
    }

   

    /**
     * Get the value of comprado
     */
    public function isComprado(): bool {
        return $this->comprado;
    }

    /**
     * Set the value of comprado
     */
    public function setComprado(bool $comprado): self {
        $this->comprado = $comprado;
        return $this;
    }

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
     * Get the value of nome
     */
    public function getNome(): ?string
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     */
    public function setNome(?string $nome): self
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of descricao
     */
    public function getDescricao(): ?string
    {
        return $this->descricao;
    }

    /**
     * Set the value of descricao
     */
    public function setDescricao(?string $descricao): self
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get the value of categoria
     */
    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    /**
     * Set the value of categoria
     */
    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get the value of prioridade
     */
    public function getPrioridade(): ?Prioridade
    {
        return $this->prioridade;
    }

    /**
     * Set the value of prioridade
     */
    public function setPrioridade(?Prioridade $prioridade): self
    {
        $this->prioridade = $prioridade;

        return $this;
    }

    /**
     * Get the value of precoEstimado
     */
    public function getPrecoEstimado(): ?float
    {
        return $this->precoEstimado;
    }

    /**
     * Set the value of precoEstimado
     */
    public function setPrecoEstimado(?float $precoEstimado): self
    {
        $this->precoEstimado = $precoEstimado;

        return $this;
    }

    /**
     * Get the value of dataDesejo
     */
    public function getDataDesejo(): ?string
    {
        return $this->dataDesejo;
    }

    /**
     * Set the value of dataDesejo
     */
    public function setDataDesejo(?string $dataDesejo): self
    {
        $this->dataDesejo = $dataDesejo;

        return $this;
    }
}
