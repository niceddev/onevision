<?php

namespace App\DTO;

class PostDTO
{
    private ?string $authorName;
    private ?int $id;
    private ?string $title;
    private ?string $body;
    private ?int $userId;
    private ?array $tags;
    private ?int $reactions;

    /**
     * @param string|null $authorName
     * @param int|null $id
     * @param string|null $title
     * @param string|null $body
     * @param int|null $userId
     * @param array|null $tags
     * @param int|null $reactions
     */
    public function __construct(
        string $authorName = null,
        int    $id = null,
        string $title = null,
        string $body = null,
        int    $userId = null,
        array  $tags = null,
        int    $reactions = null,
    )
    {
        $this->authorName = $authorName;
        $this->id = $id;
        $this->title = $title;
        $this->body = $body;
        $this->userId = $userId;
        $this->tags = $tags;
        $this->reactions = $reactions;
    }

    /**
     * @return string|null
     */
    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    /**
     * @param string|null $authorName
     * @return PostDTO
     */
    public function setAuthorName(?string $authorName): self
    {
        $this->authorName = $authorName;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return PostDTO
     */
    public function setId(?int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return PostDTO
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     * @return PostDTO
     */
    public function setBody(?string $body): self
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserId(): ?string
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     * @return PostDTO
     */
    public function setUserId(?int $userId): self
    {
        $this->userId = $userId;
        return $this;
    }

    /**
     * @return array|null
     */
    public function getTags(): ?array
    {
        return $this->tags;
    }

    /**
     * @param array|null $tags
     * @return PostDTO
     */
    public function setTags(?array $tags): self
    {
        $this->tags = $tags;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getReactions(): ?int
    {
        return $this->reactions;
    }

    /**
     * @param int|null $reactions
     * @return PostDTO
     */
    public function setReactions(?int $reactions): self
    {
        $this->reactions = $reactions;
        return $this;
    }

    public function toArray(): array
    {
        return [
            'authorName' => $this->authorName,
            'id'         => $this->id,
            'title'      => $this->title,
            'body'       => $this->body,
            'userId'     => $this->userId,
            'tags'       => $this->tags,
            'reactions'  => $this->reactions,
        ];
    }
}
